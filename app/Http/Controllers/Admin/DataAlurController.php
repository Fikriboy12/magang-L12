<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Alur;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class DataAlurController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Alur",
            'data_alur' => Alur::get(),
        ];

        return view('admin/dataalur')->with('data', $data);
    }



    public function insert(Request $request){


        $gambar = $request->file('gambar');


        $nama_document_gambar = time()."_".$gambar->getClientOriginalName();

        $tujuan_upload = 'assets_admin/img/alur';

        $gambar->move($tujuan_upload,$nama_document_gambar);

        $data = [
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'gambar_alur' => $nama_document_gambar,
            'created_at' => Carbon::now(),
        ];


        Alur::insert($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id_alur = $request->id_alur;
            
        $gambar = $request->file('gambar');

        if ($gambar == null) {
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
            ];
        } else {
            $nama_document_gambar = time()."_".$gambar->getClientOriginalName();
    
            $tujuan_upload = 'assets_admin/img/Alur';
    
            $gambar->move($tujuan_upload,$nama_document_gambar);
    
            $data = [
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'gambar_alur' => $nama_document_gambar,
            ];
            # code...
        }
        

        Alur::where('id_alur', $id_alur)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }


    public function delete($id_alur){
        Alur::where('id_alur', $id_alur)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }

}
