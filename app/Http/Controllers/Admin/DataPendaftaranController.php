<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

// HANYA USE STATEMENT yang dibutuhkan, bukan deklarasi class
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail; 

class DataPendaftaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        // Data untuk tabel utama
        $data_pendaftaran = Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')->where('status_pendaftaran', 'pengajuan')->get();

        // Data penghitung untuk sidebar (Fix agar counter tidak 0)
        $counts = [
            'pengajuan' => Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
        ];
        
        $data = [
            'title' => "Data Pendaftaran",
            'data_pendaftaran' => $data_pendaftaran,
        ];
        
        // Gabungkan data tabel dengan data penghitung
        $data = array_merge($data, $counts);
        
        return view('admin/datapendaftaran')->with('data', $data);
    }

    public function detail($id_pendaftaran)
    {
        // Data penghitung untuk sidebar (Fix agar counter tidak 0)
        $counts = [
            'pengajuan' => Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
        ];

        $detail = Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')->where('id_pendaftaran', $id_pendaftaran)->first();

        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => $detail,
        ];
        
        // Gabungkan data detail dengan data penghitung
        $data = array_merge($data, $counts);

        return view('admin/detailpendaftaran')->with('data', $data);
    }


    public function diterima(Request $request){

        $id_pendaftaran = $request->id_pendaftaran;

        $data_update = [
            'status_pendaftaran' => 'diterima',
            'keterangan' => $request->keterangan,
        ];

        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();

        $id_users = $pendaftaran->id_users;
        $users = User::where('id', $id_users)->first();
        $email = $users->email;

        $data_email = [
            'title' => 'Selamat Anda diterima Masuk Pada Magang Yang Anda Lamar!',
            'url' => 'http://localhost/aplikasi-magang/public/',
        ];
        
        // Panggil kelas Mailer yang sudah benar di app/Mail/SendMail.php
        Mail::to($email)->send(new SendMail($data_email));
        

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data_update);

        return redirect('data-pendaftaran')->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function tidak_diterima(Request $request){
        $id_pendaftaran = $request->id_pendaftaran;

        $data_update = [
            'status_pendaftaran' => 'tidak diterima',
            'keterangan' => $request->keterangan,
        ];

        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();

        $id_users = $pendaftaran->id_users;
        $users = User::where('id', $id_users)->first();
        $email = $users->email;
        
        $data_email = [
            'title' => 'Mohon Maaf Anda Tidak Diterima Masuk Pada Magang Yang Anda Lamar!',
            'url' => 'http://localhost/aplikasi-magang/public/',
        ];

        // Panggil kelas Mailer yang sudah benar di app/Mail/SendMail.php
        Mail::to($email)->send(new SendMail($data_email));

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data_update);

        return redirect('data-pendaftaran')->with('suc_message', 'Data Berhasil diupdate!');
    }

}