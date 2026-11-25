@extends('template_admin.master_pembimbing')

@section('title', 'Riwayat Absensi - ' . $user->name)

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f8fafc;
    }

    /* 1. STUDENT PROFILE HEADER */
    .student-header-banner {
        background: linear-gradient(135deg, #1e3c72 0%, #0077b6 50%, #3CB9E0 100%);
        border-radius: 20px;
        padding: 26px 30px;
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .student-header-banner::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 150px; height: 150px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        pointer-events: none;
    }
    .btn-back-modern {
        background: rgba(255, 255, 255, 0.18);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff !important;
        border-radius: 30px;
        padding: 7px 18px;
        font-size: 12.5px;
        font-weight: 600;
        backdrop-filter: blur(8px);
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
    }
    .btn-back-modern:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateX(-2px);
    }

    /* 2. TABLE CARD */
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
    .modern-table tbody tr:hover {
        background-color: #f0f9ff !important;
    }

    /* BADGES */
    .number-badge {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        display: inline-flex; align-items: center; justify-content: center;
    }
    .badge-time-in {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11.5px;
    }
    .badge-time-out {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11.5px;
    }
    .badge-status-hadir {
        background: #ecfeff;
        color: #0891b2;
        border: 1px solid #a5f3fc;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 12px;
        font-size: 11.5px;
    }
    .btn-photo-view {
        background: #f8fafc;
        border: 1.5px solid #cbd5e1;
        color: #1e293b !important;
        border-radius: 8px;
        padding: 4px 10px;
        font-size: 11.5px;
        font-weight: 600;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
    }
    .btn-photo-view:hover {
        background: #e0f2fe;
        border-color: #38bdf8;
        color: #0284c7 !important;
    }
</style>

<section class="section">
    {{-- 1. STUDENT HEADER BANNER --}}
    <div class="student-header-banner d-flex flex-wrap justify-content-between align-items-center">
        <div class="d-flex align-items-center mb-3 mb-md-0">
            <div>
                <a href="{{ route('pembimbing.absensi.index') }}" class="btn-back-modern mb-2">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Siswa
                </a>
                <h3 class="font-weight-bold text-white mb-1" style="letter-spacing: -0.5px;">
                    Riwayat Absensi: {{ $user->name }}
                </h3>
                <p class="mb-0 text-white-50" style="font-size: 13px;">
                    {{ $user->email }} @if($user->nim) | NIS/NISN: {{ $user->nim }} @endif
                </p>
            </div>
        </div>
        <div>
            <span class="badge badge-light px-3 py-2 font-weight-bold text-primary" style="border-radius: 30px; font-size: 12.5px;">
                <i class="fas fa-calendar-check mr-1 text-success"></i> Total Hadir: {{ $riwayat->count() }} Hari
            </span>
        </div>
    </div>

    {{-- 2. TABEL LOG KEHADIRAN --}}
    <div class="section-body">
        <div class="card modern-table-card">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
                <div class="d-flex align-items-center">
                    <div class="table-header-indicator mr-2"></div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15.5px;">
                        Log Kehadiran & Foto Presensi
                    </h5>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table modern-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="4%">No</th>
                                <th>Tanggal Absensi</th>
                                <th class="text-center">Jam Masuk</th>
                                <th class="text-center">Jam Pulang</th>
                                <th class="text-center">Bukti Foto</th>
                                <th>Keterangan</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $row)
                                <tr>
                                    <td class="text-center">
                                        <span class="number-badge">{{ $loop->iteration }}</span>
                                    </td>
                                    
                                    <td>
                                        <div class="font-weight-600 text-dark" style="font-size: 13px;">
                                            <i class="far fa-calendar-alt text-primary mr-1"></i>
                                            {{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('l, d F Y') }}
                                        </div>
                                    </td>
                                    
                                    <td class="text-center">
                                        <span class="badge-time-in">
                                            <i class="fas fa-sign-in-alt mr-1"></i> {{ $row->jam_masuk }} WIB
                                        </span>
                                    </td>
                                    
                                    <td class="text-center">
                                        @if($row->jam_keluar)
                                            <span class="badge-time-out">
                                                <i class="fas fa-sign-out-alt mr-1"></i> {{ $row->jam_keluar }} WIB
                                            </span>
                                        @else
                                            <span class="text-muted" style="font-size: 12px;">- Belum Absen Pulang -</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex justify-content-center" style="gap: 6px;">
                                            @if($row->foto_bukti)
                                                <a href="{{ asset($row->foto_bukti) }}" target="_blank" class="btn-photo-view" title="Lihat Foto Masuk">
                                                    <i class="fas fa-camera text-primary mr-1"></i> Masuk
                                                </a>
                                            @endif
                                            
                                            @if($row->foto_keluar)
                                                <a href="{{ asset($row->foto_keluar) }}" target="_blank" class="btn-photo-view" title="Lihat Foto Pulang">
                                                    <i class="fas fa-camera text-info mr-1"></i> Pulang
                                                </a>
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <span class="text-muted" style="font-size: 12.5px;">
                                            {{ $row->keterangan ?? '-' }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge-status-hadir">
                                            <i class="fas fa-check-circle mr-1"></i> Hadir
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <div style="font-size: 40px; color: #cbd5e1; margin-bottom: 12px;">
                                            <i class="fas fa-calendar-times"></i>
                                        </div>
                                        <h6 class="font-weight-bold text-dark mb-1">Belum Ada Data Presensi</h6>
                                        <p class="text-muted mb-0" style="font-size: 13px;">
                                            Siswa belum melakukan absensi harian pada sistem.
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
