@extends('template.master') 

@section('title', 'Data Absensi & Kehadiran')

@section('contents')

<!-- Font Google Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* ==========================================================================
       HALAMAN ABSENSI - HARMONIS DENGAN TEMA AMBIENT LIGHT TECH LOGIN
       Palet Warna Utama: Cyan (#3ECCE9) & Deep Tech Blue (#0284c7)
       ========================================================================== */
    .absensi-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                    radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                    radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                    linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%);
        min-height: 100vh;
        padding-top: 105px;
        padding-bottom: 85px;
    }

    /* 1. HERO HEADER BANNER (WARNA CYAN & BLUE GRADIENT PERSIS LOGIN) */
    .absensi-header-card {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 40%, #0284c7 70%, #3ECCE9 100%);
        color: white;
        padding: 34px 38px;
        border-radius: 20px;
        box-shadow: 0 20px 40px -10px rgba(2, 132, 199, 0.4), 0 0 30px rgba(62, 204, 233, 0.3);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    .absensi-header-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 240px;
        height: 240px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .absensi-header-card::after {
        content: '';
        position: absolute;
        bottom: -50px;
        left: 30%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(62, 204, 233, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .badge-hero-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        color: #ffffff;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 11.5px;
        font-weight: 800;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        margin-bottom: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }
    .absensi-header-card h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 26px;
        letter-spacing: -0.3px;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 10px;
        text-shadow: 0 2px 8px rgba(2, 132, 199, 0.3);
    }
    .absensi-header-card p {
        color: #f0f9ff;
        font-size: 14px;
        margin: 0;
        max-width: 650px;
        line-height: 1.5;
        font-weight: 500;
        opacity: 0.95;
    }
    .btn-download-pdf {
        background: #ffffff;
        color: #0284c7 !important;
        font-weight: 800;
        font-size: 13.5px;
        padding: 11px 24px;
        border-radius: 50px;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        transition: all 0.25s ease;
        text-decoration: none !important;
    }
    .btn-download-pdf:hover {
        background: #ffffff;
        color: #0369a1 !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(2, 132, 199, 0.35);
    }

    /* 2. APK INFO CARD */
    .banner-apk-info {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-top: 3.5px solid #3ECCE9; /* Aksen Cyan Login */
        border-radius: 16px;
        padding: 18px 24px;
        margin-bottom: 24px;
        box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.06), 0 0 20px rgba(62, 204, 233, 0.08);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 15px;
        transition: all 0.25s ease;
    }
    .banner-apk-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.09), 0 0 25px rgba(62, 204, 233, 0.14);
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

    /* 3. WIDGET STATUS HARI INI */
    .today-status-card {
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-top: 4px solid #3ECCE9; /* Aksen Cyan Login */
        padding: 24px 30px;
        box-shadow: 0 15px 35px -10px rgba(15, 23, 42, 0.06), 0 0 20px rgba(62, 204, 233, 0.08);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .clock-display {
        font-size: 32px;
        font-weight: 800;
        color: #0284c7;
        letter-spacing: 1px;
        font-variant-numeric: tabular-nums;
        font-family: 'Plus Jakarta Sans', monospace;
    }

    /* 4. TABEL RIWAYAT */
    .card-table-absensi {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-top: 4px solid #3ECCE9; /* Aksen Cyan Login */
        border-radius: 18px;
        box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.08), 0 0 25px rgba(62, 204, 233, 0.1);
        overflow: hidden;
    }
    .card-table-header {
        padding: 22px 28px;
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
        font-size: 17.5px;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .badge-data-pill {
        background: #f0f9ff;
        color: #0284c7;
        border: 1px solid #bae6fd;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .table-absensi {
        margin-bottom: 0;
    }
    .table-absensi thead th {
        background: #f8fafc;
        color: #334155;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        border-top: none;
        border-bottom: 1.5px solid #e2e8f0;
        padding: 16px 20px;
        vertical-align: middle;
    }
    .table-absensi tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 13.5px;
    }
    .table-absensi tbody tr {
        transition: background-color 0.15s ease;
    }
    .table-absensi tbody tr:hover {
        background-color: #f0f9ff;
    }

    /* BADGE JAM */
    .badge-jam {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 12.5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-masuk { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-pulang { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }

    /* FOTO SELFIE THUMBNAIL */
    .img-thumb-absensi {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #bae6fd;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .img-thumb-absensi:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 14px rgba(2, 132, 199, 0.25);
        border-color: #0284c7;
    }

    /* EMPTY STATE */
    .empty-state-card {
        padding: 60px 20px;
        text-align: center;
        background: #ffffff;
    }
    .empty-state-icon-box {
        width: 86px;
        height: 86px;
        background: radial-gradient(circle, #e0f2fe 0%, #f0f9ff 100%);
        border: 2px dashed #3ECCE9;
        border-radius: 24px;
        color: #0284c7;
        font-size: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 10px 25px rgba(62, 204, 233, 0.2);
    }
</style>

<div class="absensi-page">
    <div class="container">

        {{-- 1. HERO HEADER BANNER (WARNA CYAN & BLUE PERSIS LOGIN) --}}
        <div class="absensi-header-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div style="z-index: 2;">
                    <div class="badge-hero-pill">
                        <i class="fa-solid fa-graduation-cap"></i> Portal Siswa Magang
                    </div>
                    <h2>
                        <i class="fa-solid fa-clock"></i> Data Absensi & Kehadiran
                    </h2>
                    <p>
                        Rekapitulasi log kehadiran harian peserta magang yang disinkronkan langsung dari Aplikasi Mobile Magang.
                    </p>
                </div>
                <div style="z-index: 2;" class="d-flex align-items-center flex-wrap gap-2 mt-2 mt-md-0">
                    <a href="{{ route('mahasiswa.absensi.pdf') }}" target="_blank" class="btn-download-pdf">
                        <i class="fa-solid fa-file-pdf text-danger" style="font-size: 16px;"></i> Cetak / Unduh PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- 2. INFORMASI PELAKSANAAN VIA APK MOBILE DENGAN AKSEN CYAN LOGIN --}}
        <div class="banner-apk-info">
            <div class="d-flex align-items-center">
                <div class="apk-icon-circle mr-3">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                        <strong style="color: #0f172a; font-size: 15px; font-weight: 800;">
                            Informasi Pelaksanaan Absensi
                        </strong>
                        <span class="apk-sync-badge">
                            <span class="pulse-dot"></span> Sinkronisasi Real-Time APK
                        </span>
                    </div>
                    <span class="text-muted" style="font-size: 13px; line-height: 1.5;">
                        Perekaman absensi masuk dan absensi pulang (beserta foto selfie kehadiran) dilakukan melalui <strong>Aplikasi Mobile Magang (APK)</strong>. Halaman website ini berfungsi untuk memantau data rekapitulasi, waktu absensi, dan histori kehadiran Anda.
                    </span>
                </div>
            </div>
        </div>

        {{-- 3. STATUS ABSENSI HARI INI DENGAN BORDER-TOP CYAN --}}
        <div class="today-status-card">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5 mb-3 mb-md-0 border-right">
                    <small class="text-muted text-uppercase font-weight-bold d-block mb-1" style="font-size: 11px; letter-spacing: 0.5px;">
                        Waktu Server (WIB)
                    </small>
                    <div class="clock-display" id="jam-digital-wib">--:--:--</div>
                    <div class="text-muted font-weight-bold" style="font-size: 13.5px; margin-top: 4px;">
                        <i class="fa-regular fa-calendar-check text-primary mr-1"></i>
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <div class="col-lg-8 col-md-7 pl-md-4">
                    <small class="text-muted text-uppercase font-weight-bold d-block mb-2" style="font-size: 11px; letter-spacing: 0.5px;">
                        Status Kehadiran Hari Ini
                    </small>

                    @if(!$absenHariIni)
                        <div class="alert alert-warning border-0 mb-0 d-flex align-items-center p-3" style="border-radius: 12px; background: #fffbeb; border: 1px solid #fef3c7;">
                            <i class="fa-solid fa-clock-rotate-left fa-2x text-warning mr-3"></i>
                            <div>
                                <strong class="text-warning d-block" style="color: #b45309 !important; font-size: 14px;">Belum Melakukan Absensi Hari Ini</strong>
                                <span class="small text-muted">Silakan buka <strong>Aplikasi Mobile (APK)</strong> di ponsel Anda untuk melakukan absensi selfie masuk.</span>
                            </div>
                        </div>
                    @elseif($absenHariIni->jam_keluar == null)
                        <div class="alert alert-info border-0 mb-0 p-3" style="border-radius: 12px; background: #f0f9ff; border: 1px solid #e0f2fe;">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <strong class="text-primary d-block font-weight-bold" style="font-size: 14px;">
                                        <i class="fa-solid fa-circle-check text-success mr-1"></i> Sudah Absen Masuk
                                    </strong>
                                    <span class="small text-muted">
                                        Tercatat jam <strong>{{ $absenHariIni->jam_masuk }} WIB</strong>. Jangan lupa untuk melakukan absen pulang melalui Aplikasi Mobile saat jam operasional selesai.
                                    </span>
                                </div>
                                @if($absenHariIni->foto_bukti)
                                    <div>
                                        <img src="{{ asset($absenHariIni->foto_bukti) }}" alt="Selfie Masuk" class="img-thumb-absensi" data-toggle="modal" data-target="#modalFotoMasukToday" title="Lihat Foto Masuk">
                                    </div>
                                    <div class="modal fade" id="modalFotoMasukToday" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                <img src="{{ asset($absenHariIni->foto_bukti) }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-success border-0 mb-0 p-3" style="border-radius: 12px; background: #ecfdf5; border: 1px solid #d1fae5;">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <strong class="text-success d-block font-weight-bold" style="font-size: 14px;">
                                        <i class="fa-solid fa-circle-check text-success mr-1"></i> Absensi Hari Ini Telah Selesai
                                    </strong>
                                    <span class="small text-muted">
                                        Masuk: <strong>{{ $absenHariIni->jam_masuk }} WIB</strong> &bull; Pulang: <strong>{{ $absenHariIni->jam_keluar }} WIB</strong>
                                    </span>
                                </div>
                                <div class="d-flex gap-2">
                                    @if($absenHariIni->foto_bukti)
                                        <img src="{{ asset($absenHariIni->foto_bukti) }}" alt="Foto Masuk" class="img-thumb-absensi mr-1" data-toggle="modal" data-target="#modalTodayIn" title="Foto Masuk">
                                    @endif
                                    @if($absenHariIni->foto_keluar)
                                        <img src="{{ asset($absenHariIni->foto_keluar) }}" alt="Foto Pulang" class="img-thumb-absensi" data-toggle="modal" data-target="#modalTodayOut" title="Foto Pulang">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- 4. TABEL RIWAYAT KEHADIRAN DENGAN BORDER-TOP CYAN --}}
        <div class="card-table-absensi">
            <div class="card-table-header">
                <h5>
                    <i class="fa-solid fa-list-check" style="color: #0284c7;"></i> Log Rekapitulasi Kehadiran
                </h5>
                <span class="badge-data-pill">
                    Total: <strong>{{ $riwayat->count() }} Hari Hadir</strong>
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-absensi mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="width: 170px;">Tanggal</th>
                            <th class="text-center" style="width: 140px;">Jam Masuk</th>
                            <th class="text-center" style="width: 140px;">Jam Pulang</th>
                            <th class="text-center" style="width: 150px;">Foto Kehadiran</th>
                            <th>Keterangan Kegiatan</th>
                            <th class="text-center" style="width: 120px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $row)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">
                                    <span style="display: inline-block; width: 26px; height: 26px; line-height: 26px; background: #e0f2fe; color: #0284c7; border-radius: 50%; font-size: 12px; font-weight: 700;">
                                        {{ $loop->iteration }}
                                    </span>
                                </td>
                                
                                <td>
                                    <div class="font-weight-bold text-dark" style="font-size: 13.5px;">
                                        {{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('d M Y') }}
                                    </div>
                                    <small class="text-muted font-weight-bold" style="font-size: 11.5px;">{{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('l') }}</small>
                                </td>

                                <td class="text-center">
                                    <span class="badge-jam badge-masuk">
                                        <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i> {{ $row->jam_masuk ?? '-' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($row->jam_keluar)
                                        <span class="badge-jam badge-pulang">
                                            <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> {{ $row->jam_keluar }}
                                        </span>
                                    @else
                                        <span class="badge badge-light text-muted border px-2 py-1" style="font-size: 11px; border-radius: 6px;">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        @if($row->foto_bukti)
                                            <a href="#" data-toggle="modal" data-target="#fotoIn{{ $row->id }}" title="Foto Selfie Masuk">
                                                <img src="{{ asset($row->foto_bukti) }}" class="img-thumb-absensi mr-1">
                                            </a>
                                            <div class="modal fade" id="fotoIn{{ $row->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                        <h6 class="text-white mb-2">Foto Absen Masuk ({{ $row->jam_masuk }})</h6>
                                                        <img src="{{ asset($row->foto_bukti) }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($row->foto_keluar)
                                            <a href="#" data-toggle="modal" data-target="#fotoOut{{ $row->id }}" title="Foto Selfie Pulang">
                                                <img src="{{ asset($row->foto_keluar) }}" class="img-thumb-absensi">
                                            </a>
                                            <div class="modal fade" id="fotoOut{{ $row->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                        <h6 class="text-white mb-2">Foto Absen Pulang ({{ $row->jam_keluar }})</h6>
                                                        <img src="{{ asset($row->foto_keluar) }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if(!$row->foto_bukti && !$row->foto_keluar)
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <span style="font-weight: 500; font-size: 13.5px;">{{ $row->keterangan ?? 'Hadir tepat waktu' }}</span>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 50px; font-size: 12px; background: #ecfdf5; color: #047857; border: 1px solid #a7f3d0;">
                                        <i class="fa-solid fa-check mr-1"></i> {{ $row->status ?? 'Hadir' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="p-0">
                                    <div class="empty-state-card">
                                        <div class="empty-state-icon-box">
                                            <i class="fa-solid fa-calendar-xmark"></i>
                                        </div>
                                        <h5 class="font-weight-bold text-dark mb-2" style="font-size: 18px;">Belum Ada Riwayat Absensi</h5>
                                        <p class="text-muted small mb-0" style="max-width: 480px; margin: 0 auto;">Lakukan absensi selfie masuk dan pulang setiap hari melalui <strong>Aplikasi Mobile Magang (APK)</strong> untuk mencatat riwayat kehadiran Anda.</p>
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

<script>
    function updateWibClock() {
        const now = new Date();
        const options = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const timeString = now.toLocaleTimeString('id-ID', options);
        const clockEl = document.getElementById('jam-digital-wib');
        if (clockEl) {
            clockEl.innerText = timeString;
        }
    }
    setInterval(updateWibClock, 1000);
    updateWibClock();
</script>

@endsection
