@extends('template_admin.master')

@section('title', 'Pusat Presensi Siswa Magang - PT. MEDIA BALAI NUSA')

@section('contents')
<div class="content-wrapper">
    <section class="content-header pb-2">
        <div class="container-fluid d-flex justify-content-between align-items-center flex-wrap">
            <div class="mb-2">
                <h1 class="font-weight-bold text-dark mb-1">
                    <i class="fas fa-calendar-check text-info mr-2"></i>Pusat Presensi Siswa Magang
                </h1>
                <p class="text-muted mb-0">
                    Sistem Manajemen Kehadiran Fleksibel: <strong>QR Dinamis Anti-Screenshot</strong> &amp; <strong>Presensi Manual Cepat</strong> ala EdLink
                </p>
            </div>
            <div class="d-flex align-items-center mb-2">
                <a href="{{ route('admin.absensi.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm font-weight-bold mr-2" style="border-radius: 8px;">
                    <i class="fas fa-clipboard-list mr-1"></i> Data Rekap &amp; Cetak PDF
                </a>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            {{-- ENTERPRISE EDLINK NAVIGATION TABS --}}
            <div class="edlink-nav-tabs card shadow-sm border-0 mb-4" style="border-radius: 16px; background: #ffffff;">
                <div class="card-body p-2 d-flex justify-content-between align-items-center flex-wrap">
                    <ul class="nav nav-pills custom-portal-tabs" id="presenceTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab === 'manual' ? 'active' : '' }} font-weight-bold px-4 py-2" id="tab-manual-btn" data-toggle="pill" href="#tab-manual" role="tab" aria-controls="tab-manual" aria-selected="{{ $activeTab === 'manual' ? 'true' : 'false' }}">
                                <i class="fas fa-user-edit mr-2"></i> Presensi Manual Siswa
                                <span class="badge badge-light ml-1" style="font-size: 11px;">Input Cepat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeTab === 'qr' ? 'active' : '' }} font-weight-bold px-4 py-2" id="tab-qr-btn" data-toggle="pill" href="#tab-qr" role="tab" aria-controls="tab-qr" aria-selected="{{ $activeTab === 'qr' ? 'true' : 'false' }}">
                                <i class="fas fa-qrcode mr-2"></i> Presensi QR Dinamis (Layar Monitor)
                                <span class="badge badge-warning text-dark ml-1" style="font-size: 11px;">Anti-SS (20s)</span>
                            </a>
                        </li>
                    </ul>

                    <div class="text-muted small px-3 py-1 d-none d-md-block">
                        <i class="fas fa-info-circle text-info mr-1"></i> PT. Media Balai Nusa Smart System
                    </div>
                </div>
            </div>

            {{-- TAB CONTENTS --}}
            <div class="tab-content" id="presenceTabsContent">

                {{-- ========================================================
                     TAB 1: PRESENSI MANUAL SISWA (ALA SEVIMA EDLINK)
                     ======================================================== --}}
                <div class="tab-pane fade {{ $activeTab === 'manual' ? 'show active' : '' }}" id="tab-manual" role="tabpanel" aria-labelledby="tab-manual-btn">
                    
                    {{-- TOP ACTION & DATE FILTER BAR --}}
                    <div class="card shadow-sm border-0 mb-3" style="border-radius: 16px;">
                        <div class="card-body py-3 px-4">
                            <div class="row align-items-center">
                                <div class="col-md-4 col-sm-12 mb-2 mb-md-0">
                                    <label class="text-muted small font-weight-bold mb-1">PILIH TANGGAL PRESENSI:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;">
                                                <i class="far fa-calendar-alt text-info"></i>
                                            </span>
                                        </div>
                                        <input type="date" id="selected-date" class="form-control border-left-0 font-weight-bold text-dark" value="{{ $tanggal }}" style="border-radius: 0 8px 8px 0; background-color: #f8fafc;">
                                    </div>
                                    <small class="text-muted font-weight-bold" id="display-date-label">
                                        {{ $carbonDate->translatedFormat('l, d F Y') }}
                                    </small>
                                </div>

                                <div class="col-md-4 col-sm-12 mb-2 mb-md-0">
                                    <label class="text-muted small font-weight-bold mb-1">CARI SISWA / SEKOLAH:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px;">
                                                <i class="fas fa-search text-muted"></i>
                                            </span>
                                        </div>
                                        <input type="text" id="search-student" class="form-control border-left-0" placeholder="Ketik nama atau asal sekolah..." style="border-radius: 0 8px 8px 0;">
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-12 text-md-right d-flex flex-column justify-content-end align-items-md-end">
                                    <label class="text-muted small font-weight-bold mb-1 d-none d-md-block">AKSI CEPAT PRESENSI:</label>
                                    <div class="d-flex w-100 justify-content-md-end">
                                        <button type="button" id="btn-mark-all-present" class="btn btn-outline-success font-weight-bold mr-2 shadow-sm" style="border-radius: 8px;" title="Set semua siswa berstatus Hadir">
                                            <i class="fas fa-check-double mr-1"></i> Hadir Semua
                                        </button>
                                        <button type="button" id="btn-save-manual" class="btn btn-primary font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #0284c7, #3CB9E0); border: none; border-radius: 8px;">
                                            <i class="fas fa-save mr-1"></i> Simpan Presensi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- EDLINK REALTIME STATISTICS SUMMARY BAR --}}
                    <div class="row mb-3" id="stats-summary-bar">
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <div class="stat-card shadow-sm p-3 text-center" style="background: #ffffff; border-radius: 12px; border-left: 4px solid #64748b;">
                                <div class="text-muted small font-weight-bold">TOTAL SISWA</div>
                                <div class="font-weight-bold text-dark" id="stat-total" style="font-size: 1.5rem;">{{ $stats['total'] }}</div>
                                <div class="text-muted" style="font-size: 11px;">Diterima Magang</div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <div class="stat-card shadow-sm p-3 text-center" style="background: #ffffff; border-radius: 12px; border-left: 4px solid #10b981;">
                                <div class="text-success small font-weight-bold">HADIR (H)</div>
                                <div class="font-weight-bold text-success" id="stat-hadir" style="font-size: 1.5rem;">{{ $stats['hadir'] }}</div>
                                <div class="text-muted" style="font-size: 11px;">Masuk Kerja</div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <div class="stat-card shadow-sm p-3 text-center" style="background: #ffffff; border-radius: 12px; border-left: 4px solid #0284c7;">
                                <div class="text-info small font-weight-bold">IZIN (I)</div>
                                <div class="font-weight-bold text-info" id="stat-izin" style="font-size: 1.5rem;">{{ $stats['izin'] }}</div>
                                <div class="text-muted" style="font-size: 11px;">Disetujui</div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <div class="stat-card shadow-sm p-3 text-center" style="background: #ffffff; border-radius: 12px; border-left: 4px solid #f59e0b;">
                                <div class="small font-weight-bold" style="color: #d97706;">SAKIT (S)</div>
                                <div class="font-weight-bold" id="stat-sakit" style="font-size: 1.5rem; color: #d97706;">{{ $stats['sakit'] }}</div>
                                <div class="text-muted" style="font-size: 11px;">Kondisi Sakit</div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <div class="stat-card shadow-sm p-3 text-center" style="background: #ffffff; border-radius: 12px; border-left: 4px solid #ef4444;">
                                <div class="text-danger small font-weight-bold">ALFA (A)</div>
                                <div class="font-weight-bold text-danger" id="stat-alfa" style="font-size: 1.5rem;">{{ $stats['alfa'] }}</div>
                                <div class="text-muted" style="font-size: 11px;">Tanpa Keterangan</div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-6 mb-2">
                            <div class="stat-card shadow-sm p-3 text-center" style="background: #ffffff; border-radius: 12px; border-left: 4px solid #94a3b8;">
                                <div class="text-muted small font-weight-bold">BELUM ABSEN</div>
                                <div class="font-weight-bold text-secondary" id="stat-belum" style="font-size: 1.5rem;">{{ $stats['belum'] }}</div>
                                <div class="text-muted" style="font-size: 11px;">Belum Diisi</div>
                            </div>
                        </div>
                    </div>

                    {{-- TABEL INPUT PRESENSI INTERAKTIF GAYA EDLINK --}}
                    <div class="card shadow-sm border-0" style="border-radius: 16px;">
                        <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-users text-info mr-2"></i>Daftar Siswa Magang Diterima &mdash; Input Presensi
                            </h6>
                            <span class="badge badge-light border text-muted">
                                <span id="student-count">{{ $mahasiswa->count() }}</span> Siswa
                            </span>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0" id="table-manual-attendance">
                                    <thead style="background: #f8fafc; font-size: 12px; text-transform: uppercase; color: #475569;">
                                        <tr>
                                            <th width="4%" class="text-center">No</th>
                                            <th width="28%">Siswa Magang</th>
                                            <th width="32%" class="text-center">Pilihan Status (EdLink Style)</th>
                                            <th width="16%">Waktu (Jam)</th>
                                            <th width="20%">Keterangan / Alasan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="student-rows-container">
                                        @forelse($mahasiswa as $row)
                                            @php
                                                $user = $row->user;
                                                $absen = $existingAbsensi->get($row->id_users);
                                                $currentStatus = $absen ? $absen->status : '';
                                                $stLower = strtolower($currentStatus);
                                                $jamMasuk = $absen ? substr($absen->jam_masuk, 0, 5) : '08:00';
                                                $jamKeluar = $absen ? substr($absen->jam_keluar, 0, 5) : '17:00';
                                                $keterangan = $absen ? ($absen->keterangan ?? '') : '';
                                                $namaSiswa = $user->name ?? 'Mahasiswa';
                                                $initials = strtoupper(substr($namaSiswa, 0, 2));
                                                $asalSekolah = $row->universitas ?? $row->asal_sekolah ?? $row->asal_kampus ?? '-';
                                            @endphp
                                            <tr class="student-row" data-user-id="{{ $row->id_users }}" data-name="{{ strtolower($namaSiswa) }}" data-school="{{ strtolower($asalSekolah) }}">
                                                <td class="text-center font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar-initials mr-2 shadow-sm">
                                                            {{ $initials }}
                                                        </div>
                                                        <div>
                                                            <div class="font-weight-bold text-dark text-student-name">{{ $namaSiswa }}</div>
                                                            <div class="text-muted small text-school-name">{{ $asalSekolah }}</div>
                                                            @if($absen && $absen->foto_bukti)
                                                                <span class="badge badge-success" style="font-size: 9px;"><i class="fas fa-qrcode mr-1"></i> Scan QR APK</span>
                                                            @elseif($absen)
                                                                <span class="badge badge-light border text-muted" style="font-size: 9px;"><i class="fas fa-user-check mr-1"></i> Input Manual</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>

                                                {{-- SEGMENTED RADIO PILLS ALA SEVIMA EDLINK --}}
                                                <td class="text-center">
                                                    <div class="edlink-pill-group" data-user-id="{{ $row->id_users }}">
                                                        {{-- HADIR (H) --}}
                                                        <label class="edlink-pill pill-hadir {{ $stLower === 'hadir' ? 'active' : '' }}">
                                                            <input type="radio" name="status_{{ $row->id_users }}" value="Hadir" {{ $stLower === 'hadir' ? 'checked' : '' }}>
                                                            <span class="pill-code">H</span>
                                                            <span class="pill-label">Hadir</span>
                                                        </label>

                                                        {{-- IZIN (I) --}}
                                                        <label class="edlink-pill pill-izin {{ $stLower === 'izin' ? 'active' : '' }}">
                                                            <input type="radio" name="status_{{ $row->id_users }}" value="Izin" {{ $stLower === 'izin' ? 'checked' : '' }}>
                                                            <span class="pill-code">I</span>
                                                            <span class="pill-label">Izin</span>
                                                        </label>

                                                        {{-- SAKIT (S) --}}
                                                        <label class="edlink-pill pill-sakit {{ $stLower === 'sakit' ? 'active' : '' }}">
                                                            <input type="radio" name="status_{{ $row->id_users }}" value="Sakit" {{ $stLower === 'sakit' ? 'checked' : '' }}>
                                                            <span class="pill-code">S</span>
                                                            <span class="pill-label">Sakit</span>
                                                        </label>

                                                        {{-- ALFA (A) --}}
                                                        <label class="edlink-pill pill-alfa {{ in_array($stLower, ['alfa', 'alpa']) ? 'active' : '' }}">
                                                            <input type="radio" name="status_{{ $row->id_users }}" value="Alfa" {{ in_array($stLower, ['alfa', 'alpa']) ? 'checked' : '' }}>
                                                            <span class="pill-code">A</span>
                                                            <span class="pill-label">Alfa</span>
                                                        </label>
                                                    </div>
                                                </td>

                                                {{-- WAKTU JAM MASUK & PULANG --}}
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <input type="time" class="form-control form-control-sm input-jam-masuk text-center mr-1" value="{{ $jamMasuk }}" style="border-radius: 6px; width: 85px;" title="Jam Masuk" {{ in_array($stLower, ['izin', 'sakit', 'alfa', 'alpa']) ? 'disabled' : '' }}>
                                                        <span class="text-muted mr-1">-</span>
                                                        <input type="time" class="form-control form-control-sm input-jam-keluar text-center" value="{{ $jamKeluar }}" style="border-radius: 6px; width: 85px;" title="Jam Pulang" {{ in_array($stLower, ['izin', 'sakit', 'alfa', 'alpa']) ? 'disabled' : '' }}>
                                                    </div>
                                                </td>

                                                {{-- KETERANGAN / CATATAN --}}
                                                <td>
                                                    <input type="text" class="form-control form-control-sm input-keterangan" value="{{ $keterangan }}" placeholder="Keterangan / alasan..." style="border-radius: 6px;">
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5 text-muted">
                                                    <i class="fas fa-user-slash fa-3x text-light mb-2"></i>
                                                    <p class="mb-0">Belum ada siswa magang dengan status <strong>DITERIMA</strong>.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white py-3 border-top d-flex justify-content-between align-items-center">
                            <span class="text-muted small">
                                * Klik tombol <strong>Hadir Semua</strong> untuk mengisi otomatis seluruh siswa, lalu sesuaikan siswa yang Izin/Sakit/Alfa.
                            </span>
                            <button type="button" id="btn-save-manual-bottom" class="btn btn-primary font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #0284c7, #3CB9E0); border: none; border-radius: 8px;">
                                <i class="fas fa-save mr-1"></i> Simpan Presensi Hari Ini
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ========================================================
                     TAB 2: PRESENSI QR DINAMIS (LAYAR KIOS MONITOR KANTOR)
                     ======================================================== --}}
                <div class="tab-pane fade {{ $activeTab === 'qr' ? 'show active' : '' }}" id="tab-qr" role="tabpanel" aria-labelledby="tab-qr-btn">
                    
                    <div class="row">
                        {{-- QR CODE MAIN CONTAINER --}}
                        <div class="col-lg-7 col-md-12 mb-4">
                            <div class="card shadow-sm border-0" style="border-radius: 16px; background: #ffffff;">
                                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <span class="badge badge-success p-2 mr-2 d-flex align-items-center shadow-sm" style="border-radius: 30px; font-size: 12px; font-weight: 700;">
                                            <span class="live-indicator-dot mr-1"></span> LIVE MONITOR
                                        </span>
                                        <span class="text-muted font-weight-bold" id="live-date">Memuat tanggal...</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="digital-clock font-weight-bold text-primary mr-3" id="live-clock" style="font-size: 1.25rem;">
                                            --:--:-- WIB
                                        </div>
                                        <button type="button" id="btn-sound-toggle" class="btn btn-outline-info btn-sm mr-2 shadow-sm font-weight-bold" style="border-radius: 8px;">
                                            <i class="fas fa-volume-up mr-1" id="sound-icon"></i> <span id="sound-text">Suara</span>
                                        </button>
                                        <button type="button" id="btn-fullscreen" class="btn btn-info btn-sm shadow-sm font-weight-bold" style="background: linear-gradient(135deg, #0284c7, #3CB9E0); border: none; border-radius: 8px;">
                                            <i class="fas fa-expand mr-1"></i> Layar Penuh
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body text-center py-4 px-3">
                                    <h5 class="text-dark font-weight-bold mb-1">Pindai QR Menggunakan Aplikasi Mobile Magang</h5>
                                    <p class="text-muted small mb-3">Siswa membuka menu <strong>Presensi &rarr; Scan QR</strong> di aplikasi mobile</p>

                                    <div class="d-flex justify-content-center my-2">
                                        <div class="qr-box-container p-3 position-relative shadow-sm" style="background: #ffffff; border: 3px solid #e0f2fe; border-radius: 20px;">
                                            <div id="qrcode-display" style="width: 260px; height: 260px; display: flex; align-items: center; justify-content: center;">
                                                <div class="spinner-border text-info" role="status">
                                                    <span class="sr-only">Membuat QR...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- PROGRESS HITUNG MUNDUR --}}
                                    <div class="mt-3 px-md-4">
                                        <div class="d-flex justify-content-between align-items-center mb-1 font-weight-bold" style="font-size: 13px;">
                                            <span class="text-muted"><i class="fas fa-sync-alt fa-spin mr-1 text-info"></i> Otomatis berganti dalam:</span>
                                            <span class="badge badge-pill badge-primary px-3 py-1 font-weight-bold shadow-sm" id="countdown-badge" style="font-size: 13px; background: #0284c7;">
                                                <span id="countdown-number">20</span> Detik
                                            </span>
                                        </div>
                                        <div class="progress" style="height: 8px; border-radius: 10px; background-color: #f1f5f9;">
                                            <div id="countdown-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%; background: linear-gradient(90deg, #3CB9E0, #0284c7); border-radius: 10px;"></div>
                                        </div>
                                    </div>

                                    <div class="alert alert-light border mt-4 mb-0 mx-md-3 py-2 px-3 text-left d-flex align-items-center" style="border-radius: 12px; background: #f8fafc;">
                                        <div class="mr-3 text-primary" style="font-size: 24px;">
                                            <i class="fas fa-shield-alt"></i>
                                        </div>
                                        <div style="font-size: 12px; line-height: 1.4;">
                                            <strong class="text-dark">Keamanan Anti-Screenshot & Anti-Joki:</strong><br>
                                            <span class="text-muted">QR Code ini otomatis kedaluwarsa & berganti tiap 20 detik. Screenshot atau foto layar yang dikirimkan ke teman tidak akan berlaku.</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer bg-light py-2 text-center text-muted small">
                                    Token Aktif: <code id="active-token-text" class="text-info font-weight-bold">Memuat token...</code>
                                </div>
                            </div>
                        </div>

                        {{-- LIVE LOG & PANDUAN SISWA --}}
                        <div class="col-lg-5 col-md-12 mb-4">
                            <div class="card shadow-sm border-0 mb-4" style="border-radius: 16px; background: #ffffff;">
                                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                                    <h6 class="font-weight-bold text-dark mb-0">
                                        <i class="fas fa-history text-info mr-2"></i>Log Pemindaian Hari Ini (Live)
                                    </h6>
                                    <span class="badge badge-light border text-muted" id="scan-count-badge">0 aktivitas</span>
                                </div>
                                <div class="card-body p-0" style="max-height: 330px; overflow-y: auto;" id="recent-scans-container">
                                    <div class="text-center py-5 text-muted" id="scans-empty-state">
                                        <i class="fas fa-mobile-alt fa-3x text-light mb-2"></i>
                                        <p class="small mb-0">Belum ada siswa yang melakukan scan hari ini.</p>
                                        <span class="badge badge-light border mt-1">Menunggu pemindaian...</span>
                                    </div>
                                    <ul class="list-group list-group-flush" id="scans-list" style="display: none;">
                                        {{-- Diisi dinamis via AJAX --}}
                                    </ul>
                                </div>
                            </div>

                            <div class="card shadow-sm border-0" style="border-radius: 16px; background: linear-gradient(135deg, #0284c7, #1e3c72); color: white;">
                                <div class="card-body p-4">
                                    <h6 class="font-weight-bold mb-3 d-flex align-items-center">
                                        <i class="fas fa-info-circle mr-2" style="color: #7dd3fc;"></i> Petunjuk Siswa Magang
                                    </h6>
                                    <div class="d-flex align-items-start mb-2">
                                        <div class="step-badge mr-3">1</div>
                                        <div class="small">Buka <strong>Aplikasi Mobile Magang</strong> di smartphone Anda.</div>
                                    </div>
                                    <div class="d-flex align-items-start mb-2">
                                        <div class="step-badge mr-3">2</div>
                                        <div class="small">Pilih menu <strong>Absensi</strong> lalu klik <strong>Scan QR</strong>.</div>
                                    </div>
                                    <div class="d-flex align-items-start mb-2">
                                        <div class="step-badge mr-3">3</div>
                                        <div class="small">Arahkan kamera ke layar sebelum hitung mundur habis.</div>
                                    </div>
                                    <div class="d-flex align-items-start">
                                        <div class="step-badge mr-3">4</div>
                                        <div class="small">Presensi masuk/pulang Anda tercatat secara otomatis.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>
