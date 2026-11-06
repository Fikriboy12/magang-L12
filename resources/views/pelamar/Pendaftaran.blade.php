@extends('template.master')

@section('title', 'Formulir Pendaftaran Magang')

@section('contents')

<!-- Font Google Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* 1. Latar Belakang & Layout */
    .pendaftaran-page {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); 
        min-height: 100vh;
        padding: 110px 0 70px 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .container-custom {
        max-width: 780px;
        margin: auto;
        padding: 0 20px;
    }

    /* 2. Kartu Formulir */
    .card-pendaftaran {
        background: #ffffff;
        border-radius: 20px;
        border: none;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
        overflow: hidden;
    }

    .card-header-custom {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        padding: 35px 30px;
        text-align: center;
    }

    .card-header-custom h2 {
        color: #ffffff;
        font-weight: 800;
        font-size: 26px;
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .card-header-custom p {
        color: #dbeafe;
        font-size: 14px;
        margin: 0;
        opacity: 0.95;
    }

    .form-body {
        padding: 35px 40px;
    }

    /* 3. Section Header (A, B, C, D) */
    .section-card {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 22px 24px;
        margin-bottom: 25px;
    }

    .section-title {
        display: flex;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 10px;
        border-bottom: 2px solid #e2e8f0;
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
        font-size: 15px;
        margin-right: 12px;
        flex-shrink: 0;
    }

    .section-title h5 {
        margin: 0;
        font-weight: 800;
        color: #1e293b;
        font-size: 16px;
        letter-spacing: 0.2px;
    }

    /* 4. Inputs & Labels */
    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        font-weight: 700;
        color: #334155;
        font-size: 13.5px;
        margin-bottom: 7px;
        display: block;
    }

    .form-group label .text-danger {
        color: #ef4444;
    }

    .form-control-custom {
        background-color: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 14px;
        width: 100%;
        color: #1e293b;
        transition: all 0.2s ease;
        box-sizing: border-box;
    }

    .form-control-custom:focus {
        border-color: #2563eb;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        outline: none;
    }

    select.form-control-custom {
        height: 46px;
        cursor: pointer;
    }

    /* 5. Upload Dokumen */
    .file-upload-card {
        background: #ffffff;
        border: 1.5px dashed #94a3b8;
        border-radius: 12px;
        padding: 16px;
        margin-bottom: 16px;
        transition: all 0.2s;
    }

    .file-upload-card:hover {
        border-color: #2563eb;
        background: #f0f7ff;
    }

    .file-upload-card .doc-title {
        font-weight: 700;
        color: #1e293b;
        font-size: 14px;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .file-upload-card .doc-desc {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 10px;
        line-height: 1.4;
    }

    .file-upload-card input[type="file"] {
        width: 100%;
        font-size: 13px;
        color: #475569;
    }

    /* 6. Tombol Kirim */
    .btn-submit {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 16px;
        font-weight: 800;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.35);
        margin-top: 15px;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #1d4ed8, #1e40af);
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(37, 99, 235, 0.45);
    }

    /* Alert */
    .alert-custom {
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-size: 13.5px;
    }

    @media (max-width: 768px) {
        .form-body { padding: 25px 20px; }
        .section-card { padding: 18px 15px; }
    }
</style>

