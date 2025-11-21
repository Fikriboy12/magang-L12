@extends('layouts.app')

@section('content')

{{-- CSS MODERN FORM (Tema Biru Putih HD) --}}
<style>
    /* Background Halaman */
    body {
        background-color: #f4f6f9 !important;
        font-family: 'Nunito', sans-serif;
    }

    /* Header Kartu */
    .card-header-custom {
        background: #fff !important;
        color: #1e3c72;
        padding: 25px;
        border-radius: 15px 15px 0 0 !important;
        text-align: center;
        border-bottom: 2px solid #f1f1f1;
    }

    .card-header-custom h4 {
        font-weight: 800;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    /* Kartu Utama */
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0,0,0,0.05);
        margin-top: 40px;
        margin-bottom: 40px;
        background: white;
        overflow: hidden;
    }

    /* Label Input */
    .form-label {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 8px;
        font-size: 0.9rem;
        display: block;
    }

    /* Input Field Modern */
    .form-control {
        border: 1px solid #e3e6f0;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 0.95rem;
        background-color: #fdfdfd;
        transition: all 0.3s ease;
        color: #495057;
    }

    .form-control:focus {
        background-color: white;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    /* --- PERBAIKAN INPUT FILE MODERN --- */
    /* Kita styling tombol 'Choose File' bawaan browser agar cantik */
    input[type="file"] {
        padding: 8px 10px; /* Padding lebih kecil agar tidak kegedean */
        background-color: #f8f9fc;
        height: auto;
    }

    /* Styling Tombol 'Choose File' (Chrome/Edge/Safari) */
    input[type="file"]::-webkit-file-upload-button {
        background-color: #1e3c72; /* Biru Tua */
        color: white;
        border: none;
        padding: 6px 12px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: 0.3s;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #2563eb; /* Biru lebih terang saat hover */
    }
    /* ----------------------------------- */

    /* Tombol Submit */
    .btn-submit-custom {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        padding: 14px 30px;
        width: 100%;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(30, 60, 114, 0.2);
        margin-top: 20px;
    }

    .btn-submit-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <div class="card card-custom">
                
                <div class="card-header-custom">
                    <h4 class="mb-1">Form Pendaftaran Magang</h4>
                    <p class="mb-0 text-muted small">Silakan lengkapi data diri dan berkas Anda</p>
                </div>

                <div class="card-body p-4 p-md-5">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show alert-custom mb-4" role="alert" style="background-color: #d1fae5; color: #065f46;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('err_message'))
                        <div class="alert alert-danger alert-dismissible fade show alert-custom mb-4" role="alert" style="background-color: #fee2e2; color: #991b1b;">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('err_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-custom mb-4" style="background-color: #fee2e2; color: #991b1b;">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('insert-pendaftaran') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Universitas</label>
                            <input type="text" name="universitas" class="form-control" placeholder="Masukkan Nama Universitas" value="{{ old('universitas') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" value="{{ old('jurusan') }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Program Studi</label>
                            <input type="text" name="program_studi" class="form-control" placeholder="Masukkan Program Studi" value="{{ old('program_studi') }}" required>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="dari_tanggal" class="form-control" value="{{ old('dari_tanggal') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="sampai_tanggal" class="form-control" value="{{ old('sampai_tanggal') }}" required>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px solid #e3e6f0;">
                        <h6 class="fw-bold mb-4" style="color: #1e3c72;"><i class="fas fa-upload me-2"></i> Upload Berkas</h6>

                        {{-- 
                           PERBAIKAN: Input File Dibuat Ramping & Modern 
                           Struktur foreach dan name input TIDAK BERUBAH 
                        --}}
                        @foreach(['gambar'=>'Foto Diri (Pas Foto)','cv'=>'Curriculum Vitae (CV)','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal Magang'] as $name => $label)
                            <div class="mb-3">
                                <label class="form-label">{{ $label }}</label>
                                <input type="file" name="{{ $name }}" class="form-control">
                                <div class="form-text text-muted mt-1" style="font-size: 0.75rem;">
                                    Format: PDF/JPG/PNG (Max 2MB)
                                </div>
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-submit-custom">
                            <i class="fas fa-paper-plane me-2"></i> Daftar Sekarang
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection