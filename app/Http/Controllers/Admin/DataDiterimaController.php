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
        $data = [
            'title' => "Data Diterima",
            'data_pendaftaran' => Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')
                ->leftJoin('detail_users', 'detail_users.id_users', '=', 'users.id')
                ->where('pendaftaran.status_pendaftaran', 'Diterima')
                ->select(
                    'pendaftaran.*',
                    'users.name',
                    'users.email'
                )
                ->get(),
        ];

        return view('admin.dataditerima', compact('data'));
    }

    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Data Diterima",
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

        return view('admin.detailditerima', compact('data'));
    }
}
