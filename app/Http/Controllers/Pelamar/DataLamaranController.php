<?php

namespace App\Http\Controllers\Pelamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Informasi;
use App\Models\Sertifikat;
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
    // FUNGSI INDEX
    // =================================================================
    public function index()
    {
        $id_users = Auth::user()->id;

        $data_lamaran = Pendaftaran::with('user')
                                   ->where('id_users', $id_users)
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        $data_sertifikat = Sertifikat::where('created_by', $id_users)->get();

        return view('pelamar/datalamaran', compact('data_lamaran', 'data_sertifikat'));
    }


    // =================================================================
    // FUNGSI DETAIL
    // =================================================================
    public function detail($id_pendaftaran)
    {
        $detail = Pendaftaran::select(
                'pendaftaran.*', 
                'users.email',
                'users.name as nama_lengkap', 
                'users.nim',
                'users.tempat_lahir',
                'users.tanggal_lahir',
                'users.jenis_kelamin',
                'users.alamat_lengkap',
                'users.no_telp'
            )
            ->join('users', 'pendaftaran.id_users', '=', 'users.id')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->first();

        if (!$detail) {
            return redirect()->back()->with('err_message', 'Data lamaran tidak ditemukan.');
        }

        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => $detail,
        ];

        return view('pelamar/detaillamaran')->with('data', $data);
    }


    // =================================================================
    // FUNGSI DETAIL INFORMASI (DIPERBAIKI)
    // =================================================================
    public function detail_informasi($id_informasi){
        
        // PERBAIKAN UTAMA:
        // Hanya cari berdasarkan 'id_informasi'.
        // Hapus logika 'OR where id' karena kolom id tidak ada.
        $informasi = Informasi::where('id_informasi', $id_informasi)->first();
        
        // Jika data tidak ditemukan (NULL), kembalikan user agar tidak error di View
        if (!$informasi) {
            return redirect()->route('pelamar.lamaran.index')->with('err_message', 'Maaf, data informasi tidak ditemukan.');
        }

        $data = [
            'title' => "Detail Informasi ",
            'informasi' => $informasi,
        ];

        return view('pelamar/detailinformasi')->with('data', $data);
    }

    // =================================================================
    // FUNGSI CETAK
    // =================================================================
    public function cetak($id_pendaftaran){
        
        $detail = Pendaftaran::select(
                'pendaftaran.*',
                'users.email',
                'users.name as nama_lengkap',
                'users.nim',
                'users.tempat_lahir',
                'users.tanggal_lahir',
                'users.jenis_kelamin',
                'users.alamat_lengkap',
                'users.no_telp'
            )
            ->join('users', 'pendaftaran.id_users', '=', 'users.id')
            ->where('id_pendaftaran', $id_pendaftaran)
            ->first();

        if (!$detail) {
             return redirect()->back()->with('err_message', 'Data tidak ditemukan.');
        }

        $data = [
            'title' => "Detail Data Pendaftaran",
            'detail_pendaftaran' => $detail,
        ];

        $pdf = PDF::loadview('pelamar/cetaklamaran', $data);
        return $pdf->stream('laporan.pdf');
    }

}