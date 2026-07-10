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
use App\Http\Controllers\Admin\DataPembimbingController;
use App\Http\Controllers\Admin\DataAbsensiController;

// --- Controller Login Admin Baru ---
use App\Http\Controllers\Auth\AdminLoginController;

// --- Controller Pembimbing/Mahasiswa ---
use App\Http\Controllers\Pembimbing\DashboardController as PembimbingDashboardController;
use App\Http\Controllers\Pembimbing\AbsensiPembimbingController;

use App\Http\Controllers\Mahasiswa\LaporanHarianController as MahasiswaLaporanHarianController;
use App\Http\Controllers\Mahasiswa\AbsensiController as MahasiswaAbsensiController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route utama untuk sistem magang
*/

// ==========================================
// 🔐 AREA AUTENTIKASI DAN REGISTRASI
// ==========================================

// 1. LOGIN ADMIN (URL TERSEMBUNYI)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.action');
});

// 2. LOGIN USER BIASA (URL STANDAR)
Route::get('/login', [LoginController::class, 'login'])->name('login'); 
Route::post('/action-login', [LoginController::class, 'action_login'])->name('login.action');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- TAMBAHAN BARU: ROUTE LOGIN BIOMETRIK WAJAH ---
Route::post('/login-biometrik', [LoginController::class, 'loginBiometric'])->name('login.biometric');


// 3. REGISTRASI & OTP
Route::get('/registrasi', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/insert-register', [RegisterController::class, 'register'])->name('register.store');

// [PENTING] Route untuk AJAX Kirim OTP (Tombol Orange)
// Route ini wajib ada supaya tombol "Kirim OTP" di halaman register berfungsi
Route::post('/send-otp-ajax', [RegisterController::class, 'sendOtpAjax'])->name('send.otp.ajax');


// ==========================================
// 🌍 AREA PUBLIC (LANJUTAN)
// ==========================================

// 🏠 HALAMAN UTAMA (PUBLIC)
Route::get('/', [HomeController::class, 'index'])->name('home');

// 📖 DETAIL INFORMASI 
Route::get('/detail-informasi/{id}', [HomeController::class, 'detail_informasi'])->name('pelamar.informasi.detail');


// ----------------------------------------------------
// HALAMAN SETELAH LOGIN
// ----------------------------------------------------

// 👤 ROUTE KHUSUS PELAMAR
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
    
    // SERTIFIKAT PELAMAR
    Route::post('/insert-sertifikat', [SertifikatController::class, 'insert'])->name('sertifikat.insert');
    Route::post('/update-sertifikat', [SertifikatController::class, 'update'])->name('sertifikat.update');
    Route::get('/delete-sertifikat/{id}', [SertifikatController::class, 'delete'])->name('sertifikat.delete');
    Route::get('/cetak-sertifikat/{id}', [SertifikatController::class, 'cetak'])->name('sertifikat.cetak');


    // == Rute Laporan Harian Mahasiswa ==
    Route::get('/laporan-harian', [MahasiswaLaporanHarianController::class, 'index'])->name('mahasiswa.laporan.index');
    Route::get('/laporan-harian/tambah', [MahasiswaLaporanHarianController::class, 'create'])->name('mahasiswa.laporan.create');
    Route::post('/laporan-harian', [MahasiswaLaporanHarianController::class, 'store'])->name('mahasiswa.laporan.store');
    
    // Route Download PDF Laporan (Mahasiswa)
    Route::get('/laporan-harian/download-pdf', [MahasiswaLaporanHarianController::class, 'downloadPdf'])->name('mahasiswa.laporan.pdf');

    // ==========================================
    // RUTE ABSENSI MAHASISWA
    // ==========================================
    Route::get('/absensi', [MahasiswaAbsensiController::class, 'index'])->name('mahasiswa.absensi.index');
    Route::post('/absensi/masuk', [MahasiswaAbsensiController::class, 'store'])->name('mahasiswa.absensi.store');
    Route::put('/absensi/pulang/{id}', [MahasiswaAbsensiController::class, 'absenPulang'])->name('mahasiswa.absensi.pulang');

});


