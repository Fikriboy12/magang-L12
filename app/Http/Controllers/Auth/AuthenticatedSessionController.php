<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * INI ADALAH FUNGSI YANG KITA MODIFIKASI
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Coba login (seperti biasa)
        $request->authenticate();

        // 2. Regenerate session
        $request->session()->regenerate();

        // 3. Ambil user yang baru saja login
        $user = $request->user();

        // 4. LOGIKA REDIRECT BERDASARKAN ROLE (DARI PROYEK LAMA ANDA)
        if ($user->role == 'admin') {
            return redirect()->intended(route('dashboard')); // Kirim ke /dashboard (admin)
        
        // (Tambahkan 'elseif' untuk pembimbing jika perlu)
        // } elseif ($user->role == 'pembimbing') {
        //    return redirect()->intended(route('pembimbing.dashboard'));

        } else {
            // Pelamar dan role lain dikirim ke halaman 'home'
            return redirect()->intended(route('home')); 
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}