<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class DataAdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = [
            'title' => "Data Admin",
            'users' => User::where('role', 'admin')->get(),
        ];

        return view('admin/dataadmin')->with('data', $data);
    }



    public function insert(Request $request){

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'role' => 'admin',
            'status' => '1',
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ];


        User::insert($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil disimpan!');
    }

    public function update(Request $request){

        $id = $request->id;
            
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function non_aktiv(Request $request){

        $id = $request->id;
      
            
        $data = [
            'status' => $request->aktiv,
        ];

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }

}
