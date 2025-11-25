@extends('template.master') 

@section('title', 'Profile Saya')

@section('contents')

{{-- CSS MODERN PROFILE --}}
<style>
    /* Background Halaman */
    body {
        background-color: #f8fafc !important;
        font-family: 'Nunito', sans-serif;
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

    /* Header Kartu */
    .card-header-custom {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 25px;
        border-radius: 15px 15px 0 0 !important;
        text-align: center;
        border-bottom: 2px solid #f1f1f1;
    }

    .card-header-custom h2 {
        font-weight: 800;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        color: white;
        font-size: 1.8rem;
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
        height: 50px; /* Tinggi fix agar semua sejajar */
    }

    .form-control:focus {
        background-color: white;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    /* --- PERBAIKAN DROPDOWN (SELECT) --- */
    select.form-control {
        appearance: none; /* Hapus panah bawaan browser */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%231e3c72' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 16px 12px;
        cursor: pointer;
        padding-right: 40px; /* Ruang untuk panah */
    }
    /* ----------------------------------- */

    /* Readonly Input Style */
    .form-control[readonly] {
        background-color: #eaecf4;
        color: #6e707e;
        cursor: not-allowed;
    }

    /* Tombol Update */
    .btn-update-custom {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        padding: 14px 40px;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(30, 60, 114, 0.2);
        margin-top: 20px;
    }

    .btn-update-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
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

<div class="content-wrapper" style="background-color: #f4f6f9; min-height: 90vh;">
    <section class="content pt-4 pb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">

                    <div class="card card-custom">
                        
                        <div class="card-header-custom">
                            <h2><i class="fas fa-user-circle mr-2"></i> Update Profile</h2>
                            <p class="mb-0 text-white-50 small">Perbarui informasi data diri Anda dengan benar</p>
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

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">NIM</label>
                                            <input type="text" name="nim" class="form-control" required
                                                   value="{{ old('nim', $data['profile']->nim) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">NIK</label>
                                            <input type="text" name="nik" class="form-control" required
                                                   value="{{ old('nik', $data['profile']->nik) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Tempat Lahir</label>
                                            <input type="text" name="tempat_lahir" class="form-control" required
                                                   value="{{ old('tempat_lahir', $data['profile']->tempat_lahir) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="form-group">
                                            <label class="form-label">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" required
                                                   value="{{ old('tanggal_lahir', $data['profile']->tanggal_lahir) }}">
                                        </div>
                                    </div>
                                </div>

                                {{-- PERBAIKAN TAMPILAN SELECT JENIS KELAMIN --}}
                                <div class="form-group mb-4">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="Laki-laki" {{ (old('jenis_kelamin', $data['profile']->jenis_kelamin) == 'Laki-laki' || $data['profile']->jenis_kelamin == 'laki-laki') ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ (old('jenis_kelamin', $data['profile']->jenis_kelamin) == 'Perempuan' || $data['profile']->jenis_kelamin == 'perempuan') ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Agama</label>
                                    {{-- Dibuat select agar lebih rapi daripada input text manual --}}
                                    <select name="agama" class="form-control" required>
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="Islam" {{ (old('agama', $data['profile']->agama) == 'Islam') ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ (old('agama', $data['profile']->agama) == 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                        <option value="Hindu" {{ (old('agama', $data['profile']->agama) == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ (old('agama', $data['profile']->agama) == 'Buddha') ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ (old('agama', $data['profile']->agama) == 'Konghucu') ? 'selected' : '' }}>Konghucu</option>
                                        {{-- Fallback jika data lama bukan dari list --}}
                                        @if(!in_array($data['profile']->agama, ['Islam','Kristen','Hindu','Buddha','Konghucu']) && $data['profile']->agama)
                                            <option value="{{ $data['profile']->agama }}" selected>{{ $data['profile']->agama }}</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="4" required>{{ old('alamat', $data['profile']->alamat ?? $data['profile']->alamat_lengkap) }}</textarea>
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