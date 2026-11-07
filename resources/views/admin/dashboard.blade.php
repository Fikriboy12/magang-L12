@extends('template_admin.master')

@section('contents')

<style>
    /* ========================================================
       DESIGN DASHBOARD ADMIN MODERN, RAPI & ELEGAN
       ======================================================== */
    
    /* 1. WELCOME CARD (SLIM & PRESTISIUS) */
    .welcome-card-modern {
        background: linear-gradient(135deg, #1e3c72 0%, #0077b6 60%, #3CB9E0 100%);
        border-radius: 16px;
        padding: 22px 28px;
        color: #ffffff;
        box-shadow: 0 6px 20px rgba(0, 119, 182, 0.2);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }

    .welcome-card-modern::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 140px;
        height: 140px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-icon-box {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .badge-date-pill {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-weight: 600;
        font-size: 12px;
        padding: 8px 16px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        display: inline-flex;
        align-items: center;
    }

    /* 2. STATISTIC METRIC CARDS (UNIFORM & POLISHED) */
    .metric-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px 22px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0f3f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        height: calc(100% - 24px);
    }

    .metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 24px rgba(60, 185, 224, 0.15);
        border-color: #bae6fd;
    }

    .metric-title {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 4px;
        text-transform: capitalize;
    }

    .metric-number {
        font-size: 1.85rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.1;
        margin-bottom: 4px;
    }

    .metric-subtext {
        font-size: 12px;
        color: #94a3b8;
        margin: 0;
    }

    .metric-icon-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .icon-soft-blue { background: #e0f2fe; color: #0284c7; }
    .icon-soft-green { background: #dcfce7; color: #16a34a; }
    .icon-soft-orange { background: #ffedd5; color: #ea580c; }
    .icon-soft-purple { background: #f3e8ff; color: #9333ea; }

    /* 3. CARD CONTAINER UMUM */
    .card-panel-modern {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f0f3f8;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        margin-bottom: 24px;
        overflow: hidden;
    }

    .card-panel-header {
        padding: 18px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #ffffff;
    }

    .card-panel-header h6 {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
    }

    .card-panel-body {
        padding: 22px 24px;
    }

    /* 4. TOMBOL PINTASAN AKSI CEPAT */
    .btn-action-tile {
        display: flex;
        align-items: center;
        padding: 13px 16px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #1e293b;
        text-decoration: none !important;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 11px;
        transition: all 0.2s ease;
    }

    .btn-action-tile:last-child {
        margin-bottom: 0;
    }

    .btn-action-tile:hover {
        background: #f8fafc;
        border-color: #38bdf8;
        color: #0284c7;
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(2, 132, 199, 0.08);
    }

    .tile-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-right: 14px;
        flex-shrink: 0;
    }

    .tile-blue { background: #e0f2fe; color: #0284c7; }
    .tile-purple { background: #f3e8ff; color: #9333ea; }
    .tile-orange { background: #ffedd5; color: #ea580c; }

    /* 5. AVATAR & TABEL ELEGAN */
    .avatar-initial-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0284c7, #38bdf8);
        color: #ffffff;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .table-modern-clean thead th {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
        border-top: none !important;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        vertical-align: middle;
    }

    .table-modern-clean tbody td {
        padding: 14px 18px;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
        font-size: 13px;
    }

    .table-modern-clean tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Badge Status */
    .badge-status-pill {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: inline-block;
    }
    .badge-status-diterima { background: #dcfce7; color: #15803d; }
    .badge-status-pengajuan { background: #fef3c7; color: #b45309; }
    .badge-status-ditolak { background: #fee2e2; color: #b91c1c; }
</style>

<section class="section">
    {{-- 1. SECTION HEADER RESMI STISLA --}}
    <div class="section-header d-flex justify-content-between align-items-center">
        <div>
            <h1 class="font-weight-bold text-dark mb-0" style="font-size: 1.45rem;">
                <i class="fas fa-th-large text-primary mr-2"></i> Dashboard Admin
            </h1>
            <small class="text-muted">
                <i class="fas fa-building mr-1"></i> PT. Media Balai Nusa &bull; Pusat Kendali Magang Siswa SMK
            </small>
        </div>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Admin</a></div>
            <div class="breadcrumb-item">Dashboard</div>
        </div>
    </div>

    <div class="section-body">
        {{-- 2. WELCOME BANNER (RAMPING, BERSIH & MEWAH) --}}
        <div class="welcome-card-modern">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="welcome-icon-box mr-3">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h5 class="font-weight-bold text-white mb-1">
                            Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}!
                        </h5>
                        <p class="text-white-50 small mb-0">
                            Berikut adalah ringkasan data, presensi harian, dan aktivitas magang siswa hari ini.
                        </p>
                    </div>
                </div>
                <div class="text-md-right">
                    <span class="badge-date-pill">
                        <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                    </span>
                </div>
            </div>
        </div>

        {{-- 3. 4 KARTU STATISTIK (RAPI, SEJAJAR & SERAGAM) --}}
        <div class="row">
            {{-- Kartu 1: Total Siswa --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="metric-card">
                    <div>
                        <div class="metric-title">Total Siswa Terdaftar</div>
                        <div class="metric-number">{{ $data['pelamar'] }}</div>
                        <p class="metric-subtext"><i class="fas fa-id-badge text-primary mr-1"></i> Akun siswa aktif</p>
                    </div>
                    <div class="metric-icon-circle icon-soft-blue">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            {{-- Kartu 2: Siswa Diterima --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="metric-card">
                    <div>
                        <div class="metric-title">Siswa Aktif Magang</div>
                        <div class="metric-number text-success">{{ $data['diterima'] }}</div>
                        <p class="metric-subtext"><i class="fas fa-check-circle text-success mr-1"></i> Telah diterima</p>
                    </div>
                    <div class="metric-icon-circle icon-soft-green">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
            </div>

            {{-- Kartu 3: Pendaftaran Baru --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="metric-card">
                    <div>
                        <div class="metric-title">Pendaftaran Baru</div>
                        <div class="metric-number text-warning">{{ $data['pengajuan'] }}</div>
                        <p class="metric-subtext"><i class="fas fa-clock text-warning mr-1"></i> Butuh verifikasi</p>
                    </div>
                    <div class="metric-icon-circle icon-soft-orange">
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
            </div>

            {{-- Kartu 4: Pembimbing & Mentor --}}
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="metric-card">
                    <div>
                        <div class="metric-title">Pembimbing & Mentor</div>
                        <div class="metric-number text-purple">{{ $data['guru_pembimbing'] + $data['pembimbing_lapangan'] }}</div>
                        <p class="metric-subtext">
                            <i class="fas fa-user-tie text-purple mr-1"></i> {{ $data['guru_pembimbing'] }} Guru &bull; {{ $data['pembimbing_lapangan'] }} Mentor
                        </p>
                    </div>
                    <div class="metric-icon-circle icon-soft-purple">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. BARIS UTAMA (SEIMBANG & SEJAJAR: KIRI GRAFIK, KANAN PRESENSI & AKSI) --}}
        <div class="row">
            {{-- Kolom Kiri (8 cols): Grafik Tren Pendaftaran Siswa --}}
            <div class="col-lg-8 col-md-12 col-12 d-flex">
                <div class="card-panel-modern w-100 d-flex flex-column">
                    <div class="card-panel-header">
                        <h6>
                            <i class="fas fa-chart-line text-primary mr-2"></i> Tren Pendaftaran & Penerimaan Siswa
                        </h6>
                        <span class="badge badge-light border text-muted small font-weight-bold">
                            6 Bulan Terakhir
                        </span>
                    </div>
                    <div class="card-panel-body flex-grow-1 d-flex flex-column justify-content-center">
                        <div style="height: 240px; position: relative; width: 100%;">
                            <canvas id="chartTrenPendaftaran"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan (4 cols): Presensi Hari Ini & Akses Pintasan Cepat --}}
            <div class="col-lg-4 col-md-12 col-12 d-flex">
                <div class="card-panel-modern w-100 d-flex flex-column">
                    <div class="card-panel-header">
                        <h6>
                            <i class="fas fa-bolt text-warning mr-2"></i> Presensi & Akses Cepat
                        </h6>
                    </div>
                    <div class="card-panel-body flex-grow-1 d-flex flex-column justify-content-between">
                        {{-- Ringkasan Presensi Hari Ini --}}
                        <div class="p-3 rounded-lg mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted small font-weight-bold">PRESENSI HARI INI:</span>
                                <span class="badge badge-primary px-2 py-1 font-weight-bold" style="font-size: 11px;">
                                    {{ $data['total_siswa_aktif'] }} Siswa Aktif
                                </span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center text-center">
                                <div class="px-2">
                                    <h5 class="font-weight-bold text-success mb-0">{{ $data['hadir_today'] }}</h5>
                                    <small class="text-muted font-weight-600" style="font-size: 11px;">Hadir</small>
                                </div>
                                <div class="px-2 border-left border-right">
                                    <h5 class="font-weight-bold text-warning mb-0">{{ $data['izin_today'] + $data['sakit_today'] }}</h5>
                                    <small class="text-muted font-weight-600" style="font-size: 11px;">Izin/Sakit</small>
                                </div>
                                <div class="px-2">
                                    <h5 class="font-weight-bold text-danger mb-0">{{ $data['belum_presensi'] }}</h5>
                                    <small class="text-muted font-weight-600" style="font-size: 11px;">Belum Absen</small>
                                </div>
                            </div>
                        </div>

                        {{-- 3 Tombol Pintasan Cepat --}}
                        <div class="d-flex flex-column">
                            <a href="{{ route('admin.absensi.portal') }}" class="btn-action-tile">
                                <div class="tile-icon tile-blue">
                                    <i class="fas fa-clipboard-check"></i>
                                </div>
                                <div class="text-truncate">
                                    <div>Pusat Presensi EdLink</div>
                                    <small class="text-muted font-weight-normal">Absensi Manual Hadir / Izin / Sakit</small>
                                </div>
                            </a>

                            <a href="{{ route('admin.absensi.qr') }}" class="btn-action-tile">
                                <div class="tile-icon tile-purple">
                                    <i class="fas fa-qrcode"></i>
                                </div>
                                <div class="text-truncate">
                                    <div>Layar QR Presensi</div>
                                    <small class="text-muted font-weight-normal">Scan QR Otomatis 20 Detik</small>
                                </div>
                            </a>

                            <a href="{{ route('admin.pendaftaran.index') }}" class="btn-action-tile">
                                <div class="tile-icon tile-orange">
                                    <i class="fas fa-user-edit"></i>
                                </div>
                                <div class="text-truncate">
                                    <div>Verifikasi Pendaftar ({{ $data['pengajuan'] }})</div>
                                    <small class="text-muted font-weight-normal">Seleksi berkas siswa SMK baru</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 5. TABEL PENDAFTAR TERBARU (BERSIH, RAPI & PROPORSIONAL) --}}
        <div class="row">
            <div class="col-12">
                <div class="card-panel-modern">
                    <div class="card-panel-header">
                        <h6>
                            <i class="fas fa-user-plus text-primary mr-2"></i> Pendaftar Siswa Terbaru
                        </h6>
                        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-outline-primary font-weight-bold" style="border-radius: 8px;">
                            Lihat Semua Pendaftar <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-modern-clean mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 60px;" class="text-center">No</th>
                                        <th>Nama Siswa</th>
                                        <th>Asal Sekolah / SMK</th>
                                        <th>Jurusan</th>
                                        <th>Tanggal Daftar</th>
                                        <th>Status</th>
                                        <th class="text-center" style="width: 110px;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['pendaftar_terbaru'] as $idx => $pendaftar)
                                        <tr>
                                            <td class="text-center font-weight-bold text-muted">{{ $idx + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-initial-circle mr-3">
                                                        {{ strtoupper(substr($pendaftar->user->name ?? 'S', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-bold text-dark">{{ $pendaftar->user->name ?? '-' }}</div>
                                                        <small class="text-muted">{{ $pendaftar->user->email ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <i class="fas fa-graduation-cap text-muted mr-1"></i>
                                                {{ $pendaftar->universitas ?? $pendaftar->asal_sekolah ?? $pendaftar->nama_sekolah ?? '-' }}
                                            </td>
                                            <td>
                                                <span class="badge badge-light border text-dark font-weight-normal px-2 py-1">
                                                    {{ $pendaftar->jurusan ?? '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <i class="far fa-clock text-muted mr-1"></i>
                                                {{ \Carbon\Carbon::parse($pendaftar->created_at)->translatedFormat('d M Y') }}
                                            </td>
                                            <td>
                                                @if($pendaftar->status_pendaftaran === 'diterima')
                                                    <span class="badge-status-pill badge-status-diterima">
                                                        <i class="fas fa-check-circle mr-1"></i> Diterima
                                                    </span>
                                                @elseif($pendaftar->status_pendaftaran === 'tidak diterima')
                                                    <span class="badge-status-pill badge-status-ditolak">
                                                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                                                    </span>
                                                @else
                                                    <span class="badge-status-pill badge-status-pengajuan">
                                                        <i class="fas fa-hourglass-half mr-1"></i> Pengajuan
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pendaftaran.detail', $pendaftar->id_pendaftaran) }}" class="btn btn-sm btn-info px-3 py-1 font-weight-bold" style="border-radius: 8px;">
                                                    <i class="fas fa-eye mr-1"></i> Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5 text-muted">
                                                <i class="fas fa-inbox fa-3x mb-2 text-light d-block"></i>
                                                Belum ada pendaftaran siswa.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('scripts')
{{-- Load Chart.js --}}
<script src="{{ asset('assets_admin/modules/chart.min.js') }}"></script>

<script>
    $(document).ready(function() {
        const ctxTren = document.getElementById('chartTrenPendaftaran');
        if (ctxTren) {
            const labels = {!! json_encode($data['chart_labels']) !!};
            const dataPendaftar = {!! json_encode($data['chart_pendaftaran']) !!};
            const dataDiterima = {!! json_encode($data['chart_diterima']) !!};

            new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Total Siswa Mendaftar',
                            data: dataPendaftar,
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.08)',
                            pointBackgroundColor: '#0284c7',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.35
                        },
                        {
                            label: 'Siswa Diterima Magang',
                            data: dataDiterima,
                            borderColor: '#16a34a',
                            backgroundColor: 'rgba(22, 163, 74, 0.04)',
                            pointBackgroundColor: '#16a34a',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.35
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            fontSize: 12,
                            fontFamily: "'Poppins', sans-serif"
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0,
                                fontSize: 11
                            },
                            gridLines: {
                                color: '#f1f5f9',
                                zeroLineColor: '#e2e8f0'
                            }
                        }],
                        xAxes: [{
                            ticks: {
                                fontSize: 11
                            },
                            gridLines: {
                                display: false
                            }
                        }]
                    },
                    tooltips: {
                        backgroundColor: '#1e293b',
                        titleFontFamily: "'Poppins', sans-serif",
                        bodyFontFamily: "'Poppins', sans-serif",
                        xPadding: 12,
                        yPadding: 10,
                        cornerRadius: 8
                    }
                }
            });
        }
    });
</script>
@endsection
