@extends('template.master') 

@section('title', 'Data Laporan Harian')

@section('contents')

<!-- Font Google Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* ========================================================
       HALAMAN LAPORAN HARIAN - MODERN TECH & PREMIUM CORPORATE
       ======================================================== */
    .laporan-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: radial-gradient(circle at 10% 15%, rgba(62, 204, 233, 0.08) 0%, transparent 40%),
                    radial-gradient(circle at 90% 85%, rgba(2, 132, 199, 0.06) 0%, transparent 40%),
                    #f8fafc;
        min-height: 100vh;
        padding-top: 105px;
        padding-bottom: 80px;
    }

    /* 1. HERO HEADER BANNER */
    .laporan-header-card {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0369a1 100%);
        color: white;
        padding: 32px 36px;
        border-radius: 20px;
        box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.35), 0 0 25px rgba(2, 132, 199, 0.15);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .laporan-header-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(62, 204, 233, 0.25) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .laporan-header-card::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: 20%;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .badge-hero-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #e0f2fe;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    .laporan-header-card h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 25px;
        letter-spacing: -0.3px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .laporan-header-card p {
        color: #cbd5e1;
        font-size: 13.5px;
        margin: 0;
        max-width: 650px;
        line-height: 1.5;
    }
    .btn-download-pdf {
        background: #ffffff;
        color: #0f172a !important;
        font-weight: 700;
        font-size: 13px;
        padding: 10px 22px;
        border-radius: 50px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
        transition: all 0.25s ease;
        text-decoration: none !important;
    }
    .btn-download-pdf:hover {
        background: #f8fafc;
        color: #0284c7 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* 2. APK INFO CARD */
    .banner-apk-info {
        background: #ffffff;
        border: 1px solid #e0f2fe;
        border-left: 4px solid #0284c7;
        border-radius: 16px;
        padding: 18px 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 18px rgba(2, 132, 199, 0.05);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        transition: all 0.2s ease;
    }
    .banner-apk-info:hover {
        box-shadow: 0 6px 24px rgba(2, 132, 199, 0.09);
    }
    .apk-icon-circle {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
        color: #ffffff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        box-shadow: 0 6px 14px rgba(2, 132, 199, 0.28);
    }
    .apk-sync-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #f0fdf4;
        color: #15803d;
        border: 1px solid #bbf7d0;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 700;
        white-space: nowrap;
    }
    .pulse-dot {
        width: 8px;
        height: 8px;
        background: #22c55e;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
        animation: pulseGreen 1.8s infinite;
    }
    @keyframes pulseGreen {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(34, 197, 94, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
    }

    /* 3. METRIC STAT CARDS */
    .stat-card-laporan {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card-laporan::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: transparent;
        transition: all 0.25s ease;
    }
    .stat-card-laporan.blue::after { background: linear-gradient(90deg, #38bdf8, #0284c7); }
    .stat-card-laporan.green::after { background: linear-gradient(90deg, #34d399, #059669); }
    .stat-card-laporan.yellow::after { background: linear-gradient(90deg, #fbbf24, #d97706); }
    .stat-card-laporan.red::after { background: linear-gradient(90deg, #f87171, #dc2626); }

    .stat-card-laporan:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(15, 23, 42, 0.08);
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }
    .stat-icon.blue { background: #e0f2fe; color: #0284c7; }
    .stat-icon.green { background: #ecfdf5; color: #059669; }
    .stat-icon.yellow { background: #fffbeb; color: #d97706; }
    .stat-icon.red { background: #fef2f2; color: #dc2626; }

    .stat-number {
        font-size: 26px;
        font-weight: 800;
        letter-spacing: -0.5px;
        line-height: 1.1;
        margin-top: 2px;
    }

    /* 4. TABEL REKAPITULASI */
    .card-table-laporan {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }
    .card-table-header {
        padding: 20px 26px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .card-table-header h5 {
        margin: 0;
        font-weight: 800;
        font-size: 17px;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .badge-data-pill {
        background: #f8fafc;
        color: #475569;
        border: 1px solid #e2e8f0;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .table-laporan {
        margin-bottom: 0;
    }
    .table-laporan thead th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        border-top: none;
        border-bottom: 1px solid #e2e8f0;
        padding: 15px 20px;
        vertical-align: middle;
    }
    .table-laporan tbody td {
        padding: 18px 20px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13.5px;
    }
    .table-laporan tbody tr {
        transition: background-color 0.15s ease;
    }
    .table-laporan tbody tr:hover {
        background-color: #f8fafc;
    }

    /* BADGE STATUS VALIDASI */
    .badge-status-laporan {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .badge-approved {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .badge-pending {
        background: #fffbeb;
        color: #b45309;
        border: 1px solid #fde68a;
    }
    .badge-rejected {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    /* THUMBNAIL FOTO DOKUMENTASI */
    .img-thumb-container {
        position: relative;
        display: inline-block;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        transition: all 0.25s ease;
    }
    .img-thumb-container:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        border-color: #0284c7;
    }
    .img-thumb-laporan {
        width: 80px;
        height: 62px;
        object-fit: cover;
        display: block;
    }
    .thumb-zoom-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.45);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.2s ease;
        font-size: 14px;
    }
    .img-thumb-container:hover .thumb-zoom-overlay {
        opacity: 1;
    }

    /* TANGGAL BADGE */
    .date-badge-box {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .date-icon-circle {
        width: 36px;
        height: 36px;
        background: #f0f9ff;
        color: #0284c7;
        border: 1px solid #bae6fd;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        flex-shrink: 0;
    }

    /* EMPTY STATE MODERN */
    .empty-state-card {
        padding: 55px 20px;
        text-align: center;
    }
    .empty-state-icon-box {
        width: 84px;
        height: 84px;
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border: 2px dashed #7dd3fc;
        border-radius: 24px;
        color: #0284c7;
        font-size: 34px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 20px rgba(2, 132, 199, 0.1);
    }
    .empty-state-title {
        font-weight: 800;
        font-size: 18px;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .empty-state-desc {
        color: #64748b;
        font-size: 13.5px;
        max-width: 500px;
        margin: 0 auto 24px;
        line-height: 1.6;
    }
    .empty-steps-list {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        max-width: 600px;
    }
    .empty-step-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 8px 16px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        color: #334155;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .empty-step-num {
        width: 18px;
        height: 18px;
        background: #0284c7;
        color: #ffffff;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
    }
</style>

<div class="laporan-page">
    <div class="container">
        
        {{-- 1. HEADER BANNER MODERN --}}
        <div class="laporan-header-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div style="z-index: 2;">
                    <div class="badge-hero-pill">
                        <i class="fa-solid fa-graduation-cap"></i> Portal Siswa Magang
                    </div>
                    <h2>
                        <i class="fa-solid fa-file-lines text-info"></i> Data Laporan Harian
                    </h2>
                    <p>
                        Rekapitulasi riwayat aktivitas, dokumentasi, dan validasi kegiatan harian Anda yang disinkronkan langsung dari Aplikasi Mobile Magang.
                    </p>
                </div>
                <div style="z-index: 2;" class="mt-2 mt-md-0">
                    @if(Route::has('mahasiswa.laporan.pdf'))
                        <a href="{{ route('mahasiswa.laporan.pdf') }}" target="_blank" class="btn-download-pdf">
                            <i class="fa-solid fa-file-pdf text-danger" style="font-size: 16px;"></i> Cetak / Unduh PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- 2. INFORMASI SINKRONISASI APK MOBILE --}}
        <div class="banner-apk-info">
            <div class="d-flex align-items-center">
                <div class="apk-icon-circle mr-3">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                        <strong style="color: #0f172a; font-size: 15px; font-weight: 800;">
                            Informasi Pengisian Laporan Harian
                        </strong>
                        <span class="apk-sync-badge">
                            <span class="pulse-dot"></span> Sinkronisasi Real-Time APK
                        </span>
                    </div>
                    <span class="text-muted" style="font-size: 13px; line-height: 1.5;">
                        Pengunggahan foto dokumentasi dan pengisian aktivitas harian dilakukan melalui <strong>Aplikasi Mobile Magang (APK)</strong>. Halaman website ini berfungsi sebagai pusat monitoring rekapitulasi serta status persetujuan dari Guru Pembimbing.
                    </span>
                </div>
            </div>
        </div>

        {{-- 3. RINGKASAN STATISTIK DENGAN AKSEN MODERN --}}
        @php
            $totalLaporan = $laporan->count();
            $approvedLaporan = $laporan->where('status', 'approved')->count();
            $pendingLaporan = $laporan->where('status', 'pending')->count();
            $rejectedLaporan = $laporan->where('status', 'rejected')->count();
        @endphp

        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="stat-card-laporan blue">
                    <div class="stat-icon blue">
                        <i class="fa-solid fa-clipboard-list"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Total Laporan</div>
                        <div class="stat-number text-dark">{{ $totalLaporan }}</div>
                        <small class="text-muted" style="font-size: 11.5px;">Keseluruhan aktivitas</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="stat-card-laporan green">
                    <div class="stat-icon green">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Disetujui</div>
                        <div class="stat-number text-success">{{ $approvedLaporan }}</div>
                        <small class="text-success font-weight-bold" style="font-size: 11.5px;">Telah divalidasi</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="stat-card-laporan yellow">
                    <div class="stat-icon yellow">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Menunggu ACC</div>
                        <div class="stat-number text-warning">{{ $pendingLaporan }}</div>
                        <small class="text-warning font-weight-bold" style="font-size: 11.5px;">Dalam proses review</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="stat-card-laporan red">
                    <div class="stat-icon red">
                        <i class="fa-solid fa-circle-xmark"></i>
                    </div>
                    <div>
                        <div class="text-muted font-weight-bold text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">Ditolak / Revisi</div>
                        <div class="stat-number text-danger">{{ $rejectedLaporan }}</div>
                        <small class="text-danger font-weight-bold" style="font-size: 11.5px;">Perlu perbaikan</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. TABEL REKAPITULASI LAPORAN HARIAN --}}
        <div class="card-table-laporan">
            <div class="card-table-header">
                <h5>
                    <i class="fa-solid fa-table-list text-primary"></i> Rekapitulasi Data Laporan Harian
                </h5>
                <span class="badge-data-pill">
                    <i class="fa-solid fa-rotate text-info"></i> Data Real-Time APK
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-laporan mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th style="width: 200px;">Tanggal Kegiatan</th>
                            <th>Uraian Aktivitas Magang</th>
                            <th class="text-center" style="width: 140px;">Dokumentasi</th>
                            <th class="text-center" style="width: 160px;">Status Validasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">
                                    <span style="display: inline-block; width: 26px; height: 26px; line-height: 26px; background: #f1f5f9; border-radius: 50%; font-size: 12px;">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                
                                <td>
                                    <div class="date-badge-box">
                                        <div class="date-icon-circle">
                                            <i class="fa-regular fa-calendar-days"></i>
                                        </div>
                                        <div>
                                            <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                            </div>
                                            <small class="text-muted font-weight-bold" style="font-size: 11.5px;">
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    <div class="font-weight-bold text-dark" style="line-height: 1.6; font-size: 13.5px;">
                                        {{ $item->kegiatan }}
                                    </div>
                                    @if($item->catatan)
                                        <div class="mt-2 p-2 px-3 rounded" style="background: #fffbeb; border: 1px solid #fef3c7; border-left: 3px solid #f59e0b;">
                                            <small class="text-warning font-weight-bold d-block" style="color: #b45309 !important;">
                                                <i class="fa-solid fa-comment-dots mr-1"></i> Catatan Guru Pembimbing:
                                            </small>
                                            <small class="text-dark">{{ $item->catatan }}</small>
                                        </div>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    @if($item->foto)
                                        @php
                                            $fotoUrl = asset('laporan_harian/' . basename($item->foto));
                                            if (str_contains($item->foto, '/')) {
                                                $fotoUrl = asset($item->foto);
                                            }
                                        @endphp
                                        
                                        <div class="img-thumb-container">
                                            <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}" title="Klik untuk memperbesar foto">
                                                <img src="{{ $fotoUrl }}" alt="Dokumentasi" class="img-thumb-laporan">
                                                <div class="thumb-zoom-overlay">
                                                    <i class="fa-solid fa-magnifying-glass-plus"></i>
                                                </div>
                                            </a>
                                        </div>

                                        {{-- MODAL PREVIEW FOTO DENGAN BACKDROP BERSIH --}}
                                        <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content bg-transparent border-0 shadow-none">
                                                    <div class="modal-body text-center p-0">
                                                        <button type="button" class="close text-white mb-2" data-dismiss="modal" style="opacity: 1; text-shadow: 0 2px 10px rgba(0,0,0,0.8); font-size: 34px;">&times;</button>
                                                        <img src="{{ $fotoUrl }}" class="img-fluid rounded shadow-lg" style="max-height: 85vh; border: 2px solid rgba(255,255,255,0.2);">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="badge badge-light text-muted border px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-regular fa-image mr-1"></i> Tanpa Foto
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($item->status == 'approved')
                                        <span class="badge-status-laporan badge-approved">
                                            <i class="fa-solid fa-circle-check"></i> Disetujui
                                        </span>
                                    @elseif($item->status == 'rejected')
                                        <span class="badge-status-laporan badge-rejected">
                                            <i class="fa-solid fa-circle-xmark"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge-status-laporan badge-pending">
                                            <i class="fa-solid fa-clock"></i> Menunggu ACC
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-0">
                                    <div class="empty-state-card">
                                        <div class="empty-state-icon-box">
                                            <i class="fa-solid fa-clipboard-list"></i>
                                        </div>
                                        <h5 class="empty-state-title">Belum Ada Data Laporan Harian</h5>
                                        <p class="empty-state-desc">
                                            Laporan kegiatan magang Anda yang dikirim melalui <strong>Aplikasi Mobile Magang (APK)</strong> akan otomatis tersinkronisasi dan tampil rapi pada tabel ini.
                                        </p>
                                        <div class="empty-steps-list">
                                            <div class="empty-step-item">
                                                <span class="empty-step-num">1</span> Buka Aplikasi Mobile
                                            </div>
                                            <div class="empty-step-item">
                                                <span class="empty-step-num">2</span> Isi Aktivitas & Foto Bukti
                                            </div>
                                            <div class="empty-step-item">
                                                <span class="empty-step-num">3</span> Validasi Pembimbing
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
