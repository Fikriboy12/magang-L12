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
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

        // Cek apakah rolenya pelamar (siswa/mahasiswa) atau pembimbing
        if (!in_array($user->role, ['pelamar', 'pembimbing'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Akses ditolak! Hanya siswa atau pembimbing magang yang dapat login.'
            ], 403);
        }

        // Hapus token lama jika ada (opsional)
        $user->tokens()->delete();

        // Buat token Sanctum baru
        $token = $user->createToken('mobile_token')->plainTextToken;

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
}
