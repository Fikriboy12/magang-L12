<?php

namespace App\Http\Controllers\Mahasiswa; // Perhatikan namespace-nya

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;     // Untuk ID mahasiswa yg login
use App\Models\LaporanHarian;            // Untuk menyimpan laporan
use Illuminate\Support\Facades\Storage;  // Untuk mengelola file upload

class LaporanHarianController extends Controller
{
    /**
     * Menampilkan daftar laporan harian yg PERNAH di-upload oleh mahasiswa.
     */
    public function index()
    {
        // Ambil semua laporan milik user yg sedang login
        $laporanList = LaporanHarian::where('user_id', Auth::id())
                                    ->orderBy('tanggal', 'desc')
                                    ->get();

        return view('mahasiswa.laporan_index', compact('laporanList'));
    }

    /**
     * Menampilkan form untuk membuat laporan harian baru.
     */
    public function create()
    {
        return view('mahasiswa.laporan_create');
    }

    /**
     * Menyimpan laporan harian baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'kegiatan' => 'required|string|min:10',
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // maks 2MB
            'catatan' => 'nullable|string',
        ]);

        // 2. Handle upload foto
        // Foto akan disimpan di: storage/app/public/laporan_harian
        $path = $request->file('foto')->store('public/laporan_harian');

        // 3. Simpan ke database
        LaporanHarian::create([
            'user_id' => Auth::id(), // ID mahasiswa yg sedang login
            'tanggal' => $request->tanggal,
            'kegiatan' => $request->kegiatan,
            'foto' => $path, // Simpan path fotonya
            'catatan' => $request->catatan,
        ]);

        // 4. Kembali ke halaman daftar laporan
        return redirect()->route('mahasiswa.laporan.index')
                         ->with('success', 'Laporan harian berhasil disimpan.');
    }
}