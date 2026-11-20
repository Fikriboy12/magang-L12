@extends('template.master') 

@section('title', 'Profile Saya')

@section('contents')

{{-- CSS MODERN PROFILE --}}
<style>
    /* Background Halaman Ambient Light Tech (Selaras dengan Login) */
    body {
        background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                    radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                    radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                    linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%) !important;
        font-family: 'Roboto', 'Plus Jakarta Sans', sans-serif;
    }

    .content-wrapper {
        background: transparent !important;
    }

    /* Kartu Utama Berdimensi & Aksen Garis Atas Logo */
    .card-custom {
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-top: 4px solid #3ECCE9; /* Garis aksen atas warna Cyan Logo ANMS */
        border-radius: 18px;
        box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.12), 0 0 25px rgba(62, 204, 233, 0.12);
        margin-top: 30px;
        margin-bottom: 40px;
        background: #ffffff;
        overflow: hidden;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* Header Kartu Bersih & Berkelas */
    .card-header-custom {
        background: #ffffff;
        padding: 35px 25px 20px 25px;
        border-radius: 18px 18px 0 0 !important;
        text-align: center;
        border-bottom: 1px solid #f1f5f9;
        position: relative;
    }

    .header-icon-badge {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(62, 204, 233, 0.18) 0%, rgba(2, 132, 199, 0.18) 100%);
        border: 1.5px solid rgba(62, 204, 233, 0.45);
        color: #0284c7;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin-bottom: 12px;
        box-shadow: 0 4px 15px rgba(62, 204, 233, 0.25);
    }

    .card-header-custom h2 {
        font-weight: 800;
        letter-spacing: -0.3px;
        margin-bottom: 6px;
        color: #0f172a; /* Deep Navy Korporat */
        font-size: 1.8rem;
    }

    .card-header-custom p {
        color: #64748b;
        font-size: 0.92rem;
        font-weight: 500;
    }

    /* Label Input */
    .form-label {
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
        font-size: 0.92rem;
        display: block;
    }

    /* Input Field Modern */
    .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        padding: 12px 15px;
        font-size: 0.95rem;
        background-color: #f8fafc;
        transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        color: #0f172a;
        height: 48px;
    }

    .form-control:focus {
        background-color: #ffffff;
        border-color: #0284c7;
        box-shadow: 0 0 0 3px rgba(62, 204, 233, 0.28);
        color: #0f172a;
    }

    /* --- PERBAIKAN DROPDOWN (SELECT) --- */
    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%230284c7' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px 12px;
        cursor: pointer;
        padding-right: 40px;
    }

    /* Readonly Input Style */
    .form-control[readonly] {
        background-color: #f1f5f9;
        border-color: #e2e8f0;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Tombol Update Gradasi Logo */
    .btn-update-custom {
        background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
        color: #ffffff;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        padding: 13px 45px;
        font-size: 1rem;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(2, 132, 199, 0.35);
        margin-top: 20px;
    }

    .btn-update-custom:hover {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(2, 132, 199, 0.45);
        color: #ffffff;
    }

    /* Alert Styles */
    .alert-custom {
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    /* Textarea butuh tinggi otomatis */
    textarea.form-control {
        height: auto !important;
    }
</style>

<div class="content-wrapper" style="min-height: 90vh;">
    <section class="content pt-4 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">

                    <div class="card card-custom">
                        
                        <div class="card-header-custom">
                            <div class="header-icon-badge">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h2>Update Profile</h2>
                            <p class="mb-0">Perbarui informasi data diri Anda dengan benar</p>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show alert-custom mb-4" role="alert" style="background-color: #d1fae5; color: #065f46;">
                                    <i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('err_message'))
                                <div class="alert alert-danger alert-dismissible fade show alert-custom mb-4" role="alert" style="background-color: #fee2e2; color: #991b1b;">
                                    <i class="fas fa-exclamation-circle me-2"></i> <strong>Error!</strong> {{ session('err_message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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

                            <form method="POST" action="{{ url('update-profile-users') }}" class="needs-validation" novalidate>
                                @csrf
                                @method('POST')

                                <div class="form-group mb-4">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama_lengkap" required 
                                           value="{{ old('nama_lengkap', $data['profile']->name) }}">
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Email <small class="text-muted font-weight-normal">(Tidak dapat diubah)</small></label>
                                            <input type="email" name="email" class="form-control" 
                                                   value="{{ old('email', $data['profile']->email) }}" readonly>
                                        </div> 
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">No Telepon</label>
                                            <input type="text" name="no_telp" class="form-control" required
                                                   value="{{ old('no_telp', $data['profile']->no_telp) }}">
                                        </div> 
                                    </div>
                                </div>

                                {{-- BAGIAN NIM (NIK SUDAH DIHAPUS) --}}
                                <div class="form-group mb-4">
                                    <label class="form-label">NIM</label>
                                    <input type="text" name="nim" class="form-control" required
                                           value="{{ old('nim', $data['profile']->nim) }}">
                                </div>

                                <hr class="my-4" style="border-top: 1px dashed #cbd5e1;">

                                <div class="form-group mb-4">
                                    <label class="form-label">Ganti Password <small class="text-muted font-weight-normal">(Kosongkan jika tidak ingin mengubah)</small></label>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan password baru...">
                                </div>

                                <div class="text-center mt-5">
                                    <button type="submit" class="btn btn-update-custom">
                                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection