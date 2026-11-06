<?php

namespace App\Http\Controllers\Pembimbing; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\User;                
use App\Models\LaporanHarian;       
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;       

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

    /**
     * Download / Cetak Rekapitulasi Laporan Harian Siswa oleh Guru Pembimbing (PDF)
     */
    public function downloadPdf($id)
    {
        $user = User::findOrFail($id);
        $pendaftaran = Pendaftaran::where('id_users', $user->id)->first();
        $laporan = LaporanHarian::where('user_id', $user->id)
                    ->orderBy('tanggal', 'asc')
                    ->get();

        $data = [
            'title' => 'Rekapitulasi Laporan Harian Siswa',
            'user' => $user,
            'pendaftaran' => $pendaftaran,
            'laporan' => $laporan,
            'tanggal_cetak' => Carbon::now('Asia/Jakarta')->translatedFormat('d F Y'),
        ];

        $pdf = Pdf::loadView('mahasiswa.laporan_harian.pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        $namaFile = 'Laporan_Harian_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name) . '.pdf';

        return $pdf->stream($namaFile);
    }
}