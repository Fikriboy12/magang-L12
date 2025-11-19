<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

            // --- INI PERBAIKANNYA ---
            if ($user->role === 'pembimbing') {
                // Saya ganti 'pembimbing.laporan.index' menjadi 'pembimbing.dashboard'
                return redirect()->route('pembimbing.dashboard')
                    ->with('success', 'Selamat datang Pembimbing!');
            }
            // --- BATAS PERBAIKAN ---

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
        return view('auth.profile', compact('user'));
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
            'nama_lengkap' => $request->nama_lengkap,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat
        ]);

        return redirect()->route('profile.view')
            ->with('success', 'Profil berhasil dilengkapi!');
    }

    // =======================
    // ✏ UPDATE PROFILE
    // =======================
    public function update_profile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required'
        ]);

        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}