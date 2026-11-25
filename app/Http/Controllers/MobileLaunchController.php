<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileLaunchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Memproses Deep Linking 1-Klik dari Web ke Aplikasi Mobile (APK)
     * Mengambil session user web, generate Sanctum Token, lalu membuka APK via custom URI scheme.
     */
    public function launch(Request $request)
    {
        $user = Auth::user();

        // 1. Buat token Sanctum mobile untuk user yang sedang aktif
        $token = $user->createToken('deep_link_auth_token')->plainTextToken;

        // 2. Susun Deep Link URL khusus (Custom URI Scheme & Chrome Intent)
        $query = http_build_query([
            'token'    => $token,
            'user_id'  => $user->id,
            'name'     => $user->name,
            'email'    => $user->email,
            'role'     => $user->role,
        ]);

        $deepLinkUrl = "magangapp://auth-callback?" . $query;
        $intentUrl   = "intent://auth-callback?" . $query . "#Intent;scheme=magangapp;package=com.example.e_magang;end";

        // 3. Tampilkan halaman launcher modern yang otomatis meluncurkan APK
        return view('auth.mobile_launcher', compact('deepLinkUrl', 'intentUrl', 'user', 'token'));
    }
}