</div>

{{-- MODAL FULLSCREEN KIOSK (Jika Menampilkan di Monitor Kantor) --}}
<div id="kiosk-fullscreen-overlay" class="kiosk-overlay" style="display: none;">
    <div class="kiosk-header">
        <div class="d-flex align-items-center">
            <img src="{{ asset('gambar/AMS-logo.png') }}" alt="Logo" style="height: 48px;" class="mr-3 rounded bg-white p-1">
            <div>
                <h3 class="mb-0 font-weight-bold text-white">PT. MEDIA BALAI NUSA</h3>
                <span class="text-light" style="font-size: 14px; opacity: 0.9;">Kios Presensi Digital &mdash; Scan QR via APK Mobile</span>
            </div>
        </div>
        <div class="text-right d-flex align-items-center">
            <div class="kiosk-clock mr-4 text-white font-weight-bold" id="kiosk-clock-display" style="font-size: 2rem;">
                --:--:-- WIB
            </div>
            <button type="button" class="btn btn-outline-light btn-sm font-weight-bold px-3 py-2" id="btn-exit-fullscreen" style="border-radius: 8px;">
                <i class="fas fa-compress mr-1"></i> Tutup Layar Penuh
            </button>
        </div>
    </div>

    <div class="kiosk-body d-flex flex-column align-items-center justify-content-center">
        <div class="kiosk-qr-card text-center p-4 shadow-lg">
            <div class="badge badge-success px-3 py-2 mb-3" style="font-size: 14px; border-radius: 30px;">
                <span class="live-indicator-dot mr-1"></span> MODE KIOSK AKTIF &mdash; ANTI-SCREENSHOT (20 DETIK)
            </div>
            <div class="d-flex justify-content-center mb-3">
                <div class="p-3 bg-white rounded shadow-sm border" style="display: inline-block;">
                    <div id="qrcode-kiosk" style="width: 320px; height: 320px; display: flex; align-items: center; justify-content: center;">
                        <div class="spinner-border text-info" role="status"></div>
                    </div>
                </div>
            </div>
            <div class="kiosk-progress-container px-4">
                <div class="d-flex justify-content-between align-items-center mb-1 text-white font-weight-bold">
                    <span>Otomatis berganti dalam:</span>
                    <span id="kiosk-countdown-number" class="badge badge-warning text-dark font-weight-bold px-2 py-1" style="font-size: 14px;">20 Detik</span>
                </div>
                <div class="progress" style="height: 10px; border-radius: 10px;">
                    <div id="kiosk-countdown-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{{-- Load QRCode.js Lokal --}}
