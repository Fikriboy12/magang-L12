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
    // 🔐 PROSES LOGIN (DIPERBAIKI)
    // =======================
    public function action_login(Request $request)
    {
        // 1. Validasi Input Kosong
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // 2. CEK EMAIL DULU (Manual)
        // Kita cari apakah ada user dengan email ini
        $cekUser = User::where('email', $request->email)->first();

        if (!$cekUser) {
            // JIKA EMAIL TIDAK DITEMUKAN DI DATABASE
            return back()->with('error', 'Email yang Anda masukkan tidak terdaftar.');
        }

        // 3. CEK PASSWORD (Auth Attempt)
        // Jika kode sampai sini, berarti Email BENAR. Sekarang cek Password.
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::user();
            
            // Pesan Sukses
            $pesan = 'Berhasil Login! Selamat datang ' . $user->name;

            // =================================
            // 🔄 REDIRECT BERDASARKAN ROLE
            // =================================
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('success', $pesan);
            }

            if ($user->role === 'pelamar') {
                return redirect()->route('home.auth')
                    ->with('success', $pesan);
            }

            // --- Logic Pembimbing ---
            if ($user->role === 'pembimbing') {
                return redirect()->route('pembimbing.dashboard')
                    ->with('success', $pesan);
            }
            // -------------------------------------------

            return redirect()->route('home.auth')->with('success', $pesan);
        }

        // 4. JIKA PASSWORD SALAH
        // Karena Email sudah dicek di tahap 2 dan ada, berarti Passwordnya yang salah
        return back()->with('error', 'Kata sandi yang Anda masukkan salah.');
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
            'tanggal_lahir' => $request->tgl_lahir,  
            'alamat_lengkap' => $request->alamat     
        ]);

        return redirect()->route('profile.view')
            ->with('success', 'Profil berhasil dilengkapi!');
    }

    // =======================
    // ✏ UPDATE PROFILE
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
            'alamat' => 'required', 
        ]);

        // 2. Cek Password Baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 3. Update Database
        $user->update([
            'name'           => $request->nama_lengkap,
            'email'          => $request->email,
            'no_telp'        => $request->no_telp,
            'nim'            => $request->nim,
            'tempat_lahir'   => $request->tempat_lahir,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'alamat_lengkap' => $request->alamat 
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}