@extends('template_admin.master_orangtua')

@section('title', 'Dashboard Orang Tua')

@section('contents')

<!-- Font Poppins -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* GLOBAL */
    body, .content-wrapper {
        font-family: 'Poppins', sans-serif !important;
        background-color: #f3f4f6;
    }

    /* --- 1. BANNER ADMIN STYLE (Biru Terang Solid) --- */
    .admin-banner {
        background-color: #3b82f6;
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
        display: flex;
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
        width: 70px; 
        height: 70px;
        border-radius: 10px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-size: 32px;
        color: white;
        margin-right: 20px;
        flex-shrink: 0;
    }

    .bg-indigo { background-color: #6366f1; }
    .bg-cyan   { background-color: #06b6d4; }
    .bg-red    { background-color: #ef4444; }
    .bg-emerald { background-color: #10b981; }

    .stat-content h6 {
        color: #9ca3af;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .stat-content h2 {
        color: #374151;
        font-size: 1.6rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.2;
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
        display: flex; 
        justify-content: space-between;
        align-items: center;
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

    .avatar-box {
        width: 48px; 
        height: 48px;
        background-color: #eff6ff;
        color: #3b82f6;
        border-radius: 10px;
        display: flex; 
        align-items: center; 
        justify-content: center;
        font-weight: 700;
        font-size: 1.3rem;
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

    /* Profil Box Card */
    .child-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        padding: 25px;
        border-left: 5px solid #3b82f6;
        margin-bottom: 25px;
    }
</style>

<div class="content-wrapper">
    <section class="content pt-4 pb-5">
      <div class="container-fluid">
        
        {{-- 1. BANNER SEPERTI ADMIN (Biru Terang Solid) --}}
        <div class="row">
            <div class="col-12">
                <div class="admin-banner">
                    <h1 class="banner-title">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="banner-subtitle">
                        Sistem Monitoring Siswa Magang - PT. MEDIA BALAI NUSA astro net
                    </p>
                </div>
            </div>
        </div>

        @if(!$anak)
        <div class="alert alert-warning shadow-sm border-0 rounded-lg p-4 mb-4">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-triangle fa-2x text-warning mr-3"></i>
                <div>
                    <h5 class="font-weight-bold mb-1">Akun Belum Terhubung dengan Siswa</h5>
                    <p class="mb-0 text-muted">Akun Orang Tua ini belum ditautkan dengan data siswa magang manapun. Silakan hubungi Administrator untuk menghubungkan akun Anda dengan anak Anda.</p>
                </div>
            </div>
        </div>
        @else

        {{-- 2. KARTU STATISTIK (Style Kotak Ikon di Kiri) --}}
        <div class="row mb-4">
            
            {{-- Card 1: Nama Anak (Warna Indigo/Ungu - Ikon Siswa) --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="admin-stat-card">
                    <div class="icon-square bg-indigo">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div class="stat-content">
                        <h6>Siswa Binaan</h6>
                        <h2 style="font-size: 1.3rem;">{{ $anak->name }}</h2>
                        <small class="text-muted">{{ $anak->email }}</small>
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
                        <h2>{{ $totalLaporan }}</h2>
                        <small class="text-success"><i class="fas fa-check"></i> {{ $laporanDisetujui }} Disetujui</small>
                    </div>
                </div>
            </div>

            {{-- Card 3: Kehadiran Absensi (Warna Merah / Jam) --}}
            <div class="col-lg-4 col-md-6 col-12 mb-3">
                <div class="admin-stat-card">
                    <div class="icon-square bg-red">
                        <i class="far fa-clock"></i> 
                    </div>
                    <div class="stat-content">
                        <h6>Total Hadir / Absensi</h6>
                        <h2>{{ $totalHadir }} Hari</h2>
                        <small class="text-warning"><i class="fas fa-hourglass-half"></i> {{ $laporanPending }} Laporan Pending</small>
                    </div>
                </div>
            </div>

        </div>

        {{-- INFO PROFIL SISWA & PEMBIMBING --}}
        <div class="row">
            <div class="col-12">
                <div class="child-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <div class="d-flex align-items-center">
                                <div class="avatar-box">
                                    {{ substr($anak->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="mb-1 font-weight-bold" style="color: #1f2937;">{{ $anak->name }}</h4>
                                    <div class="text-muted" style="font-size: 0.95rem;">
                                        <span class="mr-3"><i class="fas fa-school text-primary mr-1"></i> {{ $anak->pendaftaran->universitas ?? 'SMK / Instansi Pendidikan' }}</span>
                                        <span class="mr-3"><i class="fas fa-book-reader text-info mr-1"></i> {{ $anak->pendaftaran->jurusan ?? 'Jurusan' }}</span>
                                    </div>
                                    <div class="mt-2 text-secondary" style="font-size: 0.9rem;">
                                        <i class="fas fa-chalkboard-teacher text-success mr-1"></i> Pembimbing Lapangan: 
                                        <strong>{{ $anak->pembimbing->name ?? 'Belum Ditentukan' }}</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-right mt-3 mt-md-0">
                            <a href="{{ route('orangtua.laporan.index') }}" class="btn btn-primary px-3 py-2 mr-2 mb-2" style="border-radius: 8px;">
                                <i class="fas fa-file-alt mr-1"></i> Seluruh Laporan
                            </a>
                            <a href="{{ route('orangtua.absensi.index') }}" class="btn btn-info px-3 py-2 mb-2" style="border-radius: 8px;">
                                <i class="fas fa-user-clock mr-1"></i> Riwayat Absensi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. TABEL RINGKASAN LAPORAN TERAKHIR --}}
        <div class="row">
            <div class="col-12">
                <div class="card-table">
                    <div class="table-header">
                        <h5 class="m-0 font-weight-bold" style="color: #374151; font-size: 1.1rem;">
                            <i class="fas fa-list text-primary mr-2"></i> Laporan Kegiatan Terbaru
                        </h5>
                        <a href="{{ route('orangtua.laporan.index') }}" class="btn btn-sm btn-outline-primary">
                            Lihat Semua Laporan <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="custom-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="18%">Tanggal</th>
                                    <th width="45%">Kegiatan</th>
                                    <th class="text-center" width="17%">Status Validasi</th>
                                    <th class="text-center" width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanList as $item)
                                <tr>
                                    <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}</strong>
                                    </td>
                                    <td>
                                        <span style="font-weight: 500; color: #1f2937;">{{ Str::limit($item->kegiatan, 80) }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if($item->status == 'approved')
                                            <span class="badge badge-success px-3 py-1" style="border-radius: 20px;">
                                                <i class="fas fa-check-circle mr-1"></i> Disetujui
                                            </span>
                                        @elseif($item->status == 'rejected')
                                            <span class="badge badge-danger px-3 py-1" style="border-radius: 20px;">
                                                <i class="fas fa-times-circle mr-1"></i> Ditolak
                                            </span>
                                        @else
                                            <span class="badge badge-warning text-white px-3 py-1" style="border-radius: 20px;">
                                                <i class="fas fa-clock mr-1"></i> Menunggu ACC
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('orangtua.laporan.index') }}" class="btn-detail">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-folder-open fa-3x mb-3" style="opacity: 0.3;"></i>
                                        <p>Belum ada laporan harian yang diisi oleh siswa.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- 4. TABEL RINGKASAN ABSENSI TERBARU --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card-table">
                    <div class="table-header">
                        <h5 class="m-0 font-weight-bold" style="color: #374151; font-size: 1.1rem;">
                            <i class="fas fa-calendar-check text-success mr-2"></i> Riwayat Absensi Terbaru
                        </h5>
                        <a href="{{ route('orangtua.absensi.index') }}" class="btn btn-sm btn-outline-success">
                            Lihat Semua Absensi <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="custom-table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th width="25%">Tanggal</th>
                                    <th class="text-center" width="20%">Jam Masuk</th>
                                    <th class="text-center" width="20%">Jam Pulang</th>
                                    <th class="text-center" width="30%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensiTerbaru as $absen)
                                <tr>
                                    <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($absen->tgl_absen)->translatedFormat('d F Y') }}</strong>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-success px-2 py-1">{{ $absen->jam_masuk }} WIB</span>
                                    </td>
                                    <td class="text-center">
                                        @if($absen->jam_keluar)
                                            <span class="badge badge-warning px-2 py-1">{{ $absen->jam_keluar }} WIB</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-info px-3 py-1" style="border-radius: 20px;">
                                            <i class="fas fa-check mr-1"></i> Hadir
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-calendar-times fa-3x mb-3" style="opacity: 0.3;"></i>
                                        <p>Belum ada data riwayat absensi siswa.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @endif

      </div>
    </section>
</div>
@endsection
