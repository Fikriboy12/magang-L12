@extends('template_admin.master')

@section('contents')

<style>
    /* Styling Dashboard Minimalis, Bersih & Elegan */
    .dashboard-header {
        margin-bottom: 20px;
    }

    .dashboard-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2px;
    }

    /* Kartu Statistik Minimalis */
    .card-stat-clean {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 20px;
        border: 1px solid #edf2f7;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card-stat-clean:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 4px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0f172a;
        line-height: 1;
    }

    .stat-icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }

    /* Warna Icon Halus (Soft) */
    .icon-blue { background: #e0f2fe; color: #0284c7; }
    .icon-green { background: #dcfce7; color: #16a34a; }
    .icon-orange { background: #ffedd5; color: #ea580c; }
    .icon-purple { background: #f3e8ff; color: #9333ea; }

    /* Kartu Konten */
    .content-card {
        background: #ffffff;
        border-radius: 14px;
        border: 1px solid #edf2f7;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        margin-bottom: 20px;
    }

    .content-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f1f5f9;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .content-card .card-header h6 {
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        font-size: 14px;
    }

    /* Tombol Aksi Cepat Elegan */
    .btn-quick {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        background: #ffffff;
        color: #1e293b;
        text-decoration: none !important;
        font-weight: 600;
        font-size: 13px;
        margin-bottom: 10px;
        transition: all 0.2s ease;
    }

    .btn-quick:hover {
        background: #f8fafc;
        border-color: #0284c7;
        color: #0284c7;
        transform: translateX(3px);
    }

    .btn-quick i {
        font-size: 16px;
        margin-right: 12px;
        width: 20px;
        text-align: center;
    }

    /* Badge Presensi Sederhana */
    .presensi-mini-pill {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        margin-right: 6px;
        margin-bottom: 6px;
    }
</style>

<section class="section">
    {{-- Header Minimalis: Sederhana & Luas --}}
    <div class="dashboard-header d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
        <div>
            <h1 class="dashboard-title">Dashboard</h1>
            <p class="text-muted mb-0" style="font-size: 13px;">
                Selamat datang, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong> &bull; PT. Media Balai Nusa
            </p>
        </div>
        <div class="mt-2 mt-sm-0">
            <span class="badge badge-light px-3 py-2 text-muted border font-weight-bold" style="border-radius: 8px;">
                <i class="far fa-calendar-alt text-primary mr-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </span>
        </div>
    </div>

    {{-- Baris 4 Kartu Statistik Ringkas --}}
    <div class="row">
        {{-- 1. Total Siswa --}}
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card-stat-clean">
                <div>
                    <div class="stat-label">Total Siswa</div>
                    <div class="stat-value">{{ $data['pelamar'] }}</div>
                </div>
                <div class="stat-icon-box icon-blue">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>
        </div>

        {{-- 2. Siswa Diterima --}}
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card-stat-clean">
                <div>
                    <div class="stat-label">Siswa Diterima</div>
                    <div class="stat-value text-success">{{ $data['diterima'] }}</div>
                </div>
                <div class="stat-icon-box icon-green">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>

        {{-- 3. Pendaftaran Baru --}}
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card-stat-clean">
                <div>
                    <div class="stat-label">Pendaftaran Baru</div>
                    <div class="stat-value text-warning">{{ $data['pengajuan'] }}</div>
                </div>
                <div class="stat-icon-box icon-orange">
                    <i class="fas fa-file-signature"></i>
                </div>
            </div>
        </div>

        {{-- 4. Pembimbing & Mentor --}}
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card-stat-clean">
                <div>
                    <div class="stat-label">Pembimbing / Mentor</div>
                    <div class="stat-value">{{ $data['guru_pembimbing'] + $data['pembimbing_lapangan'] }}</div>
                </div>
                <div class="stat-icon-box icon-purple">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Utama: Grafik Tren (Kiri) & Aksi Cepat + Presensi (Kanan) --}}
    <div class="row">
        {{-- Kolom Kiri (8 cols): Grafik Tren Pendaftaran Siswa --}}
        <div class="col-lg-8 col-md-12 col-12">
            <div class="content-card">
                <div class="card-header">
                    <h6><i class="fas fa-chart-line text-primary mr-2"></i> Tren Pendaftaran Siswa (6 Bulan)</h6>
                    <small class="text-muted">Statistik Bulanan</small>
                </div>
                <div class="card-body p-3">
                    <div style="height: 250px; position: relative;">
                        <canvas id="chartTrenPendaftaran"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan (4 cols): Aksi Cepat & Rekap Presensi Hari Ini --}}
        <div class="col-lg-4 col-md-12 col-12">
            <div class="content-card">
                <div class="card-header">
                    <h6><i class="fas fa-bolt text-warning mr-2"></i> Akses Presensi & Cepat</h6>
                </div>
                <div class="card-body p-3">
                    {{-- Rekap Kecil Presensi Hari Ini --}}
                    <div class="mb-3 p-2 rounded bg-light">
                        <small class="text-muted d-block mb-1 font-weight-bold">KEHADIRAN HARI INI:</small>
                        <div class="d-flex flex-wrap">
                            <span class="presensi-mini-pill bg-white text-success border">
                                <i class="fas fa-check-circle mr-1"></i> Hadir: {{ $data['hadir_today'] }}
                            </span>
                            <span class="presensi-mini-pill bg-white text-warning border">
                                <i class="fas fa-envelope mr-1"></i> Izin/Sakit: {{ $data['izin_today'] + $data['sakit_today'] }}
                            </span>
                            <span class="presensi-mini-pill bg-white text-danger border">
                                <i class="fas fa-clock mr-1"></i> Belum: {{ $data['belum_presensi'] }}
                            </span>
                        </div>
                    </div>

                    {{-- Tombol Akses Cepat --}}
                    <a href="{{ route('admin.absensi.portal') }}" class="btn-quick">
                        <i class="fas fa-clipboard-check text-primary"></i>
                        <span>Pusat Presensi EdLink</span>
                    </a>
                    <a href="{{ route('admin.absensi.qr') }}" class="btn-quick">
                        <i class="fas fa-qrcode text-info"></i>
                        <span>Layar QR Presensi</span>
                    </a>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn-quick">
                        <i class="fas fa-user-check text-warning"></i>
                        <span>Verifikasi Pendaftar ({{ $data['pengajuan'] }})</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Baris Bawah: Pendaftar Siswa Terbaru --}}
    <div class="row">
        <div class="col-12">
            <div class="content-card">
                <div class="card-header">
                    <h6><i class="fas fa-user-plus text-primary mr-2"></i> Pendaftar Siswa Terbaru</h6>
                    <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-sm btn-outline-primary" style="font-size: 12px; font-weight: 600;">
                        Lihat Semua Pendaftar &rarr;
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="font-size: 13px;">
                            <thead class="bg-light text-muted">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Nama Siswa</th>
                                    <th>Asal Sekolah / SMK</th>
                                    <th>Jurusan</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 12%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['pendaftar_terbaru'] as $idx => $pendaftar)
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td>
                                            <strong class="text-dark">{{ $pendaftar->user->name ?? '-' }}</strong>
                                        </td>
                                        <td>{{ $pendaftar->universitas ?? $pendaftar->asal_sekolah ?? $pendaftar->nama_sekolah ?? '-' }}</td>
                                        <td>{{ $pendaftar->jurusan ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pendaftar->created_at)->translatedFormat('d M Y') }}</td>
                                        <td>
                                            @if($pendaftar->status_pendaftaran === 'diterima')
                                                <span class="badge badge-success px-2 py-1">Diterima</span>
                                            @elseif($pendaftar->status_pendaftaran === 'tidak diterima')
                                                <span class="badge badge-danger px-2 py-1">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning px-2 py-1">Pengajuan</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.pendaftaran.detail', $pendaftar->id_pendaftaran) }}" class="btn btn-sm btn-info py-0 px-2" style="font-size: 11px;">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">Belum ada siswa mendaftar.</td>
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

@endsection

@section('scripts')
{{-- Load Chart.js --}}
<script src="{{ asset('assets_admin/modules/chart.min.js') }}"></script>

<script>
    $(document).ready(function() {
        const ctxTren = document.getElementById('chartTrenPendaftaran');
        if (ctxTren) {
            const labels = {!! json_encode($data['chart_labels']) !!};
            const dataPendaftar = {!! json_encode($data['chart_pendaftaran']) !!};
            const dataDiterima = {!! json_encode($data['chart_diterima']) !!};

            new Chart(ctxTren, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Pendaftar',
                            data: dataPendaftar,
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.08)',
                            pointBackgroundColor: '#0284c7',
                            pointBorderColor: '#fff',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: 'Diterima',
                            data: dataDiterima,
                            borderColor: '#16a34a',
                            backgroundColor: 'rgba(22, 163, 74, 0.04)',
                            pointBackgroundColor: '#16a34a',
                            pointBorderColor: '#fff',
                            borderWidth: 2.5,
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 10,
                            fontSize: 12,
                            fontFamily: "'Poppins', sans-serif"
                        }
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                precision: 0
                            },
                            gridLines: {
                                color: '#f1f5f9'
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            }
                        }]
                    }
                }
            });
        }
    });
</script>
@endsection
