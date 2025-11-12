<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Informasi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class DataInformasiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Informasi",
            'data_informasi' => Informasi::get(),
        ];

        return view('admin/datainfromasi')->with('data', $data);
    }



    public function insert(Request $request){


        $gambar = $request->file('gambar');


        $nama_document_gambar = time()."_".$gambar->getClientOriginalName();

        $tujuan_upload = 'assets_admin/img/informasi';

        $gambar->move($tujuan_upload,$nama_document_gambar);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tgl_informasi' => $request->tgl_informasi,
            'gambar_informasi' => $nama_document_gambar,
            'penulis' => $request->penulis,
            'created_at' => Carbon::now(),
        ];


        Informasi::insert($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id_informasi = $request->id_informasi;
            
        $gambar = $request->file('gambar');

        if ($gambar == null) {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tgl_informasi' => $request->tgl_informasi,
                'penulis' => $request->penulis,
            ];
        } else {
            $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
    
            $tujuan_upload = 'assets_admin/img/informasi';
    
            $gambar->move($tujuan_upload,$nama_document_gambar);
    
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tgl_informasi' => $request->tgl_informasi,
                'gambar_informasi' => $nama_document_gambar,
                'penulis' => $request->penulis,
            ];
            # code...
        }
        

        Informasi::where('id_informasi', $id_informasi)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }


    public function delete($id_informasi){
        informasi::where('id_informasi', $id_informasi)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }

}
