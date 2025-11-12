<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Profile;
use App\Models\Galeri;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DataGaleriController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Galeri",
            'galeri' => Galeri::get(),
        ];

        return view('admin/datagaleri')->with('data', $data);
    }

    public function insert(Request $request){

        $id_galeri = $request->id_galeri;
       

        $gambar = $request->file('gambar');


        $nama_document_gambar = time()."_".$gambar->getClientOriginalName();

        $tujuan_upload = 'assets_admin/img/galeri';

        $gambar->move($tujuan_upload,$nama_document_gambar);

        $data = [
            'created_at' => Carbon::now(),  
            'galeri_gambar' => $nama_document_gambar,
            
        ];

        Galeri::insert($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id_galeri = $request->id_galeri;

        $gambar = $request->file('gambar');
        $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
        $tujuan_upload = 'assets_admin/img/galeri';
        $gambar->move($tujuan_upload,$nama_document_gambar);

        $data = [
            'galeri_gambar' => $nama_document_gambar,
        ];


        Galeri::where('id_galeri', $id_galeri)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id){
        Galeri::where('id_galeri', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }

   
}
