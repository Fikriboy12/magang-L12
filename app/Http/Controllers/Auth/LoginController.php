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

            // --- Logic Pembimbing (Sesuai kode Anda) ---
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
    // 👤 PROFILE (BAGIAN YANG DIPERBAIKI)
    // =======================
    public function profile()
    {
        // PERBAIKAN: View profile.blade.php membutuhkan variable $data['profile']
        // Sebelumnya Anda hanya mengirim compact('user'), makanya error "Undefined variable $data"
        
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
        // Jika view lengkapi_profile juga menggunakan $data['profile'], ubah juga bagian ini.
        // Tapi jika masih pakai $user, biarkan seperti ini.
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
            'name' => $request->nama_lengkap, // Pastikan kolom di DB 'name' atau sesuaikan
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
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required',
            'alamat' => 'required'
        ]);

        // Perhatikan: Kolom di tabel users defaultnya adalah 'name', bukan 'nama_lengkap'
        // Jika di DB kolomnya 'name', ganti 'nama_lengkap' di bawah jadi 'name'
        $user->update([
            'name' => $request->nama_lengkap, 
            'alamat' => $request->alamat
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}