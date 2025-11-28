<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'profile',
            'lengkapi_profile',
            'update_profile',
            'insert_lengkapi_profile'
        ]);
    }

    // =======================
    // 🚪 FORM LOGIN
    // =======================
    public function login()
    {
        return view('auth.login');
    }

    // =======================
    // 🔐 PROSES LOGIN
    // =======================
    public function action_login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();

            // =================================
            // 🔄 REDIRECT BERDASARKAN ROLE
            // =================================
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', 'Selamat datang Admin!');
            }

            if ($user->role === 'pelamar') {
                return redirect()->route('home.auth')
                    ->with('success', 'Selamat datang Pelamar!');
            }

            // --- Logic Pembimbing ---
            if ($user->role === 'pembimbing') {
                return redirect()->route('pembimbing.dashboard')
                    ->with('success', 'Selamat datang Pembimbing!');
            }
            // -------------------------------------------

            return redirect()->route('home.auth');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah!',
        ]);
    }

    // =======================
    // 🚪 LOGOUT
    // =======================
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }

    // =======================
    // 👤 PROFILE
    // =======================
    public function profile()
    {
        $user = Auth::user();
        
        // Kita bungkus dalam array $data agar sesuai dengan View profile.blade.php
        $data = [
            'title' => 'Profile Saya',
            'profile' => $user
        ];

        return view('auth.profile', compact('data'));
    }

    // =======================
    // 📝 FORM LENGKAPI PROFILE
    // =======================
    public function lengkapi_profile()
    {
        $user = Auth::user();
        return view('auth.lengkapi_profile', compact('user'));
    }

    // =======================
    // 📝 INSERT LENGKAPI PROFILE
    // =======================
    public function insert_lengkapi_profile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required',
            'tgl_lahir' => 'required',
            'alamat' => 'required',
        ]);

        $user->update([
            'name' => $request->nama_lengkap,
            // Mapping kolom DB yang benar:
            'tanggal_lahir' => $request->tgl_lahir,  
            'alamat_lengkap' => $request->alamat     
        ]);

        return redirect()->route('profile.view')
            ->with('success', 'Profil berhasil dilengkapi!');
    }

    // =======================
    // ✏ UPDATE PROFILE (YANG DIPERBAIKI)
    // =======================
    public function update_profile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = User::find(Auth::user()->id);

        // 1. Validasi
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'nim' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required', // input name="alamat"
        ]);

        // 2. Cek Password Baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 3. Update Database (Mapping Input -> Kolom DB)
        $user->update([
            'name'           => $request->nama_lengkap,
            'email'          => $request->email,
            'no_telp'        => $request->no_telp,
            'nim'            => $request->nim,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            
            // Perbaikan: Simpan input 'alamat' ke kolom 'alamat_lengkap'
            'alamat_lengkap' => $request->alamat 
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}