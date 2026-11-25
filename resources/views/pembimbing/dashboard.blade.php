@extends('template_admin.master_pembimbing')

@section('title', 'Dashboard Guru Pembimbing')

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* ========================================================
       MODERN DASHBOARD GURU PEMBIMBING (AMBIENT TECH THEME)
       ======================================================== */
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f8fafc;
    }

    /* 1. HERO HEADER BANNER */
    .pembimbing-hero-card {
        background: linear-gradient(135deg, #1e3c72 0%, #0077b6 50%, #3CB9E0 100%);
        border-radius: 20px;
        padding: 30px 32px;
        color: #ffffff;
        box-shadow: 0 12px 30px rgba(37, 99, 235, 0.22);
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .pembimbing-hero-card::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 170px; height: 170px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        pointer-events: none;
    }
    .pembimbing-hero-card::after {
        content: '';
        position: absolute;
        bottom: -30px; left: 35%;
        width: 110px; height: 110px;
        background: rgba(255, 255, 255, 0.06);
        border-radius: 50%;
        pointer-events: none;
    }
    .badge-role-pill {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-weight: 700;
        font-size: 11.5px;
        letter-spacing: 0.6px;
        padding: 6px 14px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.28);
    }
    .badge-date-pill {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-weight: 700;
        font-size: 12px;
        padding: 8px 16px;
        border-radius: 30px;
        border: 1px solid rgba(255, 255, 255, 0.25);
        display: inline-flex; align-items: center;
    }
    .badge-active-students {
        background: #ffffff;
        color: #1e3c72;
        font-weight: 800;
        font-size: 12px;
        padding: 8px 16px;
        border-radius: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: inline-flex; align-items: center;
    }

    /* 2. STATISTIC METRIC CARDS */
    .stat-metric-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.03);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .stat-metric-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(37, 99, 235, 0.1);
        border-color: #38bdf8;
    }
    .stat-label {
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.8px;
        color: #64748b;
        text-transform: uppercase;
        display: block;
        margin-bottom: 5px;
    }
    .stat-value {
        font-size: 28px;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.5px;
        margin-bottom: 4px;
    }
    .stat-icon-wrapper {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .bg-soft-primary { background: #e0f2fe; color: #0284c7; }
    .bg-soft-info { background: #e0f7fa; color: #0891b2; }
    .bg-soft-warning { background: #fef3c7; color: #d97706; }

    /* 3. MODERN TABLE CARD */
    .modern-table-card {
        background: #ffffff;
        border-radius: 18px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.03) !important;
        overflow: hidden;
    }
    .table-header-indicator {
        width: 4px; height: 20px;
        background: linear-gradient(180deg, #38bdf8 0%, #1e3c72 100%);
        border-radius: 4px;
    }
    .search-input-wrapper {
        position: relative;
        min-width: 280px;
    }
    .search-input-wrapper .search-icon {
        position: absolute;
        top: 50%; left: 14px;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 13px;
    }
    .modern-search-input {
        padding-left: 36px !important;
        border-radius: 20px !important;
        border: 1.5px solid #e2e8f0 !important;
        background: #f8fafc !important;
        font-size: 12.5px !important;
        height: 38px !important;
        transition: all 0.2s ease;
    }
    .modern-search-input:focus {
        background: #ffffff !important;
        border-color: #38bdf8 !important;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.15) !important;
    }

    /* 4. TABLE STYLING */
    .modern-table {
        margin-bottom: 0 !important;
    }
    .modern-table thead th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-size: 11.5px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.6px !important;
        padding: 15px 18px !important;
        border-top: none !important;
        border-bottom: 2px solid #e2e8f0 !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }
    .modern-table tbody td {
        padding: 16px 18px !important;
        vertical-align: middle !important;
        border-top: 1px solid #f1f5f9 !important;
        color: #334155;
        font-size: 13px;
    }
    .modern-table tbody tr {
        transition: background-color 0.2s ease;
    }
    .modern-table tbody tr:hover {
        background-color: #f0f9ff !important;
    }

    /* 5. ITEM ELEMENTS */
    .number-badge {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .student-avatar-img {
        width: 44px; height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #ffffff;
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }
    .student-avatar-fallback {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);
        color: #ffffff;
        font-weight: 800;
        display: inline-flex; align-items: center; justify-content: center;
        font-size: 15px;
        box-shadow: 0 3px 8px rgba(2, 132, 199, 0.25);
    }
    .badge-nisn-pill {
        background: #f1f5f9;
        color: #64748b;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 7px;
        border-radius: 6px;
        display: inline-block;
    }
    .badge-jurusan-pill {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        font-weight: 700;
        border-radius: 20px;
        padding: 3px 9px;
        font-size: 10.5px;
        text-transform: uppercase;
        display: inline-block;
    }

    /* BADGES LAPORAN */
    .badge-pending-laporan {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
        border-radius: 20px;
        font-weight: 700;
        padding: 5px 12px;
        font-size: 11.5px;
        display: inline-flex; align-items: center;
    }
    .badge-approved-laporan {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
        border-radius: 20px;
        font-weight: 700;
        padding: 5px 12px;
        font-size: 11.5px;
        display: inline-flex; align-items: center;
    }
    .badge-empty-laporan {
        background: #f1f5f9;
        color: #64748b;
        border-radius: 20px;
        font-weight: 600;
        padding: 5px 12px;
        font-size: 11.5px;
        display: inline-flex; align-items: center;
    }

    /* ACTION BUTTONS */
    .btn-detail-action {
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 7px 14px !important;
        box-shadow: 0 3px 8px rgba(2, 132, 199, 0.25) !important;
        transition: all 0.2s ease !important;
        display: inline-flex; align-items: center;
        text-decoration: none !important;
        white-space: nowrap;
    }
    .btn-detail-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(2, 132, 199, 0.35) !important;
        color: #ffffff !important;
    }
    .btn-absensi-quick {
        background: #ffffff !important;
        color: #0f172a !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 11.5px !important;
        padding: 6px 12px !important;
        transition: all 0.2s ease !important;
        display: inline-flex; align-items: center;
        text-decoration: none !important;
        white-space: nowrap;
    }
    .btn-absensi-quick:hover {
        border-color: #0284c7 !important;
        color: #0284c7 !important;
        background: #f0f9ff !important;
        transform: translateY(-1px);
    }
</style>

<section class="section">
    {{-- 1. HERO BANNER GURU PEMBIMBING (AMBIENT TECH GRADIENT) --}}
        <div class="pembimbing-hero-card d-flex flex-wrap justify-content-between align-items-center">
            <div class="d-flex align-items-center mb-3 mb-lg-0">
                <div>
                    <div class="badge-role-pill mb-2">
                        <i class="fas fa-chalkboard-teacher mr-2"></i> Portal Guru Pembimbing SMK
                    </div>
                    <h2 class="font-weight-bold mb-1 text-white" style="letter-spacing: -0.5px;">
                        Selamat Datang, {{ Auth::user()->name }}!
                    </h2>
                    <p class="mb-0 text-white-50" style="font-size: 13.5px; max-width: 600px;">
                        Sistem Informasi Magang - PT. Media Balai Nusa (Astronet). Pantau aktivitas siswa bimbingan, verifikasi laporan harian, dan monitoring absensi secara berkala.
                    </p>
                </div>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-2">
                <span class="badge-date-pill mr-2 mb-2 mb-sm-0">
                    <i class="fas fa-calendar-alt mr-2 text-info"></i> {{ date('d F Y') }}
                </span>
                <span class="badge-active-students">
                    <i class="fas fa-user-graduate text-primary mr-2"></i> {{ $mahasiswaList->count() }} Siswa Bimbingan
                </span>
            </div>
        </div>

        {{-- 2. STATISTIC METRIC CARDS --}}
        <div class="row mb-4">
            
            {{-- Card 1: Data Siswa Bimbingan --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3 mb-lg-0">
                <div class="stat-metric-card">
                    <div>
                        <span class="stat-label">DATA SISWA BIMBINGAN</span>
                        <h3 class="stat-value text-primary">{{ $mahasiswaList->count() }}</h3>
                        <small class="text-muted"><i class="fas fa-check-circle text-success mr-1"></i>Siswa SMK Aktif</small>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-primary">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>

            {{-- Card 2: Total Laporan Harian --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3 mb-lg-0">
                <div class="stat-metric-card">
                    <div>
                        <span class="stat-label">TOTAL LAPORAN HARIAN</span>
                        <h3 class="stat-value text-info">{{ $mahasiswaList->flatMap->laporanHarian->count() }}</h3>
                        <small class="text-muted"><i class="fas fa-layer-group text-info mr-1"></i>Logbook Terkumpul</small>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-info">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>

            {{-- Card 3: Menunggu ACC --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3 mb-lg-0">
                <div class="stat-metric-card">
                    <div>
                        <span class="stat-label">MENUNGGU ACC / REVIEW</span>
                        <h3 class="stat-value text-warning">{{ $mahasiswaList->flatMap->laporanHarian->where('status', 'pending')->count() }}</h3>
                        <small class="text-muted"><i class="fas fa-hourglass-half text-warning mr-1"></i>Perlu Persetujuan Guru</small>
                    </div>
                    <div class="stat-icon-wrapper bg-soft-warning">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

        </div>

        {{-- 3. MODERN TABLE CARD: DAFTAR SISWA BIMBINGAN --}}
        <div class="card modern-table-card">
            <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between border-bottom">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="table-header-indicator mr-2"></div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15.5px;">
                        Daftar Siswa Bimbingan Magang
                    </h5>
                    <span class="badge badge-light border text-primary ml-2 px-2 py-1 font-weight-bold" style="border-radius: 20px;">
                        {{ $mahasiswaList->count() }} Siswa
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="customSearchInput" class="form-control form-control-sm modern-search-input" placeholder="Cari nama siswa, NISN, email...">
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table id="table" class="table modern-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">No</th>
                                <th>Nama & Identitas Siswa</th>
                                <th>Asal Sekolah & Jurusan</th>
                                <th>Kontak Siswa</th>
                                <th class="text-center">Status Laporan</th>
                                <th class="text-center" width="12%">Monitoring</th>
                                <th class="text-center" width="12%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswaList as $mhs)
                                <tr>
                                    {{-- No Urut --}}
                                    <td class="text-center">
                                        <span class="number-badge">{{ $loop->iteration }}</span>
                                    </td>

                                    {{-- Nama & Foto --}}
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $fotoSiswa = $mhs->pendaftaran->gambar ?? $mhs->gambar ?? null;
                                            @endphp

                                            @if($fotoSiswa && file_exists(public_path('gambar/' . $fotoSiswa)))
                                                <img src="{{ asset('gambar/' . $fotoSiswa) }}" alt="{{ $mhs->name }}" class="student-avatar-img mr-3">
                                            @else
                                                <div class="student-avatar-fallback mr-3">
                                                    {{ strtoupper(substr($mhs->name ?? 'S', 0, 1)) }}
                                                </div>
                                            @endif

                                            <div>
                                                <span class="font-weight-bold text-dark" style="font-size: 13.5px; display: block;">
                                                    {{ $mhs->name }}
                                                </span>
                                                @if($mhs->nim)
                                                    <span class="badge-nisn-pill mt-1">
                                                        <i class="fas fa-id-card mr-1"></i> NIS/NISN: {{ $mhs->nim }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Asal Sekolah & Jurusan --}}
                                    <td>
                                        <div class="font-weight-600 text-dark" style="font-size: 13px;">
                                            <i class="fas fa-school text-primary mr-1"></i>
                                            {{ $mhs->pendaftaran->universitas ?? 'SMK Mitra' }}
                                        </div>
                                        @if(isset($mhs->pendaftaran->jurusan) && $mhs->pendaftaran->jurusan)
                                            <div class="mt-1">
                                                <span class="badge-jurusan-pill">
                                                    {{ strtoupper($mhs->pendaftaran->jurusan) }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Kontak --}}
                                    <td>
                                        <div class="text-nowrap" style="font-size: 12.5px;">
                                            <i class="fas fa-envelope text-muted mr-1"></i>
                                            <a href="mailto:{{ $mhs->email }}" class="text-secondary font-weight-500">
                                                {{ $mhs->email }}
                                            </a>
                                        </div>
                                        @if($mhs->no_telp)
                                            <div class="text-nowrap mt-1" style="font-size: 12px;">
                                                <i class="fab fa-whatsapp text-success mr-1"></i>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $mhs->no_telp) }}" target="_blank" class="text-dark font-weight-500">
                                                    {{ $mhs->no_telp }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Status Laporan Harian --}}
                                    <td class="text-center">
                                        @php
                                            $totalLaporan = $mhs->laporanHarian->count();
                                            $pendingCount = $mhs->laporanHarian->where('status', 'pending')->count();
                                        @endphp
                                        
                                        @if($pendingCount > 0)
                                            <span class="badge-pending-laporan">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $pendingCount }} Menunggu ACC
                                            </span>
                                        @elseif($totalLaporan > 0)
                                            <span class="badge-approved-laporan">
                                                <i class="fas fa-check-circle mr-1"></i> {{ $totalLaporan }} Disetujui
                                            </span>
                                        @else
                                            <span class="badge-empty-laporan">
                                                <i class="far fa-circle mr-1"></i> Belum Ada Laporan
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Monitoring Absensi --}}
                                    <td class="text-center">
                                        <a href="{{ route('pembimbing.absensi.detail', $mhs->id) }}" class="btn-absensi-quick" title="Lihat Rekap Absensi Siswa">
                                            <i class="fas fa-user-clock mr-1 text-primary"></i> Absensi
                                        </a>
                                    </td>

                                    {{-- Aksi Detail Laporan --}}
                                    <td class="text-center">
                                        <a href="{{ route('pembimbing.laporan.mahasiswa', $mhs->id) }}" class="btn-detail-action" title="Buka Detail Logbook Laporan">
                                            <i class="fas fa-book-open mr-1"></i> Detail Laporan
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div style="font-size: 40px; color: #cbd5e1; margin-bottom: 12px;">
                                            <i class="fas fa-user-friends"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark mb-1">Belum Ada Siswa Bimbingan</h6>
                                        <p class="text-muted mb-0" style="font-size: 13px;">
                                            Siswa magang SMK yang di-plotting oleh Admin kepada Anda akan muncul di sini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Fitur Live Search Cepat & Responsif
        $("#customSearchInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#table tbody tr").filter(function() {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(value) > -1);
            });
        });
    });
</script>
@endsection
