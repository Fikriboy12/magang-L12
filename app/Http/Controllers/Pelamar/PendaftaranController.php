<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Cek apakah user sudah pernah mendaftar
        $cek_pendaftaran = Pendaftaran::where('id_users', Auth::user()->id)->first();
        
        return view('pelamar.pendaftaran', compact('cek_pendaftaran'));
    }

    public function insert(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'universitas' => 'required',
            'jurusan' => 'required',
            'prodi' => 'required', // Wajib ada
            'dari_tanggal' => 'required',
            'sampai_tanggal' => 'required',
            
            // Validasi File
            'gambar' => 'required|mimes:jpg,jpeg,png|max:2048',
            'ktp' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
            'cv' => 'required|mimes:pdf|max:2048',
            'surat_rekomendasi' => 'required|mimes:pdf|max:2048',
            'proposal' => 'required|mimes:pdf|max:2048',
        ]);

        $id_user = Auth::user()->id;

        // 2. Proses Upload File (Helper function)
        $uploadFile = function($fileRequest, $prefix) {
            if ($fileRequest) {
                $fileName = time() . '_' . $prefix . '.' . $fileRequest->extension();
                $fileRequest->move(public_path('berkas'), $fileName); 
                return $fileName;
            }
            return null;
        };
        
        // Upload Gambar (Foto Profil)
        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '_foto.' . $request->file('gambar')->extension();
            $request->file('gambar')->move(public_path('gambar'), $gambarName);
        }

        // Upload Berkas Dokumen
        $ktpName = $uploadFile($request->file('ktp'), 'KTP');
        $cvName = $uploadFile($request->file('cv'), 'CV');
        $suratName = $uploadFile($request->file('surat_rekomendasi'), 'Surat');
        $proposalName = $uploadFile($request->file('proposal'), 'Proposal');


        // 3. Simpan ke Database
        Pendaftaran::create([
            'id_users' => $id_user,
            
            'universitas' => $request->universitas,
            'jurusan' => $request->jurusan,
            'prodi' => $request->prodi, // Prodi sudah aman
            
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            
            'gambar' => $gambarName,
            
            // PERBAIKAN DI SINI: Menambahkan 'ktp' yang sebelumnya hilang
            'ktp' => $ktpName, 
            
            'cv' => $cvName,
            'surat_rekomendasi' => $suratName,
            'proposal' => $proposalName,
            
            'status_pendaftaran' => 'pengajuan',
            'keterangan' => 'Sedang diverifikasi',
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('pelamar.lamaran.index')->with('success', 'Pendaftaran berhasil dikirim!');
    }
}