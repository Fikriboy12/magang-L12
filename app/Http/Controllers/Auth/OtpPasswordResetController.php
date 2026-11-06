<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\SendOtpMail;

class OtpPasswordResetController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Tampilkan form input email untuk permintaan OTP lupa password.
     */
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    /**
     * Kirim kode OTP 4 digit ke email pengguna untuk reset password.
     */
    public function sendResetOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email'    => 'Format alamat email tidak valid.',
            'email.exists'   => 'Alamat email tidak terdaftar di sistem kami.',
        ]);

        $user = User::where('email', $request->email)->first();

        // Generate 4 digit OTP
        $otp = rand(1000, 9999);

        // Simpan ke Session
        Session::put('reset_password_otp', $otp);
        Session::put('reset_password_email', $user->email);
        Session::put('reset_password_expired', now()->addMinutes(10));

        $details = [
            'nama'    => $user->name,
            'otp'     => $otp,
            'subject' => 'Kode OTP Reset Kata Sandi - PT MEDIA BALAI NUSA',
            'judul'   => 'Reset Kata Sandi Akun',
            'pesan'   => 'Kami menerima permintaan untuk mereset kata sandi akun Anda. Masukkan kode OTP berikut untuk melanjutkan pembuatan kata sandi baru:'
        ];

        try {
            Mail::to($user->email)->send(new SendOtpMail($details));
            return redirect()->route('password.reset.form')
                ->with('success', 'Kode OTP verifikasi telah dikirimkan ke email Anda (' . $user->email . '). Silakan cek kotak masuk atau folder spam.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal mengirim email OTP. Silakan pastikan koneksi internet stabil atau hubungi Administrator.');
        }
    }

    /**
     * Kirim ulang kode OTP jika belum masuk ke email.
     */
    public function resendResetOtp(Request $request)
    {
        $email = Session::get('reset_password_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->with('error', 'Sesi telah berakhir. Silakan masukkan email Anda kembali.');
        }

        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('password.request')
                ->with('error', 'Pengguna tidak ditemukan.');
        }

        $otp = rand(1000, 9999);
        Session::put('reset_password_otp', $otp);
        Session::put('reset_password_expired', now()->addMinutes(10));

        $details = [
            'nama'    => $user->name,
            'otp'     => $otp,
            'subject' => 'Kode OTP Reset Kata Sandi (Kirim Ulang) - PT MEDIA BALAI NUSA',
            'judul'   => 'Kirim Ulang Kode OTP Reset Kata Sandi',
            'pesan'   => 'Berikut adalah kode OTP baru untuk mereset kata sandi akun Anda:'
        ];

        try {
            Mail::to($user->email)->send(new SendOtpMail($details));
            return redirect()->back()
                ->with('success', 'Kode OTP baru berhasil dikirim ulang ke email Anda!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal mengirim ulang email OTP. Silakan coba beberapa saat lagi.');
        }
    }

    /**
     * Tampilkan form verifikasi OTP dan pembuatan password baru.
     */
    public function showResetPasswordForm()
    {
        $email = Session::get('reset_password_email');

        if (!$email) {
            return redirect()->route('password.request')
                ->with('error', 'Silakan masukkan email Anda terlebih dahulu.');
        }

        return view('auth.reset-password', compact('email'));
    }

    /**
     * Proses reset password: Cek OTP dan simpan password baru.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'otp'      => 'required|numeric',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z]/', // Wajib ada huruf
                'regex:/[0-9]/',     // Wajib ada angka
            ],
        ], [
            'otp.required'       => 'Kode OTP verifikasi wajib diisi.',
            'otp.numeric'        => 'Kode OTP harus berupa angka.',
            'password.required'  => 'Kata sandi baru wajib diisi.',
            'password.min'       => 'Kata sandi minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.regex'     => 'Kata sandi harus berupa kombinasi huruf dan angka (tidak boleh hanya huruf saja atau hanya angka saja).',
        ]);

        $sessionOtp = Session::get('reset_password_otp');
        $sessionEmail = Session::get('reset_password_email');
        $sessionExpired = Session::get('reset_password_expired');

        // Cek sesi dan kadaluarsa
        if (!$sessionEmail || !$sessionOtp || !$sessionExpired || now()->greaterThan($sessionExpired)) {
            return redirect()->route('password.request')
                ->with('error', 'Kode OTP telah kadaluarsa atau sesi berakhir. Silakan minta kode OTP baru.');
        }

        // Cek kecocokan OTP
        if ((int)$request->otp !== (int)$sessionOtp) {
            return redirect()->back()
                ->withInput($request->except(['password', 'password_confirmation']))
                ->with('error', 'Kode OTP yang Anda masukkan salah. Periksa kembali email Anda.');
        }

        // Cari user & update password
        $user = User::where('email', $sessionEmail)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Akun pengguna tidak ditemukan.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Bersihkan sesi reset password
        Session::forget(['reset_password_otp', 'reset_password_email', 'reset_password_expired']);

        return redirect()->route('login')
            ->with('success', 'Kata sandi berhasil diatur ulang! Silakan login menggunakan kata sandi baru Anda.');
    }
}
