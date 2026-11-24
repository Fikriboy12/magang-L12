<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanHarianController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil ID User yang sedang login
        $userId = Auth::id();

        $search = trim($request->get('search', ''));

        // 2. Hitung Metrik Statistik Keseluruhan Data User
        $baseQuery = LaporanHarian::where('user_id', $userId);
        
        $totalLaporan = (clone $baseQuery)->count();
        $approvedLaporan = (clone $baseQuery)->where('status', 'approved')->count();
        $pendingLaporan = (clone $baseQuery)->where('status', 'pending')->count();
        $rejectedLaporan = (clone $baseQuery)->where('status', 'rejected')->count();

        // 3. Query Laporan dengan Pencarian & Paginasi 10 Data
        $query = (clone $baseQuery);
        if ($search !== '') {
            $query->where(function($q) use ($search) {
                $q->where('tanggal', 'like', "%{$search}%")
                  ->orWhere('kegiatan', 'like', "%{$search}%")
                  ->orWhere('catatan', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $laporan = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();

        return view('mahasiswa.laporan_harian.index', compact(
            'laporan',
            'totalLaporan',
            'approvedLaporan',
            'pendingLaporan',
            'rejectedLaporan',
            'search'
        ));
    }

    public function create()
    {
        return view('mahasiswa.laporan_harian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            
            // Simpan ke folder public/laporan_harian
            $foto->move(public_path('laporan_harian'), $namaFoto);
            
            // Simpan path ke database (contoh: laporan_harian/namafile.jpg)
            $fotoPath = 'laporan_harian/' . $namaFoto;
        }

        LaporanHarian::create([
            'user_id' => Auth::id(), // Pastikan pakai 'user_id'
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'foto' => $fotoPath,     // Pastikan pakai 'foto' (sesuai kolom DB)
            'catatan' => $request->catatan,
            'status' => 'pending',
        ]);

        return redirect()->route('mahasiswa.laporan.index')->with('success', 'Laporan berhasil dikirim!');
    }

    /**
     * Download / Cetak Rekapitulasi Laporan Harian Siswa (PDF)
     */
    public function downloadPdf()
    {
        $userId = Auth::id();
        $user = Auth::user();

        // Ambil data pendaftaran & profil magang siswa
        $pendaftaran = Pendaftaran::where('id_users', $userId)->first();

        // Ambil seluruh laporan harian siswa urut dari tanggal pertama
        $laporan = LaporanHarian::where('user_id', $userId)
                    ->orderBy('tanggal', 'asc')
                    ->get();

        $data = [
            'title' => 'Rekapitulasi Laporan Harian Magang',
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