<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// Tambahkan Carbon jika digunakan di fungsi lain (walaupun tidak terlihat di kode yang Anda kirim)
use Carbon\Carbon; 

class DataPembimbingController extends Controller
{
    public function index()
    {
        // Kita samakan strukturnya menggunakan array $data
        $data = [
            'title' => 'Data Guru Pembimbing',
            // Ambil data user yang memiliki role 'pembimbing'
            'pembimbings' => User::where('role', 'pembimbing')->latest()->get()
        ];

        return view('admin.datapembimbing', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'no_telp'   => 'required', 
            // HAPUS 'alamat' DARI VALIDASI
            // 'alamat'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Simpan Data
        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'no_telp'   => $request->no_telp, 
            // HAPUS ALAMAT DARI PROSES CREATE/INSERT
            // 'alamat'    => $request->alamat, 
            'password'  => Hash::make($request->password),
            'role'      => 'pembimbing',
        ]);

        return redirect()->route('admin.pembimbing.index')->with('suc_message', 'Data Guru Pembimbing berhasil ditambahkan!');
    }
    
    // Tambahkan method update (diambil dari pola Data Admin sebelumnya)
    public function update(Request $request){

        $id = $request->id;
            
        // Validasi untuk update
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id, // Ignore current user
            'no_telp' => 'required',
            // 'alamat' => 'required', // HAPUS VALIDASI ALAMAT
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            // 'alamat' => $request->alamat, // HAPUS PENGAMBILAN ALAMAT
        ];

        // Cek jika password diisi baru di-hash
        if($request->filled('password')){
             $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Berhasil diupdate!');
    }

    // Tambahkan method delete
    public function delete($id){
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Berhasil Dihapus!');
    }

    // Tambahkan method non_aktiv jika ada
    public function non_aktiv(Request $request){
        $id = $request->id;
        $data = ['status' => $request->aktiv];
        // Asumsi kolom 'status' ada di tabel users
        User::where('id', $id)->update($data);
        return redirect()->back()->with('suc_message', 'Status Berhasil Diubah!');
    }
}