<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataOrangTuaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Orang Tua',
            'orangtuas' => User::with('anak')
                ->where('role', 'orang_tua')
                ->latest()
                ->get(),
            'siswas' => User::where('role', 'pelamar')
                ->orderBy('name', 'asc')
                ->get()
        ];

        return view('admin.dataorangtua', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users,email',
            'password'  => 'required|string|min:8',
            'no_telp'   => 'required|string|max:30',
            'siswa_id'  => 'required|exists:users,id',
        ], [
            'siswa_id.required' => 'Wajib memilih siswa / anak yang diasuh.',
            'siswa_id.exists'   => 'Siswa yang dipilih tidak valid.',
            'email.unique'      => 'Alamat email sudah terdaftar di sistem.',
            'password.min'      => 'Password minimal terdiri dari 8 karakter.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'no_telp'   => $request->no_telp,
            'password'  => Hash::make($request->password),
            'role'      => 'orang_tua',
            'siswa_id'  => $request->siswa_id,
        ]);

        return redirect()->route('admin.orangtua.index')->with('suc_message', 'Akun Orang Tua berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'no_telp'  => 'required|string|max:30',
            'siswa_id' => 'required|exists:users,id',
        ], [
            'siswa_id.required' => 'Wajib memilih siswa / anak yang diasuh.',
            'siswa_id.exists'   => 'Siswa yang dipilih tidak valid.',
        ]);

        $data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'no_telp'  => $request->no_telp,
            'siswa_id' => $request->siswa_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Orang Tua berhasil diperbarui!');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Orang Tua berhasil dihapus!');
    }
}
