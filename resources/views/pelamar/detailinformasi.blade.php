@extends('template.master')

@section('title', 'Detail Informasi')

@section('contents')

<style>
    .container-blog {
        width: 80%;
        margin: auto;
    }
    @media(max-width: 768px) {
        .container-blog {
            width: 90%; /* Sedikit diperlebar untuk mobile */
        }
    }
    .img-detail {
        width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
</style>

<section id="tentang" class="mt-5 mb-5">
    <div class="container-blog">
        <div id="contact" class="contact-area">
            <div class="contact-inner area-padding">
                
                {{-- Pengecekan jika data ada --}}
                @if(isset($data['informasi']) && $data['informasi'])
                    
                    {{-- Gambar --}}
                    <img src="{{ asset('gambar_informasi/'.$data['informasi']->gambar_informasi) }}" class="img-detail" alt="Gambar Informasi">
                    
                    {{-- Judul --}}
                    <h3 class="mt-4 font-weight-bold text-primary">{{ $data['informasi']->judul_informasi }}</h3>  
                    
                    {{-- Tanggal (Format lebih rapi) --}}
                    <div class="text-muted mb-3">
                        <i class="fas fa-calendar-alt mr-1"></i> 
                        {{ \Carbon\Carbon::parse($data['informasi']->tgl_informasi)->format('d F Y') }}
                    </div>
                    
                    {{-- Isi / Deskripsi --}}
                    <div class="text-justify" style="line-height: 1.8; color: #4a5568;">
                        {!! nl2br(e($data['informasi']->isi_informasi)) !!}
                    </div>

                @else
                    {{-- Tampilan jika data tidak ditemukan (Pencegahan Error) --}}
                    <div class="alert alert-warning text-center">
                        <h4><i class="fas fa-exclamation-triangle"></i> Maaf</h4>
                        <p>Data informasi yang Anda cari tidak ditemukan atau telah dihapus.</p>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Kembali</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</section>

@endsection