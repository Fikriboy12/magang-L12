<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Atur waktu ke Asia/Jakarta (WIB)
        $hariIni = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        // 1. CEK STATUS MAGANG
        $statusMagang = Pendaftaran::where('id_users', $userId)->value('status_pendaftaran');
        
        if (strtolower($statusMagang) != 'diterima') {
            return redirect()->back()->with('error', 'Maaf, Anda belum bisa absen karena status magang belum DITERIMA.');
        }

        // 2. Cek apakah hari ini sudah absen?
        $absenHariIni = Absensi::where('id_users', $userId)
                                ->where('tgl_absen', $hariIni)
                                ->first();

        // 3. Ambil History Absen
        $riwayat = Absensi::where('id_users', $userId)->orderBy('tgl_absen', 'desc')->get();

        return view('mahasiswa.absensi.index', compact('absenHariIni', 'riwayat'));
    }

    // PROSES ABSEN MASUK
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
            'keterangan' => 'required|string' // Wajib isi keterangan
        ]);

        $userId = Auth::id();
        $file = $request->file('foto');
        
        // Simpan Foto Masuk
        $namaFoto = time() . '_masuk_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/absensi'), $namaFoto); 

        // Pakai Waktu Jakarta
        $waktuSekarang = Carbon::now('Asia/Jakarta');

        Absensi::create([
            'id_users' => $userId,
            'tgl_absen' => $waktuSekarang->format('Y-m-d'),
            'jam_masuk' => $waktuSekarang->format('H:i:s'), // Jam WIB
            'status' => 'Hadir',
            'foto_bukti' => 'uploads/absensi/' . $namaFoto,
            'lokasi_masuk' => null, // Lokasi dikosongkan
            'keterangan' => $request->keterangan // Simpan keterangan manual
        ]);

        return redirect()->back()->with('success', 'Berhasil Absen Masuk (WIB)!');
    }

    // PROSES ABSEN PULANG
    public function absenPulang(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
            // Keterangan pulang opsional, atau bisa dihapus validasinya
        ]);

        $absen = Absensi::findOrFail($id);
        $file = $request->file('foto');

        $namaFoto = time() . '_pulang_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/absensi'), $namaFoto);

        // Pakai Waktu Jakarta
        $waktuSekarang = Carbon::now('Asia/Jakarta');

        $absen->update([
            'jam_keluar' => $waktuSekarang->format('H:i:s'), // Jam WIB
            'foto_keluar' => 'uploads/absensi/' . $namaFoto,
            'lokasi_keluar' => null 
        ]);

        return redirect()->back()->with('success', 'Berhasil Absen Pulang (WIB)! Hati-hati di jalan.');
    }
}