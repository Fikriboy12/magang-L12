@extends('template.master')

@section('title', 'Pendaftaran Magang')

@section('contents')

<style>
    /* 1. Latar Belakang Biru Gradient */
    .pendaftaran-page {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); 
        background-color: #2563eb; 
        min-height: 100vh;
        padding: 120px 0 60px 0;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* 2. Container Dibuat Lebih Ramping (Tidak terlalu lebar) */
    .container-custom {
        max-width: 650px; /* Ukuran diperkecil agar pas di tengah dan memanjang ke bawah */
        margin: auto;
        padding: 0 20px;
    }

    /* 3. Kartu Putih Modern */
    .card-pendaftaran {
        background: #ffffff;
        border-radius: 25px;
        border: none;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .card-header-custom {
        padding: 40px 30px 10px 30px;
        text-align: center;
    }

    .card-header-custom h2 {
        color: #2563eb;
        font-weight: 800;
        font-size: 26px;
        margin-bottom: 8px;
    }

    .card-header-custom p {
        color: #64748b;
        font-size: 14px;
    }

    /* 4. Styling Input */
    .form-body {
        padding: 20px 40px 40px 40px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: 700;
        color: #334155;
        font-size: 14px;
        margin-bottom: 8px;
        display: block;
    }

    .form-control-custom {
        background-color: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s;
    }

    .form-control-custom:focus {
        border-color: #2563eb;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    /* 5. Styling Upload Berkas (Satu Kolom ke Bawah) */
    .file-input-wrapper {
        background-color: #f1f5f9;
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 12px;
        transition: 0.3s;
    }

    .file-input-wrapper:hover {
        border-color: #2563eb;
        background-color: #eff6ff;
    }

    /* 6. Judul Section Berkas */
    .section-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 30px 0 20px 0;
        color: #2563eb;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 12px;
    }

    .section-divider::before, .section-divider::after {
        content: '';
        flex: 1;
        border-bottom: 2px solid #f1f5f9;
    }

    .section-divider span {
        padding: 0 15px;
    }

    /* 7. Tombol Kirim */
    .btn-submit {
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        padding: 16px;
        font-weight: 800;
        font-size: 16px;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        margin-top: 10px;
    }

    .btn-submit:hover {
        background: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .form-body { padding: 20px; }
        .card-pendaftaran { border-radius: 15px; }
        .container-custom { padding: 0 15px; }
    }
</style>

<div class="pendaftaran-page">
    <div class="container-custom">
        <div class="card-pendaftaran wow animate__animated animate__fadeInUp">
            
            <div class="card-header-custom">
                <h2>Form Pendaftaran Magang</h2>
                <p>Silakan isi data diri dan upload dokumen Anda</p>
            </div>

            <div class="form-body">
                <form action="{{ url('insert-pendaftaran') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Bagian Biodata (Satu per baris) --}}
                    <div class="form-group">
                        <label>Universitas / Sekolah</label>
                        <input type="text" name="universitas" class="form-control-custom" placeholder="Contoh: Universitas Indonesia" required>
                    </div>

                    <div class="form-group">
                        <label>Jurusan</label>
                        <input type="text" name="jurusan" class="form-control-custom" placeholder="Contoh: Teknik Informatika" required>
                    </div>

                    <div class="form-group">
                        <label>Program Studi</label>
                        <input type="text" name="prodi" class="form-control-custom" placeholder="Contoh: Sistem Informasi" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-calendar-alt mr-1"></i> Mulai Magang</label>
                        <input type="date" name="dari_tanggal" class="form-control-custom" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-calendar-check mr-1"></i> Selesai Magang</label>
                        <input type="date" name="sampai_tanggal" class="form-control-custom" required>
                    </div>

                    <div class="section-divider">
                        <span><i class="fa fa-cloud-upload-alt mr-1"></i> Kelengkapan Berkas</span>
                    </div>

                    {{-- Bagian Upload Berkas (Satu per baris / Satu kolom) --}}
                    @php
                        $files = [
                            'gambar' => 'Foto Diri (Max 2MB)',
                            'cv' => 'Curriculum Vitae (PDF)',
                            'surat_rekomendasi' => 'Surat Rekomendasi (PDF)',
                            'ktp' => 'KTP / KTM (JPG/PNG)',
                            'proposal' => 'Proposal Magang (PDF)'
                        ];
                    @endphp

                    @foreach($files as $name => $label)
                    <div class="form-group">
                        <label>{{ $label }}</label>
                        <div class="file-input-wrapper">
                            <input type="file" name="{{ $name }}" class="w-100" required>
                        </div>
                    </div>
                    @endforeach

                    <button type="submit" class="btn-submit">
                        Kirim Pendaftaran <i class="fa fa-paper-plane ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection