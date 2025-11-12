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
            'data_pendaftaran' => Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->leftJoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                ->where('pendaftaran.status_pendaftaran', 'Tidak Diterima')
                ->select(
                    'pendaftaran.*',
                    'users.name',
                    'users.email'
                )
                ->get(),
        ];

        return view('admin.datatidakditerima', compact('data'));
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Data Tidak Diterima",
            'detail_pendaftaran' => Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->leftJoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                ->where('pendaftaran.id_pendaftaran', $id_pendaftaran)
                ->select(
                    'pendaftaran.*',
                    'users.name',
                    'users.email'
                )
                ->first(),
        ];

        return view('admin.detailtidakditerima', compact('data'));
    }
}
