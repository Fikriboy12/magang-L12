<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Pendaftaran;

class DataAbsensiController extends Controller
{
    // HALAMAN 1: List Mahasiswa yang Magang (Diterima)
    public function index()
    {
        // Ambil data pendaftaran yang statusnya 'diterima'
        $mahasiswa = Pendaftaran::with('user')
                        ->where('status_pendaftaran', 'diterima')
                        ->get();

        return view('admin.absensi.index', compact('mahasiswa'));
    }

    // HALAMAN 2: Detail Riwayat Absensi Per Mahasiswa
    public function detail($id_user)
    {
        // Cari datanya user
        $user = User::findOrFail($id_user);
        
        // Ambil semua absensi milik user ini
        $riwayat = Absensi::where('id_users', $id_user)
                          ->orderBy('tgl_absen', 'desc')
                          ->get();

        return view('admin.absensi.detail', compact('user', 'riwayat'));
    }
}