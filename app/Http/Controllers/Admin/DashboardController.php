<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Pendaftaran;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        
        $data = [
            'title' => "Dashboard",
            
            // --- DATA UNTUK KARTU DASHBOARD ---
            
            // PERBAIKAN: Menggunakan whereRaw untuk mencari 'pelamar' tanpa memperhatikan huruf besar/kecil
            // Ini akan memastikan query bekerja meskipun data tersimpan sebagai 'Pelamar' atau 'PELAMAR'
            'pelamar' => User::whereRaw('LOWER(role) = ?', ['pelamar'])->count(), 
            
            // Data Diterima (Sudah Bekerja)
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            
            // Data Ditolak (Sudah Bekerja)
            'tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
            
            // --- DATA UNTUK SIDEBAR ---
            // Data Pengajuan (Sudah Bekerja)
            'pengajuan' => Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(),
        ];
        
        // Catatan: Jika di view Anda menggunakan kunci 'ditolak', ganti 'tidak_diterima' di atas menjadi 'ditolak'
        
        return view('admin/dashboard')->with('data', $data);
    }
}