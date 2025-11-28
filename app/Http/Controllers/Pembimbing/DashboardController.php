<?php

namespace App\Http\Controllers\Pembimbing; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;                
use App\Models\LaporanHarian;       

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
        //    (Pastikan relasi 'mahasiswaYangDibimbing' ada di Model User)
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
        //    PERBAIKAN: Menggunakan 'user_id' agar sesuai database Anda
        $laporan = LaporanHarian::where('user_id', $mahasiswa_id)
                    ->orderBy('tanggal', 'desc')
                    ->get();

        // 5. Tampilkan view detail laporan
        return view('pembimbing.laporan_detail', compact('mahasiswa', 'laporan'));
    }

    // ==========================================
    // [BARU] FUNGSI ACC (APPROVE) LAPORAN
    // ==========================================
    public function approveLaporan($id)
    {
        // Cari laporan berdasarkan ID
        $laporan = LaporanHarian::findOrFail($id);
        
        // Update status menjadi 'approved'
        $laporan->update([
            'status' => 'approved'
        ]);

        return redirect()->back()->with('success', 'Laporan kegiatan berhasil disetujui (ACC)!');
    }

    // ==========================================
    // [BARU] FUNGSI TOLAK (REJECT) LAPORAN
    // ==========================================
    public function rejectLaporan($id)
    {
        // Cari laporan berdasarkan ID
        $laporan = LaporanHarian::findOrFail($id);
        
        // Update status menjadi 'rejected'
        $laporan->update([
            'status' => 'rejected'
        ]);

        return redirect()->back()->with('error', 'Laporan kegiatan telah ditolak.');
    }
}