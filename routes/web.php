<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pelamar\PendaftaranController;
use App\Http\Controllers\Pelamar\DataLamaranController;
use App\Http\Controllers\Pelamar\SertifikatController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataAdminController;
use App\Http\Controllers\Admin\DataProfileController;
use App\Http\Controllers\Admin\DataGaleriController;
use App\Http\Controllers\Admin\DataInformasiController;
use App\Http\Controllers\Admin\DataSertifikatController;
use App\Http\Controllers\Admin\DataAlurController;
use App\Http\Controllers\Admin\DataPelamarController;
use App\Http\Controllers\Admin\DataPendaftaranController;
use App\Http\Controllers\Admin\DataDiterimaController;
use App\Http\Controllers\Admin\DataTidakDiterimaController;

// --- Controller Baru dari Langkah 3 ---
use App\Http\Controllers\Pembimbing\DashboardController as PembimbingDashboardController;
use App\Http\Controllers\Mahasiswa\LaporanHarianController as MahasiswaLaporanHarianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route utama untuk sistem magang
*/

// 🏠 HALAMAN UTAMA (PUBLIC)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔐 LOGIN, LOGOUT & REGISTER (PUBLIC)
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/action-login', [LoginController::class, 'action_login'])->name('login.action');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/registrasi', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/insert-register', [RegisterController::class, 'register'])->name('register.store');

// ----------------------------------------------------
// HALAMAN SETELAH LOGIN
// ----------------------------------------------------

// 👤 ROUTE KHUSUS PELAMAR
// --- Middleware 'pelamar' Anda sudah benar ---
Route::middleware(['auth', 'pelamar'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home.auth');

    // PROFILE PELAMAR
    Route::get('/profile', [LoginController::class, 'profile'])->name('profile.view');
    Route::get('/lengkapi-profile', [LoginController::class, 'lengkapi_profile'])->name('profile.complete');
    Route::post('/update-profile-users', [LoginController::class, 'update_profile'])->name('profile.update');
    Route::post('/insert-lengkapi-profile', [LoginController::class, 'insert_lengkapi_profile'])->name('profile.complete.insert');

    // PENDAFTARAN PELAMAR
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/insert-pendaftaran', [PendaftaranController::class, 'insert'])->name('pendaftaran.insert');

    Route::get('/data-lamaran', [DataLamaranController::class, 'index'])->name('pelamar.lamaran.index');
    Route::get('/detail-lamaran/{id}', [DataLamaranController::class, 'detail'])->name('pelamar.lamaran.detail');
    Route::get('/cetak-lamaran/{id}', [DataLamaranController::class, 'cetak'])->name('pelamar.lamaran.cetak');
    Route::get('/detail-informasi/{id}', [DataLamaranController::class, 'detail_informasi'])->name('pelamar.informasi.detail');

    // SERTIFIKAT PELAMAR
    Route::post('/insert-sertifikat', [SertifikatController::class, 'insert'])->name('sertifikat.insert');
    Route::post('/update-sertifikat', [SertifikatController::class, 'update'])->name('sertifikat.update');
    Route::get('/delete-sertifikat/{id}', [SertifikatController::class, 'delete'])->name('sertifikat.delete');
    Route::get('/cetak-sertifikat/{id}', [SertifikatController::class, 'cetak'])->name('sertifikat.cetak');


    // ===================================================================
    // == TAMBAHAN BARU: Rute Laporan Harian Mahasiswa ==
    // ===================================================================
    // (Ini tetap di dalam grup 'pelamar')

    // Halaman Daftar Laporan Harian (yang pernah di-submit)
    Route::get('/laporan-harian', [MahasiswaLaporanHarianController::class, 'index'])->name('mahasiswa.laporan.index');
    
    // Halaman Form Tambah Laporan Harian
    Route::get('/laporan-harian/tambah', [MahasiswaLaporanHarianController::class, 'create'])->name('mahasiswa.laporan.create');
    
    // URL untuk MENYIMPAN laporan harian baru (via method POST)
    Route::post('/laporan-harian', [MahasiswaLaporanHarianController::class, 'store'])->name('mahasiswa.laporan.store');

});


