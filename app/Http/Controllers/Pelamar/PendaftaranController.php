<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use App\Models\User;
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
        $user = Auth::user();
        
        return view('pelamar.pendaftaran', compact('cek_pendaftaran', 'user'));
    }

    public function insert(Request $request)
    {
        // 1. Validasi Input Sesuai Rancangan Final E-Magang
        $request->validate([
            // A. Data Akademik Siswa
            'nisn'                  => 'required|string|max:30',
            'nama_sekolah'          => 'required|string|max:255',
            'jurusan'               => 'required|string|max:255',
            'kelas'                 => 'required|string|max:50',
            'nama_guru_pembimbing'  => 'required|string|max:255',
            'email_guru_pembimbing' => 'required|email|max:255',
            'no_hp_guru_pembimbing' => 'required|string|max:25',

            // B. Data Orang Tua / Wali
            'nama_wali'             => 'required|string|max:255',
            'hubungan_wali'         => 'required|in:Ayah,Ibu,Wali',
            'no_hp_wali'            => 'required|string|max:25',
            'email_wali'            => 'required|email|max:255',

            // C. Data Pelaksanaan Magang
            'dari_tanggal'          => 'required|date',
            'sampai_tanggal'        => 'required|date|after_or_equal:dari_tanggal',
            
            // D. Dokumen Persyaratan
            'cv'                    => 'required|mimes:pdf|max:2048',
            'surat_pengantar'       => 'required|mimes:pdf|max:2048',
            'surat_izin_wali'       => 'required|mimes:pdf|max:2048',
            'gambar'                => 'required|mimes:jpg,jpeg,png|max:2048',
        ], [
            // Pesan Validasi Indonesia
            'nisn.required'                  => 'NIS/NISN wajib diisi.',
            'nama_sekolah.required'          => 'Nama sekolah wajib diisi.',
            'jurusan.required'               => 'Jurusan/program keahlian wajib diisi.',
            'kelas.required'                 => 'Kelas siswa wajib diisi.',
            'nama_guru_pembimbing.required'  => 'Nama guru pembimbing wajib diisi.',
            'email_guru_pembimbing.required' => 'Email guru pembimbing wajib diisi.',
            'email_guru_pembimbing.email'    => 'Format email guru pembimbing tidak valid.',
            'no_hp_guru_pembimbing.required' => 'Nomor HP guru pembimbing wajib diisi.',

            'nama_wali.required'             => 'Nama orang tua/wali wajib diisi.',
            'hubungan_wali.required'         => 'Hubungan dengan siswa wajib dipilih (Ayah/Ibu/Wali).',
            'hubungan_wali.in'               => 'Pilihan hubungan tidak valid (harus Ayah, Ibu, atau Wali).',
            'no_hp_wali.required'            => 'Nomor HP orang tua/wali wajib diisi.',
            'email_wali.required'            => 'Email orang tua/wali wajib diisi.',
            'email_wali.email'               => 'Format email orang tua/wali tidak valid.',

            'dari_tanggal.required'          => 'Tanggal mulai magang wajib diisi.',
            'sampai_tanggal.required'        => 'Tanggal selesai magang wajib diisi.',
            'sampai_tanggal.after_or_equal'  => 'Tanggal selesai magang harus sama atau setelah tanggal mulai.',

            'cv.required'                    => 'File CV siswa wajib diunggah.',
            'cv.mimes'                       => 'File CV harus berformat PDF.',
            'cv.max'                         => 'Ukuran file CV maksimal 2MB.',

            'surat_pengantar.required'       => 'Surat pengantar magang dari sekolah wajib diunggah.',
            'surat_pengantar.mimes'          => 'Surat pengantar harus berformat PDF.',
            'surat_pengantar.max'            => 'Ukuran surat pengantar maksimal 2MB.',

            'surat_izin_wali.required'       => 'Surat izin orang tua/wali wajib diunggah.',
            'surat_izin_wali.mimes'          => 'Surat izin orang tua/wali harus berformat PDF.',
            'surat_izin_wali.max'            => 'Ukuran surat izin orang tua/wali maksimal 2MB.',

            'gambar.required'                => 'Pas foto siswa wajib diunggah.',
            'gambar.mimes'                   => 'Pas foto harus berformat JPG, JPEG, atau PNG.',
            'gambar.max'                     => 'Ukuran pas foto maksimal 2MB.',
        ]);

        $id_user = Auth::user()->id;

        // 2. Upload Dokumen File
        $uploadFile = function($fileRequest, $prefix) {
            if ($fileRequest) {
                $fileName = time() . '_' . $prefix . '.' . $fileRequest->extension();
                $fileRequest->move(public_path('berkas'), $fileName); 
                return $fileName;
            }
            return null;
        };
        
        // Upload Gambar (Pas Foto Siswa)
        $gambarName = null;
        if ($request->hasFile('gambar')) {
            $gambarName = time() . '_foto.' . $request->file('gambar')->extension();
            $request->file('gambar')->move(public_path('gambar'), $gambarName);
        }

        // Upload Berkas Dokumen Persyaratan
        $cvName = $uploadFile($request->file('cv'), 'CV');
        $suratPengantarName = $uploadFile($request->file('surat_pengantar'), 'SuratPengantar');
        $suratIzinWaliName = $uploadFile($request->file('surat_izin_wali'), 'SuratIzinWali');

        // 3. Simpan ke Database Pendaftaran
        Pendaftaran::create([
            'id_users'              => $id_user,
            
            // A. Data Akademik Siswa
            'nisn'                  => $request->nisn,
            'nama_sekolah'          => $request->nama_sekolah,
            'universitas'           => $request->nama_sekolah, // Kompatibilitas sistem lama
            'jurusan'               => $request->jurusan,
            'prodi'                 => $request->jurusan,      // Kompatibilitas sistem lama
            'kelas'                 => $request->kelas,
            'nama_guru_pembimbing'  => $request->nama_guru_pembimbing,
            'email_guru_pembimbing' => $request->email_guru_pembimbing,
            'no_hp_guru_pembimbing' => $request->no_hp_guru_pembimbing,

            // B. Data Orang Tua / Wali
            'nama_wali'             => $request->nama_wali,
            'hubungan_wali'         => $request->hubungan_wali,
            'no_hp_wali'            => $request->no_hp_wali,
            'email_wali'            => $request->email_wali,

            // C. Data Pelaksanaan Magang
            'dari_tanggal'          => $request->dari_tanggal,
            'sampai_tanggal'        => $request->sampai_tanggal,
            
            // D. Dokumen Persyaratan
            'gambar'                => $gambarName,
            'cv'                    => $cvName,
            'surat_pengantar'       => $suratPengantarName,
            'surat_rekomendasi'     => $suratPengantarName, // Kompatibilitas dengan fitur lama
            'surat_izin_wali'       => $suratIzinWaliName,
            
            'status_pendaftaran'    => 'pengajuan',
            'keterangan'            => 'Sedang diverifikasi',
            'created_at'            => Carbon::now(),
        ]);

        // 4. Sinkronisasi data ke profil User
        $user = User::find($id_user);
        if ($user) {
            $user->nim = $request->nisn;
            $user->nama_wali = $request->nama_wali;
            $user->email_wali = $request->email_wali;
            $user->no_hp_wali = $request->no_hp_wali;
            $user->save();
        }

        return redirect()->route('pelamar.lamaran.index')->with('success', 'Formulir pendaftaran magang berhasil dikirim!');
    }
}