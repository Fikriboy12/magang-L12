<?php

namespace App\Http\Controllers\OrangTua;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\LaporanHarian;
use App\Models\Absensi;

class OrangTuaDashboardController extends Controller
{
    /**
     * Menampilkan dashboard utama Orang Tua.
     */
    public function index()
    {
        $orangTua = Auth::user();
        $anak = $orangTua->anak;

        $totalLaporan = 0;
        $laporanPending = 0;
        $laporanDisetujui = 0;
        $totalHadir = 0;
        $laporanList = collect();
        $absensiTerbaru = collect();

        if ($anak) {
            $totalLaporan = LaporanHarian::where('user_id', $anak->id)->count();
            $laporanPending = LaporanHarian::where('user_id', $anak->id)->where('status', 'pending')->count();
            $laporanDisetujui = LaporanHarian::where('user_id', $anak->id)->where('status', 'approved')->count();
            $totalHadir = Absensi::where('id_users', $anak->id)->count();
            
            // 5 Laporan Terakhir untuk tabel ringkasan di dashboard
            $laporanList = LaporanHarian::where('user_id', $anak->id)
                ->orderBy('tanggal', 'desc')
                ->take(5)
                ->get();

            // 5 Absensi Terakhir
            $absensiTerbaru = Absensi::where('id_users', $anak->id)
                ->orderBy('tgl_absen', 'desc')
                ->take(5)
                ->get();
        }

        return view('orangtua.dashboard', compact(
            'orangTua',
            'anak',
            'totalLaporan',
            'laporanPending',
            'laporanDisetujui',
            'totalHadir',
            'laporanList',
            'absensiTerbaru'
        ));
    }

    /**
     * Menampilkan riwayat seluruh laporan harian anak.
     */
    public function lihatLaporan()
    {
        $orangTua = Auth::user();
        $anak = $orangTua->anak;

        if (!$anak) {
            return redirect()->route('orangtua.dashboard')->with('error', 'Akun Anda belum terhubung dengan data siswa/anak.');
        }

        $laporan = LaporanHarian::where('user_id', $anak->id)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('orangtua.laporan_detail', compact('orangTua', 'anak', 'laporan'));
    }

    /**
     * Menampilkan riwayat seluruh absensi / kehadiran anak.
     */
    public function absensi()
    {
        $orangTua = Auth::user();
        $anak = $orangTua->anak;

        if (!$anak) {
            return redirect()->route('orangtua.dashboard')->with('error', 'Akun Anda belum terhubung dengan data siswa/anak.');
        }

        $riwayat = Absensi::where('id_users', $anak->id)
            ->orderBy('tgl_absen', 'desc')
            ->get();

        return view('orangtua.absensi', compact('orangTua', 'anak', 'riwayat'));
    }
}
