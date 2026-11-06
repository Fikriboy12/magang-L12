<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // --- 1. KIRIM OTP (TETAP SAMA SEPERTI ASLINYA) ---
    public function sendOtpAjax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => 'Email tidak valid atau sudah terdaftar!']);
        }

        $otp = rand(1000, 9999); 

        Session::put('registrasi_otp', $otp);
        Session::put('registrasi_email', $request->email);

        $details = [
            'nama' => 'Calon Pendaftar', 
            'otp'  => $otp
        ];

        try {
            Mail::to($request->email)->send(new SendOtpMail($details));
            return response()->json(['status' => 'success', 'message' => 'Kode OTP 4 digit berhasil dikirim!']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Gagal mengirim email. Cek koneksi internet.']);
        }
    }

    // --- 2. PROSES REGISTER (DISESUAIKAN DENGAN FORM BARU) ---
    public function register(Request $request)
    {
        $validated = $request->validate([
            // Data Akun
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z]/', // Wajib ada huruf
                'regex:/[0-9]/',     // Wajib ada angka
            ],
            'no_hp_siswa' => 'required|string|max:20', 
            'otp_input' => 'required|numeric', 

            // Verifikasi Biometrik
            'face_descriptor' => 'required|string', 
        ], [
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.regex' => 'Kata sandi harus berupa kombinasi huruf dan angka (tidak boleh hanya huruf saja atau hanya angka saja).',
        ]);

        // Cek kecocokan OTP
        $sessionOtp = Session::get('registrasi_otp');
        $sessionEmail = Session::get('registrasi_email');

        if ($request->otp_input != $sessionOtp || $request->email != $sessionEmail) {
            return back()->withInput()->with('error', 'Kode OTP Salah atau Email berubah!');
        }

        // Simpan ke Database
        $user = User::create([
            // Data Akun
            'name' => $validated['nama_lengkap'],         // Disimpan ke name
            'nama_lengkap' => $validated['nama_lengkap'], // Disimpan ke nama_lengkap juga (sesuai struktur tabel Anda)
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'pelamar', 
            'status' => 1, 
            'no_telp' => $validated['no_hp_siswa'],       // Input no_hp_siswa disimpan ke kolom no_telp
            'email_verified_at' => now(), 

            // Data Biometrik Wajah
            'face_descriptor' => $validated['face_descriptor'],
        ]);

        // Hapus session setelah berhasil
        Session::forget('registrasi_otp');
        Session::forget('registrasi_email');

        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan Login menggunakan Email atau Wajah Anda.');
    }
}