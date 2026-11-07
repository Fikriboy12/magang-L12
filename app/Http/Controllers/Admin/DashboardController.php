<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Absensi;
use App\Models\LaporanHarian;
use App\Models\Sertifikat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $today = Carbon::today()->toDateString();

        // 1. STATISTIK UTAMA
        $totalPelamar = User::whereRaw('LOWER(role) = ?', ['pelamar'])->count();
        $totalDiterima = Pendaftaran::where('status_pendaftaran', 'diterima')->count();
        $totalPengajuan = Pendaftaran::where('status_pendaftaran', 'pengajuan')->count();
        $totalDitolak = Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count();
        
        $totalGuruPembimbing = User::where('role', 'pembimbing')->count();
        $totalPembimbingLapangan = User::where('role', 'pembimbing_lapangan')->count();
        $totalOrangTua = User::where('role', 'orang_tua')->count();
        $totalSertifikat = Sertifikat::count();

        // 2. PRESENSI HARI INI
        $siswaDiterimaIds = Pendaftaran::where('status_pendaftaran', 'diterima')->pluck('id_users')->toArray();
        $totalSiswaAktif = count($siswaDiterimaIds);

        $hadirToday = Absensi::whereIn('id_users', $siswaDiterimaIds)->whereDate('tgl_absen', $today)->where('status', 'Hadir')->count();
        $izinToday = Absensi::whereIn('id_users', $siswaDiterimaIds)->whereDate('tgl_absen', $today)->where('status', 'Izin')->count();
        $sakitToday = Absensi::whereIn('id_users', $siswaDiterimaIds)->whereDate('tgl_absen', $today)->where('status', 'Sakit')->count();
        $alfaToday = Absensi::whereIn('id_users', $siswaDiterimaIds)->whereDate('tgl_absen', $today)->where('status', 'Alfa')->count();
        $sudahPresensi = $hadirToday + $izinToday + $sakitToday + $alfaToday;
        $belumPresensi = max(0, $totalSiswaAktif - $sudahPresensi);

        // 3. GRAFIK TREN PENDAFTARAN 6 BULAN TERAKHIR
        $chartBulanLabels = [];
        $chartPendaftaranData = [];
        $chartDiterimaData = [];

        for ($i = 5; $i >= 0; $i--) {
            $monthDate = Carbon::now()->subMonths($i);
            $monthYear = $monthDate->translatedFormat('M Y');
            $chartBulanLabels[] = $monthYear;

            $chartPendaftaranData[] = Pendaftaran::whereYear('created_at', $monthDate->year)
                                                ->whereMonth('created_at', $monthDate->month)
                                                ->count();

            $chartDiterimaData[] = Pendaftaran::whereYear('created_at', $monthDate->year)
                                              ->whereMonth('created_at', $monthDate->month)
                                              ->where('status_pendaftaran', 'diterima')
                                              ->count();
        }

        // 4. PENDAFTAR SISWA TERBARU (5 Terakhir)
        $pendaftarTerbaru = Pendaftaran::with('user')
                                       ->latest('created_at')
                                       ->take(5)
                                       ->get();

        // 5. LOG PRESENSI TERBARU HARI INI (5 Terakhir)
        $presensiTerbaru = Absensi::with('user')
                                  ->whereDate('tgl_absen', $today)
                                  ->latest('updated_at')
                                  ->take(5)
                                  ->get();

        $data = [
            'title' => 'Dashboard Utama Admin',
            'pelamar' => $totalPelamar,
            'diterima' => $totalDiterima,
            'pengajuan' => $totalPengajuan,
            'tidak_diterima' => $totalDitolak,
            'guru_pembimbing' => $totalGuruPembimbing,
            'pembimbing_lapangan' => $totalPembimbingLapangan,
            'orang_tua' => $totalOrangTua,
            'sertifikat' => $totalSertifikat,
            'total_siswa_aktif' => $totalSiswaAktif,
            // Presensi hari ini
            'hadir_today' => $hadirToday,
            'izin_today' => $izinToday,
            'sakit_today' => $sakitToday,
            'alfa_today' => $alfaToday,
            'sudah_presensi' => $sudahPresensi,
            'belum_presensi' => $belumPresensi,
            // Data Grafik
            'chart_labels' => $chartBulanLabels,
            'chart_pendaftaran' => $chartPendaftaranData,
            'chart_diterima' => $chartDiterimaData,
            // Data List
            'pendaftar_terbaru' => $pendaftarTerbaru,
            'presensi_terbaru' => $presensiTerbaru,
        ];

        return view('admin.dashboard', compact('data'));
    }
}
