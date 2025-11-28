<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered; 

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        // 1. Validasi
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            
            // Biodata
            'no_telp' => 'required|string|max:20',
            'nim' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'alamat_lengkap' => 'required|string',
            
            'agree' => 'accepted',
        ]);

        // 2. Simpan Data
        $user = User::create([
            'name' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pelamar', 
            'status' => 1, 
            
            'no_telp' => $validated['no_telp'],
            'nim' => $validated['nim'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
        ]);

        // Panggil event Registered (standar Laravel) untuk proses framework
        event(new Registered($user));

        // PENTING: Kita TIDAK melakukan Auth::login() agar user tidak langsung masuk.
        // Hapus kode logout paksa.

        // 3. Arahkan kembali ke halaman register dengan notifikasi sukses
        return redirect()->route('register')->with('success', 'Akun anda berhasil dibuat!.');
    }
}