<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'profile',
            'update_profile',
            'insert_lengkapi_profile',
            'lengkapi_profile'
        ]);
    }

    // Form login
    public function login()
    {
        return view('auth.login');
    }

    // Proses login
    public function action_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();

            if($user->role == 'admin'){
                return redirect('admin/dashboard')->with('success', 'Selamat datang, ' . $user->name);
            } else {
                return redirect('/home')->with('success', 'Selamat datang, ' . $user->name);
            }
        }

        return back()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda berhasil logout');
    }

    // Tampilkan profile
    public function profile(): View
    {
        $user = Auth::user();
        $data = [
            'profile' => $user
        ];
        return view('auth.profile', compact('data'));
    }

    // Tampilkan lengkapi profile
    public function lengkapi_profile(): View
    {
        $user = Auth::user();
        $data = [
            'profile' => $user
        ];
        return view('auth.lengkapiprofile', compact('data'));
    }


    // ==========================================================
    // PERBAIKAN PADA FUNGSI UPDATE
    // ==========================================================
    public function update_profile(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'nim' => 'required|string',
            'nik' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'alamat_lengkap' => 'required|string', 
            'password' => 'nullable|min:8',
        ]);

        $user = Auth::user();

        $dataToUpdate = [
            'name' => $request->nama_lengkap, 
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'nim' => $request->nim,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            
            // ======================================================
            // PERBAIKAN: Hanya update 2 kolom ini
            // ======================================================
            'alamat' => $request->alamat_lengkap, // Mengisi kolom 'alamat' lama
            'alamat_lengkap' => $request->alamat_lengkap, // Mengisi kolom 'alamat_lengkap' baru
        ];

        if (!empty($request->password)) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataToUpdate);

        return redirect('profile')->with('suc_message', 'Profile berhasil di-update!');
    }

    // ==========================================================
    // PERBAIKAN PADA FUNGSI LENGKAPI PROFILE
    // ==========================================================
    public function insert_lengkapi_profile(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|string',
            'nim' => 'required|string', 
            'nik' => 'required|string', 
            'tempat_lahir' => 'required|string', 
            'tanggal_lahir' => 'required|date', 
            'jenis_kelamin' => 'required|string', 
            'agama' => 'required|string', 
            'alamat_lengkap' => 'required|string',
            'password' => 'nullable|min:8', 
        ]);

        $user = Auth::user();

        $dataToUpdate = [
            'name' => $request->nama_lengkap, 
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'nim' => $request->nim,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            
            // ======================================================
            // PERBAIKAN: Hanya update 2 kolom ini
            // ======================================================
            'alamat' => $request->alamat_lengkap, // Mengisi kolom 'alamat' lama
            'alamat_lengkap' => $request->alamat_lengkap, // Mengisi kolom 'alamat_lengkap' baru
        ];

        if (!empty($request->password)) {
            $dataToUpdate['password'] = Hash::make($request->password);
        }

        $user->update($dataToUpdate);

        return redirect('profile')->with('suc_message', 'Profile berhasil di-update!');
    }
}

