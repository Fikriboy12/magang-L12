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
});