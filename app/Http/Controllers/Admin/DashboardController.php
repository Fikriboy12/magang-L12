<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Hitung data pendaftaran berdasarkan status
        $countTidakDiterima = Pendaftaran::whereRaw("LOWER(status_pendaftaran) = 'tidak diterima'")->count();
        $countDiterima = Pendaftaran::whereRaw("LOWER(status_pendaftaran) = 'diterima'")->count();
        $countPengajuan = Pendaftaran::whereRaw("LOWER(status_pendaftaran) = 'pengajuan'")->count();

        // Hitung jumlah user dengan role pelamar
        $countPelamarUser = User::whereRaw("LOWER(role) = 'pelamar'")->count();

        // Siapkan data untuk dikirim ke view
        $data = [
            'title' => 'Dashboard Admin',
            'tidak_diterima' => $countTidakDiterima,
            'diterima' => $countDiterima,
            'pengajuan' => $countPengajuan,
            'jumlah_pelamar_user' => $countPelamarUser,
        ];

        // Return ke view admin/dashboard.blade.php
        return view('admin.dashboard', compact('data'));
    }
}
