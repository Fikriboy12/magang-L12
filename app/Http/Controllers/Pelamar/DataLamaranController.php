<?php

namespace App\Http\Controllers\Pelamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Informasi;
use App\Models\Sertifikat;
use App\Models\DetailUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;

class DataLamaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // =================================================================
    // BAGIAN INI YANG SAYA PERBAIKI (FUNGSI INDEX)
    // =================================================================
    public function index()
    {
        $id_users = Auth::user()->id;

        // Menggunakan 'with(user)' agar bisa dipanggil $item->user->name di View
        $data_lamaran = Pendaftaran::with('user')
                                   ->where('id_users', $id_users)
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        // Mengambil data sertifikat
        $data_sertifikat = Sertifikat::where('created_by', $id_users)->get();

        // Kirim variable menggunakan compact (agar tidak Undefined variable di View)
        return view('pelamar/datalamaran', compact('data_lamaran', 'data_sertifikat'));
    }
    // =================================================================


    // FUNGSI DI BAWAH INI TIDAK SAYA UBAH (SESUAI PERMINTAAN)
    
    public function detail($id_pendaftaran)
    {
        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')->where('id_pendaftaran', $id_pendaftaran)->first(),
        ];

        return view('pelamar/detaillamaran')->with('data', $data);
    }


    public function detail_informasi($id_informasi){
        $data = [
            'title' => "Detail Informasi ",
            'informasi' => Informasi::where('id_informasi', $id_informasi)->first(),
        ];

        return view('pelamar/detailinformasi')->with('data', $data);
    }

    public function cetak($id_pendaftaran){
        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')->where('id_pendaftaran', $id_pendaftaran)->first(),
        ];


        $pdf = PDF::loadview('pelamar/cetaklamaran', $data);
        //mendownload laporan.pdf
        return $pdf->stream('laporan.pdf');
    }

}