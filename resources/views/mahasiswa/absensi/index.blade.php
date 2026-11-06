@extends('template.master') 

@section('title', 'Data Absensi & Kehadiran')

@section('contents')

<!-- Font Google Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .absensi-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
        min-height: 100vh;
        padding-top: 110px;
        padding-bottom: 70px;
    }

    /* Header Banner */
    .absensi-header-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: white;
        padding: 30px 35px;
        border-radius: 18px;
        box-shadow: 0 10px 30px rgba(37, 99, 235, 0.2);
        margin-bottom: 25px;
    }
    .absensi-header-card h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 24px;
        margin-bottom: 6px;
    }
    .absensi-header-card p {
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

    /* Widget Status Hari Ini */
    .today-status-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        padding: 25px 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        margin-bottom: 25px;
    }
    .clock-display {
        font-size: 32px;
        font-weight: 800;
        color: #1e3a8a;
        letter-spacing: 1px;
        font-variant-numeric: tabular-nums;
    }

    /* Tabel Riwayat */
    .card-table-absensi {
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

    .table-absensi th {
        background: #f8fafc;
        color: #64748b;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e2e8f0;
        padding: 14px 18px;
        vertical-align: middle;
    }
    .table-absensi td {
        padding: 14px 18px;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
    }
    .table-absensi tr:hover {
        background-color: #f8fafc;
    }

    /* Foto Selfie Thumbnail */
    .img-thumb-absensi {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .img-thumb-absensi:hover {
        transform: scale(1.15);
        box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        border-color: #2563eb;
    }

    .badge-jam {
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 13px;
        display: inline-block;
    }
    .badge-masuk { background: #dcfce7; color: #15803d; }
    .badge-pulang { background: #fee2e2; color: #b91c1c; }
</style>

<div class="absensi-page">
    <div class="container">

        {{-- HEADER BANNER --}}
        <div class="absensi-header-card">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h2><i class="fa-solid fa-clock mr-2"></i> Data Absensi & Kehadiran</h2>
                    <p>Rekapitulasi log kehadiran harian peserta magang yang disinkronkan langsung dari Aplikasi Mobile</p>
                </div>
                <div class="d-flex align-items-center flex-wrap" style="gap: 10px;">
                    <a href="{{ route('mahasiswa.absensi.pdf') }}" target="_blank" class="btn btn-light px-3 py-2" style="border-radius: 50px; font-weight: 700; font-size: 13px; color: #1e3a8a;">
                        <i class="fa-solid fa-file-pdf text-danger mr-1"></i> Cetak / Unduh PDF
                    </a>
                    <span class="badge badge-light px-3 py-2 font-weight-bold" style="border-radius: 50px; color: #1e3a8a; font-size: 13px;">
                        <i class="fa-solid fa-satellite-dish mr-1 text-success"></i> Terhubung ke Mobile APK
                    </span>
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
                    Informasi Pelaksanaan Absensi
                </strong>
                <span class="text-muted small">
                    Perekaman absensi masuk dan absensi pulang (beserta foto selfie kehadiran) dilakukan melalui <strong>Aplikasi Mobile Magang (APK)</strong>. Halaman website ini berfungsi untuk memantau data rekapitulasi, waktu absensi, dan histori kehadiran Anda.
                </span>
            </div>
        </div>

        {{-- STATUS ABSENSI HARI INI --}}
        <div class="today-status-card">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-5 mb-3 mb-md-0 border-right">
                    <small class="text-muted text-uppercase font-weight-bold d-block mb-1" style="font-size: 11px;">
                        Waktu Server (WIB)
                    </small>
                    <div class="clock-display" id="jam-digital-wib">--:--:--</div>
                    <div class="text-muted font-weight-bold" style="font-size: 14px;">
                        <i class="fa-regular fa-calendar-check text-primary mr-1"></i>
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->translatedFormat('l, d F Y') }}
                    </div>
                </div>

                <div class="col-lg-8 col-md-7 pl-md-4">
                    <small class="text-muted text-uppercase font-weight-bold d-block mb-2" style="font-size: 11px;">
                        Status Kehadiran Hari Ini
                    </small>

                    @if(!$absenHariIni)
                        <div class="alert alert-warning border-0 mb-0 d-flex align-items-center" style="border-radius: 10px; background: #fffbeb;">
                            <i class="fa-solid fa-clock-rotate-left fa-2x text-warning mr-3"></i>
                            <div>
                                <strong class="text-warning d-block" style="color: #b45309 !important;">Belum Melakukan Absensi Hari Ini</strong>
                                <span class="small text-muted">Silakan buka <strong>Aplikasi Mobile (APK)</strong> di ponsel Anda untuk melakukan absensi selfie masuk.</span>
                            </div>
                        </div>
                    @elseif($absenHariIni->jam_keluar == null)
                        <div class="alert alert-info border-0 mb-0" style="border-radius: 10px; background: #eff6ff;">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <strong class="text-primary d-block font-weight-bold">
                                        <i class="fa-solid fa-circle-check text-success mr-1"></i> Sudah Absen Masuk
                                    </strong>
                                    <span class="small text-muted">
                                        Tercatat jam <strong>{{ $absenHariIni->jam_masuk }} WIB</strong>. Jangan lupa untuk melakukan absen pulang melalui Aplikasi Mobile saat jam operasional selesai.
                                    </span>
                                </div>
                                @if($absenHariIni->foto_bukti)
                                    <div>
                                        <img src="{{ asset($absenHariIni->foto_bukti) }}" alt="Selfie Masuk" class="img-thumb-absensi" data-toggle="modal" data-target="#modalFotoMasukToday" title="Lihat Foto Masuk">
                                    </div>
                                    <div class="modal fade" id="modalFotoMasukToday" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                <img src="{{ asset($absenHariIni->foto_bukti) }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="alert alert-success border-0 mb-0" style="border-radius: 10px; background: #ecfdf5;">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div>
                                    <strong class="text-success d-block font-weight-bold">
                                        <i class="fa-solid fa-circle-check text-success mr-1"></i> Absensi Hari Ini Telah Selesai
                                    </strong>
                                    <span class="small text-muted">
                                        Masuk: <strong>{{ $absenHariIni->jam_masuk }} WIB</strong> &bull; Pulang: <strong>{{ $absenHariIni->jam_keluar }} WIB</strong>
                                    </span>
                                </div>
                                <div class="d-flex gap-2">
                                    @if($absenHariIni->foto_bukti)
                                        <img src="{{ asset($absenHariIni->foto_bukti) }}" alt="Foto Masuk" class="img-thumb-absensi mr-1" data-toggle="modal" data-target="#modalTodayIn" title="Foto Masuk">
                                    @endif
                                    @if($absenHariIni->foto_keluar)
                                        <img src="{{ asset($absenHariIni->foto_keluar) }}" alt="Foto Pulang" class="img-thumb-absensi" data-toggle="modal" data-target="#modalTodayOut" title="Foto Pulang">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- TABEL RIWAYAT KEHADIRAN --}}
        <div class="card-table-absensi">
            <div class="card-table-header">
                <h5><i class="fa-solid fa-list-check text-primary mr-2"></i> Log Rekapitulasi Kehadiran</h5>
                <span class="badge badge-light text-muted px-3 py-2 border font-weight-bold" style="border-radius: 50px;">
                    Total: {{ $riwayat->count() }} Hari Hadir
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-absensi mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th style="width: 160px;">Tanggal</th>
                            <th class="text-center" style="width: 130px;">Jam Masuk</th>
                            <th class="text-center" style="width: 130px;">Jam Pulang</th>
                            <th class="text-center" style="width: 150px;">Foto Kehadiran</th>
                            <th>Keterangan Kegiatan</th>
                            <th class="text-center" style="width: 110px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $row)
                            <tr>
                                <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                
                                <td>
                                    <div class="font-weight-bold text-dark">
                                        {{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('d M Y') }}
                                    </div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($row->tgl_absen)->translatedFormat('l') }}</small>
                                </td>

                                <td class="text-center">
                                    <span class="badge-jam badge-masuk">
                                        <i class="fa-solid fa-arrow-right-to-bracket mr-1"></i> {{ $row->jam_masuk ?? '-' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($row->jam_keluar)
                                        <span class="badge-jam badge-pulang">
                                            <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> {{ $row->jam_keluar }}
                                        </span>
                                    @else
                                        <span class="badge badge-light text-muted border">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center align-items-center gap-1">
                                        @if($row->foto_bukti)
                                            <a href="#" data-toggle="modal" data-target="#fotoIn{{ $row->id }}" title="Foto Selfie Masuk">
                                                <img src="{{ asset($row->foto_bukti) }}" class="img-thumb-absensi mr-1">
                                            </a>
                                            <div class="modal fade" id="fotoIn{{ $row->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                        <h6 class="text-white mb-2">Foto Absen Masuk ({{ $row->jam_masuk }})</h6>
                                                        <img src="{{ asset($row->foto_bukti) }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if($row->foto_keluar)
                                            <a href="#" data-toggle="modal" data-target="#fotoOut{{ $row->id }}" title="Foto Selfie Pulang">
                                                <img src="{{ asset($row->foto_keluar) }}" class="img-thumb-absensi">
                                            </a>
                                            <div class="modal fade" id="fotoOut{{ $row->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-transparent border-0 shadow-none text-center">
                                                        <h6 class="text-white mb-2">Foto Absen Pulang ({{ $row->jam_keluar }})</h6>
                                                        <img src="{{ asset($row->foto_keluar) }}" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if(!$row->foto_bukti && !$row->foto_keluar)
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <span style="font-weight: 500;">{{ $row->keterangan ?? 'Hadir tepat waktu' }}</span>
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-success px-3 py-1 font-weight-bold" style="border-radius: 50px;">
                                        <i class="fa-solid fa-check mr-1"></i> {{ $row->status ?? 'Hadir' }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted" style="font-size: 42px; opacity: 0.3;">
                                        <i class="fa-solid fa-calendar-xmark"></i>
                                    </div>
                                    <h6 class="mt-3 font-weight-bold text-dark">Belum Ada Riwayat Absensi</h6>
                                    <p class="text-muted small mb-0">Lakukan absensi setiap hari melalui <strong>Aplikasi Mobile (APK)</strong> untuk mencatat riwayat kehadiran Anda.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    function updateWibClock() {
        const now = new Date();
        const options = { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        const timeString = now.toLocaleTimeString('id-ID', options);
        const clockEl = document.getElementById('jam-digital-wib');
        if (clockEl) {
            clockEl.innerText = timeString;
        }
    }
    setInterval(updateWibClock, 1000);
    updateWibClock();
</script>

@endsection