@extends('template.master') 

@section('title', 'Data Laporan Harian')

@section('contents')

<!-- Font Google Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .laporan-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 110px;
        padding-bottom: 70px;
    }

    /* Header Card */
    .laporan-header-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 30px 35px;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
        margin-bottom: 25px;
        position: relative;
        overflow: hidden;
    }
    .laporan-header-card h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 24px;
        margin-bottom: 6px;
    }
    .laporan-header-card p {
        color: #dbeafe;
        font-size: 14px;
        margin: 0;
        opacity: 0.95;
    }

    /* Info Banner APK */
    .banner-apk-info {
        background: #ffffff;
        border: 1px solid #bfdbfe;
        border-left: 5px solid #2563eb;
        border-radius: 14px;
        padding: 18px 22px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    /* Stat Cards */
    .stat-card-laporan {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        transition: 0.2s;
    }
    .stat-card-laporan:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
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
    .stat-icon.blue { background: #eff6ff; color: #2563eb; }
    .stat-icon.green { background: #ecfdf5; color: #10b981; }
    .stat-icon.yellow { background: #fffbeb; color: #f59e0b; }
    .stat-icon.red { background: #fef2f2; color: #ef4444; }

    /* Table Card */
    .card-table-laporan {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    .card-table-header {
        padding: 20px 25px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
    }
    .card-table-header h5 {
        margin: 0;
        font-weight: 700;
        font-size: 17px;
        color: #0f172a;
    }

    .table-laporan th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        padding: 14px 20px;
        vertical-align: middle;
    }
    .table-laporan td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }
    .table-laporan tr:hover {
        background-color: #f8fafc;
    }

    /* Thumbnail Foto */
    .img-thumb-laporan {
        width: 75px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .img-thumb-laporan:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .badge-status-laporan {
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .badge-approved { background: #d1fae5; color: #065f46; }
    .badge-pending { background: #fef3c7; color: #92400e; }
    .badge-rejected { background: #fee2e2; color: #991b1b; }
</style>

<div class="laporan-page">
    <div class="container">
        
        {{-- HEADER BANNER --}}
        <div class="laporan-header-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h2><i class="fa-solid fa-file-lines mr-2"></i> Data Laporan Harian</h2>
                    <p>Rekapitulasi riwayat aktivitas dan kegiatan magang Anda yang disinkronkan dari Aplikasi Mobile</p>
                </div>
                <div>
                    @if(Route::has('mahasiswa.laporan.pdf'))
                        <a href="{{ route('mahasiswa.laporan.pdf') }}" target="_blank" class="btn btn-light px-3 py-2" style="border-radius: 50px; font-weight: 700; font-size: 13px; color: #1e3a8a;">
                            <i class="fa-solid fa-file-pdf text-danger mr-1"></i> Cetak / Unduh PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>

        {{-- INFORMASI PENGISIAN VIA APK MOBILE --}}
        <div class="banner-apk-info d-flex align-items-center">
            <div class="mr-3 text-primary" style="font-size: 32px;">
                <i class="fa-solid fa-mobile-screen-button"></i>
            </div>
            <div>
                <strong class="text-primary d-block font-weight-bold" style="font-size: 15px;">
                    Informasi Pengisian Laporan Harian
                </strong>
                <span class="text-muted small">
                    Pengunggahan foto dokumentasi dan pengisian aktivitas harian dilakukan melalui <strong>Aplikasi Mobile Magang (APK)</strong>. Halaman website ini berfungsi sebagai pusat monitoring untuk melihat data rekapitulasi serta status persetujuan dari Guru Pembimbing.
                </span>
            </div>
        </div>

        {{-- RINGKASAN STATISTIK --}}
        @php
            $totalLaporan = $laporan->count();
            $approvedLaporan = $laporan->where('status', 'approved')->count();
            $pendingLaporan = $laporan->where('status', 'pending')->count();
            $rejectedLaporan = $laporan->where('status', 'rejected')->count();
        @endphp

        <div class="row">
            <div class="col-md-3 col-6">
                <div class="stat-card-laporan">
                    <div class="stat-icon blue"><i class="fa-solid fa-list-check"></i></div>
                    <div>
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Total Laporan</small>
                        <h4 class="m-0 font-weight-bold text-dark">{{ $totalLaporan }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card-laporan">
                    <div class="stat-icon green"><i class="fa-solid fa-circle-check"></i></div>
                    <div>
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Disetujui</small>
                        <h4 class="m-0 font-weight-bold text-success">{{ $approvedLaporan }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card-laporan">
                    <div class="stat-icon yellow"><i class="fa-solid fa-clock"></i></div>
                    <div>
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Menunggu ACC</small>
                        <h4 class="m-0 font-weight-bold text-warning">{{ $pendingLaporan }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card-laporan">
                    <div class="stat-icon red"><i class="fa-solid fa-circle-xmark"></i></div>
                    <div>
                        <small class="text-muted text-uppercase font-weight-bold" style="font-size: 11px;">Ditolak / Revisi</small>
                        <h4 class="m-0 font-weight-bold text-danger">{{ $rejectedLaporan }}</h4>
                    </div>
                </div>
            </div>
        </div>

        {{-- TABEL REKAPITULASI LAPORAN --}}
        <div class="card-table-laporan">
            <div class="card-table-header">
                <h5><i class="fa-solid fa-table-list text-primary mr-2"></i> Rekapitulasi Data Laporan Harian</h5>
                <span class="badge badge-light text-muted px-3 py-2 border font-weight-bold" style="border-radius: 50px;">
                    <i class="fa-solid fa-sync-alt mr-1"></i> Data Real-Time APK
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-laporan mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th style="width: 170px;">Tanggal Kegiatan</th>
                            <th>Uraian Aktivitas Magang</th>
                            <th class="text-center" style="width: 130px;">Dokumentasi</th>
                            <th class="text-center" style="width: 150px;">Status Validasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($laporan as $item)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                
                                <td>
                                    <div class="font-weight-bold text-dark">
                                        <i class="fa-regular fa-calendar text-primary mr-1"></i>
                                        {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                    </div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('l') }}</small>
                                </td>
                                
                                <td>
                                    <div class="font-weight-bold text-dark" style="line-height: 1.6;">
                                        {{ $item->kegiatan }}
                                    </div>
                                    @if($item->catatan)
                                        <div class="mt-2 p-2 rounded bg-light border-left" style="border-left: 3px solid #f59e0b !important;">
                                            <small class="text-danger font-weight-bold d-block">
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
                                        
                                        <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}" title="Klik untuk memperbesar">
                                            <img src="{{ $fotoUrl }}" alt="Dokumentasi" class="img-thumb-laporan">
                                        </a>

                                        {{-- MODAL PREVIEW FOTO --}}
                                        <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content bg-transparent border-0 shadow-none">
                                                    <div class="modal-body text-center p-0">
                                                        <button type="button" class="close text-white mb-2" data-dismiss="modal" style="opacity: 1; text-shadow: 0 1px 5px black; font-size: 32px;">&times;</button>
                                                        <img src="{{ $fotoUrl }}" class="img-fluid rounded shadow-lg" style="max-height: 85vh;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="badge badge-light text-muted border">Tanpa Foto</span>
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
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted" style="font-size: 42px; opacity: 0.3;">
                                        <i class="fa-solid fa-clipboard-list"></i>
                                    </div>
                                    <h6 class="mt-3 font-weight-bold text-dark">Belum Ada Data Laporan Harian</h6>
                                    <p class="text-muted small mb-0">Laporan harian yang Anda kirim melalui <strong>Aplikasi Mobile (APK)</strong> akan otomatis tampil di sini.</p>
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