<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Http\Controllers\Controller;
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
        $data_pendaftaran = Pendaftaran::select(
                'pendaftaran.*', 
                'users.email', 
                'users.name as nama_lengkap', 
                'users.nim',
                'users.no_telp'
            )
            ->join('users', 'pendaftaran.id_users', '=', 'users.id')
            ->where('status_pendaftaran', 'pengajuan')
            ->get();

        $counts = [
            'pengajuan' => Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
        ];
        
        $data = [
            'title' => "Data Pendaftaran",
            'data_pendaftaran' => $data_pendaftaran,
        ];
        
        $data = array_merge($data, $counts);
        
        return view('admin/datapendaftaran')->with('data', $data);
    }

    public function detail($id_pendaftaran)
    {
        $counts = [
            'pengajuan' => Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(),
            'diterima' => Pendaftaran::where('status_pendaftaran', 'diterima')->count(),
            'tidak_diterima' => Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(),
        ];

        // PERBAIKAN DI SINI: Menambahkan kembali kolom yang hilang
        $detail = Pendaftaran::select(
                'pendaftaran.*', 
                'users.email', 
                'users.name as nama_lengkap', 
                'users.nim',
                'users.tempat_lahir', // Ditambahkan kembali
                'users.tanggal_lahir', // Ditambahkan kembali
                'users.jenis_kelamin', // Ditambahkan kembali
                'users.alamat_lengkap', // Ditambahkan kembali
                'users.no_telp'        // Ditambahkan kembali
            )
            ->join('users', 'pendaftaran.id_users', '=', 'users.id')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->first();

        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => $detail,
        ];
        
        $data = array_merge($data, $counts);

        return view('admin/detailpendaftaran')->with('data', $data);
    }

    public function diterima(Request $request){
        $id_pendaftaran = $request->id_pendaftaran;
        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();
        $users = User::where('id', $pendaftaran->id_users)->first();

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update([
            'status_pendaftaran' => 'diterima',
            'keterangan' => $request->keterangan,
        ]);

        $users->status = 'diterima';
        $users->save();

        $data_email = [
            'subject' => 'Selamat! Pendaftaran Magang Diterima',
            'status'  => 'terima', 
            'url'     => url('/login'), 
        ];
        
        Mail::to($users->email)->send(new SendMail($data_email));

        return redirect('data-pendaftaran')->with('suc_message', 'Status diperbarui dan email penerimaan berhasil dikirim.');
    }

    public function tidak_diterima(Request $request){
        $id_pendaftaran = $request->id_pendaftaran;
        $pendaftaran = Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->first();
        $users = User::where('id', $pendaftaran->id_users)->first();

        Pendaftaran::where('id_pendaftaran', $id_pendaftaran)->update([
            'status_pendaftaran' => 'tidak diterima',
            'keterangan' => $request->keterangan,
        ]);

        $data_email = [
            'subject' => 'Informasi Status Pendaftaran Magang',
            'status'  => 'tolak',
            'url'     => url('/login'),
        ];

        Mail::to($users->email)->send(new SendMail($data_email));

        return redirect('data-pendaftaran')->with('suc_message', 'Status diperbarui dan email penolakan berhasil dikirim.');
    }
}