<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MobileController;

// Rute bawaan Laravel (biarkan saja)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rute Autentikasi Mobile (Tanpa Token)
Route::post('/login', [MobileController::class, 'login']);

// Rute Mobile dengan Pengamanan Sanctum Token
Route::middleware('auth:sanctum')->group(function () {
    // Profil & Status Pendaftaran
    Route::get('/user-status', [MobileController::class, 'userStatus']);
    Route::post('/update-profile', [MobileController::class, 'updateProfile']);
    Route::post('/change-password', [MobileController::class, 'changePassword']);

    // Laporan Harian
    Route::get('/laporan', [MobileController::class, 'getLaporan']);
    Route::post('/laporan', [MobileController::class, 'storeLaporan']);

    // Absensi Harian
    Route::get('/absensi', [MobileController::class, 'getAbsensi']);
    Route::post('/absensi/masuk', [MobileController::class, 'absenMasuk']);
    Route::post('/absensi/pulang/{id}', [MobileController::class, 'absenPulang']);
    Route::post('/absensi/scan-qr', [MobileController::class, 'scanQrAbsensi']);

    // Pengajuan Sertifikat
    Route::get('/sertifikat', [MobileController::class, 'getSertifikat']);
    Route::post('/sertifikat/ajukan', [MobileController::class, 'ajukanSertifikat']);

    // --- RUTE KHUSUS PEMBIMBING ---
    Route::prefix('pembimbing')->group(function () {
        Route::get('/dashboard', [MobileController::class, 'getPembimbingDashboard']);
        Route::get('/mahasiswa/{mahasiswa_id}/laporan', [MobileController::class, 'getLaporanMahasiswa']);
        Route::post('/laporan/{id}/approve', [MobileController::class, 'approveLaporan']);
        Route::post('/laporan/{id}/reject', [MobileController::class, 'rejectLaporan']);
        Route::get('/monitoring-absensi', [MobileController::class, 'getMonitoringAbsensi']);
        Route::get('/absensi/detail/{mahasiswa_id}', [MobileController::class, 'getAbsensiDetailMahasiswa']);
    });

    // --- RUTE KHUSUS ORANG TUA / WALI ---
    Route::prefix('orang-tua')->group(function () {
        Route::get('/dashboard', [MobileController::class, 'getOrangTuaDashboard']);
        Route::get('/absensi', [MobileController::class, 'getOrangTuaAbsensi']);
        Route::get('/laporan', [MobileController::class, 'getOrangTuaLaporan']);
        Route::get('/laporan/{id}', [MobileController::class, 'getOrangTuaLaporanDetail']);
        Route::get('/profil-anak', [MobileController::class, 'getOrangTuaProfilAnak']);
    });

    // --- RUTE KHUSUS PEMBIMBING LAPANGAN (INDUSTRI) ---
    Route::prefix('pembimbing-lapangan')->group(function () {
        Route::get('/dashboard', [MobileController::class, 'getPembimbingLapanganDashboard']);
        Route::get('/siswa', [MobileController::class, 'getPembimbingLapanganSiswa']);
        // ACC Izin
        Route::get('/izin', [MobileController::class, 'getPembimbingLapanganIzin']);
        Route::post('/izin/{id}/approve', [MobileController::class, 'approveIzinMobile']);
        Route::post('/izin/{id}/reject', [MobileController::class, 'rejectIzinMobile']);
        // Data Laporan
        Route::get('/laporan', [MobileController::class, 'getPembimbingLapanganLaporan']);
        Route::post('/laporan/{id}/approve', [MobileController::class, 'approveLaporanMobile']);
        Route::post('/laporan/{id}/reject', [MobileController::class, 'rejectLaporanMobile']);
        // Absensi Siswa
        Route::get('/absensi', [MobileController::class, 'getPembimbingLapanganAbsensi']);
        Route::get('/absensi/siswa/{siswa_id}', [MobileController::class, 'getPembimbingLapanganAbsensiDetail']);
        // Sertifikat
        Route::get('/sertifikat', [MobileController::class, 'getPembimbingLapanganSertifikat']);
        Route::post('/sertifikat/{id}/approve', [MobileController::class, 'approveSertifikatMobile']);
        Route::post('/sertifikat/{id}/reject', [MobileController::class, 'rejectSertifikatMobile']);
        // Chat
        Route::get('/chat-contacts', [MobileController::class, 'getPembimbingLapanganChatContacts']);
        Route::get('/chat/{siswa_id}', [MobileController::class, 'getChatMessages']);
        Route::post('/chat/send', [MobileController::class, 'sendChatMessage']);
    });

    // --- RUTE CHAT UMUM UNTUK SISWA & MENTOR ---
    Route::get('/chat/messages/{partner_id}', [MobileController::class, 'getChatMessages']);
    Route::post('/chat/send', [MobileController::class, 'sendChatMessage']);
});