<script src="{{ asset('assets_admin/js/qrcode.min.js') }}"></script>

<style>
/* CUSTOM PORTAL & EDLINK TABS */
.custom-portal-tabs .nav-link {
    color: #475569;
    border-radius: 10px;
    transition: all 0.25s ease;
}
.custom-portal-tabs .nav-link:hover {
    background: #f1f5f9;
    color: #0284c7;
}
.custom-portal-tabs .nav-link.active {
    background: linear-gradient(135deg, #0284c7, #3CB9E0) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
}

/* AVATAR INITIALS */
.avatar-initials {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, #e0f2fe, #bae6fd);
    color: #0369a1;
    font-weight: 700;
    font-size: 13px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* SEGMENTED RADIO PILLS ALA SEVIMA EDLINK */
.edlink-pill-group {
    display: inline-flex;
    background: #f1f5f9;
    padding: 3px;
    border-radius: 30px;
    user-select: none;
}
.edlink-pill {
    margin: 0 2px;
    padding: 5px 12px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 700;
    color: #64748b;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    margin-bottom: 0;
}
.edlink-pill input[type="radio"] {
    display: none;
}
.edlink-pill .pill-code {
    width: 18px;
    height: 18px;
    border-radius: 50%;
    background: rgba(0,0,0,0.06);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-right: 5px;
    font-size: 10px;
}

/* AKTIF COLOR PALETTES */
.edlink-pill.pill-hadir.active {
    background: #10b981;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(16, 185, 129, 0.35);
}
.edlink-pill.pill-hadir.active .pill-code { background: rgba(255,255,255,0.25); }

.edlink-pill.pill-izin.active {
    background: #0284c7;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(2, 132, 199, 0.35);
}
.edlink-pill.pill-izin.active .pill-code { background: rgba(255,255,255,0.25); }

.edlink-pill.pill-sakit.active {
    background: #f59e0b;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(245, 158, 11, 0.35);
}
.edlink-pill.pill-sakit.active .pill-code { background: rgba(255,255,255,0.25); }

.edlink-pill.pill-alfa.active {
    background: #ef4444;
    color: #ffffff;
    box-shadow: 0 2px 6px rgba(239, 68, 68, 0.35);
}
.edlink-pill.pill-alfa.active .pill-code { background: rgba(255,255,255,0.25); }

/* LIVE INDICATOR DOT */
.live-indicator-dot {
    width: 8px;
    height: 8px;
    background-color: #22c55e;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 0 rgba(34, 197, 94, 0.7);
    animation: pulseDot 1.5s infinite;
}
@keyframes pulseDot {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7); }
    70% { box-shadow: 0 0 0 8px rgba(34, 197, 94, 0); }
    100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
}

