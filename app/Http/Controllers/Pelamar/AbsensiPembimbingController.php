<?php

namespace App\Http\Controllers\Pembimbing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Absensi;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class AbsensiPembimbingController extends Controller
{
    // HALAMAN 1: List Mahasiswa Binaan Saya
    public function index()
    {
        // Ambil ID Pembimbing yang sedang login
        $id_pembimbing = Auth::id();

        // Cari Data Pendaftaran yang:
        // 1. Statusnya 'diterima'
        // 2. Mahasiswanya dibimbing oleh orang yang sedang login ini
        $mahasiswa = Pendaftaran::with('user')
                        ->where('status_pendaftaran', 'diterima')
                        ->whereHas('user', function($query) use ($id_pembimbing) {
                            $query->where('pembimbing_id', $id_pembimbing);
                        })
                        ->get();

        return view('pembimbing.absensi.index', compact('mahasiswa'));
    }

    // HALAMAN 2: Detail Riwayat Absensi Mahasiswa Binaan
    public function detail($id_user)
    {
        $id_pembimbing = Auth::id();

        // 1. Cek dulu, apakah mahasiswa ini benar bimbingan dia? (Keamanan)
        $user = User::where('id', $id_user)
                    ->where('pembimbing_id', $id_pembimbing)
                    ->firstOrFail(); // Kalau bukan bimbingannya, error 404
        
        // 2. Ambil riwayat absensinya
        $riwayat = Absensi::where('id_users', $id_user)
                          ->orderBy('tgl_absen', 'desc')
                          ->get();

        return view('pembimbing.absensi.detail', compact('user', 'riwayat'));
    }
}