// 💼 ROUTE KHUSUS ADMIN
// --- BAGIAN INI TIDAK SAYA UBAH SAMA SEKALI, SESUAI PERMINTAAN ANDA ---
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // DATA ADMIN
    Route::get('/data-admin', [DataAdminController::class, 'index'])->name('admin.data.index');
    Route::post('/insert-admin', [DataAdminController::class, 'insert'])->name('admin.data.insert');
    Route::post('/update-admin', [DataAdminController::class, 'update'])->name('admin.data.update');
    Route::get('/delete-admin/{id}', [DataAdminController::class, 'delete'])->name('admin.data.delete');

    // PROFILE ADMIN
    Route::get('/data-profile', [DataProfileController::class, 'index'])->name('admin.profile.index');
    Route::post('/update-profile', [DataProfileController::class, 'update'])->name('admin.profile.update');

    // GALERI
    Route::get('/data-galeri', [DataGaleriController::class, 'index'])->name('admin.galeri.index');
    Route::post('/insert-galeri', [DataGaleriController::class, 'insert'])->name('admin.galeri.insert');
    Route::post('/update-galeri', [DataGaleriController::class, 'update'])->name('admin.galeri.update');
    Route::get('/delete-galeri/{id}', [DataGaleriController::class, 'delete'])->name('admin.galeri.delete');

    // INFORMASI
    Route::get('/data-informasi', [DataInformasiController::class, 'index'])->name('admin.informasi.index');
    Route::post('/insert-informasi', [DataInformasiController::class, 'insert'])->name('admin.informasi.insert');
    Route::post('/update-informasi', [DataInformasiController::class, 'update'])->name('admin.informasi.update');
    Route::get('/delete-informasi/{id}', [DataInformasiController::class, 'delete'])->name('admin.informasi.delete');

    // SERTIFIKAT
    Route::get('/data-sertifikat', [DataSertifikatController::class, 'index'])->name('admin.sertifikat.index');
    Route::post('/approve-sertifikat', [DataSertifikatController::class, 'approve'])->name('admin.sertifikat.approve');

    // ALUR
    Route::get('/data-alur', [DataAlurController::class, 'index'])->name('admin.alur.index');
    Route::post('/insert-alur', [DataAlurController::class, 'insert'])->name('admin.alur.insert');
    Route::post('/update-alur', [DataAlurController::class, 'update'])->name('admin.alur.update');
    Route::get('/delete-alur/{id}', [DataAlurController::class, 'delete'])->name('admin.alur.delete');

    // DATA PENDAFTARAN
    Route::get('/data-pelamar', [DataPelamarController::class, 'index'])->name('admin.pelamar.index');
    Route::get('/data-pendaftaran', [DataPendaftaranController::class, 'index'])->name('admin.pendaftaran.index');
    Route::get('/detail-pendaftaran/{id}', [DataPendaftaranController::class, 'detail'])->name('admin.pendaftaran.detail');
    Route::post('/update-diterima', [DataPendaftaranController::class, 'diterima'])->name('admin.pendaftaran.diterima');
    Route::post('/update-tidak-diterima', [DataPendaftaranController::class, 'tidak_diterima'])->name('admin.pendaftaran.tidak_diterima');

    Route::get('/data-diterima', [DataDiterimaController::class, 'index'])->name('admin.diterima.index');
    Route::get('/detail-diterima/{id}', [DataDiterimaController::class, 'detail'])->name('admin.diterima.detail');

    Route::get('/data-tidak-diterima', [DataTidakDiterimaController::class, 'index'])->name('admin.tidak_diterima.index');
});


// 👨‍🏫 ROUTE KHUSUS PEMBIMBING (BARU)
// --- Ini adalah BLOK BARU yang sudah diperbaiki ---
// (Kita asumsikan middleware Anda namanya 'pembimbing')
Route::middleware(['auth', 'pembimbing'])->prefix('pembimbing')->name('pembimbing.')->group(function () {
    
    // Dashboard Utama Pembimbing
    Route::get('/dashboard', [PembimbingDashboardController::class, 'index'])->name('dashboard');
    
    // Halaman untuk melihat detail laporan satu mahasiswa
    Route::get('/laporan/mahasiswa/{mahasiswa_id}', [PembimbingDashboardController::class, 'lihatLaporan'])->name('laporan.mahasiswa');

});