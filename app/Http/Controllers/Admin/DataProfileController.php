<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DataProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Profile",
            'profile' => Profile::first(),
        ];

        return view('admin/dataprofile')->with('data', $data);
    }



    public function update(Request $request){

        $id_perusahaan = $request->id_perusahaan;
            

        $gambar = $request->file('gambar');



        if($gambar != null){
            $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
    
            $tujuan_upload = 'assets_admin/img/profile_perusahaan';
    
            $gambar->move($tujuan_upload,$nama_document_gambar);

            $data = [
                'nama_perusahaan' => $request->nama_perusahaan,
                'deskripsi' => $request->deskripsi,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'no_hp' => $request->no_hp,
                'facebook' => $request->facebook,
                'email' => $request->email,
                'instagram' => $request->instagram,
                'alamat' => $request->alamat,
                'id_users' => Auth::user()->id,
                'gambar_perusahaan' => $nama_document_gambar,
                
            ];
    
            Profile::where('id_perusahaan', $id_perusahaan)->update($data);

        }else{
            $data = [
                'nama_perusahaan' => $request->nama_perusahaan,
                'deskripsi' => $request->deskripsi,
                'visi' => $request->visi,
                'misi' => $request->misi,
                'no_hp' => $request->no_hp,
                'facebook' => $request->facebook,
                'email' => $request->email,
                'instagram' => $request->instagram,
                'alamat' => $request->alamat,
                'id_users' => Auth::user()->id,
                
            ];
    
            Profile::where('id_perusahaan', $id_perusahaan)->update($data);
        }
        

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

   
}
