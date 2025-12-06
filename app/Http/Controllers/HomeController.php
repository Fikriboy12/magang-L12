<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Informasi;
use App\Models\Alur;
use App\Models\Galeri;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function Index()
    {
        $data = [
            'title' => 'Data News And Event',
            'profile' => Profile::first(),
            'galeri' => Galeri::get(),
            'alur' => Alur::get(),
            'informasi' => Informasi::get(),
        ];

        return view('pelamar/home')->with('data', $data);
    }

    // ==========================================
    // TAMBAHAN: DETAIL INFORMASI (PUBLIC)
    // ==========================================
    public function detail_informasi($id)
    {
        // 1. Cari berita berdasarkan ID
        $info = Informasi::find($id);

        // 2. Cek jika berita tidak ditemukan
        if (!$info) {
            return redirect('/')->with('error', 'Berita tidak ditemukan.');
        }

        // 3. Bungkus data
        $data = [
            'informasi' => $info
        ];

        // 4. Panggil View Detail (Sesuai nama file Anda: pelamar/detailinformasi.blade.php)
        return view('pelamar.detailinformasi', compact('data'));
    }
}