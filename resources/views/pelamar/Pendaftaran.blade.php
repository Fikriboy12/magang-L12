@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center rounded-top-4" style="background-color: #370cf3ff;">
                    <h4 class="mb-0 fw-bold" style="f@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 650px; width: 100%;">
        <div class="card-header text-white text-center rounded-top-4" style="background-color: #3c0ee2ff;">
            <h4 class="mb-0 fw-semibold">Form Pendaftaran Magang</h4>
        </div>

        <div class="card-body p-4" style="background-color: #f8faff;">

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Pesan Error --}}
            @if(session('err_message'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('err_message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Validasi Error --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Form --}}
            <form method="POST" action="{{ url('insert-pendaftaran') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Universitas</label>
                    <input type="text" name="universitas" class="form-control" value="{{ old('universitas') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Program Studi</label>
                    <input type="text" name="program_studi" class="form-control" value="{{ old('program_studi') }}" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col">
                        <label class="form-label fw-semibold">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control" value="{{ old('dari_tanggal') }}" required>
                    </div>
                    <div class="col">
                        <label class="form-label fw-semibold">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control" value="{{ old('sampai_tanggal') }}" required>
                    </div>
                </div>

                @foreach(['gambar'=>'Gambar','cv'=>'CV','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal','sertifikat'=>'Sertifikat'] as $name => $label)
                    <div class="mb-3">
                        <label class="form-label fw-semibold">{{ $label }}</label>
                        <input type="file" name="{{ $name }}" class="form-control">
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Daftar Sekarang</button>
            </form>

        </div>
    </div>
</div>
@endsection
ont-size: 1.2rem;">Form Pendaftaran Magang</h4>
                </div>
                <div class="card-body p-4" style="background-color: #e7f0ff;">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    
                    {{-- Ini adalah baris yang error jika Anda tidak menggunakan kode controller yang sudah divalidasi --}}
                    @if(session('err_message')) 
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('err_message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    {{-- Menampilkan error validasi jika ada --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('insert-pendaftaran') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Universitas</label>
                            <input type="text" name="universitas" class="form-control" value="{{ old('universitas') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="{{ old('jurusan') }}" required>
                        </div>

                        <div class="mb-3">
                            <label>Program Studi</label>
                            <input type="text" name="program_studi" class="form-control" value="{{ old('program_studi') }}" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label>Dari Tanggal</label>
                                <input type="date" name="dari_tanggal" class="form-control" value="{{ old('dari_tanggal') }}" required>
                            </div>
                            <div class="col">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="sampai_tanggal" class="form-control" value="{{ old('sampai_tanggal') }}" required>
                            </div>
                        </div>

                        {{-- ====================================================== --}}
                        {{-- PERUBAHAN YANG BENAR ADA DI BARIS DI BAWAH INI --}}
                        {{-- Saya mengubah 'ktp_ktm' menjadi 'ktp' agar cocok dengan Database --}}
                        {{-- ====================================================== --}}
                        @foreach(['gambar'=>'Gambar','cv'=>'CV','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal','sertifikat'=>'Sertifikat'] as $name => $label)
                            <div class="mb-3">
                                <label>{{ $label }}</label>
                                <input type="file" name="{{ $name }}" class="form-control">
                            </div>
                        @endforeach

                        <button type="submit" class="btn btn-primary w-100 mt-3">Daftar Sekarang</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection