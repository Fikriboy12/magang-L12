@extends('template_admin.master_pembimbing')

@section('title', 'Monitoring Absensi')

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* ========================================================
       MODERN MONITORING ABSENSI (COHESIVE TECH BLUE THEME)
       ======================================================== */
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f8fafc;
    }

    /* 1. HERO BANNER */
    .hero-banner-absensi {
        background: linear-gradient(135deg, #1e3c72 0%, #2563eb 50%, #38bdf8 100%);
        border-radius: 20px;
        padding: 28px 32px;
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .hero-banner-absensi::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 160px; height: 160px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        pointer-events: none;
    }
    .badge-sub-pill {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        color: #ffffff;
        font-weight: 700;
        font-size: 11.5px;
        letter-spacing: 0.6px;
        padding: 5px 14px;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        border: 1px solid rgba(255, 255, 255, 0.25);
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

    /* 2. MODERN TABLE CARD */
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

    /* 3. TABLE STYLING */
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

    /* 4. ITEM ELEMENTS */
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
    .badge-presensi-count {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
        font-weight: 700;
        border-radius: 20px;
        padding: 5px 12px;
        font-size: 11.5px;
        display: inline-flex; align-items: center;
    }
    .btn-riwayat-action {
        background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%) !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        font-size: 12px !important;
        padding: 7px 16px !important;
        box-shadow: 0 3px 8px rgba(2, 132, 199, 0.25) !important;
        transition: all 0.2s ease !important;
        display: inline-flex; align-items: center;
        text-decoration: none !important;
        white-space: nowrap;
    }
    .btn-riwayat-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 14px rgba(2, 132, 199, 0.35) !important;
        color: #ffffff !important;
    }
</style>

<section class="section">
    {{-- 1. HERO BANNER MONITORING ABSENSI --}}
    <div class="hero-banner-absensi d-flex flex-wrap justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
            <div class="badge-sub-pill mb-2">
                <i class="fas fa-user-clock mr-2"></i> Rekapitulasi Presensi Magang
            </div>
            <h3 class="font-weight-bold mb-1 text-white" style="letter-spacing: -0.5px;">
                Monitoring Absensi Siswa SMK
            </h3>
            <p class="mb-0 text-white-50" style="font-size: 13.5px; max-width: 600px;">
                Pantau kehadiran harian, jam masuk, jam kepulangan, dan bukti foto presensi seluruh siswa bimbingan Anda secara real-time.
            </p>
        </div>
        <div class="d-flex align-items-center">
            <span class="badge-date-pill">
                <i class="fas fa-calendar-alt mr-2 text-info"></i> {{ date('d F Y') }}
            </span>
        </div>
    </div>

    {{-- 2. TABEL DAFTAR SISWA BIMBINGAN --}}
    <div class="section-body">
        <div class="card modern-table-card">
            <div class="card-header bg-white py-3 d-flex flex-wrap align-items-center justify-content-between border-bottom">
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <div class="table-header-indicator mr-2"></div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15.5px;">
                        Daftar Siswa Bimbingan Anda
                    </h5>
                    <span class="badge badge-light border text-primary ml-2 px-2 py-1 font-weight-bold" style="border-radius: 20px;">
                        {{ $mahasiswa->count() }} Siswa
                    </span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="customSearchInput" class="form-control form-control-sm modern-search-input" placeholder="Cari nama siswa, sekolah, email...">
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
                                <th>Asal Sekolah SMK</th>
                                <th>Email & Kontak</th>
                                <th class="text-center">Total Presensi</th>
                                <th class="text-center" width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $row)
                                <tr>
                                    {{-- No Urut --}}
                                    <td class="text-center">
                                        <span class="number-badge">{{ $loop->iteration }}</span>
                                    </td>

                                    {{-- Nama Siswa & Avatar --}}
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($row->gambar && file_exists(public_path('gambar/' . $row->gambar)))
                                                <img src="{{ asset('gambar/' . $row->gambar) }}" alt="{{ $row->user->name }}" class="student-avatar-img mr-3">
                                            @else
                                                <div class="student-avatar-fallback mr-3">
                                                    {{ strtoupper(substr($row->user->name ?? 'S', 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <span class="font-weight-bold text-dark" style="font-size: 13.5px; display: block;">
                                                    {{ $row->user->name }}
                                                </span>
                                                @if($row->user->nim)
                                                    <span class="badge-nisn-pill mt-1">
                                                        <i class="fas fa-id-card mr-1"></i> NISN: {{ $row->user->nim }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Asal Sekolah SMK & Jurusan --}}
                                    <td>
                                        <div class="font-weight-600 text-dark" style="font-size: 13px;">
                                            <i class="fas fa-school text-primary mr-1"></i>
                                            {{ $row->universitas ?? $row->asal_sekolah ?? 'SMK Mitra' }}
                                        </div>
                                        @if($row->jurusan)
                                            <div class="mt-1">
                                                <span class="badge-jurusan-pill">
                                                    {{ strtoupper($row->jurusan) }}
                                                </span>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Email & Kontak --}}
                                    <td>
                                        <div class="text-nowrap" style="font-size: 12.5px;">
                                            <i class="fas fa-envelope text-muted mr-1"></i>
                                            <a href="mailto:{{ $row->user->email }}" class="text-secondary font-weight-500">
                                                {{ $row->user->email }}
                                            </a>
                                        </div>
                                        @if($row->user->no_telp)
                                            <div class="text-nowrap mt-1" style="font-size: 12px;">
                                                <i class="fab fa-whatsapp text-success mr-1"></i>
                                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $row->user->no_telp) }}" target="_blank" class="text-dark font-weight-500">
                                                    {{ $row->user->no_telp }}
                                                </a>
                                            </div>
                                        @endif
                                    </td>

                                    {{-- Total Presensi --}}
                                    <td class="text-center">
                                        <span class="badge-presensi-count">
                                            <i class="fas fa-check-double mr-1"></i> {{ $row->user->absensi->count() }} Hari Tercatat
                                        </span>
                                    </td>

                                    {{-- Tombol Aksi --}}
                                    <td class="text-center">
                                        <a href="{{ route('pembimbing.absensi.detail', $row->id_users) }}" class="btn-riwayat-action" title="Lihat Rekap Absensi">
                                            <i class="fas fa-eye mr-1"></i> Lihat Riwayat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <div style="font-size: 40px; color: #cbd5e1; margin-bottom: 12px;">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark mb-1">Belum Ada Siswa Bimbingan</h6>
                                        <p class="text-muted mb-0" style="font-size: 13px;">
                                            Siswa magang SMK yang di-plotting ke Anda akan ditampilkan di sini.
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
