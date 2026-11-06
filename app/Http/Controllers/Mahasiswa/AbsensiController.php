<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

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
            return redirect()->back()->with('error', 'Maaf, Anda belum bisa mengakses data absensi karena status magang belum DITERIMA.');
        }

        // 2. Cek apakah hari ini sudah absen?
        $absenHariIni = Absensi::where('id_users', $userId)
                                ->where('tgl_absen', $hariIni)
                                ->first();

        // 3. Ambil History Absen
        $riwayat = Absensi::where('id_users', $userId)->orderBy('tgl_absen', 'desc')->get();

        return view('mahasiswa.absensi.index', compact('absenHariIni', 'riwayat'));
    }

    /**
     * Download / Cetak Rekapitulasi Absensi & Kehadiran Siswa (PDF)
     */
    public function downloadPdf()
    {
        $userId = Auth::id();
        $user = Auth::user();

        // 1. Ambil Data Pendaftaran Magang
        $pendaftaran = Pendaftaran::where('id_users', $userId)->first();

        // 2. Ambil Seluruh History Absensi (urutkan dari tanggal pertama agar rapi)
        $riwayat = Absensi::where('id_users', $userId)
                            ->orderBy('tgl_absen', 'asc')
                            ->get();

        $data = [
            'title' => 'Rekapitulasi Absensi & Kehadiran Magang',
            'user' => $user,
            'pendaftaran' => $pendaftaran,
            'riwayat' => $riwayat,
            'total_hadir' => $riwayat->where('status', 'Hadir')->count(),
            'total_hari' => $riwayat->count(),
            'tanggal_cetak' => Carbon::now('Asia/Jakarta')->translatedFormat('d F Y'),
        ];

        $pdf = Pdf::loadView('mahasiswa.absensi.pdf', $data);
        $pdf->setPaper('A4', 'portrait');

        $namaFile = 'Rekap_Absensi_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $user->name) . '.pdf';

        return $pdf->stream($namaFile);
    }

    // PROSES ABSEN MASUK (Untuk fallback jika diperlukan)
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:2048',
            'keterangan' => 'required|string'
        ]);

        $userId = Auth::id();
        $file = $request->file('foto');
        
        $namaFoto = time() . '_masuk_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/absensi'), $namaFoto); 

        $waktuSekarang = Carbon::now('Asia/Jakarta');

        Absensi::create([
            'id_users' => $userId,
            'tgl_absen' => $waktuSekarang->format('Y-m-d'),
            'jam_masuk' => $waktuSekarang->format('H:i:s'),
            'status' => 'Hadir',
            'foto_bukti' => 'uploads/absensi/' . $namaFoto,
            'lokasi_masuk' => null,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->back()->with('success', 'Berhasil Absen Masuk (WIB)!');
    }

    // PROSES ABSEN PULANG (Untuk fallback jika diperlukan)
    public function absenPulang(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:2048'
        ]);

        $absen = Absensi::findOrFail($id);
        $file = $request->file('foto');

        $namaFoto = time() . '_pulang_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/absensi'), $namaFoto);

        $waktuSekarang = Carbon::now('Asia/Jakarta');

        $absen->update([
            'jam_keluar' => $waktuSekarang->format('H:i:s'),
            'foto_keluar' => 'uploads/absensi/' . $namaFoto,
            'lokasi_keluar' => null 
        ]);

        return redirect()->back()->with('success', 'Berhasil Absen Pulang (WIB)!');
    }
}
