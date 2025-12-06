@extends('layouts.app')

@section('content')

{{-- CSS MODERN & CLEAN UI --}}
<style>
    /* 1. Background Halaman: BIRU SESUAI LOGO (Gradient Modern) */
    body {
        /* Ganti kode warna hex di bawah ini jika ingin biru yang spesifik */
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%); 
        /* Fallback jika gradasi tidak muncul */
        background-color: #2563eb; 
        font-family: 'Nunito', sans-serif;
        min-height: 100vh; /* Agar warna full satu layar */
    }

    /* 2. Styling Card Utama */
    .card-registration {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 50px rgba(0,0,0,0.2); /* Bayangan lebih kuat agar kontras dengan biru */
        background: #ffffff; /* Tetap Putih agar tulisan terbaca */
        overflow: hidden;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    /* Header Form */
    .form-header {
        text-align: center;
        padding: 40px 30px 20px 30px;
        border-bottom: 1px solid #f1f5f9;
    }
    .form-header h4 {
        color: #2563eb; /* Biru Modern */
        font-weight: 800;
        margin-bottom: 10px;
    }
    .form-header p {
        color: #64748b;
        font-size: 0.95rem;
    }

    /* Label Input */
    .form-label {
        font-weight: 600;
        color: #334155;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    /* Input Fields */
    .form-control {
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px 15px;
        font-size: 0.95rem;
        transition: all 0.3s;
        background-color: #f8fafc;
    }

    .form-control:focus {
        border-color: #2563eb;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1); /* Efek glow biru saat diklik */
    }

    /* Styling Input File yang lebih cantik */
    input[type="file"] {
        padding: 10px;
        background-color: #f1f5f9;
    }
    input[type="file"]::-webkit-file-upload-button {
        background: #2563eb;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        margin-right: 15px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.85rem;
        transition: 0.3s;
    }
    input[type="file"]::-webkit-file-upload-button:hover {
        background: #1d4ed8;
    }

    /* Tombol Submit */
    .btn-daftar {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px;
        width: 100%;
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-daftar:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
        color: white;
    }

    /* Section Divider */
    .section-divider {
        display: flex;
        align-items: center;
        text-align: center;
        margin: 30px 0;
        color: #94a3b8;
    }
    .section-divider::before, .section-divider::after {
        content: '';
        flex: 1;
        border-bottom: 1px dashed #cbd5e1;
    }
    .section-divider span {
        padding: 0 15px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    /* Copyright Text agar terlihat di background biru */
    .footer-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.85rem;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card card-registration">
                
                {{-- Bagian Judul --}}
                <div class="form-header">
                    <h4>Form Pendaftaran Magang</h4>
                    <p>Silakan lengkapi biodata dan berkas Anda di bawah ini</p>
                </div>

                <div class="card-body p-4 pt-0">

                    {{-- Pesan Sukses --}}
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm rounded-3 mt-4 mb-4" style="background-color: #dcfce7; color: #166534;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div>
                    @endif

                    {{-- Pesan Error --}}
                    @if(session('err_message'))
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 mt-4 mb-4" style="background-color: #fee2e2; color: #991b1b;">
                            <i class="fas fa-exclamation-triangle me-2"></i> {{ session('err_message') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 mt-4 mb-4" style="background-color: #fee2e2; color: #991b1b;">
                            <ul class="mb-0 ps-3 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('insert-pendaftaran') }}" enctype="multipart/form-data" class="mt-3">
                        @csrf

                        {{-- Section Data Akademik --}}
                        <div class="mb-3">
                            <label class="form-label">Universitas</label>
                            <input type="text" name="universitas" class="form-control" placeholder="Contoh: Universitas Indonesia" value="{{ old('universitas') }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Jurusan</label>
                                <input type="text" name="jurusan" class="form-control" placeholder="Contoh: Teknik Informatika" value="{{ old('jurusan') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Program Studi</label>
                                <input type="text" name="prodi" class="form-control" placeholder="Contoh: Sistem Informasi" value="{{ old('prodi') }}" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="form-label">Mulai Magang</label>
                                <input type="date" name="dari_tanggal" class="form-control" value="{{ old('dari_tanggal') }}" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Selesai Magang</label>
                                <input type="date" name="sampai_tanggal" class="form-control" value="{{ old('sampai_tanggal') }}" required>
                            </div>
                        </div>

                        {{-- Divider Pemisah --}}
                        <div class="section-divider">
                            <span><i class="fas fa-cloud-upload-alt me-1"></i> Upload Berkas</span>
                        </div>

                        {{-- Loop untuk Upload File --}}
                        @foreach(['gambar'=>'Foto Diri','cv'=>'CV','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal Magang'] as $name => $label)
                            <div class="mb-3">
                                <label class="form-label d-flex justify-content-between">
                                    {{ $label }}
                                    <span class="text-muted fw-normal" style="font-size: 0.75rem;">(PDF/JPG, Max 2MB)</span>
                                </label>
                                <input type="file" name="{{ $name }}" class="form-control">
                            </div>
                        @endforeach

                        <div class="mt-4 mb-2">
                            <button type="submit" class="btn btn-daftar">
                                Kirim Pendaftaran <i class="fas fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                    </form>

                </div>
            </div>

            <div class="text-center mb-5 footer-text">
       
            </div>

        </div>
    </div>
</div>
@endsection