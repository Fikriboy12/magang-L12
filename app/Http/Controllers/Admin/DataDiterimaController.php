<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Http\Controllers\Controller;

class DataDiterimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 1. Ambil data semua user yang rolenya pembimbing untuk isi dropdown
        $pembimbings = User::where('role', 'pembimbing')->get();

        $data = [
            'title' => "Data Diterima",
            'pembimbings' => $pembimbings, // Kirim variabel ini ke view
            'data_pendaftaran' => Pendaftaran::select(
                    'pendaftaran.*', 
                    'users.id as id_user_asli', // PENTING: ID User untuk update
                    'users.email', 
                    'users.name as nama_lengkap', 
                    'users.nim', 
                    'users.tempat_lahir', 
                    'users.tanggal_lahir', 
                    'users.alamat_lengkap', 
                    'users.no_telp',
                    'users.jenis_kelamin',
                    'users.pembimbing_id' // Ambil data pembimbing saat ini
                )
                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->where('pendaftaran.status_pendaftaran', 'diterima') 
                ->get(),
        ];

        return view('admin.dataditerima', compact('data'));
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Data Diterima",
            'detail_diterima' => Pendaftaran::select(
                    'pendaftaran.*', 
                    'users.email', 
                    'users.name as nama_lengkap', 
                    'users.nim', 
                    'users.tempat_lahir', 
                    'users.tanggal_lahir', 
                    'users.alamat_lengkap', 
                    'users.no_telp',
                    'users.jenis_kelamin'
                )
                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->where('pendaftaran.id_pendaftaran', $id_pendaftaran)
                ->first(),
        ];

        return view('admin.detailditerima', compact('data'));
    }

    // --- FUNGSI BARU UNTUK SIMPAN PEMBIMBING ---
    public function aturPembimbing(Request $request, $id)
    {
        // Cari data USER (Mahasiswa) berdasarkan ID User
        $user = User::findOrFail($id);

        // Update kolom pembimbing_id sesuai pilihan di dropdown
        $user->pembimbing_id = $request->pembimbing_id;
        $user->save();

        // MENGGUNAKAN 'suc_message' AGAR NOTIFIKASI WARNA HIJAU MUNCUL
        return redirect()->back()->with('suc_message', 'Sukses! Akun Mahasiswa berhasil dikaitkan dengan Pembimbing.');
    }
}