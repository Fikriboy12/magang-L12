@extends('template_admin.master_pembimbing')

@section('title', 'Detail Laporan Siswa - ' . $mahasiswa->name)

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f8fafc;
    }

    /* 1. STUDENT LOGBOOK HEADER BANNER */
    .logbook-header-banner {
        background: linear-gradient(135deg, #1e3c72 0%, #0077b6 50%, #3CB9E0 100%);
        border-radius: 20px;
        padding: 26px 30px;
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.2);
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }
    .logbook-header-banner::before {
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
        padding: 6px 16px;
        font-size: 12px;
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
    .btn-pdf-print {
        background: #ffffff !important;
        color: #1e3c72 !important;
        font-weight: 700 !important;
        font-size: 12.5px !important;
        border-radius: 30px !important;
        padding: 8px 18px !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
        display: inline-flex;
        align-items: center;
        transition: all 0.2s ease;
        text-decoration: none !important;
    }
    .btn-pdf-print:hover {
        background: #f8fafc !important;
        transform: translateY(-2px);
        color: #0284c7 !important;
    }

    /* 2. STAT PILLS */
    .stat-pill-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .stat-pill {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 10px 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .stat-pill-num {
        font-size: 16px;
        font-weight: 800;
    }
    .stat-pill-label {
        font-size: 11.5px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
    }

    /* 3. TABLE CARD */
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
    .badge-approved {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #86efac;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11.5px;
    }
    .badge-pending {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11.5px;
    }
    .badge-rejected {
        background: #ffe4e6;
        color: #e11d48;
        border: 1px solid #fecdd3;
        font-weight: 700;
        border-radius: 20px;
        padding: 4px 10px;
        font-size: 11.5px;
    }
    .photo-thumb-wrap img {
        width: 60px; height: 60px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e2e8f0;
        transition: transform 0.2s;
    }
    .photo-thumb-wrap img:hover {
        transform: scale(1.05);
        border-color: #38bdf8;
    }

    /* ACTION BUTTONS */
    .btn-acc {
        background: #dcfce7 !important;
        border: 1px solid #86efac !important;
        color: #15803d !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        padding: 5px 10px !important;
    }
    .btn-acc:hover {
        background: #15803d !important;
        color: #ffffff !important;
    }
    .btn-tolak {
        background: #ffe4e6 !important;
        border: 1px solid #fecdd3 !important;
        color: #e11d48 !important;
        border-radius: 8px !important;
        font-weight: 700 !important;
        padding: 5px 10px !important;
    }
    .btn-tolak:hover {
        background: #e11d48 !important;
        color: #ffffff !important;
    }
</style>

<section class="section">
    {{-- NOTIFIKASI SUKSES / ERROR --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible show fade shadow-sm mb-3" role="alert" style="border-radius: 12px; background: #dcfce7; border: 1px solid #86efac; color: #15803d;">
                <div class="d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-check-circle mr-2"></i> <strong>Sukses!</strong> {{ session('success') }}</div>
                    <button class="close text-success" data-dismiss="alert"><span>&times;</span></button>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible show fade shadow-sm mb-3" role="alert" style="border-radius: 12px;">
                <div class="d-flex align-items-center justify-content-between">
                    <div><i class="fas fa-exclamation-circle mr-2"></i> <strong>Pemberitahuan:</strong> {{ session('error') }}</div>
                    <button class="close" data-dismiss="alert"><span>&times;</span></button>
                </div>
            </div>
        @endif

        {{-- 1. LOGBOOK HEADER BANNER --}}
        <div class="logbook-header-banner d-flex flex-wrap justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">
                <a href="{{ route('pembimbing.dashboard') }}" class="btn-back-modern mb-2">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
                </a>
                <h3 class="font-weight-bold text-white mb-1" style="letter-spacing: -0.5px;">
                    Logbook Laporan Harian: {{ $mahasiswa->name }}
                </h3>
                <p class="mb-0 text-white-50" style="font-size: 13px;">
                    {{ $mahasiswa->email }} @if($mahasiswa->nim) | NIS/NISN: {{ $mahasiswa->nim }} @endif
                </p>
            </div>
            <div>
                <a href="{{ route('pembimbing.laporan.mahasiswa.pdf', $mahasiswa->id) }}" target="_blank" class="btn-pdf-print">
                    <i class="fas fa-file-pdf text-danger mr-2"></i> Cetak Rekap PDF
                </a>
            </div>
        </div>

        {{-- 2. STAT PILLS RINGKASAN --}}
        <div class="stat-pill-group">
            <div class="stat-pill">
                <i class="fas fa-file-alt text-primary"></i>
                <div>
                    <span class="stat-pill-label">Total Laporan:</span>
                    <span class="stat-pill-num text-primary ml-1">{{ $laporan->count() }}</span>
                </div>
            </div>
            <div class="stat-pill">
                <i class="fas fa-check-circle text-success"></i>
                <div>
                    <span class="stat-pill-label">Disetujui:</span>
                    <span class="stat-pill-num text-success ml-1">{{ $laporan->where('status', 'approved')->count() }}</span>
                </div>
            </div>
            <div class="stat-pill">
                <i class="fas fa-hourglass-half text-warning"></i>
                <div>
                    <span class="stat-pill-label">Menunggu ACC:</span>
                    <span class="stat-pill-num text-warning ml-1">{{ $laporan->where('status', 'pending')->count() }}</span>
                </div>
            </div>
            <div class="stat-pill">
                <i class="fas fa-times-circle text-danger"></i>
                <div>
                    <span class="stat-pill-label">Ditolak:</span>
                    <span class="stat-pill-num text-danger ml-1">{{ $laporan->where('status', 'rejected')->count() }}</span>
                </div>
            </div>
        </div>

        {{-- 3. MODERN TABLE CARD --}}
        <div class="card modern-table-card">
            <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
                <div class="d-flex align-items-center">
                    <div class="table-header-indicator mr-2"></div>
                    <h5 class="font-weight-bold text-dark mb-0" style="font-size: 15.5px;">
                        Daftar Catatan Kegiatan Harian
                    </h5>
                </div>
            </div>

            <div class="card-body p-0">
                @if ($laporan->isEmpty())
                    {{-- EMPTY STATE MODERN (BUKAN ORANGE KASAR) --}}
                    <div class="text-center py-5">
                        <div style="font-size: 46px; color: #cbd5e1; margin-bottom: 12px;">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h6 class="font-weight-bold text-dark mb-1">Belum Ada Laporan Harian</h6>
                        <p class="text-muted mb-0" style="font-size: 13.5px;">
                            Siswa <strong>{{ $mahasiswa->name }}</strong> belum mengunggah catatan kegiatan harian magang.
                        </p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table modern-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="4%">No</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan yang Dilakukan</th>
                                    <th>Catatan / Evaluasi Siswa</th>
                                    <th class="text-center">Foto Dokumentasi</th>
                                    <th class="text-center">Status ACC</th>
                                    <th class="text-center" width="12%">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($laporan as $item)
                                    <tr>
                                        {{-- No --}}
                                        <td class="text-center">
                                            <span class="number-badge">{{ $loop->iteration }}</span>
                                        </td>

                                        {{-- Tanggal --}}
                                        <td>
                                            <div class="font-weight-600 text-dark" style="font-size: 13px;">
                                                <i class="far fa-calendar-alt text-primary mr-1"></i>
                                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                            </div>
                                        </td>

                                        {{-- Kegiatan --}}
                                        <td>
                                            <span class="font-weight-500 text-dark" style="font-size: 13px;">
                                                {{ $item->kegiatan }}
                                            </span>
                                        </td>

                                        {{-- Catatan --}}
                                        <td>
                                            @if($item->catatan)
                                                <span class="text-muted" style="font-size: 12.5px;">{{ $item->catatan }}</span>
                                            @else
                                                <span class="text-muted font-italic" style="font-size: 12px;">- Tidak ada catatan -</span>
                                            @endif
                                        </td>

                                        {{-- Foto Dokumentasi --}}
                                        <td class="text-center">
                                            @if(!empty($item->foto))
                                                @php
                                                    $pathFoto = $item->foto;
                                                    if (!str_contains($pathFoto, 'laporan_harian')) {
                                                        $pathFoto = 'laporan_harian/' . $pathFoto;
                                                    }
                                                    $fotoUrl = asset($pathFoto);
                                                @endphp
                                                <div class="photo-thumb-wrap">
                                                    <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}" title="Klik untuk memperbesar">
                                                        <img src="{{ $fotoUrl }}" alt="Dokumentasi">
                                                    </a>
                                                </div>

                                                {{-- Modal Preview Foto --}}
                                                <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                        <div class="modal-content" style="border-radius: 16px; overflow: hidden;">
                                                            <div class="modal-header border-0 pb-0">
                                                                <h6 class="modal-title font-weight-bold">Dokumentasi: {{ $item->kegiatan }}</h6>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                                            </div>
                                                            <div class="modal-body text-center p-4">
                                                                <img src="{{ $fotoUrl }}" class="img-fluid rounded" style="max-height: 75vh; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted" style="font-size: 12px;">-</span>
                                            @endif
                                        </td>

                                        {{-- Status ACC --}}
                                        <td class="text-center">
                                            @if($item->status == 'approved')
                                                <span class="badge-approved">
                                                    <i class="fas fa-check mr-1"></i> Disetujui
                                                </span>
                                            @elseif($item->status == 'rejected')
                                                <span class="badge-rejected">
                                                    <i class="fas fa-times mr-1"></i> Ditolak
                                                </span>
                                            @else
                                                <span class="badge-pending">
                                                    <i class="fas fa-hourglass-half mr-1"></i> Menunggu
                                                </span>
                                            @endif
                                        </td>

                                        {{-- Tindakan Guru Pembimbing --}}
                                        <td class="text-center">
                                            @if($item->status == 'pending')
                                                <div class="d-flex justify-content-center" style="gap: 6px;">
                                                    <form action="{{ route('pembimbing.laporan.approve', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-acc btn-sm" onclick="return confirm('Setujui laporan ini?')" title="Setujui (ACC)">
                                                            <i class="fas fa-check mr-1"></i> ACC
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('pembimbing.laporan.reject', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-tolak btn-sm" onclick="return confirm('Tolak laporan ini?')" title="Tolak Laporan">
                                                            <i class="fas fa-times mr-1"></i> Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="text-muted font-weight-600" style="font-size: 12px;">
                                                    <i class="fas fa-lock mr-1"></i> Selesai
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
</section>

@endsection
