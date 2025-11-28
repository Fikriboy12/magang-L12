<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

// HANYA USE STATEMENT yang dibutuhkan
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
        // PERBAIKAN: Hapus leftjoin ke detail_users dan tambahkan select eksplisit
        $data_pendaftaran = Pendaftaran::select(
                'pendaftaran.*', // Ambil semua dari pendaftaran (termasuk universitas, jurusan, prodi)
                'users.email', 
                'users.name as nama_lengkap', // Nama lengkap
                'users.nim',
                'users.tempat_lahir',
                'users.tanggal_lahir',
                'users.jenis_kelamin', // Jenis kelamin
                'users.alamat_lengkap',
                'users.no_telp'
            )
            ->join('users', 'pendaftaran.id_users', '=', 'users.id')
            // HAPUS: ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
            ->where('status_pendaftaran', 'pengajuan')
            ->get();

        // Data penghitung untuk sidebar
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
        // Data penghitung untuk sidebar
        $counts = [
            'pengajuan' => Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
        ];

        // PERBAIKAN: Hapus leftjoin ke detail_users dan tambahkan select eksplisit
        $detail = Pendaftaran::select(
                'pendaftaran.*', // Ambil semua dari pendaftaran (termasuk universitas, jurusan, prodi)
                'users.email', 
                'users.name as nama_lengkap', // Nama lengkap
                'users.nim',
                'users.tempat_lahir',
                'users.tanggal_lahir',
                'users.jenis_kelamin', // Jenis kelamin
                'users.alamat_lengkap',
                'users.no_telp'
            )
            ->join('users', 'pendaftaran.id_users', '=', 'users.id')
            // HAPUS: ->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->first();

        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => $detail,
        ];
        
        // Gabungkan data detail dengan data penghitung
        $data = array_merge($data, $counts);

        return view('admin/detailpendaftaran')->with('data', $data);
    }


    // FUNGSI INI YANG DIMODIFIKASI
    public function diterima(Request $request){

        $id_pendaftaran = $request->id_pendaftaran;

        // 1. Update Status di Tabel Pendaftaran
        $data_update = [
            'status_pendaftaran' => 'diterima',
            'keterangan' => $request->keterangan,
        ];

        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();
        
        // Update data pendaftaran
        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data_update);


        // 2. Update Status di Tabel Users (OTOMATIS)
        $id_users = $pendaftaran->id_users;
        $users = User::where('id', $id_users)->first();
        
        // Update status user jadi 'diterima'
        $users->status = 'diterima';
        
        // (Opsi) Jika form Anda mengirim 'pembimbing_id', simpan juga di sini
        if ($request->has('pembimbing_id')) {
             $users->pembimbing_id = $request->pembimbing_id;
        }
        
        $users->save();


        // 3. Kirim Email Notifikasi
        $email = $users->email;
        $data_email = [
            'title' => 'Selamat Anda diterima Masuk Pada Magang Yang Anda Lamar!',
            'url' => 'http://localhost/aplikasi-magang/public/',
        ];
        
        Mail::to($email)->send(new SendMail($data_email));
        

        return redirect('data-pendaftaran')->with('suc_message', 'Data Berhasil diupdate! Status User otomatis menjadi Diterima.');
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

        Mail::to($email)->send(new SendMail($data_email));

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update($data_update);

        return redirect('data-pendaftaran')->with('suc_message', 'Data Berhasil diupdate!');
    }

}