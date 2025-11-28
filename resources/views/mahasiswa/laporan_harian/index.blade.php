@extends('template.master') 

@section('title', 'Daftar Laporan Harian')

@section('contents')

<style>
    /* CSS Header Modern */
    .hd-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        color: white !important;
        padding: 30px;
        border-radius: 15px 15px 0 0;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        position: relative;
        overflow: hidden;
    }

    /* Dekorasi Header */
    .hd-header::before {
        content: ''; position: absolute; top: -20px; right: -20px;
        width: 100px; height: 100px; background: rgba(255,255,255,0.1); border-radius: 50%;
    }

    /* Thumbnail Foto di Tabel */
    .img-thumbnail-custom {
        width: 80px; height: 60px; object-fit: cover;
        border-radius: 8px; border: 2px solid #e2e8f0;
        transition: transform 0.3s ease;
        cursor: pointer;
    }
    .img-thumbnail-custom:hover { transform: scale(1.1); border-color: #3b82f6; }

    /* --- CSS UNTUK FORM MODAL --- */
    .form-control-custom {
        border-radius: 10px; padding: 10px 15px; border: 1px solid #e2e8f0;
        background-color: #f8fafc; font-size: 0.95rem;
    }
    .form-control-custom:focus {
        border-color: #3b82f6; background-color: #fff;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    .upload-box {
        border: 2px dashed #cbd5e1; border-radius: 12px; padding: 20px;
        text-align: center; background: #f8fafc; cursor: pointer; transition: all 0.3s;
    }
    .upload-box:hover { border-color: #3b82f6; background: #eff6ff; }
</style>

<div class="content-wrapper" style="background-color: #f8fafc;">
    <section class="content pt-5 pb-5">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-11">
                
                {{-- CARD UTAMA --}}
                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                    
                    {{-- Header Biru --}}
                    <div class="hd-header d-flex justify-content-between align-items-center">
                        <div style="z-index: 2;">
                            <h3 class="m-0 font-weight-bold">Laporan Harian</h3>
                            <p class="m-0 mt-1" style="opacity: 0.9;">Rekap aktivitas magang Anda</p>
                        </div>
                        <div style="z-index: 2;">
                            {{-- TOMBOL TAMBAH (MEMBUKA MODAL) --}}
                            <button type="button" class="btn btn-light text-primary font-weight-bold shadow-sm" style="border-radius: 50px;" data-toggle="modal" data-target="#modalTambahLaporan">
                                <i class="fas fa-plus mr-2"></i> Tambah Laporan
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        
                        {{-- Alert Notifikasi --}}
                        @if (session('success'))
                            <div class="alert alert-success fade show shadow-sm border-0" role="alert" style="border-radius: 10px;">
                                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        @endif

                        {{-- TABEL LAPORAN --}}
                        <div class="table-responsive">
                            <table class="table table-hover w-100" id="tableLaporan">
                                <thead style="background-color: #f1f5f9;">
                                    <tr>
                                        <th class="text-center" width="5%">No</th>
                                        <th width="20%">Tanggal</th>
                                        <th>Aktivitas</th>
                                        <th class="text-center" width="15%">Foto</th>
                                        <th class="text-center" width="15%">Status Validasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($laporan as $item)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            
                                            <td class="align-middle">
                                                <span class="badge badge-light text-primary" style="font-size: 0.9rem;">
                                                    <i class="far fa-calendar-alt mr-1"></i>
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                                                </span>
                                            </td>
                                            
                                            <td class="align-middle">
                                                <strong>{{ $item->kegiatan }}</strong>
                                                @if($item->catatan)
                                                    <br><small class="text-danger font-italic"><i class="fas fa-comment-dots"></i> Catatan Pembimbing: {{ $item->catatan }}</small>
                                                @endif
                                            </td>
                                            
                                            <td class="align-middle text-center">
                                                @if($item->foto)
                                                    @php
                                                        // Fix Path Foto
                                                        $fotoUrl = asset('laporan_harian/' . basename($item->foto));
                                                        if (str_contains($item->foto, '/')) {
                                                            $fotoUrl = asset($item->foto);
                                                        }
                                                    @endphp
                                                    
                                                    {{-- Thumbnail untuk Modal Preview Foto --}}
                                                    <a href="#" data-toggle="modal" data-target="#modalFoto{{ $item->id }}">
                                                        <img src="{{ $fotoUrl }}" class="img-thumbnail-custom">
                                                    </a>

                                                    {{-- MODAL PREVIEW FOTO (Pop-up Gambar Besar) --}}
                                                    <div class="modal fade" id="modalFoto{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content bg-transparent border-0 shadow-none">
                                                                <div class="modal-body text-center p-0">
                                                                    <button type="button" class="close text-white mb-2" data-dismiss="modal" style="opacity: 1; text-shadow: 0 1px 5px black;">&times;</button>
                                                                    <img src="{{ $fotoUrl }}" class="img-fluid rounded shadow-lg" style="max-height: 85vh;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="text-muted small">-</span>
                                                @endif
                                            </td>

                                            <td class="align-middle text-center">
                                                @if($item->status == 'approved')
                                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Disetujui</span>
                                                @elseif($item->status == 'rejected')
                                                    <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Ditolak</span>
                                                @else
                                                    <span class="badge badge-warning text-white"><i class="fas fa-clock"></i> Menunggu</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-clipboard-list fa-3x mb-3"></i><br>
                                                Belum ada laporan harian.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>

{{-- ================================================= --}}
{{-- MODAL TAMBAH LAPORAN (FORMULIR INPUT) --}}
{{-- ================================================= --}}
<div class="modal fade" id="modalTambahLaporan" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
            
            {{-- Header Modal --}}
            <div class="modal-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                <h5 class="modal-title font-weight-bold" id="modalLabel">
                    <i class="fas fa-edit mr-2"></i> Tulis Laporan Kegiatan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            {{-- Form Input --}}
            <form action="{{ route('mahasiswa.laporan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    
                    {{-- Input Tanggal --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Tanggal Kegiatan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal" class="form-control form-control-custom" value="{{ date('Y-m-d') }}" required>
                    </div>

                    {{-- Input Kegiatan --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Deskripsi Kegiatan <span class="text-danger">*</span></label>
                        <textarea name="kegiatan" class="form-control form-control-custom" rows="3" placeholder="Ceritakan aktivitas apa yang kamu lakukan..." required></textarea>
                    </div>

                    {{-- Input Catatan --}}
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">Lokasi / Catatan <small class="text-muted">(Opsional)</small></label>
                        <input type="text" name="catatan" class="form-control form-control-custom" placeholder="Contoh: Lantai 2">
                    </div>

                    {{-- Input Foto (Upload Area) --}}
                    <div class="form-group mb-0">
                        <label class="font-weight-bold text-dark">Foto Dokumentasi <span class="text-danger">*</span></label>
                        
                        <div class="upload-box" onclick="document.getElementById('fileInput').click()">
                            <i class="fas fa-cloud-upload-alt fa-2x text-primary mb-2"></i>
                            <p class="mb-0 font-weight-bold">Klik untuk upload foto</p>
                            <small class="text-muted">Format: JPG, PNG (Max 2MB)</small>
                            
                            {{-- Preview Gambar Upload --}}
                            <div id="previewContainer" class="mt-3" style="display: none;">
                                <img id="imagePreview" src="#" alt="Preview" class="img-fluid rounded border shadow-sm" style="max-height: 150px;">
                                <p id="fileName" class="text-success small mt-1 font-weight-bold mb-0"></p>
                            </div>
                        </div>

                        <input type="file" name="foto" id="fileInput" class="d-none" accept="image/*" onchange="previewUpload(this)">
                    </div>

                </div>

                {{-- Footer Modal --}}
                <div class="modal-footer bg-light" style="border-radius: 0 0 15px 15px;">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script Preview Gambar Upload --}}
<script>
    function previewUpload(input) {
        const file = input.files[0];
        const previewContainer = document.getElementById('previewContainer');
        const imagePreview = document.getElementById('imagePreview');
        const fileName = document.getElementById('fileName');
        
        if (file) {
            fileName.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                previewContainer.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            previewContainer.style.display = 'none';
        }
    }
</script>

@endsection