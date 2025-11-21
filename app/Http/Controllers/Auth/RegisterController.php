<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest'); // Hanya guest bisa akses
    }

    // Tampilkan form register
    public function showRegistrationForm()
    {
        return view('auth.register'); // Blade register
    }

    // Proses register
    public function register(Request $request)
    {
        // 1. Validasi (TIDAK SAYA UBAH, SESUAI PERMINTAAN)
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'nik' => 'required|string|max:50',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'agree' => 'accepted',
        ]);

        // 2. Simpan Data (TIDAK SAYA UBAH, SESUAI PERMINTAAN)
        User::create([
            'name' => $validated['nama_lengkap'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pelamar', // selalu pelamar
            'status' => 1, 
            'no_telp' => $validated['no_telp'],
            'alamat' => $validated['alamat'],
            'nim' => $validated['nim'],
            'nik' => $validated['nik'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'agama' => $validated['agama'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
        ]);

        // 3. PERUBAHAN DI SINI:
        // - Redirect pakai back() (tetap di halaman register)
        // - Nama session jadi 'success' (agar muncul hijau di view register)
        return redirect()->back()->with('success', 'Registrasi berhasil! Silakan loginAkun Anda');
    }
}