// 💼 ROUTE KHUSUS ADMIN
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // DATA ADMIN
    Route::get('/data-admin', [DataAdminController::class, 'index'])->name('admin.data.index');
    Route::post('/insert-admin', [DataAdminController::class, 'insert'])->name('admin.data.insert');
    Route::post('/update-admin', [DataAdminController::class, 'update'])->name('admin.data.update');
    Route::get('/delete-admin/{id}', [DataAdminController::class, 'delete'])->name('admin.data.delete');
    
    // DATA PEMBIMBING
    Route::get('/data-pembimbing', [DataPembimbingController::class, 'index'])->name('admin.pembimbing.index');
    Route::post('/insert-pembimbing', [DataPembimbingController::class, 'store'])->name('admin.pembimbing.store');
    Route::post('/update-pembimbing', [DataPembimbingController::class, 'update'])->name('admin.pembimbing.update');
    Route::get('/delete-pembimbing/{id}', [DataPembimbingController::class, 'delete'])->name('admin.pembimbing.delete');

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

    // SERTIFIKAT (ADMIN)
    Route::get('/data-sertifikat', [DataSertifikatController::class, 'index'])->name('admin.sertifikat.index');
    Route::post('/approve-sertifikat', [DataSertifikatController::class, 'approve'])->name('admin.sertifikat.approve');
    Route::delete('admin/delete-sertifikat/{id}', [DataSertifikatController::class, 'delete'])->name('admin.sertifikat.delete');
    
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

    // --- DATA DITERIMA ---
    Route::get('/data-diterima', [DataDiterimaController::class, 'index'])->name('admin.diterima.index');
    Route::get('/detail-diterima/{id}', [DataDiterimaController::class, 'detail'])->name('admin.diterima.detail');
    Route::put('/update-pembimbing-mahasiswa/{id}', [DataDiterimaController::class, 'aturPembimbing'])->name('admin.diterima.atur_pembimbing');

    Route::get('/data-tidak-diterima', [DataTidakDiterimaController::class, 'index'])->name('admin.tidak_diterima.index');
    Route::get('/detail-tidak-diterima/{id}', [DataTidakDiterimaController::class, 'detail'])->name('admin.tidak_diterima.detail');

    // ABSENSI (ADMIN)
    Route::get('/data-absensi', [DataAbsensiController::class, 'index'])->name('admin.absensi.index');
    Route::get('/data-absensi/detail/{id}', [DataAbsensiController::class, 'detail'])->name('admin.absensi.detail');

});


// 👨‍🏫 ROUTE KHUSUS PEMBIMBING
Route::middleware(['auth', 'pembimbing'])->prefix('pembimbing')->name('pembimbing.')->group(function () {
    
    // Dashboard Utama Pembimbing
    Route::get('/dashboard', [PembimbingDashboardController::class, 'index'])->name('dashboard');
    
    // Halaman untuk melihat detail laporan satu mahasiswa
    Route::get('/laporan/mahasiswa/{mahasiswa_id}', [PembimbingDashboardController::class, 'lihatLaporan'])->name('laporan.mahasiswa');

    // Route untuk Acc Laporan
    Route::post('/laporan/approve/{id}', [PembimbingDashboardController::class, 'approveLaporan'])->name('laporan.approve');
    
    // Route untuk Tolak Laporan
    Route::post('/laporan/reject/{id}', [PembimbingDashboardController::class, 'rejectLaporan'])->name('laporan.reject');

    // Download PDF Laporan Mahasiswa oleh Pembimbing
    Route::get('/laporan/mahasiswa/{id}/pdf', [PembimbingDashboardController::class, 'downloadPdf'])->name('laporan.mahasiswa.pdf');

    // MONITORING ABSENSI (KHUSUS PEMBIMBING)
    Route::get('/monitoring-absensi', [AbsensiPembimbingController::class, 'index'])->name('absensi.index');
    Route::get('/monitoring-absensi/detail/{id}', [AbsensiPembimbingController::class, 'detail'])->name('absensi.detail');

});