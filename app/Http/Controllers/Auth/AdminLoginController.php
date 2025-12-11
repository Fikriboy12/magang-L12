<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Menampilkan form login khusus Admin.
     * Dipanggil via URL: /admin/login
     */
    public function showLoginForm()
    {
        // Memanggil view login khusus Admin
        return view('auth.admin-login'); 
    }

    /**
     * Menangani proses login Admin.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            
            // Cek ROLE pengguna yang baru login
            if (Auth::user()->role === 'admin') {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard')); 
            }
            
            // Jika login sukses TAPI role bukan admin, logout dan beri notif error
            Auth::logout();
            return redirect()->route('admin.login')->with('err_message', 'Akses ditolak. Anda tidak berhak login sebagai Admin.');
        }

        // Jika login gagal (password/email salah)
        return redirect()->back()->with('err_message', 'Email atau Password salah.');
    }
}