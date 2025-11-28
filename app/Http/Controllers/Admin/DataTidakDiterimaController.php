<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Http\Controllers\Controller;

class DataTidakDiterimaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => "Data Tidak Diterima",
            'data_pendaftaran' => Pendaftaran::select(
                    'pendaftaran.*', 
                    'users.email', 
                    'users.name as nama_lengkap', 
                    'users.nim', 
                    'users.tempat_lahir', 
                    'users.tanggal_lahir', 
                    'users.alamat_lengkap', 
                    'users.no_telp',
                    // PERBAIKAN: MENAMBAHKAN KOLOM JENIS KELAMIN
                    'users.jenis_kelamin'
                )
                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->where('pendaftaran.status_pendaftaran', 'tidak diterima') 
                ->get(),
        ];

        return view('admin.datatidakditerima', compact('data'));
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Data Tidak Diterima",
            'detail_tidak_diterima' => Pendaftaran::select(
                    'pendaftaran.*', 
                    'users.email', 
                    'users.name as nama_lengkap', 
                    'users.nim', 
                    'users.tempat_lahir', 
                    'users.tanggal_lahir', 
                    'users.alamat_lengkap', 
                    'users.no_telp',
                    // PERBAIKAN: MENAMBAHKAN KOLOM JENIS KELAMIN DI SINI JUGA
                    'users.jenis_kelamin'
                )
                ->join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->where('pendaftaran.id_pendaftaran', $id_pendaftaran)
                ->first(),
        ];

        return view('admin.detailtidakditerima', compact('data'));
    }
}