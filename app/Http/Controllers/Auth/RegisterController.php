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

    // --- 1. KIRIM OTP (PENDAFTARAN SISWA) ---
    public function sendOtpAjax(Request $request)
    {
        $email = strtolower(trim($request->email ?? ''));
        $request->merge(['email' => $email]);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email'
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format alamat email tidak valid.',
            'email.unique'   => 'Email ini sudah terdaftar di sistem! Silakan langsung login.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error', 
                'message' => $validator->errors()->first('email')
            ]);
        }

        $otp = rand(1000, 9999); 

        Session::put('registrasi_otp', $otp);
        Session::put('registrasi_email', $email);

        $details = [
            'nama'    => 'Calon Siswa / Pendaftar', 
            'otp'     => $otp,
            'subject' => 'Kode verifikasi akun Anda: ' . $otp,
            'judul'   => 'Verifikasi Pendaftaran Akun Magang',
            'pesan'   => 'Gunakan kode verifikasi berikut untuk menyelesaikan pendaftaran akun magang Anda:'
        ];

        try {
            Mail::to($email)->send(new SendOtpMail($details));
            \Illuminate\Support\Facades\Log::info("OTP Registrasi berhasil dikirim ke {$email}: {$otp}");

            return response()->json([
                'status'  => 'success', 
                'message' => 'Kode OTP 4 digit telah dikirim ke ' . $email . '. Silakan periksa Kotak Masuk atau folder Spam di Gmail Anda.'
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error("Gagal mengirim email OTP ke {$email}: " . $e->getMessage());
            return response()->json([
                'status'  => 'error', 
                'message' => 'Gagal mengirim email: ' . $e->getMessage() . '. Pastikan koneksi internet stabil.'
            ]);
        }
    }

    // --- 2. PROSES REGISTER (DISESUAIKAN DENGAN FORM BARU) ---
    public function register(Request $request)
    {
        $request->merge(['email' => strtolower(trim($request->email ?? ''))]);

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

        if ($request->otp_input != $sessionOtp || strtolower(trim($request->email)) != strtolower(trim($sessionEmail))) {
            return back()->withInput()->with('error', 'Kode OTP Salah atau Email berubah!');
        }

        // Validasi keaslian fitur biometrik wajah 68 Landmark (128 nilai floating point)
        $desc = json_decode($validated['face_descriptor'], true);
        if (!is_array($desc) || count($desc) !== 128) {
            return back()->withInput()->with('error', 'Data biometrik wajah tidak valid. Silakan ambil foto wajah dengan 68 landmark menghadap depan kembali.');
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