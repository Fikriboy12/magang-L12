<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class DataPelamarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Pelamar",
            'data_pelamar' => User::leftJoin('detail_users', 'detail_users.id_users', '=', 'users.id')->where('role', 'pelamar')->get(),
        ];

        return view('admin/datapelamar')->with('data', $data);
    }



}
