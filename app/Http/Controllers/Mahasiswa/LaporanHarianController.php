<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanHarian;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LaporanHarianController extends Controller
{
    public function index()
    {
        // 1. Ambil ID User yang sedang login
        $userId = Auth::id();

        // 2. Ambil data laporan milik user tersebut
        // PENTING: Menggunakan 'user_id' sesuai screenshot database Anda
        $laporan = LaporanHarian::where('user_id', $userId)
                    ->orderBy('tanggal', 'desc')
                    ->get();

        // DEBUG: Jika data tetap kosong, uncomment baris bawah ini untuk cek ID user
        // dd("ID Login: " . $userId, "Data Laporan:", $laporan);

        return view('mahasiswa.laporan_harian.index', compact('laporan'));
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
}