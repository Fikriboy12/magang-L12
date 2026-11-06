<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LaporanHarian;
use App\Models\Absensi;
use App\Models\Sertifikat;
use App\Models\Pendaftaran;
use App\Models\Chat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

class MobileController extends Controller
{
    // ==========================================
    // 🔐 1. LOGIN API (Siswa & Pembimbing)
    // ==========================================
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah.'
            ], 401);
        }

        // Cek apakah rolenya pelamar (siswa/mahasiswa), pembimbing, pembimbing_lapangan, atau orang_tua
        if (!in_array($user->role, ['pelamar', 'pembimbing', 'pembimbing_lapangan', 'orang_tua'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak! Akun Anda tidak memiliki hak akses aplikasi mobile.'
            ], 403);
        }

        // Hapus token lama jika ada (opsional)
        $user->tokens()->delete();

        // Buat token Sanctum baru
        $token = $user->createToken('mobile_token')->plainTextToken;

        $anakData = null;
        if ($user->role === 'orang_tua') {
            $anak = $user->anak;
            if ($anak) {
                $pendaftaranAnak = Pendaftaran::where('id_users', $anak->id)->first();
                $anakData = [
                    'id' => $anak->id,
                    'name' => $anak->name,
                    'email' => $anak->email,
                    'nim' => $anak->nim,
                    'no_telp' => $anak->no_telp,
                    'sekolah' => $pendaftaranAnak->universitas ?? $pendaftaranAnak->asal_sekolah ?? $pendaftaranAnak->asal_kampus ?? '-',
                    'jurusan' => $pendaftaranAnak->jurusan ?? '-',
                    'status_magang' => $pendaftaranAnak->status_pendaftaran ?? 'pengajuan',
                ];
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil!',
            'data' => [
                'token' => $token,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'nim' => $user->nim,
                    'no_telp' => $user->no_telp,
                    'anak' => $anakData,
                ]
            ]
        ]);
    }

    // ==========================================
    // 👤 2. CEK STATUS PENDAFTARAN USER (Siswa)
    // ==========================================
    public function userStatus(Request $request)
    {
        $user = $request->user();
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user,
                'pendaftaran' => $pendaftaran
            ]
        ]);
    }

    // ==========================================
    // 📝 3. LAPORAN HARIAN API (Siswa)
    // ==========================================
    public function getLaporan(Request $request)
    {
        $user = $request->user();
        $laporan = LaporanHarian::where('user_id', $user->id)
                                ->orderBy('tanggal', 'desc')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => $laporan
        ]);
    }

    public function storeLaporan(Request $request)
    {
        $user = $request->user();
        
        $validator = Validator::make($request->all(), [
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string',
            'catatan' => 'nullable|string',
            'foto' => 'required|image|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            
            // Simpan ke folder public/laporan_harian (agar selaras dengan web)
            $foto->move(public_path('laporan_harian'), $namaFoto);
            $fotoPath = 'laporan_harian/' . $namaFoto;
        }

        $laporan = LaporanHarian::create([
            'user_id' => $user->id,
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'catatan' => $request->catatan,
            'foto' => $fotoPath,
            'status' => 'pending' // default pending, menunggu persetujuan pembimbing
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan harian berhasil dikirim!',
            'data' => $laporan
        ], 201);
    }

    // ==========================================
    // ⏰ 4. ABSENSI HARIAN API (Siswa)
    // ==========================================
    public function getAbsensi(Request $request)
    {
        $user = $request->user();
        $hariIni = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        // Cek status pendaftaran magang
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        $statusMagang = $pendaftaran ? strtolower($pendaftaran->status_pendaftaran) : 'pending';

        // 1. Cek apakah sudah absen hari ini
        $absenHariIni = Absensi::where('id_users', $user->id)
                                ->where('tgl_absen', $hariIni)
                                ->first();

        // 2. Ambil history absensi
        $riwayat = Absensi::where('id_users', $user->id)
                           ->orderBy('tgl_absen', 'desc')
                           ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'status_magang' => $statusMagang,
                'sudah_absen' => $absenHariIni ? true : false,
                'absen_hari_ini' => $absenHariIni,
                'riwayat' => $riwayat
            ]
        ]);
    }

    public function absenMasuk(Request $request)
    {
        $user = $request->user();
        $hariIni = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        // Cek status pendaftaran magang
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        if (!$pendaftaran || strtolower($pendaftaran->status_pendaftaran) !== 'diterima') {
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf, Anda belum bisa absen karena status magang belum DITERIMA.'
            ], 403);
        }

        // Cek apakah hari ini sudah absen masuk
        $cekAbsen = Absensi::where('id_users', $user->id)
                            ->where('tgl_absen', $hariIni)
                            ->first();

        if ($cekAbsen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melakukan absen masuk hari ini.'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|max:2048',
            'keterangan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_masuk_' . $file->getClientOriginalName();
            
            // Simpan ke folder public/uploads/absensi (agar selaras dengan web)
            $file->move(public_path('uploads/absensi'), $namaFoto); 
            $fotoPath = 'uploads/absensi/' . $namaFoto;
        }

        $waktuSekarang = Carbon::now('Asia/Jakarta');

        $absen = Absensi::create([
            'id_users' => $user->id,
            'tgl_absen' => $hariIni,
            'jam_masuk' => $waktuSekarang->format('H:i:s'),
            'status' => 'Hadir',
            'foto_bukti' => $fotoPath,
            'lokasi_masuk' => $request->lokasi_masuk, // opsional
            'keterangan' => $request->keterangan,
            'status_validasi' => 'pending'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil absen masuk (WIB)!',
            'data' => $absen
        ], 201);
    }

    public function absenPulang(Request $request, $id)
    {
        $user = $request->user();
        
        $absen = Absensi::where('id', $id)
                        ->where('id_users', $user->id)
                        ->first();

        if (!$absen) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data absensi tidak ditemukan.'
            ], 404);
        }

        if ($absen->jam_keluar) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melakukan absen pulang hari ini.'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_pulang_' . $file->getClientOriginalName();
            
            // Simpan ke folder public/uploads/absensi (agar selaras dengan web)
            $file->move(public_path('uploads/absensi'), $namaFoto);
            $fotoPath = 'uploads/absensi/' . $namaFoto;
        }

        $waktuSekarang = Carbon::now('Asia/Jakarta');

        $absen->update([
            'jam_keluar' => $waktuSekarang->format('H:i:s'),
            'foto_keluar' => $fotoPath,
            'lokasi_keluar' => $request->lokasi_keluar // opsional
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil absen pulang (WIB)! Hati-hati di jalan.',
            'data' => $absen
        ]);
    }

    /**
     * 📱 Scan Dynamic QR Code Absensi Siswa
     * Menerima input:
     * - qr_token (wajib): String token hasil scan QR dari layar Admin
     * - tipe (opsional): 'masuk' atau 'pulang' (jika tidak dikirim, sistem otomatis mendeteksi)
     * - foto (opsional): Foto selfie kehadiran
     * - keterangan (opsional): Catatan kegiatan
     * - lokasi (opsional): Koordinat GPS / Nama lokasi
     */
    public function scanQrAbsensi(Request $request)
    {
        $user = $request->user();
        $rawToken = $request->input('qr_token');

        if (!$rawToken) {
            return response()->json([
                'status' => 'error',
                'message' => 'Token QR tidak ditemukan. Pastikan Anda memindai QR Code yang tampil di layar kantor.'
            ], 422);
        }

        // Ekstrak token jika QR berupa string JSON (misal {"token":"..."})
        $token = trim($rawToken);
        if (str_starts_with($token, '{') && str_ends_with($token, '}')) {
            $json = json_decode($token, true);
            if (isset($json['token'])) {
                $token = $json['token'];
            }
        }

        // 1. Validasi Token QR dari Cache (Anti-Screenshot / Time-based Security)
        $cached = Cache::get('active_attendance_qr_' . $token);
        $nowTimestamp = Carbon::now('Asia/Jakarta')->timestamp;

        if (!$cached || !isset($cached['valid_until']) || $nowTimestamp > $cached['valid_until']) {
            return response()->json([
                'status' => 'error',
                'code' => 'QR_EXPIRED',
                'message' => 'QR Code sudah kedaluwarsa atau tidak valid! Mohon arahkan kamera ke layar monitor kantor dan pindai QR Code terbaru yang sedang tampil.'
            ], 400);
        }

        // 2. Cek status magang user
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        if (!$pendaftaran || strtolower($pendaftaran->status_pendaftaran) !== 'diterima') {
            return response()->json([
                'status' => 'error',
                'message' => 'Maaf, Anda belum bisa melakukan absensi karena status magang Anda belum DITERIMA.'
            ], 403);
        }

        $waktuSekarang = Carbon::now('Asia/Jakarta');
        $hariIni = $waktuSekarang->format('Y-m-d');

        // 3. Simpan foto jika dilampirkan dari kamera APK
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_qr_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/absensi'), $namaFoto);
            $fotoPath = 'uploads/absensi/' . $namaFoto;
        }

        $keteranganInput = $request->input('keterangan', 'Hadir via Scan QR Layar Kantor');
        $lokasiInput = $request->input('lokasi', 'Kantor PT. MEDIA BALAI NUSA (Via QR)');
        $reqTipe = strtolower($request->input('tipe', ''));

        // 4. Cek record absensi hari ini
        $absenHariIni = Absensi::where('id_users', $user->id)
                               ->where('tgl_absen', $hariIni)
                               ->first();

        // KASUS A: BELUM ABSEN MASUK
        if (!$absenHariIni) {
            // Jika siswa memilih mode pulang padahal belum masuk
            if ($reqTipe === 'pulang') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Anda belum melakukan absen masuk hari ini. Silakan pilih absen masuk terlebih dahulu.'
                ], 400);
            }

            $absen = Absensi::create([
                'id_users' => $user->id,
                'tgl_absen' => $hariIni,
                'jam_masuk' => $waktuSekarang->format('H:i:s'),
                'status' => 'Hadir',
                'foto_bukti' => $fotoPath,
                'lokasi_masuk' => $lokasiInput,
                'keterangan' => $keteranganInput,
                'status_validasi' => 'valid'
            ]);

            // Catat log live feed untuk layar Admin
            $this->pushLiveScanFeed($user->name, 'Masuk', $waktuSekarang->format('H:i:s'));

            return response()->json([
                'status' => 'success',
                'tipe' => 'masuk',
                'message' => 'Presensi MASUK berhasil! Tercatat pada pukul ' . $waktuSekarang->format('H:i:s') . ' WIB.',
                'data' => $absen
            ], 200);
        }

        // KASUS B: SUDAH ABSEN MASUK, TAPI BELUM ABSEN PULANG
        if (!$absenHariIni->jam_keluar) {
            // Jika siswa memaksa mode 'masuk' lagi padahal sudah masuk
            if ($reqTipe === 'masuk') {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Anda sudah melakukan absen masuk hari ini pada pukul ' . substr($absenHariIni->jam_masuk, 0, 5) . ' WIB.'
                ], 400);
            }

            // Cegah scan beruntun yang tidak sengaja dalam 2 menit
            $jamMasukCarbon = Carbon::parse($hariIni . ' ' . $absenHariIni->jam_masuk, 'Asia/Jakarta');
            if ($waktuSekarang->diffInMinutes($jamMasukCarbon) < 2) {
                return response()->json([
                    'status' => 'warning',
                    'message' => 'Anda baru saja absen masuk. Absen pulang dapat dilakukan minimal 2 menit setelah absen masuk.'
                ], 400);
            }

            $absenHariIni->update([
                'jam_keluar' => $waktuSekarang->format('H:i:s'),
                'foto_keluar' => $fotoPath ?? $absenHariIni->foto_keluar,
                'lokasi_keluar' => $lokasiInput,
            ]);

            // Catat log live feed untuk layar Admin
            $this->pushLiveScanFeed($user->name, 'Pulang', $waktuSekarang->format('H:i:s'));

            return response()->json([
                'status' => 'success',
                'tipe' => 'pulang',
                'message' => 'Presensi PULANG berhasil! Tercatat pada pukul ' . $waktuSekarang->format('H:i:s') . ' WIB. Hati-hati di jalan!',
                'data' => $absenHariIni
            ], 200);
        }

        // KASUS C: SUDAH SELESAI MASUK DAN PULANG HARI INI
        return response()->json([
            'status' => 'info',
            'message' => 'Anda sudah menyelesaikan absensi masuk (' . substr($absenHariIni->jam_masuk, 0, 5) . ' WIB) dan absen pulang (' . substr($absenHariIni->jam_keluar, 0, 5) . ' WIB) untuk hari ini.',
            'data' => $absenHariIni
        ], 200);
    }

    /**
     * Simpan feed scan langsung ke Cache agar layar Admin bisa menampilkan notifikasi secara instan
     */
    protected function pushLiveScanFeed($nama, $tipe, $jam)
    {
        try {
            $scans = Cache::get('recent_attendance_scans', []);
            if (!is_array($scans)) {
                $scans = [];
            }
            array_unshift($scans, [
                'nama' => $nama,
                'tipe' => $tipe,
                'jam' => $jam,
                'waktu' => Carbon::now('Asia/Jakarta')->format('d M Y - H:i:s')
            ]);
            // Batasi 15 riwayat terbaru
            $scans = array_slice($scans, 0, 15);
            Cache::put('recent_attendance_scans', $scans, 3600);
        } catch (\Exception $e) {
            // Fail gracefully
        }
    }

    // ==========================================
    // 🎓 5. SERTIFIKAT API (Siswa)
    // ==========================================
    public function getSertifikat(Request $request)
    {
        $user = $request->user();
        
        // Ambil riwayat pengajuan sertifikat
        $sertifikat = Sertifikat::where('created_by', $user->id)->first();

        return response()->json([
            'status' => 'success',
            'data' => $sertifikat
        ]);
    }

    public function ajukanSertifikat(Request $request)
    {
        $user = $request->user();

        // 1. Cek apakah magang sudah diterima
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        if (!$pendaftaran || strtolower($pendaftaran->status_pendaftaran) !== 'diterima') {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda tidak dapat mengajukan sertifikat karena status pendaftaran magang Anda belum DITERIMA.'
            ], 403);
        }

        // 2. Cek apakah sudah pernah mengajukan
        $cek = Sertifikat::where('created_by', $user->id)->first();
        if ($cek) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah pernah mengajukan sertifikat.'
            ], 400);
        }

        // 3. Simpan pengajuan sertifikat
        $sertifikat = Sertifikat::create([
            'nama_sertifikat' => 'Pengajuan Sertifikat Magang',
            'status_pengajuan' => 'pending',
            'file_path' => null,
            'created_by' => $user->id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Pengajuan sertifikat berhasil dikirim! Menunggu konfirmasi Admin.',
            'data' => $sertifikat
        ], 201);
    }

    // ==========================================
    // 👨‍🏫 6. PEMBIMBING (MENTOR) API ENDPOINTS
    // ==========================================

    // A. Dashboard Pembimbing (List Mahasiswa Bimbingan & Stats)
    public function getPembimbingDashboard(Request $request)
    {
        $pembimbing = $request->user();

        if ($pembimbing->role !== 'pembimbing') {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak! Anda bukan pembimbing.'
            ], 403);
        }

        // Ambil daftar mahasiswa bimbingan
        $mahasiswaList = User::where('pembimbing_id', $pembimbing->id)
                             ->where('role', 'pelamar')
                             ->get();

        $studentsData = [];
        $totalLaporan = 0;
        $menungguAcc = 0;

        foreach ($mahasiswaList as $mhs) {
            // Laporan Stats
            $laporan = LaporanHarian::where('user_id', $mhs->id)->get();
            $pendingCount = $laporan->where('status', 'pending')->count();
            
            $totalLaporan += $laporan->count();
            $menungguAcc += $pendingCount;

            $studentsData[] = [
                'id' => $mhs->id,
                'name' => $mhs->name,
                'email' => $mhs->email,
                'nim' => $mhs->nim,
                'pending_reports' => $pendingCount,
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'stats' => [
                    'total_mahasiswa' => count($studentsData),
                    'total_laporan' => $totalLaporan,
                    'menunggu_acc' => $menungguAcc,
                ],
                'mahasiswa' => $studentsData
            ]
        ]);
    }

    // B. Detail Laporan Harian Mahasiswa Tertentu
    public function getLaporanMahasiswa(Request $request, $mahasiswa_id)
    {
        $pembimbing = $request->user();

        if ($pembimbing->role !== 'pembimbing') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        // Keamanan: Cek apakah mahasiswa ini dibimbing oleh pembimbing yang login
        $mahasiswa = User::where('id', $mahasiswa_id)
                         ->where('pembimbing_id', $pembimbing->id)
                         ->first();

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mahasiswa tidak ditemukan atau Anda tidak membimbing mahasiswa ini.'
            ], 404);
        }

        $laporan = LaporanHarian::where('user_id', $mahasiswa_id)
                                ->orderBy('tanggal', 'desc')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'mahasiswa' => $mahasiswa,
                'laporan' => $laporan
            ]
        ]);
    }

    // C. Approve Laporan Harian
    public function approveLaporan(Request $request, $id)
    {
        $pembimbing = $request->user();

        if ($pembimbing->role !== 'pembimbing') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        $laporan = LaporanHarian::find($id);

        if (!$laporan) {
            return response()->json(['status' => 'error', 'message' => 'Laporan tidak ditemukan.'], 404);
        }

        // Cek apakah mahasiswa ini bimbingan dia
        $mhs = User::find($laporan->user_id);
        if (!$mhs || $mhs->pembimbing_id !== $pembimbing->id) {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak untuk laporan ini.'], 403);
        }

        $laporan->update([
            'status' => 'approved',
            'catatan' => $request->catatan // opsional catatan
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil disetujui (Approved)!',
            'data' => $laporan
        ]);
    }

    // D. Reject Laporan Harian
    public function rejectLaporan(Request $request, $id)
    {
        $pembimbing = $request->user();

        if ($pembimbing->role !== 'pembimbing') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        $laporan = LaporanHarian::find($id);

        if (!$laporan) {
            return response()->json(['status' => 'error', 'message' => 'Laporan tidak ditemukan.'], 404);
        }

        // Cek apakah mahasiswa ini bimbingan dia
        $mhs = User::find($laporan->user_id);
        if (!$mhs || $mhs->pembimbing_id !== $pembimbing->id) {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak untuk laporan ini.'], 403);
        }

        $laporan->update([
            'status' => 'rejected',
            'catatan' => $request->catatan // opsional catatan
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Laporan berhasil ditolak (Rejected).',
            'data' => $laporan
        ]);
    }

    // E. List Monitoring Absensi
    public function getMonitoringAbsensi(Request $request)
    {
        $pembimbing = $request->user();

        if ($pembimbing->role !== 'pembimbing') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        // Ambil daftar mahasiswa bimbingan yang diterima
        $students = User::where('pembimbing_id', $pembimbing->id)
                        ->where('role', 'pelamar')
                        ->get();

        $attendanceData = [];
        $hariIni = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        foreach ($students as $mhs) {
            $absenHariIni = Absensi::where('id_users', $mhs->id)
                                    ->where('tgl_absen', $hariIni)
                                    ->first();

            $attendanceData[] = [
                'id' => $mhs->id,
                'name' => $mhs->name,
                'email' => $mhs->email,
                'nim' => $mhs->nim,
                'sudah_absen' => $absenHariIni ? true : false,
                'absen_hari_ini' => $absenHariIni
            ];
        }

        return response()->json([
            'status' => 'success',
            'data' => $attendanceData
        ]);
    }

    // F. Detail Absensi Mahasiswa Tertentu
    public function getAbsensiDetailMahasiswa(Request $request, $mahasiswa_id)
    {
        $pembimbing = $request->user();

        if ($pembimbing->role !== 'pembimbing') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        // Cek bimbingan
        $mahasiswa = User::where('id', $mahasiswa_id)
                         ->where('pembimbing_id', $pembimbing->id)
                         ->first();

        if (!$mahasiswa) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mahasiswa tidak ditemukan atau Anda tidak membimbing mahasiswa ini.'
            ], 404);
        }

        $riwayat = Absensi::where('id_users', $mahasiswa_id)
                          ->orderBy('tgl_absen', 'desc')
                          ->get();

        return response()->json([
            'status' => 'success',
            'data' => [
                'mahasiswa' => $mahasiswa,
                'riwayat' => $riwayat
            ]
        ]);
    }

    // G. Update Profile (Siswa & Pembimbing)
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'nim' => 'nullable|string|max:50',
            'no_telp' => 'nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'nim' => $request->nim,
            'no_telp' => $request->no_telp,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil diperbarui!',
            'data' => $user
        ]);
    }

    // H. Change Password (Siswa & Pembimbing)
    public function changePassword(Request $request)
    {
        $user = $request->user();
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()
            ], 422);
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Password lama salah.'
            ], 400);
        }

        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah!'
        ]);
    }

    // ==========================================
    // 👨‍👩‍👧 8. FITUR KHUSUS ROLE ORANG TUA / WALI (MOBILE)
    // ==========================================

    /**
     * Dashboard Utama Orang Tua: Data Anak, Statistik Kehadiran & Laporan, Aktivitas Terbaru
     */
    public function getOrangTuaDashboard(Request $request)
    {
        $orangTua = $request->user();

        if ($orangTua->role !== 'orang_tua') {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak! Anda bukan pengguna dengan role Orang Tua.'
            ], 403);
        }

        $anak = $orangTua->anak;
        if (!$anak) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akun Orang Tua ini belum dihubungkan dengan data siswa magang.'
            ], 404);
        }

        $pendaftaran = Pendaftaran::where('id_users', $anak->id)->first();
        $pembimbing = $anak->pembimbing_id ? User::find($anak->pembimbing_id) : null;

        // Statistik Absensi Anak
        $absensiAll = Absensi::where('id_users', $anak->id)->get();
        $totalHadir = $absensiAll->where('status', 'Hadir')->count();
        $totalIzin = $absensiAll->where('status', 'Izin')->count();
        $totalSakit = $absensiAll->where('status', 'Sakit')->count();
        $totalAlfa = $absensiAll->whereIn('status', ['Alfa', 'Alpa'])->count();

        $hariIni = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $absenHariIni = $absensiAll->where('tgl_absen', $hariIni)->first();

        $statusHariIni = 'Belum Ada Presensi';
        if ($absenHariIni) {
            if ($absenHariIni->status === 'Hadir') {
                if ($absenHariIni->jam_keluar) {
                    $statusHariIni = 'Selesai Magang (Masuk: ' . substr($absenHariIni->jam_masuk, 0, 5) . ', Pulang: ' . substr($absenHariIni->jam_keluar, 0, 5) . ' WIB)';
                } else {
                    $statusHariIni = 'Sedang Magang (Masuk: ' . substr($absenHariIni->jam_masuk, 0, 5) . ' WIB)';
                }
            } else {
                $statusHariIni = $absenHariIni->status . ($absenHariIni->keterangan ? ' - ' . $absenHariIni->keterangan : '');
            }
        }

        // Statistik Laporan Harian Anak
        $laporanAll = LaporanHarian::where('user_id', $anak->id)->get();
        $totalLaporan = $laporanAll->count();
        $laporanApproved = $laporanAll->where('status', 'approved')->count();
        $laporanPending = $laporanAll->where('status', 'pending')->count();
        $laporanRejected = $laporanAll->where('status', 'rejected')->count();

        // 5 Absensi Terbaru Anak
        $absensiTerbaru = Absensi::where('id_users', $anak->id)
            ->orderBy('tgl_absen', 'desc')
            ->take(5)
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'tanggal' => $row->tgl_absen,
                    'tanggal_formatted' => Carbon::parse($row->tgl_absen)->translatedFormat('l, d F Y'),
                    'jam_masuk' => $row->jam_masuk ? substr($row->jam_masuk, 0, 5) : '-',
                    'jam_keluar' => $row->jam_keluar ? substr($row->jam_keluar, 0, 5) : '-',
                    'status' => $row->status,
                    'keterangan' => $row->keterangan,
                    'foto_masuk_url' => $row->foto_bukti ? url($row->foto_bukti) : null,
                    'foto_keluar_url' => $row->foto_keluar ? url($row->foto_keluar) : null,
                ];
            });

        // 5 Laporan Terbaru Anak
        $laporanTerbaru = LaporanHarian::where('user_id', $anak->id)
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get()
            ->map(function ($lap) {
                return [
                    'id' => $lap->id,
                    'tanggal' => $lap->tanggal,
                    'tanggal_formatted' => Carbon::parse($lap->tanggal)->translatedFormat('l, d F Y'),
                    'kegiatan' => $lap->kegiatan,
                    'catatan' => $lap->catatan,
                    'status' => $lap->status,
                    'foto_url' => $lap->foto ? url($lap->foto) : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => [
                'orang_tua' => [
                    'id' => $orangTua->id,
                    'name' => $orangTua->name,
                    'email' => $orangTua->email,
                    'role' => $orangTua->role,
                ],
                'anak' => [
                    'id' => $anak->id,
                    'name' => $anak->name,
                    'email' => $anak->email,
                    'nim' => $anak->nim,
                    'no_telp' => $anak->no_telp,
                    'sekolah' => $pendaftaran->universitas ?? $pendaftaran->asal_sekolah ?? $pendaftaran->asal_kampus ?? '-',
                    'jurusan' => $pendaftaran->jurusan ?? '-',
                    'kelas' => $pendaftaran->kelas ?? '-',
                    'status_magang' => $pendaftaran->status_pendaftaran ?? 'pengajuan',
                    'tanggal_mulai' => $pendaftaran->tanggal_mulai ?? '-',
                    'tanggal_selesai' => $pendaftaran->tanggal_selesai ?? '-',
                    'guru_pembimbing' => $pembimbing ? [
                        'name' => $pembimbing->name,
                        'email' => $pembimbing->email,
                        'no_telp' => $pembimbing->no_telp,
                    ] : null,
                ],
                'stats' => [
                    'kehadiran' => [
                        'total_hadir' => $totalHadir,
                        'total_izin' => $totalIzin,
                        'total_sakit' => $totalSakit,
                        'total_alfa' => $totalAlfa,
                        'status_hari_ini' => $statusHariIni,
                    ],
                    'laporan' => [
                        'total_laporan' => $totalLaporan,
                        'disetujui' => $laporanApproved,
                        'menunggu' => $laporanPending,
                        'ditolak' => $laporanRejected,
                    ],
                ],
                'absensi_terbaru' => $absensiTerbaru,
                'laporan_terbaru' => $laporanTerbaru,
            ]
        ]);
    }

    /**
     * Monitoring Seluruh Riwayat Absensi / Kehadiran Anak
     */
    public function getOrangTuaAbsensi(Request $request)
    {
        $orangTua = $request->user();

        if ($orangTua->role !== 'orang_tua') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        $anak = $orangTua->anak;
        if (!$anak) {
            return response()->json(['status' => 'error', 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $riwayat = Absensi::where('id_users', $anak->id)
            ->orderBy('tgl_absen', 'desc')
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'tanggal' => $row->tgl_absen,
                    'tanggal_formatted' => Carbon::parse($row->tgl_absen)->translatedFormat('l, d F Y'),
                    'jam_masuk' => $row->jam_masuk ? substr($row->jam_masuk, 0, 5) : '-',
                    'jam_keluar' => $row->jam_keluar ? substr($row->jam_keluar, 0, 5) : '-',
                    'status' => $row->status,
                    'keterangan' => $row->keterangan,
                    'foto_masuk_url' => $row->foto_bukti ? url($row->foto_bukti) : null,
                    'foto_keluar_url' => $row->foto_keluar ? url($row->foto_keluar) : null,
                    'lokasi_masuk' => $row->lokasi_masuk,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => [
                'anak' => [
                    'id' => $anak->id,
                    'name' => $anak->name,
                    'nim' => $anak->nim,
                ],
                'total_hari' => $riwayat->count(),
                'total_hadir' => $riwayat->where('status', 'Hadir')->count(),
                'total_izin' => $riwayat->where('status', 'Izin')->count(),
                'total_sakit' => $riwayat->where('status', 'Sakit')->count(),
                'total_alfa' => $riwayat->whereIn('status', ['Alfa', 'Alpa'])->count(),
                'riwayat' => $riwayat,
            ]
        ]);
    }

    /**
     * Monitoring Seluruh Laporan Harian Anak
     */
    public function getOrangTuaLaporan(Request $request)
    {
        $orangTua = $request->user();

        if ($orangTua->role !== 'orang_tua') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        $anak = $orangTua->anak;
        if (!$anak) {
            return response()->json(['status' => 'error', 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $laporan = LaporanHarian::where('user_id', $anak->id)
            ->orderBy('tanggal', 'desc')
            ->get()
            ->map(function ($lap) {
                return [
                    'id' => $lap->id,
                    'tanggal' => $lap->tanggal,
                    'tanggal_formatted' => Carbon::parse($lap->tanggal)->translatedFormat('l, d F Y'),
                    'kegiatan' => $lap->kegiatan,
                    'catatan' => $lap->catatan,
                    'status' => $lap->status,
                    'foto_url' => $lap->foto ? url($lap->foto) : null,
                    'created_at' => $lap->created_at ? $lap->created_at->format('Y-m-d H:i') : null,
                ];
            });

        return response()->json([
            'status' => 'success',
            'data' => [
                'anak' => [
                    'id' => $anak->id,
                    'name' => $anak->name,
                    'nim' => $anak->nim,
                ],
                'total_laporan' => $laporan->count(),
                'disetujui' => $laporan->where('status', 'approved')->count(),
                'pending' => $laporan->where('status', 'pending')->count(),
                'ditolak' => $laporan->where('status', 'rejected')->count(),
                'laporan' => $laporan,
            ]
        ]);
    }

    /**
     * Detail Satu Laporan Harian Anak
     */
    public function getOrangTuaLaporanDetail(Request $request, $id)
    {
        $orangTua = $request->user();

        if ($orangTua->role !== 'orang_tua') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        $anak = $orangTua->anak;
        if (!$anak) {
            return response()->json(['status' => 'error', 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $laporan = LaporanHarian::where('id', $id)
            ->where('user_id', $anak->id)
            ->first();

        if (!$laporan) {
            return response()->json(['status' => 'error', 'message' => 'Laporan tidak ditemukan atau bukan milik anak Anda.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $laporan->id,
                'tanggal' => $laporan->tanggal,
                'tanggal_formatted' => Carbon::parse($laporan->tanggal)->translatedFormat('l, d F Y'),
                'kegiatan' => $laporan->kegiatan,
                'catatan' => $laporan->catatan,
                'status' => $laporan->status,
                'foto_url' => $laporan->foto ? url($laporan->foto) : null,
                'created_at' => $laporan->created_at ? $laporan->created_at->format('Y-m-d H:i') : null,
            ]
        ]);
    }

    /**
     * Profil Lengkap Siswa/Anak yang Diasuh
     */
    public function getOrangTuaProfilAnak(Request $request)
    {
        $orangTua = $request->user();

        if ($orangTua->role !== 'orang_tua') {
            return response()->json(['status' => 'error', 'message' => 'Akses ditolak!'], 403);
        }

        $anak = $orangTua->anak;
        if (!$anak) {
            return response()->json(['status' => 'error', 'message' => 'Data anak tidak ditemukan.'], 404);
        }

        $pendaftaran = Pendaftaran::where('id_users', $anak->id)->first();
        $pembimbing = $anak->pembimbing_id ? User::find($anak->pembimbing_id) : null;

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $anak->id,
                'nama_anak' => $anak->name,
                'email_anak' => $anak->email,
                'nis_nim' => $anak->nim,
                'no_telp_anak' => $anak->no_telp,
                'sekolah' => $pendaftaran->universitas ?? $pendaftaran->asal_sekolah ?? $pendaftaran->asal_kampus ?? '-',
                'jurusan' => $pendaftaran->jurusan ?? '-',
                'kelas' => $pendaftaran->kelas ?? '-',
                'status_magang' => $pendaftaran->status_pendaftaran ?? 'pengajuan',
                'tanggal_mulai' => $pendaftaran->tanggal_mulai ?? '-',
                'tanggal_selesai' => $pendaftaran->tanggal_selesai ?? '-',
                'guru_pembimbing' => $pembimbing ? [
                    'name' => $pembimbing->name,
                    'email' => $pembimbing->email,
                    'no_telp' => $pembimbing->no_telp,
                ] : null,
                'orang_tua' => [
                    'nama_wali' => $orangTua->name,
                    'email_wali' => $orangTua->email,
                    'no_telp_wali' => $orangTua->no_telp,
                ]
            ]
        ]);
    }

    // =========================================================================
    // 🏭 RUTE KHUSUS MOBILE: PEMBIMBING LAPANGAN (INDUSTRI)
    // =========================================================================
    protected function getMentorSiswaIds(User $mentor)
    {
        $siswaIds = User::where('role', 'pelamar')
                        ->where('pembimbing_lapangan_id', $mentor->id)
                        ->pluck('id')
                        ->toArray();

        if (empty($siswaIds)) {
            $siswaIds = Pendaftaran::where('status_pendaftaran', 'diterima')->pluck('id_users')->toArray();
        }

        return $siswaIds;
    }

    public function getPembimbingLapanganDashboard(Request $request)
    {
        $mentor = $request->user();
        if ($mentor->role !== 'pembimbing_lapangan') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $siswaIds = $this->getMentorSiswaIds($mentor);
        $today = Carbon::today()->toDateString();

        $totalSiswa = count($siswaIds);
        $pendingLaporan = LaporanHarian::whereIn('user_id', $siswaIds)->where('status', 'pending')->count();
        $pendingIzin = Absensi::whereIn('id_users', $siswaIds)
                                ->whereIn('status', ['Izin', 'Sakit'])
                                ->where(function($q) {
                                    $q->whereNull('status_validasi')->orWhere('status_validasi', 'pending');
                                })->count();
        $pengajuanSertifikat = Sertifikat::whereIn('created_by', $siswaIds)
                                         ->whereIn('status_pengajuan', ['pending', 'menunggu_verifikasi'])
                                         ->count();
        $unreadChats = Chat::where('receiver_id', $mentor->id)->where('is_read', false)->count();

        $hadirToday = Absensi::whereIn('id_users', $siswaIds)->whereDate('tgl_absen', $today)->where('status', 'Hadir')->count();

        return response()->json([
            'status' => 'success',
            'data' => [
                'total_siswa' => $totalSiswa,
                'pending_laporan' => $pendingLaporan,
                'pending_izin' => $pendingIzin,
                'pengajuan_sertifikat' => $pengajuanSertifikat,
                'unread_chats' => $unreadChats,
                'hadir_hari_ini' => $hadirToday,
            ]
        ]);
    }

    public function getPembimbingLapanganSiswa(Request $request)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $siswa = User::whereIn('id', $siswaIds)->with('pendaftaran')->get();

        return response()->json([
            'status' => 'success',
            'data' => $siswa
        ]);
    }

    public function getPembimbingLapanganIzin(Request $request)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $izin = Absensi::whereIn('id_users', $siswaIds)
                        ->whereIn('status', ['Izin', 'Sakit'])
                        ->with('user')
                        ->latest('tgl_absen')
                        ->get();

        return response()->json([
            'status' => 'success',
            'data' => $izin
        ]);
    }

    public function approveIzinMobile(Request $request, $id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $absensi = Absensi::whereIn('id_users', $siswaIds)->findOrFail($id);
        $absensi->update(['status_validasi' => 'valid']);

        return response()->json(['status' => 'success', 'message' => 'Izin berhasil disetujui (ACC).']);
    }

    public function rejectIzinMobile(Request $request, $id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $absensi = Absensi::whereIn('id_users', $siswaIds)->findOrFail($id);
        $absensi->update([
            'status_validasi' => 'rejected',
            'keterangan' => ($absensi->keterangan ?? '') . ($request->alasan ? ' [Ditolak: ' . $request->alasan . ']' : ' [Ditolak]')
        ]);

        return response()->json(['status' => 'success', 'message' => 'Izin berhasil ditolak.']);
    }

    public function getPembimbingLapanganLaporan(Request $request)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $laporan = LaporanHarian::whereIn('user_id', $siswaIds)
                                ->with('user')
                                ->latest('tanggal')
                                ->get();

        return response()->json([
            'status' => 'success',
            'data' => $laporan
        ]);
    }

    public function approveLaporanMobile(Request $request, $id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $laporan = LaporanHarian::whereIn('user_id', $siswaIds)->findOrFail($id);
        $laporan->update([
            'status' => 'approved',
            'catatan' => $request->catatan ?? $laporan->catatan
        ]);

        return response()->json(['status' => 'success', 'message' => 'Laporan harian berhasil di-ACC.']);
    }

    public function rejectLaporanMobile(Request $request, $id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $laporan = LaporanHarian::whereIn('user_id', $siswaIds)->findOrFail($id);
        $laporan->update([
            'status' => 'rejected',
            'catatan' => $request->catatan ?? 'Perlu perbaikan.'
        ]);

        return response()->json(['status' => 'success', 'message' => 'Laporan harian ditolak untuk revisi.']);
    }

    public function getPembimbingLapanganAbsensi(Request $request)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);
        $date = $request->get('tanggal', Carbon::today()->toDateString());

        $absensi = Absensi::whereIn('id_users', $siswaIds)
                          ->whereDate('tgl_absen', $date)
                          ->with('user')
                          ->get();

        return response()->json([
            'status' => 'success',
            'date' => $date,
            'data' => $absensi
        ]);
    }

    public function getPembimbingLapanganAbsensiDetail(Request $request, $siswa_id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        if (!in_array($siswa_id, $siswaIds)) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $absensi = Absensi::where('id_users', $siswa_id)->latest('tgl_absen')->get();

        return response()->json([
            'status' => 'success',
            'data' => $absensi
        ]);
    }

    public function getPembimbingLapanganSertifikat(Request $request)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $sertifikat = Sertifikat::whereIn('created_by', $siswaIds)->with('user')->latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $sertifikat
        ]);
    }

    public function approveSertifikatMobile(Request $request, $id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $sertifikat = Sertifikat::whereIn('created_by', $siswaIds)->findOrFail($id);
        $sertifikat->update(['status_pengajuan' => 'disetujui']);

        return response()->json(['status' => 'success', 'message' => 'Pengajuan sertifikat disetujui (ACC).']);
    }

    public function rejectSertifikatMobile(Request $request, $id)
    {
        $mentor = $request->user();
        $siswaIds = $this->getMentorSiswaIds($mentor);

        $sertifikat = Sertifikat::whereIn('created_by', $siswaIds)->findOrFail($id);
        $sertifikat->update(['status_pengajuan' => 'ditolak']);

        return response()->json(['status' => 'success', 'message' => 'Pengajuan sertifikat ditolak.']);
    }

    // ==========================================
    // 💬 API CHAT MOBILE (GENERAL)
    // ==========================================
    public function getChatMessages(Request $request, $partner_id)
    {
        $currentUser = $request->user();

        // Tandai pesan terbaca
        Chat::where('sender_id', $partner_id)
            ->where('receiver_id', $currentUser->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = Chat::where(function($q) use ($currentUser, $partner_id) {
            $q->where('sender_id', $currentUser->id)->where('receiver_id', $partner_id);
        })->orWhere(function($q) use ($currentUser, $partner_id) {
            $q->where('sender_id', $partner_id)->where('receiver_id', $currentUser->id);
        })->orderBy('created_at', 'asc')->get();

        return response()->json([
            'status' => 'success',
            'current_user_id' => $currentUser->id,
            'data' => $messages->map(function($m) use ($currentUser) {
                return [
                    'id' => $m->id,
                    'is_mine' => $m->sender_id === $currentUser->id,
                    'message' => $m->message,
                    'attachment' => $m->attachment ? asset('uploads/chat/' . $m->attachment) : null,
                    'time' => Carbon::parse($m->created_at)->format('H:i'),
                    'date' => Carbon::parse($m->created_at)->toDateString(),
                ];
            })
        ]);
    }

    public function sendChatMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required_without:attachment|nullable|string',
            'attachment' => 'nullable|file|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validator->errors()], 422);
        }

        $currentUser = $request->user();
        $attachmentName = null;

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $attachmentName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/chat');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $attachmentName);
        }

        $chat = Chat::create([
            'sender_id' => $currentUser->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message ?? '',
            'attachment' => $attachmentName,
            'is_read' => false,
        ]);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $chat->id,
                'is_mine' => true,
                'message' => $chat->message,
                'attachment' => $chat->attachment ? asset('uploads/chat/' . $chat->attachment) : null,
                'time' => Carbon::parse($chat->created_at)->format('H:i'),
            ]
        ]);
    }
}
