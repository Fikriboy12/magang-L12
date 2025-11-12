<?php

namespace App\Http\Controllers\Pelamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\DetailUsers;
use App\Models\Pendaftaran;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class PendaftaranController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id_users = Auth::user()->id;
        $data = [
            'title' => "Data Pendaftaran",
            'users' => DetailUsers::where('id_users', $id_users)->first(),
        ];

        return view('pelamar/pendaftaran')->with('data', $data);
    }



    public function insert(Request $request){

        $id_users = Auth::user()->id;
        $cek_pendaftarn = Pendaftaran::where('status_pendaftaran', 'pengajuan')->where('id_users', $id_users)->get()->count();
        if( $cek_pendaftarn > 0){
            return redirect()->back()->with('err_message', 'Hasil Lamaran Masih Dalam Proses!');
        }
        $cv = $request->file('cv');
        $nama_document_cv = time()."_".$cv->getClientOriginalName();
        $gambar = $request->file('gambar');
        $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
        $ktp = $request->file('ktp');
        $nama_document_ktp = time()."_".$ktp->getClientOriginalName();
        $surat_rekomendasi = $request->file('surat_rekomendasi');
        $nama_document_surat_rekomendasi = time()."_".$surat_rekomendasi->getClientOriginalName();

        $tujuan_upload = 'berkas';
        $tujuan_gambar = 'gambar';

        $cv->move($tujuan_upload,$nama_document_cv);
        $gambar->move($tujuan_gambar,$nama_document_gambar);
        $ktp->move($tujuan_upload,$nama_document_ktp);
        $surat_rekomendasi->move($tujuan_upload,$nama_document_surat_rekomendasi);


        $proposal = $request->file('proposal');
        if ($proposal != null) {
            $nama_proposal = time()."_".$proposal->getClientOriginalName();
            $proposal->move($tujuan_upload,$nama_proposal);
        }else{
            $nama_proposal = '';   
        }

        $data = [
            'universitas' => $request->universitas,
            'prodi' => $request->prodi,
            'jurusan' => $request->jurusan,
            'dari_tanggal' => $request->dari_tanggal,
            'sampai_tanggal' => $request->sampai_tanggal,
            'gambar' => $nama_document_gambar,
            'ktp' => $nama_document_ktp,
            'cv' => $nama_document_cv,
            'proposal' => $nama_proposal,
            'surat_rekomendasi' => $nama_document_surat_rekomendasi,
            'status_pendaftaran' => 'pengajuan',
            'id_users' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ];



        Pendaftaran::insert($data);

        return redirect('data-lamaran')->with('suc_message', 'Data Pendaftaran berhasil!');
    }

    

}