<div class="pendaftaran-page">
    <div class="container-custom">
        <div class="card-pendaftaran">
            
            <div class="card-header-custom">
                <h2>Formulir Pendaftaran Magang</h2>
                <p>Sistem Informasi E-Magang PT. MEDIA BALAI NUSA (ASTRONET.ID)</p>
            </div>

            <div class="form-body">
                
                @if(session('error'))
                <div class="alert alert-danger alert-custom">
                    <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-custom">
                    <strong class="d-block mb-1"><i class="fas fa-exclamation-triangle mr-1"></i> Terjadi kesalahan pengisian formulir:</strong>
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($cek_pendaftaran)
                <div class="alert alert-info alert-custom p-4 text-center">
                    <i class="fas fa-info-circle fa-2x mb-2 text-primary d-block"></i>
                    <h5 class="font-weight-bold text-dark mb-1">Anda Sudah Mengirimkan Formulir Pendaftaran</h5>
                    <p class="text-muted mb-3">Status Pengajuan: <span class="badge badge-primary px-3 py-1 text-uppercase">{{ $cek_pendaftaran->status_pendaftaran }}</span></p>
                    <a href="{{ route('pelamar.lamaran.index') }}" class="btn btn-primary px-4 py-2 font-weight-bold" style="border-radius: 8px;">
                        <i class="fas fa-eye mr-1"></i> Lihat Status Lamaran Saya
                    </a>
                </div>
                @else

                <form action="{{ url('insert-pendaftaran') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- ========================================== -->
                    <!-- A. DATA AKADEMIK SISWA -->
                    <!-- ========================================== -->
                    <div class="section-card">
                        <div class="section-title">
                            <div class="section-badge">A</div>
                            <h5>Data Akademik Siswa</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>1. NIS / NISN <span class="text-danger">*</span></label>
                                <input type="text" name="nisn" class="form-control-custom" placeholder="Contoh: 0054321987" value="{{ old('nisn', $user->nim ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>2. Nama Sekolah <span class="text-danger">*</span></label>
                                <input type="text" name="nama_sekolah" class="form-control-custom" placeholder="Contoh: SMKN 1 Tanjungbalai" value="{{ old('nama_sekolah') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>3. Jurusan / Program Keahlian <span class="text-danger">*</span></label>
                                <input type="text" name="jurusan" class="form-control-custom" placeholder="Contoh: Teknik Komputer dan Jaringan" value="{{ old('jurusan') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>4. Kelas <span class="text-danger">*</span></label>
                                <input type="text" name="kelas" class="form-control-custom" placeholder="Contoh: XII TKJ 2" value="{{ old('kelas') }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>5. Nama Guru Pembimbing <span class="text-danger">*</span></label>
                            <input type="text" name="nama_guru_pembimbing" class="form-control-custom" placeholder="Nama Lengkap Guru Pembimbing Sekolah" value="{{ old('nama_guru_pembimbing') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>6. Email Guru Pembimbing <span class="text-danger">*</span></label>
                                <input type="email" name="email_guru_pembimbing" class="form-control-custom" placeholder="pembimbing@sekolah.sch.id" value="{{ old('email_guru_pembimbing') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>7. Nomor HP Guru Pembimbing <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp_guru_pembimbing" class="form-control-custom" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_guru_pembimbing') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- B. DATA ORANG TUA / WALI -->
                    <!-- ========================================== -->
                    <div class="section-card">
                        <div class="section-title">
                            <div class="section-badge">B</div>
                            <h5>Data Orang Tua / Wali</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-7 form-group">
                                <label>1. Nama Orang Tua / Wali <span class="text-danger">*</span></label>
                                <input type="text" name="nama_wali" class="form-control-custom" placeholder="Nama Lengkap Orang Tua / Wali" value="{{ old('nama_wali', $user->nama_wali ?? '') }}" required>
                            </div>
                            <div class="col-md-5 form-group">
                                <label>2. Hubungan dengan Siswa <span class="text-danger">*</span></label>
                                <select name="hubungan_wali" class="form-control-custom" required>
                                    <option value="">-- Pilih Hubungan --</option>
                                    <option value="Ayah" {{ old('hubungan_wali') == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                                    <option value="Ibu" {{ old('hubungan_wali') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                                    <option value="Wali" {{ old('hubungan_wali') == 'Wali' ? 'selected' : '' }}>Wali</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>3. Nomor HP Orang Tua / Wali <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp_wali" class="form-control-custom" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_wali', $user->no_hp_wali ?? '') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>4. Email Orang Tua / Wali <span class="text-danger">*</span></label>
                                <input type="email" name="email_wali" class="form-control-custom" placeholder="orangtua@email.com" value="{{ old('email_wali', $user->email_wali ?? '') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- C. DATA PELAKSANAAN MAGANG -->
                    <!-- ========================================== -->
                    <div class="section-card">
                        <div class="section-title">
                            <div class="section-badge">C</div>
                            <h5>Data Pelaksanaan Magang</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label><i class="far fa-calendar-alt text-primary mr-1"></i> 1. Tanggal Mulai Magang <span class="text-danger">*</span></label>
                                <input type="date" name="dari_tanggal" class="form-control-custom" value="{{ old('dari_tanggal') }}" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label><i class="far fa-calendar-check text-success mr-1"></i> 2. Tanggal Selesai Magang <span class="text-danger">*</span></label>
                                <input type="date" name="sampai_tanggal" class="form-control-custom" value="{{ old('sampai_tanggal') }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- ========================================== -->
                    <!-- D. DOKUMEN PERSYARATAN -->
                    <!-- ========================================== -->
                    <div class="section-card">
                        <div class="section-title">
                            <div class="section-badge">D</div>
                            <h5>Dokumen Persyaratan</h5>
                        </div>

                        <!-- 1. CV Siswa -->
                        <div class="file-upload-card">
                            <div class="doc-title">
                                <i class="fas fa-file-pdf text-danger"></i>
                                <span>1. CV Siswa (PDF) <span class="text-danger">*</span></span>
                            </div>
                            <div class="doc-desc">
                                Berisi identitas lengkap, riwayat pendidikan, dan keterampilan siswa. (Format: PDF, Maks 2MB).
                            </div>
                            <input type="file" name="cv" accept=".pdf" required>
                        </div>

                        <!-- 2. Surat Pengantar Magang dari Sekolah -->
                        <div class="file-upload-card">
                            <div class="doc-title">
                                <i class="fas fa-file-invoice text-info"></i>
                                <span>2. Surat Pengantar Magang dari Sekolah (PDF) <span class="text-danger">*</span></span>
                            </div>
                            <div class="doc-desc">
                                Sebagai bukti bahwa siswa mendapat izin atau rekomendasi resmi dari pihak sekolah. (Format: PDF, Maks 2MB).
                            </div>
                            <input type="file" name="surat_pengantar" accept=".pdf" required>
                        </div>

                        <!-- 3. Surat Izin Orang Tua/Wali -->
                        <div class="file-upload-card">
                            <div class="doc-title">
                                <i class="fas fa-file-signature text-warning"></i>
                                <span>3. Surat Izin Orang Tua / Wali (PDF) <span class="text-danger">*</span></span>
                            </div>
                            <div class="doc-desc">
                                Sebagai bukti persetujuan orang tua/wali untuk pelaksanaan magang. (Format: PDF, Maks 2MB).
                            </div>
                            <input type="file" name="surat_izin_wali" accept=".pdf" required>
                        </div>

                        <!-- 4. Pas Foto Siswa -->
                        <div class="file-upload-card">
                            <div class="doc-title">
                                <i class="fas fa-id-badge text-primary"></i>
                                <span>4. Pas Foto Siswa (JPG/PNG) <span class="text-danger">*</span></span>
                            </div>
                            <div class="doc-desc">
                                Foto formal/rapi berlatar polos untuk kebutuhan identitas peserta magang. (Format: JPG, JPEG, PNG, Maks 2MB).
                            </div>
                            <input type="file" name="gambar" accept=".jpg,.jpeg,.png" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane mr-2"></i> Kirim Formulir Pendaftaran
                    </button>
                </form>

                @endif

            </div>
        </div>
    </div>
</div>

@endsection
