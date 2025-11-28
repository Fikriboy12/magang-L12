@extends('template.master') 

@section('title', 'Tambah Laporan Harian')

@section('contents')

<style>
    /* CUSTOM CSS UNTUK TAMPILAN MODERN */
    .hd-header {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%) !important;
        color: white !important;
        padding: 40px 30px;
        border-radius: 20px 20px 0 0;
        box-shadow: 0 4px 20px rgba(37, 99, 235, 0.2);
        position: relative;
        overflow: hidden;
    }

    /* Efek lingkaran dekorasi di header */
    .hd-header::before {
        content: '';
        position: absolute;
        top: -30px; right: -30px;
        width: 150px; height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    .hd-header::after {
        content: '';
        position: absolute;
        bottom: -50px; left: -20px;
        width: 100px; height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
    }
    
    .card-modern {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
        overflow: hidden;
        background: white;
    }

    .form-group label {
        font-weight: 600;
        color: #334155;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .form-control-custom {
        border-radius: 12px;
        padding: 15px;
        border: 1px solid #e2e8f0;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .form-control-custom:focus {
        border-color: #3b82f6;
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
    }

    /* AREA UPLOAD FILE MODERN */
    .upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 15px;
        padding: 40px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
    }

    .upload-box:hover {
        border-color: #3b82f6;
        background: #eff6ff;
        transform: translateY(-2px);
    }

    .upload-icon {
        font-size: 3rem;
        color: #94a3b8;
        margin-bottom: 15px;
        transition: color 0.3s;
    }

    .upload-box:hover .upload-icon {
        color: #3b82f6;
    }

    .btn-submit-modern {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        padding: 15px;
        border-radius: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        transition: all 0.3s;
    }

    .btn-submit-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(37, 99, 235, 0.4);
    }

    .btn-back-modern {
        background: white;
        color: #64748b;
        border: 1px solid #e2e8f0;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
    }

    .btn-back-modern:hover {
        background: #f1f5f9;
        color: #334155;
    }
    
    /* Preview Image Style */
    #imagePreview {
        max-width: 100%;
        max-height: 200px;
        border-radius: 10px;
        margin-top: 15px;
        display: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border: 2px solid #e2e8f0;
    }
</style>

<div class="content-wrapper" style="background-color: #f1f5f9; min-height: 100vh;">
    
    <section class="content pt-5 pb-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                
                {{-- Tombol Kembali --}}
                <div class="mb-4">
                    <a href="{{ route('mahasiswa.laporan.index') }}" class="btn-back-modern shadow-sm">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                    </a>
                </div>

                <div class="card card-modern">
                    
                    {{-- Header Biru --}}
                    <div class="hd-header text-center">
                        <h3 class="font-weight-bold mb-1"><i class="fas fa-edit mr-2"></i> Laporan Kegiatan</h3>
                        <p class="mb-0 text-white-50" style="font-size: 0.9rem;">Isi formulir di bawah ini dengan lengkap</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        
                        {{-- Form Mulai --}}
                        <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Input Tanggal --}}
                            <div class="form-group mb-4">
                                <label>Tanggal Kegiatan <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ date('Y-m-d') }}" required>
                                @error('tanggal') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Input Kegiatan --}}
                            <div class="form-group mb-4">
                                <label>Nama / Deskripsi Kegiatan <span class="text-danger">*</span></label>
                                <textarea name="kegiatan" class="form-control form-control-custom" rows="4" placeholder="Ceritakan aktivitas apa yang kamu lakukan hari ini..." required></textarea>
                                @error('kegiatan') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            {{-- Input Catatan --}}
                            <div class="form-group mb-4">
                                <label>Catatan Tambahan / Lokasi <span class="text-muted font-weight-normal">(Opsional)</span></label>
                                <input type="text" name="catatan" class="form-control form-control-custom" placeholder="Misal: Lantai 2, Ruang Server">
                            </div>

                            {{-- Input Foto (Upload Area Modern) --}}
                            <div class="form-group mb-5">
                                <label>Foto Dokumentasi <span class="text-danger">*</span></label>
                                
                                <div class="upload-box" onclick="document.getElementById('fileInput').click()">
                                    <i class="fas fa-cloud-upload-alt upload-icon"></i>
                                    <h6 class="font-weight-bold text-dark mb-1">Klik untuk upload foto</h6>
                                    <p class="text-muted small mb-0">Format: JPG, PNG (Max 2MB)</p>
                                    
                                    {{-- Preview Nama File --}}
                                    <p id="fileName" class="text-primary mt-3 font-weight-bold d-none mb-0"></p>
                                    
                                    {{-- Preview Gambar --}}
                                    <img id="imagePreview" src="#" alt="Preview Gambar">
                                </div>

                                <input type="file" name="foto" id="fileInput" class="d-none" accept="image/*" onchange="previewFile(this)">
                                @error('foto') <small class="text-danger d-block mt-2 font-weight-bold">{{ $message }}</small> @enderror
                            </div>

                            {{-- Tombol Submit --}}
                            <button type="submit" class="btn btn-primary btn-block btn-submit-modern">
                                <i class="fas fa-paper-plane mr-2"></i> KIRIM LAPORAN
                            </button>

                        </form>
                    </div>
                </div>

                {{-- Footer Kecil --}}
                <div class="text-center mt-4 text-muted small">
                    Pastikan data yang diisi sudah benar sebelum dikirim.
                </div>

            </div>
        </div>
      </div>
    </section>
</div>

{{-- SCRIPT JAVASCRIPT UNTUK PREVIEW GAMBAR --}}
<script>
    function previewFile(input) {
        const file = input.files[0];
        const fileNameDisplay = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');
        const uploadIcon = document.querySelector('.upload-icon');
        
        if (file) {
            // Tampilkan nama file
            fileNameDisplay.textContent = "File Terpilih: " + file.name;
            fileNameDisplay.classList.remove('d-none');
            
            // Tampilkan preview gambar
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'inline-block';
                uploadIcon.style.display = 'none'; // Sembunyikan ikon upload biar rapi
            }
            reader.readAsDataURL(file);
        } else {
            fileNameDisplay.classList.add('d-none');
            imagePreview.style.display = 'none';
            uploadIcon.style.display = 'block';
        }
    }
</script>

@endsection