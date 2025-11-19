<?php

namespace App\Http\Controllers\Pembimbing; // Perhatikan namespace-nya

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mengambil data user yg login
use App\Models\User;                 // Untuk mengambil data mahasiswa
use App\Models\LaporanHarian;        // Untuk mengambil data laporan

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama Pembimbing.
     */
    public function index()
    {
        // 1. Ambil ID pembimbing yg sedang login
        $pembimbingId = Auth::id();

        // 2. Ambil semua mahasiswa yg dibimbing oleh dia
        //    (Kita menggunakan relasi 'mahasiswaYangDibimbing' yg kita buat di Model User)
        $mahasiswaList = Auth::user()->mahasiswaYangDibimbing;

        // 3. Tampilkan view dashboard, kirim data mahasiswa
        return view('pembimbing.dashboard', compact('mahasiswaList'));
    }

    /**
     * Menampilkan halaman detail laporan harian dari SATU mahasiswa.
     */
    public function lihatLaporan($mahasiswa_id)
    {
        // 1. Ambil ID pembimbing yg sedang login
        $pembimbingId = Auth::id();

        // 2. Cari mahasiswa berdasarkan ID-nya
        $mahasiswa = User::findOrFail($mahasiswa_id);

        // 3. (Keamanan) Pastikan mahasiswa ini adalah bimbingan pembimbing yg sedang login
        if ($mahasiswa->pembimbing_id != $pembimbingId) {
            abort(403, 'Anda tidak punya hak akses ke mahasiswa ini.');
        }

        // 4. Ambil semua laporan harian milik mahasiswa tsb
        //    (Kita gunakan relasi 'laporanHarian' yg ada di Model User)
        $laporanList = $mahasiswa->laporanHarian()->orderBy('tanggal', 'desc')->get();

        // 5. Tampilkan view detail laporan
        return view('pembimbing.laporan_detail', compact('mahasiswa', 'laporanList'));
    }
}