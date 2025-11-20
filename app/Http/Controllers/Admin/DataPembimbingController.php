<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataPembimbingController extends Controller
{
    public function index()
    {
        // Kita samakan strukturnya menggunakan array $data
        $data = [
            'title' => 'Data Pembimbing',
            'pembimbings' => User::where('role', 'pembimbing')->latest()->get()
        ];

        return view('admin.datapembimbing', compact('data'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            // Asumsi kolom no_telp dan alamat ada di tabel users karena ada di dataadmin
            'no_telp'  => 'required', 
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Simpan Data
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_telp'  => $request->no_telp, // Tambahan sesuai template kamu
            'alamat'   => $request->alamat,  // Tambahan sesuai template kamu
            'password' => Hash::make($request->password),
            'role'     => 'pembimbing',
        ]);

        return redirect()->route('admin.pembimbing.index')->with('suc_message', 'Data Pembimbing berhasil ditambahkan!');
    }
    
    // Tambahkan method update/delete nanti jika diperlukan
}