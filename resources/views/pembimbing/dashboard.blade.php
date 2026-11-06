@extends('template_admin.master_pembimbing')

@section('title', 'Dashboard Guru Pembimbing')

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* GLOBAL */
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f3f4f6; /* Background abu-abu muda bersih */
    }

    /* --- 1. BANNER ADMIN STYLE (Biru Terang Solid) --- */
    .admin-banner {
        background-color: #3b82f6; /* Warna Biru Terang (Royal Blue) */
        color: white;
        padding: 40px 30px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.3);
        margin-bottom: 30px;
    }

    .banner-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .banner-subtitle {
        font-size: 1.1rem;
        font-weight: 400;
        opacity: 0.9;
    }

    /* --- 2. STAT CARDS (Gaya Kotak Ikon di Kiri) --- */
    .admin-stat-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        display: flex; /* Menyusun Ikon dan Teks bersebelahan */
        align-items: center;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        border: none;
        height: 100%;
        transition: transform 0.2s;
    }

    .admin-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    }

    /* Kotak Ikon Berwarna */
    .icon-square {
        width: 70px; height: 70px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 32px;
        color: white;
        margin-right: 20px; /* Jarak antara ikon dan teks */
        flex-shrink: 0;
    }

    /* Warna-warna Ikon sesuai referensi */
    .bg-indigo { background-color: #6366f1; } /* Warna Ungu Kebiruan */
    .bg-cyan   { background-color: #06b6d4; } /* Warna Biru Langit */
    .bg-red    { background-color: #ef4444; } /* Warna Merah */

    .stat-content h6 {
        color: #9ca3af; /* Abu-abu label */
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .stat-content h2 {
        color: #374151; /* Abu-abu gelap angka */
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        line-height: 1;
    }

    /* --- 3. TABEL STYLE --- */
    .card-table {
        background: white;
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        margin-top: 20px;
        overflow: hidden;
    }

    .table-header {
        padding: 20px 25px;
        border-bottom: 1px solid #f3f4f6;
        display: flex; align-items: center;
    }

    .custom-table th {
        background-color: #f9fafb;
        color: #6b7280;
        font-weight: 600;
        border: none;
        padding: 15px 25px;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .custom-table td {
        padding: 15px 25px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f4f6;
        color: #4b5563;
        font-size: 0.95rem;
    }

    /* Avatar Kotak Biru Muda */
    .avatar-box {
        width: 40px; height: 40px;
        background-color: #eff6ff;
        color: #3b82f6;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700;
        font-size: 1.1rem;
        margin-right: 15px;
    }

    .btn-detail {
        background-color: #eff6ff;
        color: #3b82f6;
        padding: 6px 18px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        border: 1px solid transparent;
        transition: 0.2s;
    }
    .btn-detail:hover {
        background-color: #3b82f6;
        color: white;
        text-decoration: none;
    }
</style>

<div class="content-wrapper">
    <section class="content pt-4 pb-5">
      <div class="container-fluid">
        
        {{-- 1. BANNER SEPERTI ADMIN (Biru Terang Solid) --}}
        <div class="row">
            <div class="col-12">
                <div class="admin-banner">
                    <h1 class="banner-title">Selamat Datang, Guru Pembimbing!</h1>
                    <p class="banner-subtitle">
                        Sistem Informasi Magang - PT. MEDIA BALAI NUSA astro net
                    </p>
                </div>
            </div>
        </div>

        {{-- 2. KARTU STATISTIK (Style Kotak Ikon di Kiri) --}}
        <div class="row mb-4">
            
            {{-- Card 1: Mahasiswa (Warna Indigo/Ungu - Ikon User) --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="admin-stat-card">
                    <div class="icon-square bg-indigo">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="stat-content">
                        <h6>Data Siswa Bimbingan</h6>
                        <h2>{{ $mahasiswaList->count() }}</h2>
                    </div>
                </div>
            </div>

            {{-- Card 2: Total Laporan (Warna Cyan/Biru Langit - Ikon Ceklis) --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="admin-stat-card">
                    <div class="icon-square bg-cyan">
                        <i class="far fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h6>Total Laporan</h6>
                        <h2>{{ $mahasiswaList->flatMap->laporanHarian->count() }}</h2>
                    </div>
                </div>
            </div>

            {{-- Card 3: Menunggu ACC (Warna Merah - Ikon Silang/Jam) --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="admin-stat-card">
                    <div class="icon-square bg-red">
                        <i class="far fa-clock"></i> 
                    </div>
                    <div class="stat-content">
                        <h6>Menunggu Acc</h6>
                        <h2>{{ $mahasiswaList->flatMap->laporanHarian->where('status', 'pending')->count() }}</h2>
                    </div>
                </div>
            </div>

        </div>

        {{-- 3. DAFTAR MAHASISWA --}}
        <div class="row">
            <div class="col-12">
                <div class="card-table">
                    <div class="table-header">
                        <h5 class="m-0 font-weight-bold" style="color: #374151; font-size: 1.1rem;">
                            <i class="fas fa-list text-primary mr-2"></i> Daftar Siswa Bimbingan
                        </h5>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="custom-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="35%">Nama Siswa</th>
                                    <th width="30%">Email</th>
                                    <th class="text-center">Status Laporan</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($mahasiswaList as $mhs)
                                <tr>
                                    <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{-- Avatar Inisial Kotak --}}
                                            <div class="avatar-box">
                                                {{ substr($mhs->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <span style="font-weight: 600; display: block; color: #1f2937;">{{ $mhs->name }}</span>
                                                <span style="font-size: 0.8rem; color: #9ca3af;">NIS/NISN: {{ $mhs->nim ?? '-' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $mhs->email }}</td>
                                    
                                    <td class="text-center">
                                        @php
                                            $pendingCount = $mhs->laporanHarian->where('status', 'pending')->count();
                                        @endphp
                                        
                                        @if($pendingCount > 0)
                                            <span class="badge badge-warning text-white px-3 py-1" style="border-radius: 20px;">
                                                {{ $pendingCount }} Pending
                                            </span>
                                        @else
                                            <i class="fas fa-check-circle text-success" style="font-size: 1.3rem;"></i>
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                        <a href="{{ route('pembimbing.laporan.mahasiswa', $mhs->id) }}" class="btn-detail">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3" style="opacity: 0.3;"></i>
                                        <p>Belum ada siswa yang dibimbing.</p>
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
    </section>
</div>
@endsection