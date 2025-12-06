@extends('template.master')

@section('title', 'Detail Informasi')

@section('contents')

<style>
    .detail-section {
        padding-top: 120px;
        padding-bottom: 80px;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    .container-blog {
        width: 80%;
        margin: auto;
        background: #ffffff;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    }

    @media(max-width: 768px) {
        .container-blog {
            width: 95%; 
            padding: 20px;
        }
    }

    .img-wrapper {
        width: 100%;
        height: 450px;
        background-color: #e2e8f0;
        border-radius: 15px;
        overflow: hidden;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .img-detail {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .img-wrapper:hover .img-detail {
        transform: scale(1.02);
    }

    .blog-date {
        color: #2563eb;
        font-weight: 600;
        font-size: 14px;
        background: rgba(37, 99, 235, 0.1);
        padding: 5px 15px;
        border-radius: 50px;
        display: inline-block;
        margin-bottom: 15px;
    }

    .blog-title {
        font-size: 32px;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 25px;
        line-height: 1.4;
    }

    .blog-content {
        font-size: 16px;
        line-height: 1.8;
        color: #475569;
        text-align: justify;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #0f172a;
        color: #ffffff;
        padding: 10px 25px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
        margin-bottom: 20px;
    }
    .btn-back:hover {
        background: #2563eb;
        color: #ffffff;
        transform: translateX(-5px);
    }
</style>

<section class="detail-section">
    <div class="container">
        
        <div class="container-blog">
            
            {{-- Tombol Kembali --}}
            <a href="{{ url('/') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>

            {{-- Pengecekan data --}}
            @if(isset($data['informasi']) && $data['informasi'])
                
                {{-- 1. GAMBAR (Path ke assets_admin/img/informasi) --}}
                <div class="img-wrapper">
                    <img src="{{ asset('assets_admin/img/informasi/'.$data['informasi']->gambar_informasi) }}" 
                         class="img-detail" 
                         alt="{{ $data['informasi']->judul }}"
                         onerror="this.onerror=null; this.src='https://placehold.co/800x450?text=Gambar+Tidak+Ditemukan';">
                </div>
                
                <div class="text-center">
                    {{-- 2. TANGGAL --}}
                    <div class="mb-2">
                        <span class="blog-date">
                            <i class="fa-regular fa-calendar-days mr-1"></i> 
                            {{ \Carbon\Carbon::parse($data['informasi']->tgl_informasi)->format('d F Y') }}
                        </span>
                    </div>

                    {{-- 3. JUDUL (Gunakan 'judul' bukan 'judul_informasi') --}}
                    <h1 class="blog-title">{{ $data['informasi']->judul }}</h1> 
                </div>

                <hr style="margin: 30px 0; border-color: #f1f5f9;">
                
                {{-- 4. DESKRIPSI (Gunakan 'deskripsi' bukan 'isi_informasi') --}}
                <div class="blog-content">
                    {!! nl2br(e($data['informasi']->deskripsi)) !!}
                </div>

            @else
                {{-- Tampilan Error --}}
                <div class="alert alert-warning text-center" role="alert">
                    <h4 class="alert-heading"><i class="fas fa-exclamation-triangle"></i> Maaf!</h4>
                    <p>Data informasi yang Anda cari tidak ditemukan atau telah dihapus.</p>
                </div>
            @endif

        </div>
    </div>
</section>

@endsection