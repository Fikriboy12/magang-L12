<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\SendMail;

class DataSertifikatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data_sertifikat = Sertifikat::leftJoin('users', 'sertifikat.created_by', '=', 'users.id')
                            // PERBAIKAN UTAMA DI SINI:
                            // Ganti 'pendaftaran.id_user' menjadi 'pendaftaran.id_users' (PAKAI S)
                            ->leftJoin('pendaftaran', 'users.id', '=', 'pendaftaran.id_users')
                            ->select(
                                'sertifikat.*', 
                                'users.name as nama_mahasiswa', 
                                'users.email',
                                'users.no_telp',
                                // Data Akademik
                                'pendaftaran.universitas',
                                'pendaftaran.jurusan',
                                'pendaftaran.prodi as program_studi', // Fix sebelumnya (prodi)
                                'pendaftaran.dari_tanggal',
                                'pendaftaran.sampai_tanggal'
                            )
                            ->orderBy('sertifikat.created_at', 'DESC')
                            ->get();

        $data = [
            'title' => "Data Sertifikat",
            'data_sertifikat' => $data_sertifikat,
        ];

        return view('admin/datasertifikat')->with('data', $data);
    }

    public function approve(Request $request)
    {
        $id = $request->id; 

        if (!$id) {
             return redirect()->back()->with('err_message', 'ID Sertifikat tidak ditemukan!');
        }

        $dataUpdate = [
            'status_pengajuan' => $request->status_pengajuan, 
            'updated_at' => Carbon::now(),
        ];

        if ($request->hasFile('file_sertifikat')) {
            $file = $request->file('file_sertifikat');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('sertifikat'), $filename);
            $dataUpdate['file_path'] = $filename;
        }

        Sertifikat::where('id', $id)->update($dataUpdate);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }
    
    public function proses(Request $request)
    {
        return $this->approve($request);
    }
    
    public function delete($id)
    {
        $sertifikat = Sertifikat::where('id', $id)->first();
        
        if($sertifikat){
            if($sertifikat->file_path && file_exists(public_path('sertifikat/' . $sertifikat->file_path))){
                unlink(public_path('sertifikat/' . $sertifikat->file_path));
            }

            $sertifikat->delete();
            return redirect()->back()->with('suc_message', 'Data Berhasil dihapus!');
        }

        return redirect()->back()->with('err_message', 'Data tidak ditemukan!');
    }
}