.step-badge {
    width: 26px;
    height: 26px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
    flex-shrink: 0;
}

/* KIOSK OVERLAY */
.kiosk-overlay {
    position: fixed;
    top: 0; left: 0; width: 100vw; height: 100vh;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0284c7 100%);
    z-index: 99999;
    padding: 30px 40px;
    display: flex;
    flex-direction: column;
}
.kiosk-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    padding-bottom: 20px;
}
.kiosk-body { flex: 1; }
.kiosk-qr-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 24px;
    max-width: 480px;
    width: 100%;
}
.new-scan-pulse {
    animation: flashGreen 2s ease-out;
}
@keyframes flashGreen {
    0% { background-color: #dcfce7; }
    100% { background-color: transparent; }
}
</style>

<script>
$(document).ready(function() {
    // ========================================================
    // 1. PRESENSI MANUAL ALA SEVIMA EDLINK
    // ========================================================

    // Event Klik Pill Radio Status (Hadir, Izin, Sakit, Alfa)
    $(document).on('click', '.edlink-pill', function() {
        const group = $(this).closest('.edlink-pill-group');
        group.find('.edlink-pill').removeClass('active');
        $(this).addClass('active');
        $(this).find('input[type="radio"]').prop('checked', true);

        const val = $(this).find('input[type="radio"]').val();
        const row = $(this).closest('.student-row');
        const jamMasuk = row.find('.input-jam-masuk');
        const jamKeluar = row.find('.input-jam-keluar');
        const inputKet = row.find('.input-keterangan');

        if (val === 'Hadir') {
            jamMasuk.prop('disabled', false);
            jamKeluar.prop('disabled', false);
            if (!jamMasuk.val()) jamMasuk.val('08:00');
            if (!jamKeluar.val()) jamKeluar.val('17:00');
            if (!inputKet.val()) inputKet.val('Hadir tepat waktu');
        } else {
            jamMasuk.prop('disabled', true);
            jamKeluar.prop('disabled', true);
            if (val === 'Izin' && (!inputKet.val() || inputKet.val() === 'Hadir tepat waktu')) {
                inputKet.val('Izin keperluan');
            } else if (val === 'Sakit' && (!inputKet.val() || inputKet.val() === 'Hadir tepat waktu')) {
                inputKet.val('Sakit');
            } else if (val === 'Alfa') {
                inputKet.val('Tanpa keterangan (Alfa)');
            }
        }

        recalculateStats();
    });

    // Fitur Edlink: Tandai Hadir Semua (1-Click Mark All Present)
    $('#btn-mark-all-present').on('click', function() {
        $('.student-row:visible').each(function() {
            const row = $(this);
            const hadirPill = row.find('.pill-hadir');
            hadirPill.trigger('click');
        });

        Swal.fire({
            icon: 'success',
            title: 'Hadir Semua Dipilih',
            text: 'Semua siswa yang tampil telah ditandai Hadir.',
            timer: 1500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    });

    // Hitung Ulang Statistik Real-Time di Header
    function recalculateStats() {
        let total = 0;
        let hadir = 0;
        let izin = 0;
        let sakit = 0;
        let alfa = 0;
        let belum = 0;

        $('.student-row').each(function() {
            total++;
            const activeVal = $(this).find('.edlink-pill.active input[type="radio"]').val();
            if (activeVal === 'Hadir') hadir++;
            else if (activeVal === 'Izin') izin++;
            else if (activeVal === 'Sakit') sakit++;
            else if (activeVal === 'Alfa') alfa++;
            else belum++;
        });

        $('#stat-total').text(total);
        $('#stat-hadir').text(hadir);
        $('#stat-izin').text(izin);
        $('#stat-sakit').text(sakit);
        $('#stat-alfa').text(alfa);
        $('#stat-belum').text(belum);
    }

    // Pencarian Siswa / Sekolah
    $('#search-student').on('keyup', function() {
        const query = $(this).val().toLowerCase().trim();
        let visibleCount = 0;
        $('.student-row').each(function() {
            const name = $(this).data('name') || '';
            const school = $(this).data('school') || '';
            if (name.includes(query) || school.includes(query)) {
                $(this).show();
                visibleCount++;
            } else {
                $(this).hide();
            }
        });
        $('#student-count').text(visibleCount);
    });

    // Ganti Tanggal di Datepicker: Muat Data Otomatis via AJAX
    $('#selected-date').on('change', function() {
        const dateVal = $(this).val();
        if (!dateVal) return;

        Swal.fire({
            title: 'Memuat Data...',
            text: 'Mengambil riwayat presensi tanggal terpilih...',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        $.ajax({
            url: "{{ route('admin.absensi.manual.data') }}",
            type: "GET",
            data: { date: dateVal },
            dataType: "json",
            success: function(res) {
                Swal.close();
                if (res.status === 'success') {
                    $('#display-date-label').text(res.tanggal_formatted);

                    // Update Statistik
                    $('#stat-total').text(res.stats.total);
                    $('#stat-hadir').text(res.stats.hadir);
                    $('#stat-izin').text(res.stats.izin);
                    $('#stat-sakit').text(res.stats.sakit);
                    $('#stat-alfa').text(res.stats.alfa);
                    $('#stat-belum').text(res.stats.belum);

                    // Update Tiap Baris Siswa
                    res.items.forEach(function(item) {
                        const row = $(`.student-row[data-user-id="${item.user_id}"]`);
                        if (row.length) {
                            const group = row.find('.edlink-pill-group');
                            group.find('.edlink-pill').removeClass('active');
                            group.find('input[type="radio"]').prop('checked', false);

                            const st = (item.status || '').toLowerCase();
                            if (st === 'hadir') group.find('.pill-hadir').addClass('active').find('input').prop('checked', true);
                            else if (st === 'izin') group.find('.pill-izin').addClass('active').find('input').prop('checked', true);
                            else if (st === 'sakit') group.find('.pill-sakit').addClass('active').find('input').prop('checked', true);
                            else if (st === 'alfa' || st === 'alpa') group.find('.pill-alfa').addClass('active').find('input').prop('checked', true);

                            row.find('.input-jam-masuk').val(item.jam_masuk || '08:00').prop('disabled', st !== 'hadir');
                            row.find('.input-jam-keluar').val(item.jam_keluar || '17:00').prop('disabled', st !== 'hadir');
                            row.find('.input-keterangan').val(item.keterangan || '');
                        }
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Memuat Data',
                    text: 'Terjadi kesalahan saat memuat data presensi tanggal tersebut.'
                });
            }
        });
    });

    // Simpan Presensi Manual (Tombol Atas & Bawah)
    $('#btn-save-manual, #btn-save-manual-bottom').on('click', function() {
        const dateVal = $('#selected-date').val();
        const attendances = [];

        $('.student-row').each(function() {
            const userId = $(this).data('user-id');
            const activeStatus = $(this).find('.edlink-pill.active input[type="radio"]').val();
            const jamMasuk = $(this).find('.input-jam-masuk').val();
            const jamKeluar = $(this).find('.input-jam-keluar').val();
            const ket = $(this).find('.input-keterangan').val();

            if (userId && activeStatus) {
                attendances.push({
                    user_id: userId,
                    status: activeStatus,
                    jam_masuk: jamMasuk,
                    jam_keluar: jamKeluar,
                    keterangan: ket
                });
            }
        });

        if (attendances.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Belum Ada Status Terpilih',
                text: 'Silakan pilih status Hadir/Izin/Sakit/Alfa untuk minimal 1 siswa sebelum menyimpan.'
            });
            return;
        }

        Swal.fire({
            title: 'Simpan Presensi?',
            text: `Akan menyimpan presensi untuk ${attendances.length} siswa pada tanggal ${$('#display-date-label').text()}.`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0284c7',
            cancelButtonColor: '#64748b',
            confirmButtonText: 'Ya, Simpan Sekarang',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Menyimpan...',
                    allowOutsideClick: false,
                    didOpen: () => { Swal.showLoading(); }
                });

                $.ajax({
                    url: "{{ route('admin.absensi.manual.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        tanggal: dateVal,
                        attendances: attendances
                    },
                    dataType: "json",
                    success: function(res) {
                        if (res.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Disimpan!',
                                text: res.message
                            });
                            recalculateStats();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: res.message || 'Terjadi kesalahan sistem.'
                            });
                        }
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error Server',
                            text: 'Gagal menghubungi server untuk menyimpan data presensi.'
                        });
                    }
                });
            }
        });
    });

    // ========================================================
    // 2. PRESENSI QR DINAMIS (ANTI-SCREENSHOT)
    // ========================================================
    let currentInterval = 20;
    let remainingSeconds = 20;
    let timerInterval = null;
    let soundEnabled = true;
    let isFetchingToken = false;
    let knownScanKeys = new Set();

    function playChimeSound() {
        if (!soundEnabled) return;
        try {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            if (!AudioContext) return;
            const ctx = new AudioContext();
            const osc = ctx.createOscillator();
            const gain = ctx.createGain();
            osc.type = 'sine';
            osc.frequency.setValueAtTime(587.33, ctx.currentTime);
            osc.frequency.setValueAtTime(880.00, ctx.currentTime + 0.1);
            gain.gain.setValueAtTime(0.2, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.5);
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.start();
            osc.stop(ctx.currentTime + 0.5);
        } catch (e) {}
    }

    $('#btn-sound-toggle').on('click', function() {
        soundEnabled = !soundEnabled;
        if (soundEnabled) {
            $('#sound-icon').attr('class', 'fas fa-volume-up mr-1');
            $('#sound-text').text('Suara: Aktif');
            $(this).removeClass('btn-outline-secondary').addClass('btn-outline-info');
            playChimeSound();
        } else {
            $('#sound-icon').attr('class', 'fas fa-volume-mute mr-1');
            $('#sound-text').text('Suara: Mute');
            $(this).removeClass('btn-outline-info').addClass('btn-outline-secondary');
        }
    });

    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const timeString = `${hours}:${minutes}:${seconds} WIB`;
        $('#live-clock').text(timeString);
        $('#kiosk-clock-display').text(timeString);
    }
    setInterval(updateClock, 1000);
    updateClock();

    function renderQrCode(payloadText) {
        const mainContainer = document.getElementById('qrcode-display');
        if (mainContainer) {
            mainContainer.innerHTML = '';
            new QRCode(mainContainer, {
                text: payloadText,
                width: 260,
                height: 260,
                colorDark: "#0f172a",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.M
            });
        }

        const kioskContainer = document.getElementById('qrcode-kiosk');
        if (kioskContainer) {
            kioskContainer.innerHTML = '';
            new QRCode(kioskContainer, {
                text: payloadText,
                width: 320,
                height: 320,
                colorDark: "#0f172a",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.M
            });
        }
    }

    function fetchNewQrToken() {
        if (isFetchingToken) return;
        isFetchingToken = true;

        $.ajax({
            url: "{{ route('admin.absensi.qr.token') }}",
            type: "GET",
            dataType: "json",
            success: function(response) {
                isFetchingToken = false;
                if (response.status === 'success') {
                    $('#active-token-text').text(response.token);
                    if (response.date_formatted) {
                        $('#live-date').text(response.date_formatted);
                    }
                    renderQrCode(response.qr_payload || response.token);
                    currentInterval = response.interval || 20;
                    remainingSeconds = currentInterval;
                    updateCountdownDisplay();
                }
            },
            error: function(err) {
                isFetchingToken = false;
                $('#active-token-text').text('Gagal memuat token.');
            }
        });
    }

    function updateCountdownDisplay() {
        $('#countdown-number').text(remainingSeconds);
        $('#kiosk-countdown-number').text(remainingSeconds + ' Detik');
        const percentage = (remainingSeconds / currentInterval) * 100;
        $('#countdown-bar').css('width', percentage + '%');
        $('#kiosk-countdown-bar').css('width', percentage + '%');

        if (remainingSeconds <= 5) {
            $('#countdown-bar').removeClass('bg-info').addClass('bg-danger');
            $('#countdown-badge').removeClass('badge-primary').addClass('badge-danger');
        } else {
            $('#countdown-bar').removeClass('bg-danger').addClass('bg-info');
            $('#countdown-badge').removeClass('badge-danger').addClass('badge-primary');
        }
    }

    timerInterval = setInterval(function() {
        remainingSeconds--;
        if (remainingSeconds <= 0) {
            remainingSeconds = 0;
            updateCountdownDisplay();
            fetchNewQrToken();
        } else {
            updateCountdownDisplay();
        }
    }, 1000);

    fetchNewQrToken();

    // Polling Live Scan Feed
    function checkRecentScans() {
        $.ajax({
            url: "{{ route('admin.absensi.qr.recent') }}",
            type: "GET",
            dataType: "json",
            success: function(res) {
                if (res.status === 'success' && res.scans && res.scans.length > 0) {
                    $('#scans-empty-state').hide();
                    $('#scans-list').show();
                    $('#scan-count-badge').text(res.scans.length + ' aktivitas');

                    let html = '';
                    let hasNewScan = false;

                    res.scans.forEach(function(item, index) {
                        const key = item.nama + '_' + item.jam + '_' + item.tipe;
                        const isNew = !knownScanKeys.has(key);
                        if (isNew) {
                            hasNewScan = true;
                            knownScanKeys.add(key);
                        }

                        const badgeClass = item.tipe.toLowerCase() === 'masuk' ? 'badge-success' : 'badge-info';
                        const iconClass = item.tipe.toLowerCase() === 'masuk' ? 'fa-sign-in-alt' : 'fa-sign-out-alt';
                        const pulseClass = (index === 0 && isNew) ? 'new-scan-pulse' : '';

                        html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3 border-bottom ${pulseClass}">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center mr-2 text-primary font-weight-bold" style="width: 34px; height: 34px; font-size: 13px;">
                                        ${item.nama.substring(0, 2).toUpperCase()}
                                    </div>
                                    <div>
                                        <div class="font-weight-bold text-dark" style="font-size: 13px;">${item.nama}</div>
                                        <div class="text-muted" style="font-size: 11px;">${item.waktu || item.jam}</div>
                                    </div>
                                </div>
                                <span class="badge ${badgeClass} px-2 py-1" style="border-radius: 6px; font-size: 11px;">
                                    <i class="fas ${iconClass} mr-1"></i> ${item.tipe.toUpperCase()}
                                </span>
                            </li>
                        `;
                    });

                    $('#scans-list').html(html);

                    if (hasNewScan && knownScanKeys.size > 0) {
                        playChimeSound();
                    }
                }
            }
        });
    }
    setInterval(checkRecentScans, 3500);
    checkRecentScans();

    // Fullscreen Kiosk
    $('#btn-fullscreen').on('click', function() {
        $('#kiosk-fullscreen-overlay').fadeIn(200);
        const elem = document.documentElement;
        if (elem.requestFullscreen) elem.requestFullscreen().catch(err => {});
    });

    $('#btn-exit-fullscreen').on('click', function() {
        $('#kiosk-fullscreen-overlay').fadeOut(200);
        if (document.exitFullscreen) document.exitFullscreen().catch(err => {});
    });

    $(document).on('keydown', function(e) {
        if (e.key === "Escape") $('#kiosk-fullscreen-overlay').fadeOut(200);
    });
});
</script>
@endsection
