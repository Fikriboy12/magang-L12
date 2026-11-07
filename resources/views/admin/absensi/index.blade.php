@extends('template_admin.master')

@section('title', 'Monitoring Absensi Siswa')

@section('contents')

<style>
    /* Styling Halaman Monitoring Absensi Modern */
    .metric-stat-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        border: 1px solid #f0f3f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .metric-stat-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    }

    .stat-mini-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .icon-blue-light { background: #e0f2fe; color: #0284c7; }
    .icon-green-light { background: #dcfce7; color: #16a34a; }
    .icon-yellow-light { background: #fef3c7; color: #d97706; }
    .icon-red-light { background: #fee2e2; color: #dc2626; }

    /* Student Avatar / Photo */
    .student-avatar-img {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        border: 2px solid #ffffff;
        flex-shrink: 0;
    }

    .student-avatar-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0284c7, #38bdf8);
        color: #ffffff;
        font-weight: 700;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(2, 132, 199, 0.2);
        border: 2px solid #ffffff;
        flex-shrink: 0;
    }

    /* Badges Status Kehadiran */
    .badge-presensi-pill {
        display: inline-flex;
        align-items: center;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-presensi-hadir {
        background: #dcfce7;
        color: #15803d;
        border: 1px solid #bbf7d0;
    }

    .badge-presensi-izin {
        background: #fef3c7;
        color: #b45309;
        border: 1px solid #fde68a;
    }

    .badge-presensi-sakit {
        background: #e0f2fe;
        color: #0369a1;
        border: 1px solid #bae6fd;
    }

    .badge-presensi-alfa {
        background: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }

    .badge-presensi-belum {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    /* Card Table */
    .card-monitoring-main {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f0f3f8;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
        overflow: hidden;
    }

    .card-monitoring-header {
        background: #ffffff;
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    @media (min-width: 768px) {
        .card-monitoring-header {
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
    }

    /* Table Styling */
    .table-monitoring thead th {
        background: #f8fafc;
        border-bottom: 2px solid #e2e8f0;
        border-top: none !important;
        color: #475569;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 14px 18px;
        vertical-align: middle;
    }

    .table-monitoring tbody td {
        padding: 14px 18px;
        vertical-align: middle;
        border-top: 1px solid #f1f5f9;
    }

    .table-monitoring tbody tr:hover {
        background-color: #f8fafc;
    }
</style>

<section class="section">
    {{-- Header Section Resmi --}}
    <div class="section-header d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <h1 class="font-weight-bold text-dark mb-0" style="font-size: 1.45rem;">
                <i class="fas fa-user-clock text-primary mr-2"></i> Monitoring Absensi Siswa
            </h1>
            <small class="text-muted">
                <i class="fas fa-building mr-1"></i> Pantau kehadiran harian seluruh siswa magang SMK di PT. Media Balai Nusa
            </small>
        </div>
        <div class="mt-3 mt-md-0 d-flex flex-wrap gap-2">
            <a href="{{ route('admin.absensi.portal') }}" class="btn btn-warning font-weight-bold text-dark mr-2 shadow-sm" style="border-radius: 10px;">
                <i class="fas fa-calendar-check mr-1"></i> Pusat Presensi EdLink
            </a>
            <a href="{{ route('admin.absensi.qr') }}" class="btn btn-primary font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #0284c7, #3CB9E0); border: none; border-radius: 10px;">
                <i class="fas fa-qrcode mr-1"></i> Layar QR Presensi
            </a>
        </div>
    </div>

    <div class="section-body">
        {{-- 4 Kartu Ringkasan Metrik Hari Ini --}}
        <div class="row">
            {{-- 1. Total Siswa Aktif --}}
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="metric-stat-box">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 12px;">TOTAL SISWA AKTIF</span>
                        <h3 class="font-weight-bold text-dark mt-1 mb-0">{{ $stats['total'] }}</h3>
                        <small class="text-muted">Siswa Diterima Magang</small>
                    </div>
                    <div class="stat-mini-icon icon-blue-light">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>

            {{-- 2. Hadir Hari Ini --}}
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="metric-stat-box">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 12px;">HADIR</span>
                        <h3 class="font-weight-bold text-success mt-1 mb-0">{{ $stats['hadir'] }}</h3>
                        <small class="text-success font-weight-600"><i class="fas fa-check-circle mr-1"></i> Sudah Presensi</small>
                    </div>
                    <div class="stat-mini-icon icon-green-light">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>

            {{-- 3. Izin / Sakit --}}
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="metric-stat-box">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 12px;">IZIN & SAKIT</span>
                        <h3 class="font-weight-bold text-warning mt-1 mb-0">{{ $stats['izin'] + $stats['sakit'] }}</h3>
                        <small class="text-warning font-weight-600">{{ $stats['izin'] }} Izin &bull; {{ $stats['sakit'] }} Sakit</small>
                    </div>
                    <div class="stat-mini-icon icon-yellow-light">
                        <i class="fas fa-envelope-open-text"></i>
                    </div>
                </div>
            </div>

            {{-- 4. Belum Presensi --}}
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="metric-stat-box">
                    <div>
                        <span class="text-muted font-weight-600" style="font-size: 12px;">BELUM HADIR</span>
                        <h3 class="font-weight-bold text-danger mt-1 mb-0">{{ $stats['belum'] + $stats['alfa'] }}</h3>
                        <small class="text-danger font-weight-600"><i class="fas fa-clock mr-1"></i> Belum Mengisi Absen</small>
                    </div>
                    <div class="stat-mini-icon icon-red-light">
                        <i class="fas fa-user-times"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Utama Monitoring Absensi --}}
        <div class="card-monitoring-main">
            {{-- Toolbar Filter & Pencarian --}}
            <div class="card-monitoring-header">
                <div>
                    <h5 class="font-weight-bold text-dark mb-1" style="font-size: 16px;">
                        <i class="fas fa-calendar-day text-primary mr-2"></i> Presensi Tanggal: {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('l, d F Y') }}
                    </h5>
                    <p class="text-muted small mb-0">Status kehadiran otomatis diperbarui saat siswa scan QR atau diabsenkan manual.</p>
                </div>
                
                {{-- Form Filter Tanggal --}}
                <div class="d-flex align-items-center">
                    <form action="{{ route('admin.absensi.index') }}" method="GET" class="d-flex align-items-center">
                        <label class="small font-weight-bold text-muted mr-2 mb-0 d-none d-sm-inline">Pilih Tanggal:</label>
                        <div class="input-group input-group-sm">
                            <input type="date" name="date" class="form-control font-weight-bold" value="{{ $selectedDate }}" onchange="this.form.submit()">
                            @if($selectedDate !== $today)
                                <div class="input-group-append">
                                    <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary" title="Kembali ke Hari Ini">
                                        <i class="fas fa-undo"></i> Hari Ini
                                    </a>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel Data Siswa & Status Kehadiran Hari Ini --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-monitoring mb-0 datatable-custom">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Foto & Siswa Magang</th>
                                <th>Asal SMK / Sekolah</th>
                                <th>Jurusan / Kelas</th>
                                <th>Status Kehadiran Hari Ini</th>
                                <th>Jam Presensi</th>
                                <th class="text-center" style="width: 140px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mahasiswa as $row)
                                @php
                                    $absen = $existingAbsensi->get($row->id_users);
                                    $statusStr = $absen ? strtolower($absen->status) : 'belum';
                                    $hasPhoto = $row->gambar && file_exists(public_path('gambar/' . $row->gambar));
                                    $namaSiswa = $row->user->name ?? 'Siswa';
                                @endphp
                                <tr>
                                    {{-- Kolom 1: No --}}
                                    <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>

                                    {{-- Kolom 2: Foto & Nama Siswa --}}
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($hasPhoto)
                                                <img src="{{ asset('gambar/' . $row->gambar) }}" class="student-avatar-img mr-3" alt="{{ $namaSiswa }}">
                                            @else
                                                <div class="student-avatar-placeholder mr-3">
                                                    {{ strtoupper(substr($namaSiswa, 0, 1)) }}
                                                </div>
                                            @endif
                                            <div>
                                                <div class="font-weight-bold text-dark" style="font-size: 14px;">{{ $namaSiswa }}</div>
                                                <small class="text-muted"><i class="fas fa-envelope mr-1"></i> {{ $row->user->email ?? '-' }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom 3: Asal Sekolah --}}
                                    <td>
                                        <div class="font-weight-600 text-dark">
                                            <i class="fas fa-school text-muted mr-1"></i>
                                            {{ $row->universitas ?? $row->asal_sekolah ?? $row->nama_sekolah ?? '-' }}
                                        </div>
                                        <small class="text-muted"><i class="fas fa-id-card mr-1"></i> NIS/NIM: {{ $row->user->nim ?? '-' }}</small>
                                    </td>

                                    {{-- Kolom 4: Jurusan --}}
                                    <td>
                                        <span class="badge badge-light border text-dark font-weight-normal px-2 py-1">
                                            {{ $row->jurusan ?? '-' }}
                                        </span>
                                    </td>

                                    {{-- Kolom 5: Status Kehadiran Hari Ini (⭐ FITUR BARU UTAMA) --}}
                                    <td>
                                        @if($statusStr === 'hadir')
                                            <span class="badge-presensi-pill badge-presensi-hadir">
                                                <i class="fas fa-check-circle mr-1"></i> Hadir
                                            </span>
                                            @if($absen->status_validasi === 'valid')
                                                <small class="d-block text-success font-weight-bold mt-1" style="font-size: 11px;">
                                                    <i class="fas fa-shield-alt mr-1"></i> Terverifikasi
                                                </small>
                                            @endif
                                        @elseif($statusStr === 'izin')
                                            <span class="badge-presensi-pill badge-presensi-izin">
                                                <i class="fas fa-envelope mr-1"></i> Izin
                                            </span>
                                            @if($absen->keterangan)
                                                <small class="d-block text-muted mt-1 text-truncate" style="max-width: 160px; font-size: 11px;" title="{{ $absen->keterangan }}">
                                                    "{{ $absen->keterangan }}"
                                                </small>
                                            @endif
                                        @elseif($statusStr === 'sakit')
                                            <span class="badge-presensi-pill badge-presensi-sakit">
                                                <i class="fas fa-hospital mr-1"></i> Sakit
                                            </span>
                                            <small class="d-block text-info font-weight-bold mt-1" style="font-size: 11px;">
                                                <i class="fas fa-file-medical mr-1"></i> Surat Dokter
                                            </small>
                                        @elseif(in_array($statusStr, ['alfa', 'alpa']))
                                            <span class="badge-presensi-pill badge-presensi-alfa">
                                                <i class="fas fa-times-circle mr-1"></i> Alfa
                                            </span>
                                        @else
                                            <span class="badge-presensi-pill badge-presensi-belum">
                                                <i class="fas fa-clock mr-1"></i> Belum Hadir
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Kolom 6: Jam Presensi --}}
                                    <td>
                                        @if($absen && $statusStr === 'hadir')
                                            <div class="small">
                                                <span class="text-success font-weight-bold">
                                                    <i class="fas fa-sign-in-alt mr-1"></i> Masuk: {{ $absen->jam_masuk ? substr($absen->jam_masuk, 0, 5) . ' WIB' : '-' }}
                                                </span>
                                                <br>
                                                <span class="{{ $absen->jam_keluar ? 'text-primary' : 'text-muted' }}">
                                                    <i class="fas fa-sign-out-alt mr-1"></i> Pulang: {{ $absen->jam_keluar ? substr($absen->jam_keluar, 0, 5) . ' WIB' : 'Belum Pulang' }}
                                                </span>
                                            </div>
                                        @elseif($absen && in_array($statusStr, ['izin', 'sakit']))
                                            <small class="text-muted font-italic">Dispensasi Tidak Hadir</small>
                                        @else
                                            <small class="text-muted font-italic">-</small>
                                        @endif
                                    </td>

                                    {{-- Kolom 7: Aksi --}}
                                    <td class="text-center">
                                        <a href="{{ route('admin.absensi.detail', $row->id_users) }}" class="btn btn-primary btn-sm font-weight-bold px-3 py-1 shadow-sm" style="border-radius: 8px;">
                                            <i class="fas fa-history mr-1"></i> Riwayat
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="fas fa-users-slash fa-3x mb-2 text-light d-block"></i>
                                        Belum ada siswa magang aktif (diterima) yang terdaftar.
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
        if ($('.datatable-custom').length > 0) {
            $('.datatable-custom').DataTable({
                language: {
                    search: "Cari Siswa / Sekolah:",
                    searchPlaceholder: "Ketik nama siswa...",
                    lengthMenu: "Tampilkan _MENU_ siswa",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ siswa",
                    infoEmpty: "Menampilkan 0 data",
                    zeroRecords: "Tidak ditemukan siswa yang cocok",
                    paginate: {
                        first: "Awal",
                        last: "Akhir",
                        next: "Berikutnya &rarr;",
                        previous: "&larr; Sebelumnya"
                    }
                },
                pageLength: 10,
                ordering: true,
                order: [[0, 'asc']]
            });
        }
    });
</script>
@endsection
