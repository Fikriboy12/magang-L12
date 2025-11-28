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
    
    // Fungsi Index tidak perlu diubah jika sudah benar di route
    // Tapi biasanya sertifikat ditampilkan menyatu di DataLamaranController
    // Jika route kamu mengarah ke sini, biarkan saja.

    public function insert(Request $request){

        $id_user = Auth::user()->id;

        // 1. Cek Validasi: Apakah user sudah pernah mengajukan?
        $cek = Sertifikat::where('created_by', $id_user)->first();
        if($cek) {
            return redirect()->back()->with('err_message', 'Anda sudah melakukan pengajuan sertifikat.');
        }

        // 2. Simpan Data menggunakan create()
        // create() otomatis mengisi created_at & updated_at
        Sertifikat::create([
            'nama_sertifikat'  => 'Pengajuan Sertifikat Magang', // Default nama, atau dari $request->nama_sertifikat
            'status_pengajuan' => 'pending', // Gunakan 'pending' agar sesuai View (bukan 'pengajuan')
            'file_path'        => null,      // Karena DB sudah Default NULL, ini aman
            'created_by'       => $id_user,
        ]);

        return redirect()->back()->with('suc_message', 'Pengajuan berhasil dikirim! Menunggu konfirmasi Admin.');
    }


    public function update(Request $request){

        $id_sertifikat = $request->id_sertifikat;
        
        $data = [
            'nama_sertifikat'  => $request->nama_sertifikat,
            // Jika diupdate user, status kembali ke pending
            'status_pengajuan' => 'pending', 
            // 'updated_by' tidak ada di tabel sertifikat default, hati-hati error
            // 'updated_by' => Auth::user()->id, 
        ];

        Sertifikat::where('id_sertifikat', $id_sertifikat)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diperbarui!');
    }

    public function delete($id_sertifikat){
        Sertifikat::where('id_sertifikat', $id_sertifikat)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }

    public function cetak($id_sertifikat){
        
        // Menggunakan join agar nama user terbaca di PDF
        $detail = Sertifikat::join('users', 'sertifikat.created_by', '=', 'users.id')
                            ->where('sertifikat.id_sertifikat', $id_sertifikat)
                            ->first();
                            
        if(!$detail) {
            return redirect()->back()->with('err_message', 'Data sertifikat tidak ditemukan.');
        }

        $data = [
            'title'  => "Cetak Sertifikat",
            'detail' => $detail,
        ];

        $pdf = PDF::loadview('pelamar/cetaksertifikat', $data);
        
        // Set Paper Landscape untuk sertifikat
        return $pdf->setPaper('a4', 'landscape')->stream('sertifikat.pdf');
    }

}