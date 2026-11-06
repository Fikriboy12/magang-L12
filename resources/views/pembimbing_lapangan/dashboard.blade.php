@extends('template_admin.master_pembimbing_lapangan')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Pembimbing Lapangan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ route('pembimbing_lapangan.dashboard') }}">Dashboard</a></div>
            <div class="breadcrumb-item">Utama</div>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert"><span>&times;</span></button>
                <i class="fas fa-exclamation-triangle mr-1"></i> {{ session('error') }}
            </div>
        </div>
    @endif

    {{-- Banner Selamat Datang --}}
    <div class="card mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #0d47a1 0%, #1976d2 100%); color: white; border-radius: 14px;">
        <div class="card-body p-4 d-flex flex-column flex-md-row align-items-center justify-content-between">
            <div class="mb-3 mb-md-0">
                <h4 class="font-weight-bold mb-1">
                    <i class="fas fa-handshake mr-2"></i> Selamat Datang, {{ $mentor->name }}!
                </h4>
                <p class="mb-0 text-white-50" style="font-size: 15px;">
                    Portal Pengawasan Magang Industri Siswa SMK &mdash; PT. Media Balai Nusa. Kelola absensi, ACC izin, laporan kegiatan, dan verifikasi sertifikat.
                </p>
            </div>
            <div class="d-flex">
                <a href="{{ route('pembimbing_lapangan.izin.index') }}" class="btn btn-warning font-weight-bold mr-2 shadow-sm text-dark">
                    <i class="fas fa-clipboard-check mr-1"></i> Periksa Izin ({{ $pendingIzin }})
                </a>
                <a href="{{ route('pembimbing_lapangan.chat.index') }}" class="btn btn-light font-weight-bold shadow-sm text-primary">
                    <i class="fas fa-comments mr-1"></i> Buka Chat
                </a>
            </div>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row">
        {{-- Card 1: Siswa Bimbingan --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-primary text-white">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Siswa Bimbingan</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalSiswa }} <small class="text-muted" style="font-size: 13px;">Siswa</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 2: Laporan Menunggu ACC --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-warning text-white">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Laporan Butuh ACC</h4>
                    </div>
                    <div class="card-body">
                        {{ $pendingLaporan }} <small class="text-muted" style="font-size: 13px;">Laporan</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 3: Izin Butuh ACC --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-danger text-white">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Izin Butuh ACC</h4>
                    </div>
                    <div class="card-body">
                        {{ $pendingIzin }} <small class="text-muted" style="font-size: 13px;">Pengajuan</small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card 4: Pengajuan Sertifikat --}}
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 shadow-sm">
                <div class="card-icon bg-success text-white">
                    <i class="fas fa-award"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengajuan Sertifikat</h4>
                    </div>
                    <div class="card-body">
                        {{ $pengajuanSertifikat }} <small class="text-muted" style="font-size: 13px;">Berkas</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Konten: Presensi Hari Ini & Laporan Terbaru --}}
    <div class="row">
        {{-- Kolom Kiri: Presensi Siswa Hari Ini --}}
        <div class="col-lg-6 col-md-12 col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-clock text-primary mr-2"></i> Presensi Hari Ini
                    </h5>
                    <div>
                        <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> {{ $hadirToday }} Hadir</span>
                        <span class="badge badge-warning px-2 py-1 ml-1"><i class="fas fa-envelope-open mr-1"></i> {{ $izinToday }} Izin/Sakit</span>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Nama Siswa</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($absensiTerbaru as $absen)
                                    <tr>
                                        <td>
                                            <div class="font-weight-600 text-dark">{{ $absen->user->name ?? 'Siswa' }}</div>
                                            <small class="text-muted">{{ $absen->user->email ?? '' }}</small>
                                        </td>
                                        <td>{{ $absen->jam_masuk ? substr($absen->jam_masuk, 0, 5) : '-' }}</td>
                                        <td>{{ $absen->jam_keluar ? substr($absen->jam_keluar, 0, 5) : '-' }}</td>
                                        <td>
                                            @if($absen->status === 'Hadir')
                                                <span class="badge badge-success">Hadir</span>
                                            @elseif($absen->status === 'Izin')
                                                <span class="badge badge-warning">Izin</span>
                                            @elseif($absen->status === 'Sakit')
                                                <span class="badge badge-info">Sakit</span>
                                            @else
                                                <span class="badge badge-danger">Alfa</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-info-circle mb-1 d-block"></i> Belum ada presensi siswa untuk hari ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light text-right py-2">
                    <a href="{{ route('pembimbing_lapangan.absensi.index') }}" class="btn btn-sm btn-primary">
                        Lihat Seluruh Absensi <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Laporan Kegiatan Butuh ACC --}}
        <div class="col-lg-6 col-md-12 col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 font-weight-bold text-dark">
                        <i class="fas fa-tasks text-warning mr-2"></i> Laporan Kegiatan Menunggu ACC
                    </h5>
                    <span class="badge badge-warning font-weight-bold">{{ $pendingLaporan }} Menunggu</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Siswa & Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th class="text-center">Aksi Cepat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($laporanTerbaru as $lap)
                                    <tr>
                                        <td>
                                            <div class="font-weight-600 text-dark">{{ $lap->user->name ?? 'Siswa' }}</div>
                                            <small class="text-muted"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($lap->tanggal)->translatedFormat('d M Y') }}</small>
                                        </td>
                                        <td>
                                            <div style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $lap->kegiatan }}
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('pembimbing_lapangan.laporan.approve', $lap->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="ACC Laporan">
                                                    <i class="fas fa-check"></i> ACC
                                                </button>
                                            </form>
                                            <a href="{{ route('pembimbing_lapangan.laporan.siswa', $lap->user_id) }}" class="btn btn-sm btn-info" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            <i class="fas fa-check-circle text-success mb-1 d-block fa-2x"></i>
                                            Semua laporan siswa sudah diperiksa dan disetujui!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light text-right py-2">
                    <a href="{{ route('pembimbing_lapangan.laporan.index') }}" class="btn btn-sm btn-primary">
                        Kelola Seluruh Laporan <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Daftar Siswa Binaan Industri --}}
    <div class="card shadow-sm border-0 mt-3">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-dark">
                <i class="fas fa-users text-primary mr-2"></i> Siswa Magang yang Dibimbing
            </h5>
            <a href="{{ route('pembimbing_lapangan.chat.index') }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-comment-dots mr-1"></i> Obrolan Grup / Chat
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>NIS / NIM</th>
                            <th>Asal SMK / Sekolah</th>
                            <th>Jurusan</th>
                            <th>WhatsApp</th>
                            <th class="text-center">Aksi Bimbingan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($siswaList as $idx => $s)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-initial mr-2" style="width: 32px; height: 32px; font-size: 13px;">
                                            {{ strtoupper(substr($s->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <span class="font-weight-600 text-dark">{{ $s->name }}</span>
                                            <br>
                                            <small class="text-muted">{{ $s->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $s->nim ?? '-' }}</td>
                                <td>{{ $s->pendaftaran->universitas ?? $s->pendaftaran->asal_sekolah ?? '-' }}</td>
                                <td>{{ $s->pendaftaran->jurusan ?? '-' }}</td>
                                <td>
                                    @if($s->no_telp)
                                        <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $s->no_telp)) }}" target="_blank" class="btn btn-sm btn-success py-0 px-2" style="font-size: 12px;">
                                            <i class="fab fa-whatsapp"></i> {{ $s->no_telp }}
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('pembimbing_lapangan.chat.index', $s->id) }}" class="btn btn-sm btn-primary" title="Kirim Pesan">
                                            <i class="fas fa-comment-alt"></i> Chat
                                        </a>
                                        <a href="{{ route('pembimbing_lapangan.laporan.siswa', $s->id) }}" class="btn btn-sm btn-info" title="Laporan Kegiatan">
                                            <i class="fas fa-book"></i> Laporan
                                        </a>
                                        <a href="{{ route('pembimbing_lapangan.absensi.siswa', $s->id) }}" class="btn btn-sm btn-secondary" title="Riwayat Absensi">
                                            <i class="fas fa-calendar-check"></i> Absensi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    Belum ada siswa magang yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
