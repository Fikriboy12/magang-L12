@extends('template.master') 

@section('title', 'Daftar Laporan Harian')

@section('contents')

{{-- CSS MODERN & HD --}}
<style>
    /* Header Biru "HD" */
    .hd-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        color: white !important;
        padding: 30px;
        border-radius: 15px 15px 0 0;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .hd-header::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }

    .card-modern {
        border: none !important;
        border-radius: 15px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08) !important;
        background: #fff;
        overflow: hidden;
        margin-top: 20px;
    }

    .btn-hd-white {
        background: #ffffff !important;
        color: #2563eb !important;
        font-weight: 700 !important;
        border-radius: 50px !important;
        padding: 10px 25px !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
        transition: all 0.3s ease !important;
    }

    .btn-hd-white:hover {
        background: #f0fdfa !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.2) !important;
    }

    .table-hd thead th {
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.85rem;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 18px !important;
    }

    .table-hd tbody td {
        padding: 15px !important;
        vertical-align: middle !important;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.95rem;
    }

    /* Style Foto Thumbnail */
    .img-thumbnail-custom {
        width: 80px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        cursor: pointer;
        border: 2px solid #e2e8f0;
    }

    .img-thumbnail-custom:hover {
        transform: scale(1.1);
        border-color: #3b82f6;
    }

    .date-pill {
        background: #e0f2fe;
        color: #0369a1;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }
</style>

<div class="content-wrapper" style="background-color: #f8fafc;">
    
    <section class="content pt-5 pb-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                
                <div class="card card-modern">
                    
                    <div class="hd-header d-flex justify-content-between align-items-center">
                        <div style="z-index: 2;">
                            <h3 class="m-0 font-weight-bold" style="font-size: 1.6rem;">Laporan Harian</h3>
                            <p class="m-0 mt-1" style="opacity: 0.9; font-size: 0.95rem;">
                                Rekap aktivitas magang Anda di PT. MEDIA BALAI NUSA astro net
                            </p>
                        </div>
                        
                        <div style="z-index: 2;">
                            <a href="{{ route('mahasiswa.laporan.create') }}" class="btn btn-hd-white">
                                <i class="fas fa-plus mr-2"></i> Tambah Laporan
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        
                        @if (session('success'))
                            <div class="alert alert-success fade show shadow-sm border-0" role="alert" style="background-color: #d1fae5; color: #065f46; border-radius: 10px;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-check-circle mr-2" style="font-size: 1.2rem;"></i>
                                    <strong>Berhasil!</strong> &nbsp; {{ session('success') }}
                                    <button type="button" class="close ml-auto" data-dismiss="alert" aria-label="Close" style="color: #065f46;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <div class="table-responsive mt-3">
                            <table id="example1" class="table table-hd table-hover w-100">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%">No</th>
                                        <th style="width: 20%">Tanggal</th>
                                        <th>Aktivitas / Kegiatan</th>
                                        <th class="text-center" style="width: 15%">Dokumentasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporanList as $laporan)
                                        <tr>
                                            <td class="text-center font-weight-bold text-secondary">{{ $loop->iteration }}</td>
                                            
                                            <td>
                                                <div class="date-pill">
                                                    <i class="far fa-calendar-alt mr-2"></i>
                                                    {{ \Carbon\Carbon::parse($laporan->tanggal)->translatedFormat('d M Y') }}
                                                </div>
                                            </td>
                                            
                                            <td>
                                                <span style="font-weight: 500; color: #334155;">
                                                    {{ Str::limit($laporan->kegiatan, 75) }}
                                                </span>
                                            </td>
                                            
                                            {{-- KOLOM FOTO DIPERBAIKI --}}
                                            <td class="text-center">
                                                @if($laporan->foto)
                                                    @php
                                                        $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                                    @endphp
                                                    
                                                    {{-- TAMPILKAN GAMBAR LANGSUNG (Thumbnail) --}}
                                                    <a href="#" data-toggle="modal" data-target="#modalFoto{{ $laporan->id }}">
                                                        <img src="{{ $fotoUrl }}" alt="Dokumentasi" class="img-thumbnail-custom">
                                                    </a>

                                                    {{-- MODAL PREVIEW BESAR --}}
                                                    <div class="modal fade" id="modalFoto{{ $laporan->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header border-0">
                                                                    <h5 class="modal-title font-weight-bold text-primary">Dokumentasi Kegiatan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body text-center bg-light">
                                                                    <img src="{{ $fotoUrl }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                                                    <p class="mt-3 text-muted font-italic">{{ $laporan->kegiatan }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted small font-italic">Tidak ada</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div style="color: #94a3b8;">
                                                    <i class="fas fa-clipboard-list fa-4x mb-3"></i>
                                                    <h5>Data Kosong</h5>
                                                    <p>Belum ada laporan harian yang dibuat.</p>
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
        </div>
      </div>
    </section>
</div>
@endsection