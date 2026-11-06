@extends('template.master')

@section('title', 'Detail Lamaran Magang')

@section('contents')
<!-- Font Google Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    .detail-lamaran-page {
        background: #f8fafc;
        min-height: 100vh;
        padding: 110px 0 70px 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .container-custom {
        max-width: 900px;
        margin: auto;
        padding: 0 20px;
    }

    .card-detail {
        background: #ffffff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .card-header-detail {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        color: #ffffff;
        padding: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .card-header-detail h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 24px;
        margin: 0;
    }

    .badge-status {
        padding: 8px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .badge-diterima { background: #10b981; color: #ffffff; }
    .badge-diproses { background: #f59e0b; color: #ffffff; }
    .badge-ditolak { background: #ef4444; color: #ffffff; }

    .detail-body {
        padding: 35px 40px;
    }

    .section-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 24px;
        margin-bottom: 25px;
        transition: 0.3s ease;
    }
    .section-card:hover {
        border-color: #cbd5e1;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    .section-title {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid #f1f5f9;
    }

    .section-badge {
        width: 32px;
        height: 32px;
        background: #2563eb;
        color: #ffffff;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .section-title h5 {
        margin: 0;
        font-weight: 700;
        font-size: 16px;
        color: #0f172a;
    }

    .info-label {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 4px;
    }

    .info-value {
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        word-break: break-word;
    }

    .doc-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 16px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        margin-bottom: 12px;
    }

    .doc-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .btn-download-doc {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none !important;
        background: #2563eb;
        color: #ffffff !important;
        transition: 0.2s;
    }
    .btn-download-doc:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
    }

    @media (max-width: 768px) {
        .detail-body { padding: 25px 20px; }
    }
</style>

<div class="detail-lamaran-page">
    <div class="container-custom">
        @php
            $p = $data['detail_pendaftaran'];
            $status = strtolower($p->status_pendaftaran ?? 'diproses');
            $nisn = $p->nisn ?? $p->nim ?? '-';
            $namaSekolah = $p->nama_sekolah ?? $p->universitas ?? '-';
            $suratSekolah = $p->surat_pengantar ?? $p->surat_rekomendasi ?? null;
        @endphp

        <div class="card-detail">
            <!-- HEADER -->
            <div class="card-header-detail">
                <div>
                    <h2><i class="fa-solid fa-file-invoice mr-2"></i> Detail Pendaftaran Magang</h2>
                    <small style="opacity: 0.9;">Terdaftar pada {{ $p->created_at ? $p->created_at->format('d M Y, H:i') : '-' }} WIB</small>
                </div>
                <div>
                    @if($status == 'diterima')
                        <span class="badge-status badge-diterima"><i class="fa-solid fa-circle-check mr-1"></i> Diterima</span>
                    @elseif($status == 'tidak diterima' || $status == 'ditolak')
                        <span class="badge-status badge-ditolak"><i class="fa-solid fa-circle-xmark mr-1"></i> Ditolak</span>
                    @else
                        <span class="badge-status badge-diproses"><i class="fa-solid fa-clock mr-1"></i> Sedang Diproses</span>
                    @endif
                </div>
            </div>

            <div class="detail-body">
                <!-- ROW: PAS FOTO & DATA PRIBADI SISWA -->
                <div class="row mb-4">
                    <div class="col-md-4 text-center mb-3 mb-md-0">
                        <div style="border: 2px solid #e2e8f0; border-radius: 14px; padding: 15px; background: #f8fafc;">
                            @if($p->gambar)
                                <img src="{{ asset('gambar/'.$p->gambar) }}" alt="Pas Foto Siswa" class="img-fluid rounded shadow-sm" style="max-height: 220px; width: auto; object-fit: cover;">
                            @else
                                <div class="py-5 text-muted"><i class="fa-solid fa-image fa-2x mb-2 d-block"></i>Foto belum diunggah</div>
                            @endif
                            <div class="mt-3">
                                <span class="font-weight-bold text-dark d-block">{{ $p->nama_lengkap ?? '-' }}</span>
                                <small class="text-muted">{{ $p->email ?? '-' }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="section-card h-100 mb-0">
                            <div class="section-title">
                                <div class="section-badge"><i class="fa-solid fa-id-card"></i></div>
                                <h5>Data Pribadi Siswa</h5>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="info-label">Nomor HP / WhatsApp</div>
                                    <div class="info-value">{{ $p->no_telp ?? '-' }}</div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="info-label">Jenis Kelamin</div>
                                    <div class="info-value">{{ $p->jenis_kelamin ?? '-' }}</div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <div class="info-label">Tempat, Tanggal Lahir</div>
                                    <div class="info-value">
                                        {{ $p->tempat_lahir ?? '-' }}, {{ $p->tanggal_lahir ? date('d F Y', strtotime($p->tanggal_lahir)) : '-' }}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="info-label">Alamat Lengkap</div>
                                    <div class="info-value" style="font-weight: 500;">{{ $p->alamat_lengkap ?? '-' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- A. DATA AKADEMIK SISWA -->
                <div class="section-card">
                    <div class="section-title">
                        <div class="section-badge">A</div>
                        <h5>Data Akademik Siswa</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-label">1. NIS / NISN</div>
                            <div class="info-value">{{ $nisn }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">2. Nama Sekolah</div>
                            <div class="info-value">{{ $namaSekolah }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">3. Jurusan / Program Keahlian</div>
                            <div class="info-value">{{ $p->jurusan ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">4. Kelas</div>
                            <div class="info-value">{{ $p->kelas ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="info-label">5. Nama Guru Pembimbing</div>
                            <div class="info-value">{{ $p->nama_guru_pembimbing ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="info-label">6. Email Guru Pembimbing</div>
                            <div class="info-value">{{ $p->email_guru_pembimbing ?? '-' }}</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="info-label">7. No HP Guru Pembimbing</div>
                            <div class="info-value">{{ $p->no_hp_guru_pembimbing ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- B. DATA ORANG TUA / WALI -->
                <div class="section-card">
                    <div class="section-title">
                        <div class="section-badge">B</div>
                        <h5>Data Orang Tua / Wali</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="info-label">1. Nama Orang Tua / Wali</div>
                            <div class="info-value">{{ $p->nama_wali ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="info-label">2. Hubungan dengan Siswa</div>
                            <div class="info-value">{{ $p->hubungan_wali ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="info-label">3. Nomor HP Orang Tua / Wali</div>
                            <div class="info-value">{{ $p->no_hp_wali ?? '-' }}</div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="info-label">4. Email Orang Tua / Wali</div>
                            <div class="info-value">{{ $p->email_wali ?? '-' }}</div>
                        </div>
                    </div>
                </div>

                <!-- C. DATA PELAKSANAAN MAGANG -->
                <div class="section-card">
                    <div class="section-title">
                        <div class="section-badge">C</div>
                        <h5>Data Pelaksanaan Magang</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <div class="info-label">1. Tanggal Mulai Magang</div>
                            <div class="info-value">
                                <i class="fa-regular fa-calendar-check text-primary mr-1"></i>
                                {{ $p->dari_tanggal ? date('d F Y', strtotime($p->dari_tanggal)) : '-' }}
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="info-label">2. Tanggal Selesai Magang</div>
                            <div class="info-value">
                                <i class="fa-regular fa-calendar-xmark text-danger mr-1"></i>
                                {{ $p->sampai_tanggal ? date('d F Y', strtotime($p->sampai_tanggal)) : '-' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- D. DOKUMEN PERSYARATAN -->
                <div class="section-card">
                    <div class="section-title">
                        <div class="section-badge">D</div>
                        <h5>Dokumen Persyaratan</h5>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="doc-card">
                                <div class="d-flex align-items-center">
                                    <div class="doc-icon"><i class="fa-solid fa-file-pdf text-danger"></i></div>
                                    <div>
                                        <div class="font-weight-bold" style="font-size: 14px;">1. CV Siswa (PDF)</div>
                                        <small class="text-muted">Riwayat pendidikan & keahlian</small>
                                    </div>
                                </div>
                                <div>
                                    @if($p->cv)
                                        <a href="{{ url('berkas/'.$p->cv) }}" target="_blank" download class="btn-download-doc">
                                            <i class="fa-solid fa-download mr-1"></i> Unduh
                                        </a>
                                    @else
                                        <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doc-card">
                                <div class="d-flex align-items-center">
                                    <div class="doc-icon"><i class="fa-solid fa-file-pdf text-danger"></i></div>
                                    <div>
                                        <div class="font-weight-bold" style="font-size: 14px;">2. Surat Pengantar Sekolah (PDF)</div>
                                        <small class="text-muted">Bukti rekomendasi resmi</small>
                                    </div>
                                </div>
                                <div>
                                    @if($suratSekolah)
                                        <a href="{{ url('berkas/'.$suratSekolah) }}" target="_blank" download class="btn-download-doc">
                                            <i class="fa-solid fa-download mr-1"></i> Unduh
                                        </a>
                                    @else
                                        <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doc-card">
                                <div class="d-flex align-items-center">
                                    <div class="doc-icon"><i class="fa-solid fa-file-pdf text-danger"></i></div>
                                    <div>
                                        <div class="font-weight-bold" style="font-size: 14px;">3. Surat Izin Orang Tua (PDF)</div>
                                        <small class="text-muted">Persetujuan orang tua/wali</small>
                                    </div>
                                </div>
                                <div>
                                    @if($p->surat_izin_wali)
                                        <a href="{{ url('berkas/'.$p->surat_izin_wali) }}" target="_blank" download class="btn-download-doc">
                                            <i class="fa-solid fa-download mr-1"></i> Unduh
                                        </a>
                                    @else
                                        <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="doc-card">
                                <div class="d-flex align-items-center">
                                    <div class="doc-icon"><i class="fa-solid fa-file-image text-primary"></i></div>
                                    <div>
                                        <div class="font-weight-bold" style="font-size: 14px;">4. Pas Foto Siswa (JPG/PNG)</div>
                                        <small class="text-muted">Identitas peserta magang</small>
                                    </div>
                                </div>
                                <div>
                                    @if($p->gambar)
                                        <a href="{{ asset('gambar/'.$p->gambar) }}" target="_blank" download class="btn-download-doc">
                                            <i class="fa-solid fa-download mr-1"></i> Unduh
                                        </a>
                                    @else
                                        <span class="badge badge-secondary">Tidak ada</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TOMBOL KEMBALI -->
                <div class="text-center mt-4">
                    <a href="{{ route('pelamar.lamaran.index') }}" class="btn btn-secondary px-4 py-2" style="border-radius: 50px; font-weight: 700;">
                        <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Daftar Lamaran
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection