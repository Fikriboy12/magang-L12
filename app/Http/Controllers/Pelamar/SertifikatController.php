<?php

namespace App\Http\Controllers\Pelamar;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;
use App\Models\Sertifikat;
use App\Models\Informasi;
use App\Models\DetailUsers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PDF;

class SertifikatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $id_users = Auth::user()->id;
        $data = [
            'title' => "Data Lamaran",
            'data_lamaran' => Pendaftaran::join('users', 'pendaftaran.id_users', '=', 'users.id')->leftjoin('detail_users', 'detail_users.id_users', '=', 'users.id')->where('pendaftaran.id_users', $id_users)->get(),
        ];

        return view('pelamar/datalamaran')->with('data', $data);
    }

    public function insert(Request $request){

        $data = [
            'nama_sertifikat' => $request->nama_sertifikat,
            'status_pengajuan' => 'pengajuan',
            'created_by' => Auth::user()->id,
        ];


        Sertifikat::insert($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }


    public function update(Request $request){

        $id_sertifikat = $request->id_sertifikat;
        $data = [
            'nama_sertifikat' => $request->nama_sertifikat,
            'status_pengajuan' => 'pengajuan',
            'updated_by' => Auth::user()->id,
        ];


        Sertifikat::where('id_sertifikat', $id_sertifikat)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function delete($id_sertifikat){
        Sertifikat::where('id_sertifikat', $id_sertifikat)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }


    

    public function cetak($id_sertifikat){
        $data = [
            'title' => "Cetak Sertifikat",
            'detail' => Sertifikat::join('users', 'sertifikat.created_by', '=', 'users.id')->where('sertifikat.id_sertifikat', $id_sertifikat)->first(),
        ];


        $pdf = PDF::loadview('pelamar/cetaksertifikat', $data);
        //mendownload laporan.pdf
    	// return $pdf->stream('sertifikat.pdf');
        return $pdf->setPaper('a4', 'landscape')->stream('sertifikat.pdf');
        
    }


}
