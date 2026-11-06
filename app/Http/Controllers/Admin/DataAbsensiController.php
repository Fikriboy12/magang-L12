<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DataAbsensiController extends Controller
{
    // HALAMAN REKAP & MONITORING SISWA
    public function index()
    {
        $mahasiswa = Pendaftaran::with('user')
                        ->where('status_pendaftaran', 'diterima')
                        ->get();

        return view('admin.absensi.index', compact('mahasiswa'));
    }

    // DETAIL RIWAYAT ABSENSI PER SISWA
    public function detail($id_user)
    {
        $user = User::findOrFail($id_user);
        
        $riwayat = Absensi::where('id_users', $id_user)
                          ->orderBy('tgl_absen', 'desc')
                          ->get();

        return view('admin.absensi.detail', compact('user', 'riwayat'));
    }

    // PUSAT PRESENSI ENTERPRISE (ALA EDLINK): TAB QR DINAMIS & TAB MANUAL INPUT
    public function portal(Request $request)
    {
        $defaultTab = $request->is('*qr*') ? 'qr' : 'manual';
        $activeTab = $request->input('tab', $defaultTab);
        $tanggal = $request->input('date', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
        $carbonDate = Carbon::parse($tanggal, 'Asia/Jakarta');

        // Ambil semua mahasiswa magang yang diterima
        $mahasiswa = Pendaftaran::with('user')
                        ->where('status_pendaftaran', 'diterima')
                        ->get();

        // Ambil data absensi yang sudah tercatat pada tanggal tersebut
        $existingAbsensi = Absensi::where('tgl_absen', $tanggal)
                                  ->get()
                                  ->keyBy('id_users');

        // Hitung statistik
        $totalSiswa = $mahasiswa->count();
        $totalHadir = 0;
        $totalIzin = 0;
        $totalSakit = 0;
        $totalAlfa = 0;

        foreach ($mahasiswa as $m) {
            $absen = $existingAbsensi->get($m->id_users);
            if ($absen) {
                $st = strtolower($absen->status);
                if ($st === 'hadir') $totalHadir++;
                elseif ($st === 'izin') $totalIzin++;
                elseif ($st === 'sakit') $totalSakit++;
                elseif (in_array($st, ['alfa', 'alpa'])) $totalAlfa++;
            }
        }
        $totalBelum = $totalSiswa - ($totalHadir + $totalIzin + $totalSakit + $totalAlfa);

        $stats = [
            'total' => $totalSiswa,
            'hadir' => $totalHadir,
            'izin' => $totalIzin,
            'sakit' => $totalSakit,
            'alfa' => $totalAlfa,
            'belum' => max(0, $totalBelum),
        ];

        return view('admin.absensi.portal', compact('mahasiswa', 'existingAbsensi', 'tanggal', 'carbonDate', 'stats', 'activeTab'));
    }

    // AJAX API: AMBIL DATA PRESENSI MANUAL BERDASARKAN TANGGAL TERTENTU
    public function getManualData(Request $request)
    {
        $tanggal = $request->input('date', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
        $carbonDate = Carbon::parse($tanggal, 'Asia/Jakarta');

        $mahasiswa = Pendaftaran::with('user')
                        ->where('status_pendaftaran', 'diterima')
                        ->get();

        $existingAbsensi = Absensi::where('tgl_absen', $tanggal)
                                  ->get()
                                  ->keyBy('id_users');

        $items = [];
        $totalHadir = 0;
        $totalIzin = 0;
        $totalSakit = 0;
        $totalAlfa = 0;

        foreach ($mahasiswa as $m) {
            $absen = $existingAbsensi->get($m->id_users);
            $status = $absen ? $absen->status : '';
            $stLower = strtolower($status);
            
            if ($stLower === 'hadir') $totalHadir++;
            elseif ($stLower === 'izin') $totalIzin++;
            elseif ($stLower === 'sakit') $totalSakit++;
            elseif (in_array($stLower, ['alfa', 'alpa'])) $totalAlfa++;

            $items[] = [
                'user_id' => $m->id_users,
                'name' => $m->user->name ?? 'Mahasiswa',
                'email' => $m->user->email ?? '-',
                'sekolah' => $m->universitas ?? $m->asal_sekolah ?? $m->asal_kampus ?? '-',
                'nim_nis' => $m->nim ?? $m->nisn ?? $m->nis ?? '-',
                'status' => $status,
                'jam_masuk' => $absen ? substr($absen->jam_masuk, 0, 5) : '08:00',
                'jam_keluar' => $absen ? substr($absen->jam_keluar, 0, 5) : '17:00',
                'keterangan' => $absen ? ($absen->keterangan ?? '') : '',
                'sumber' => $absen ? ($absen->foto_bukti ? 'QR Mobile' : 'Manual Admin') : '-'
            ];
        }

        $totalSiswa = count($items);
        $totalBelum = $totalSiswa - ($totalHadir + $totalIzin + $totalSakit + $totalAlfa);

        return response()->json([
            'status' => 'success',
            'tanggal' => $tanggal,
            'tanggal_formatted' => $carbonDate->translatedFormat('l, d F Y'),
            'stats' => [
                'total' => $totalSiswa,
                'hadir' => $totalHadir,
                'izin' => $totalIzin,
                'sakit' => $totalSakit,
                'alfa' => $totalAlfa,
                'belum' => max(0, $totalBelum),
            ],
            'items' => $items
        ]);
    }

    // AJAX API: SIMPAN / PERBARUI PRESENSI MANUAL
    public function storeManual(Request $request)
    {
        $tanggal = $request->input('tanggal', Carbon::now('Asia/Jakarta')->format('Y-m-d'));
        $attendances = $request->input('attendances', []);

        if (empty($attendances) || !is_array($attendances)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada data presensi yang dikirim.'
            ], 422);
        }

        $savedCount = 0;
        $now = Carbon::now('Asia/Jakarta');

        foreach ($attendances as $item) {
            $userId = $item['user_id'] ?? null;
            $status = $item['status'] ?? null;

            if (!$userId || !$status) {
                continue;
            }

            // Normalisasi status
            $validStatuses = ['Hadir', 'Izin', 'Sakit', 'Alfa'];
            $matchedStatus = 'Hadir';
            foreach ($validStatuses as $vs) {
                if (strcasecmp($status, $vs) === 0) {
                    $matchedStatus = $vs;
                    break;
                }
            }

            $jamMasuk = ($matchedStatus === 'Hadir') 
                ? (!empty($item['jam_masuk']) ? $item['jam_masuk'] : '08:00:00') 
                : '00:00:00';
            $jamKeluar = ($matchedStatus === 'Hadir') 
                ? (!empty($item['jam_keluar']) ? $item['jam_keluar'] : null) 
                : null;
            $keterangan = $item['keterangan'] ?? ('Presensi manual (' . $matchedStatus . ') oleh Admin');

            // Format jam jika hanya HH:mm
            if ($jamMasuk && strlen($jamMasuk) === 5) {
                $jamMasuk .= ':00';
            }
            if ($jamKeluar && strlen($jamKeluar) === 5) {
                $jamKeluar .= ':00';
            }

            $absen = Absensi::updateOrCreate(
                [
                    'id_users' => $userId,
                    'tgl_absen' => $tanggal,
                ],
                [
                    'status' => $matchedStatus,
                    'jam_masuk' => $jamMasuk,
                    'jam_keluar' => $jamKeluar,
                    'keterangan' => $keterangan,
                    'lokasi_masuk' => 'Manual Input (Admin Web)',
                    'status_validasi' => 'valid',
                ]
            );

            // Jika hari ini dan status Hadir, simpan ke live feed juga
            if ($tanggal === $now->format('Y-m-d')) {
                $user = User::find($userId);
                if ($user) {
                    $this->pushLiveFeed($user->name, $matchedStatus, $jamMasuk ?: $now->format('H:i:s'));
                }
            }

            $savedCount++;
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil menyimpan presensi manual untuk ' . $savedCount . ' siswa pada tanggal ' . Carbon::parse($tanggal)->translatedFormat('d F Y') . '!'
        ]);
    }

    // AJAX API: GENERATOR DYNAMIC QR TOKEN (BERUBAH TIAP 20 DETIK)
    public function getQrToken()
    {
        $now = Carbon::now('Asia/Jakarta');
        $interval = 20; // 20 detik
        
        $token = 'MBN-QR-' . strtoupper(Str::random(10)) . '-' . $now->timestamp;
        
        Cache::put('active_attendance_qr_' . $token, [
            'token' => $token,
            'created_at' => $now->timestamp,
            'expires_at' => $now->timestamp + $interval,
            'valid_until' => $now->timestamp + $interval + 15,
        ], 40);

        Cache::put('current_active_qr_token', $token, 40);

        $qrPayload = json_encode([
            'app' => 'magang-mbn',
            'type' => 'dynamic_attendance_qr',
            'token' => $token,
            'ts' => $now->timestamp
        ]);

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'qr_payload' => $qrPayload,
            'interval' => $interval,
            'server_time' => $now->format('H:i:s'),
            'date_formatted' => $now->translatedFormat('l, d F Y')
        ]);
    }

    // AJAX API: LIVE FEED PEMINDAIAN
    public function getRecentScans()
    {
        $scans = Cache::get('recent_attendance_scans', []);
        return response()->json([
            'status' => 'success',
            'scans' => $scans
        ]);
    }

    // Helper Push Live Feed
    protected function pushLiveFeed($nama, $tipe, $jam)
    {
        try {
            $scans = Cache::get('recent_attendance_scans', []);
            if (!is_array($scans)) $scans = [];
            array_unshift($scans, [
                'nama' => $nama,
                'tipe' => $tipe,
                'jam' => $jam,
                'waktu' => Carbon::now('Asia/Jakarta')->format('d M Y - H:i:s')
            ]);
            $scans = array_slice($scans, 0, 15);
            Cache::put('recent_attendance_scans', $scans, 3600);
        } catch (\Exception $e) {}
    }
}
