<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DataPembimbingLapanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pembimbing Lapangan',
            'pembimbing_lapangans' => User::where('role', 'pembimbing_lapangan')->withCount('siswaLapangan')->latest()->get()
        ];

        return view('admin.datapembimbinglapangan', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'no_telp'   => 'required',
            'alamat'    => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::create([
            'name'           => $request->name,
            'nama_lengkap'   => $request->name,
            'email'          => $request->email,
            'no_telp'        => $request->no_telp,
            'alamat_lengkap' => $request->alamat ?? '',
            'password'       => Hash::make($request->password),
            'role'           => 'pembimbing_lapangan',
            'status'         => '1',
        ]);

        return redirect()->route('admin.pembimbing_lapangan.index')->with('suc_message', 'Data Pembimbing Lapangan berhasil ditambahkan!');
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,'.$id,
            'no_telp' => 'required',
        ]);

        $data = [
            'name'           => $request->name,
            'nama_lengkap'   => $request->name,
            'email'          => $request->email,
            'no_telp'        => $request->no_telp,
            'alamat_lengkap' => $request->alamat ?? '',
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);

        return redirect()->back()->with('suc_message', 'Data Pembimbing Lapangan berhasil diupdate!');
    }

    public function delete($id)
    {
        User::where('id', $id)->delete();
        return redirect()->back()->with('suc_message', 'Data Pembimbing Lapangan berhasil dihapus!');
    }

    public function non_aktiv(Request $request)
    {
        $id = $request->id;
        $data = ['status' => $request->aktiv];
        User::where('id', $id)->update($data);

        return response()->json(['success' => true]);
    }
}
