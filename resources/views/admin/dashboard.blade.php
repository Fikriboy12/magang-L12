@extends('template_admin.master')

@section('contents')

<style>
    /* Styling Dashboard Admin Modern */
    .hero-banner-admin {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #0284c7 100%);
        border-radius: 18px;
        color: #ffffff;
        padding: 30px 35px;
        box-shadow: 0 10px 25px rgba(2, 132, 199, 0.25);
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }

    .hero-banner-admin::after {
        content: '';
        position: absolute;
        right: -30px;
        bottom: -30px;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }

    .stat-card-modern {
        border-radius: 16px;
        border: none;
        background: #ffffff;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.04);
        padding: 22px 24px;
        margin-bottom: 25px;
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        overflow: hidden;
    }

    .stat-card-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(2, 132, 199, 0.15);
    }

    .stat-card-modern .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .icon-gradient-1 { background: linear-gradient(135deg, #0284c7, #38bdf8); }
    .icon-gradient-2 { background: linear-gradient(135deg, #16a34a, #4ade80); }
    .icon-gradient-3 { background: linear-gradient(135deg, #ea580c, #fb923c); }
    .icon-gradient-4 { background: linear-gradient(135deg, #7c3aed, #a78bfa); }

    .quick-action-card {
        border-radius: 14px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        padding: 18px 20px;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        text-decoration: none !important;
        color: inherit;
        margin-bottom: 15px;
    }

    .quick-action-card:hover {
        background: #f8fafc;
        border-color: #38bdf8;
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(2, 132, 199, 0.12);
        color: #0284c7;
    }

    .quick-action-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 15px;
        flex-shrink: 0;
    }

    .avatar-sm-circle {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #0284c7;
        color: #fff;
        font-weight: 700;
        font-size: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .badge-soft-primary { background: #e0f2fe; color: #0284c7; }
    .badge-soft-success { background: #dcfce7; color: #16a34a; }
    .badge-soft-warning { background: #fef3c7; color: #d97706; }
    .badge-soft-danger { background: #fee2e2; color: #dc2626; }
    .badge-soft-secondary { background: #f1f5f9; color: #64748b; }
</style>

<section class="section">
    {{-- Header Section --}}
    <div class="section-header d-flex justify-content-between align-items-center">
        <div>
            <h1 style="font-size: 1.4rem; font-weight: 700; color: #1e293b; margin-bottom: 2px;">
                <i class="fas fa-th-large text-primary mr-2"></i> {{ $data['title'] }}
            </h1>
            <small class="text-muted"><i class="fas fa-building mr-1"></i> Sistem Manajemen Magang & Presensi — PT. Media Balai Nusa</small>
        </div>
        <div>
            <span class="badge badge-light px-3 py-2 font-weight-bold text-dark shadow-sm">
                <i class="far fa-calendar-alt text-primary mr-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </span>
        </div>
    </div>

    <div class="section-body">
        {{-- Hero Banner Admin --}}
        <div class="hero-banner-admin">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                <div class="mb-3 mb-md-0">
                    <span class="badge badge-light px-3 py-1 font-weight-bold text-primary mb-2 shadow-sm" style="font-size: 12px; letter-spacing: 0.5px;">
                        <i class="fas fa-shield-alt mr-1"></i> ADMIN KONTROL UTAMA
                    </span>
                    <h3 class="font-weight-bold mb-1">Selamat Datang, {{ Auth::user()->name ?? 'Administrator' }}!</h3>
                    <p class="mb-0 text-white-50" style="font-size: 14px; max-width: 650px;">
                        Pantau seluruh aktivitas siswa magang SMK, kelola kehadiran harian secara real-time, verifikasi pendaftaran baru, dan koordinasikan pembimbing industri.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('admin.absensi.portal') }}" class="btn btn-warning font-weight-bold text-dark px-3 py-2 mr-2 shadow-sm" style="border-radius: 10px;">
                        <i class="fas fa-calendar-check mr-1"></i> Presensi EdLink
                    </a>
                    <a href="{{ route('admin.absensi.qr') }}" class="btn btn-light font-weight-bold text-primary px-3 py-2 shadow-sm" style="border-radius: 10px;">
                        <i class="fas fa-qrcode mr-1"></i> Layar QR Live
                    </a>
                </div>
            </div>
        </div>

        {{-- 4 Kartu Metrik Utama --}}
        <div class="row">
            {{-- 1. Total Siswa Terdaftar --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="stat-card-modern">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 13px;">Total Siswa Terdaftar</span>
                        <h3 class="font-weight-bold text-dark mt-1 mb-0">{{ $data['pelamar'] }}</h3>
                        <small class="text-muted"><i class="fas fa-users mr-1"></i> Akun siswa aktif</small>
                    </div>
                    <div class="stat-icon icon-gradient-1 shadow-sm">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            {{-- 2. Siswa Diterima / Aktif Magang --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="stat-card-modern">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 13px;">Siswa Aktif Magang</span>
                        <h3 class="font-weight-bold text-success mt-1 mb-0">{{ $data['diterima'] }}</h3>
                        <small class="text-muted"><i class="fas fa-check-circle text-success mr-1"></i> Status Diterima</small>
                    </div>
                    <div class="stat-icon icon-gradient-2 shadow-sm">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>

            {{-- 3. Pendaftaran Baru (Menunggu Review) --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="stat-card-modern">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 13px;">Pendaftaran Baru</span>
                        <h3 class="font-weight-bold text-warning mt-1 mb-0">{{ $data['pengajuan'] }}</h3>
                        <small class="text-muted"><i class="fas fa-clock text-warning mr-1"></i> Butuh Verifikasi</small>
                    </div>
                    <div class="stat-icon icon-gradient-3 shadow-sm">
                        <i class="fas fa-file-signature"></i>
                    </div>
                </div>
            </div>

            {{-- 4. Pembimbing & Mentor --}}
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="stat-card-modern">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 13px;">Guru & Mentor Industri</span>
                        <h3 class="font-weight-bold text-primary mt-1 mb-0">{{ $data['guru_pembimbing'] + $data['pembimbing_lapangan'] }}</h3>
                        <small class="text-muted">{{ $data['guru_pembimbing'] }} Guru &bull; {{ $data['pembimbing_lapangan'] }} Mentor</small>
                    </div>
                    <div class="stat-icon icon-gradient-4 shadow-sm">
                        <i class="fas fa-user-tie"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris: Presensi Siswa Hari Ini (Widget Kehadiran Live) --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-dark">
                    <i class="fas fa-clock text-primary mr-2"></i> Monitoring Presensi Hari Ini ({{ \Carbon\Carbon::now()->translatedFormat('d M Y') }})
                </h6>
                <div class="d-flex align-items-center">
                    <span class="badge badge-primary px-3 py-1 font-weight-bold mr-2">
                        Total Siswa Aktif: {{ $data['total_siswa_aktif'] }}
                    </span>
                    <a href="{{ route('admin.absensi.portal') }}" class="btn btn-sm btn-outline-primary font-weight-bold">
                        Buka Pusat Presensi <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="row align-items-center">
                    {{-- 4 Kartu Rekap Kehadiran --}}
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-0">
                        <div class="row">
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="p-3 rounded-lg border d-flex align-items-center justify-content-between" style="background: #f0fdf4; border-color: #bbf7d0 !important;">
                                    <div>
                                        <span class="text-muted small font-weight-600">HADIR HARI INI</span>
                                        <h3 class="font-weight-bold text-success mb-0">{{ $data['hadir_today'] }}</h3>
                                        <small class="text-success font-weight-600"><i class="fas fa-check-circle mr-1"></i> Siswa Hadir</small>
                                    </div>
                                    <div class="avatar-sm-circle bg-success">
                                        <i class="fas fa-walking"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="p-3 rounded-lg border d-flex align-items-center justify-content-between" style="background: #fffbeb; border-color: #fde68a !important;">
                                    <div>
                                        <span class="text-muted small font-weight-600">IZIN RESMI</span>
                                        <h3 class="font-weight-bold text-warning mb-0">{{ $data['izin_today'] }}</h3>
                                        <small class="text-warning font-weight-600"><i class="fas fa-envelope mr-1"></i> Disetujui/Permohonan</small>
                                    </div>
                                    <div class="avatar-sm-circle bg-warning">
                                        <i class="fas fa-envelope-open-text"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="p-3 rounded-lg border d-flex align-items-center justify-content-between" style="background: #f0f9ff; border-color: #bae6fd !important;">
                                    <div>
                                        <span class="text-muted small font-weight-600">SAKIT</span>
                                        <h3 class="font-weight-bold text-info mb-0">{{ $data['sakit_today'] }}</h3>
                                        <small class="text-info font-weight-600"><i class="fas fa-hospital mr-1"></i> Surat Dokter</small>
                                    </div>
                                    <div class="avatar-sm-circle bg-info">
                                        <i class="fas fa-first-aid"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-12 mb-3">
                                <div class="p-3 rounded-lg border d-flex align-items-center justify-content-between" style="background: #fef2f2; border-color: #fecaca !important;">
                                    <div>
                                        <span class="text-muted small font-weight-600">ALFA / BELUM ABSEN</span>
                                        <h3 class="font-weight-bold text-danger mb-0">{{ $data['alfa_today'] + $data['belum_presensi'] }}</h3>
                                        <small class="text-danger font-weight-600"><i class="fas fa-exclamation-circle mr-1"></i> Belum Masuk</small>
                                    </div>
                                    <div class="avatar-sm-circle bg-danger">
                                        <i class="fas fa-user-times"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Donut Chart Visual --}}
                    <div class="col-lg-5 col-md-12 text-center">
                        <h6 class="text-muted font-weight-600 mb-2" style="font-size: 13px;">PERSENTASE KEHADIRAN HARI INI</h6>
                        <div style="max-height: 200px; position: relative;">
                            <canvas id="donutPresensiToday" height="190"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris: Grafik Tren Pendaftaran & Menu Pintasan Cepat --}}
        <div class="row">
            {{-- Kolom Kiri: Grafik Tren Pendaftaran 6 Bulan --}}
            <div class="col-lg-8 col-md-12 col-12 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-chart-line text-primary mr-2"></i> Tren Pendaftaran Siswa Magang (6 Bulan Terakhir)
                        </h6>
                        <span class="badge badge-light text-muted">Statistik Bulanan</span>
                    </div>
                    <div class="card-body p-4">
                        <div style="height: 280px; position: relative;">
                            <canvas id="chartTrenPendaftaran"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Quick Command Center (Pusat Pintasan Cepat) --}}
            <div class="col-lg-4 col-md-12 col-12 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-bolt text-warning mr-2"></i> Akses Cepat Admin
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        {{-- 1. Layar QR Dinamis --}}
                        <a href="{{ route('admin.absensi.qr') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-primary text-white shadow-sm">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <div>
                                <div class="font-weight-bold text-dark">Layar QR Presensi</div>
                                <small class="text-muted">Kode QR Dinamis 20 Detik Anti-Joki</small>
                            </div>
                        </a>

                        {{-- 2. Presensi Manual EdLink --}}
                        <a href="{{ route('admin.absensi.portal') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-success text-white shadow-sm">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div>
                                <div class="font-weight-bold text-dark">Portal Presensi EdLink</div>
                                <small class="text-muted">Absensi Manual Hadir / Izin / Sakit</small>
                            </div>
                        </a>

                        {{-- 3. Review Pendaftaran --}}
                        <a href="{{ route('admin.pendaftaran.index') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-warning text-white shadow-sm">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <div>
                                <div class="font-weight-bold text-dark">Pendaftaran Baru ({{ $data['pengajuan'] }})</div>
                                <small class="text-muted">Tinjau dan seleksi berkas siswa SMK</small>
                            </div>
                        </a>

                        {{-- 4. Pembimbing Lapangan --}}
                        <a href="{{ route('admin.pembimbing_lapangan.index') }}" class="quick-action-card">
                            <div class="quick-action-icon bg-info text-white shadow-sm">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div>
                                <div class="font-weight-bold text-dark">Pembimbing Lapangan</div>
                                <small class="text-muted">Kelola akun mentor industri perusahaan</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Baris: Tabel Aktivitas Terkini (Two-Column Grid) --}}
        <div class="row">
            {{-- Kolom Kiri: Pendaftar Siswa Terbaru --}}
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-user-plus text-primary mr-2"></i> Pendaftar Siswa Terbaru
                        </h6>
                        <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Siswa</th>
                                        <th>Asal Sekolah</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['pendaftar_terbaru'] as $pendaftar)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm-circle mr-2" style="width: 32px; height: 32px; font-size: 12px;">
                                                        {{ strtoupper(substr($pendaftar->user->name ?? 'S', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-600 text-dark" style="font-size: 13px;">{{ $pendaftar->user->name ?? '-' }}</span>
                                                        <br>
                                                        <small class="text-muted">{{ $pendaftar->jurusan ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <small class="text-dark font-weight-500">
                                                    {{ $pendaftar->universitas ?? $pendaftar->asal_sekolah ?? $pendaftar->nama_sekolah ?? '-' }}
                                                </small>
                                            </td>
                                            <td>
                                                @if($pendaftar->status_pendaftaran === 'diterima')
                                                    <span class="badge badge-soft-success px-2 py-1 font-weight-bold">Diterima</span>
                                                @elseif($pendaftar->status_pendaftaran === 'tidak diterima')
                                                    <span class="badge badge-soft-danger px-2 py-1 font-weight-bold">Ditolak</span>
                                                @else
                                                    <span class="badge badge-soft-warning px-2 py-1 font-weight-bold">Pengajuan</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.pendaftaran.detail', $pendaftar->id_pendaftaran) }}" class="btn btn-sm btn-info py-1 px-2" title="Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small">Belum ada siswa mendaftar.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Log Presensi Masuk Hari Ini --}}
            <div class="col-lg-6 col-md-12 col-12 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-dark">
                            <i class="fas fa-clipboard-list text-success mr-2"></i> Log Presensi Masuk Hari Ini
                        </h6>
                        <a href="{{ route('admin.absensi.index') }}" class="btn btn-sm btn-outline-success">Lihat Absensi</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Nama Siswa</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data['presensi_terbaru'] as $presensi)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm-circle mr-2" style="width: 32px; height: 32px; font-size: 12px; background: #16a34a;">
                                                        {{ strtoupper(substr($presensi->user->name ?? 'S', 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-600 text-dark" style="font-size: 13px;">{{ $presensi->user->name ?? '-' }}</span>
                                                        <br>
                                                        <small class="text-muted">{{ $presensi->user->email ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="font-weight-600 text-dark">
                                                    {{ $presensi->jam_masuk ? substr($presensi->jam_masuk, 0, 5) . ' WIB' : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="font-weight-600 text-dark">
                                                    {{ $presensi->jam_keluar ? substr($presensi->jam_keluar, 0, 5) . ' WIB' : '-' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($presensi->status === 'Hadir')
                                                    <span class="badge badge-soft-success px-2 py-1 font-weight-bold"><i class="fas fa-check mr-1"></i> Hadir</span>
                                                @elseif($presensi->status === 'Izin')
                                                    <span class="badge badge-soft-warning px-2 py-1 font-weight-bold">Izin</span>
                                                @elseif($presensi->status === 'Sakit')
                                                    <span class="badge badge-soft-primary px-2 py-1 font-weight-bold">Sakit</span>
                                                @else
                                                    <span class="badge badge-soft-danger px-2 py-1 font-weight-bold">Alfa</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4 text-muted small">
                                                <i class="fas fa-info-circle mr-1"></i> Belum ada aktivitas presensi pada hari ini.
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
{{-- Load Chart.js dari Asset Lokal --}}
<script src="{{ asset('assets_admin/modules/chart.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // ==========================================
        // 1. DONUT CHART PRESENSI HARI INI
        // ==========================================
        const ctxDonut = document.getElementById('donutPresensiToday');
        if (ctxDonut) {
            const hadir = {{ $data['hadir_today'] }};
            const izin = {{ $data['izin_today'] }};
            const sakit = {{ $data['sakit_today'] }};
            const belum = {{ $data['alfa_today'] + $data['belum_presensi'] }};
            const total = hadir + izin + sakit + belum;

            // Jika belum ada data sama sekali, tampilkan placeholder
            const chartData = (total === 0) ? [0, 0, 0, 1] : [hadir, izin, sakit, belum];
            const chartColors = (total === 0) 
                ? ['#22c55e', '#f59e0b', '#0ea5e9', '#e2e8f0'] 
                : ['#22c55e', '#f59e0b', '#0ea5e9', '#ef4444'];

            new Chart(ctxDonut, {
                type: 'doughnut',
                data: {
                    labels: ['Hadir', 'Izin', 'Sakit', 'Belum Absen'],
                    datasets: [{
                        data: chartData,
                        backgroundColor: chartColors,
                        borderWidth: 2,
                        borderColor: '#ffffff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            fontSize: 11,
                            fontFamily: "'Poppins', sans-serif"
                        }
                    },
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    }
                }
            });
        }

        // ==========================================
        // 2. LINE / BAR CHART TREN PENDAFTARAN (6 BULAN)
        // ==========================================
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
                            backgroundColor: 'rgba(2, 132, 199, 0.1)',
                            pointBackgroundColor: '#0284c7',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3
                        },
                        {
                            label: 'Siswa Diterima',
                            data: dataDiterima,
                            borderColor: '#16a34a',
                            backgroundColor: 'rgba(22, 163, 74, 0.05)',
                            pointBackgroundColor: '#16a34a',
                            pointBorderColor: '#fff',
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.35,
                            borderWidth: 3
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
                            fontFamily: "'Poppins', sans-serif"
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            },
                            gridLines: {
                                color: '#f1f5f9'
                            }
                        }],
                        xAxes: [{
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
