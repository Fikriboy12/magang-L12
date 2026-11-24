@extends('template.master')

@section('contents')

{{-- FONT & ANIMASI LIBRARY --}}
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* ======================================================== */
    /* 1. RESET CSS GLOBAL */
    /* ======================================================== */
    html, body {
        margin: 0 !important; padding: 0 !important;
        width: 100%; height: 100%; overflow-x: hidden;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: #f0f7ff; 
        background-attachment: fixed; color: #334155;
    }

    /* Agar saat klik menu scrollnya pas */
    html { scroll-behavior: smooth; }
    #home, #about, #services, #portfolio, #blog, #contact {
        scroll-margin-top: 90px;
    }

    /* ======================================================== */
    /* 2. SLIDER AREA */
    /* ======================================================== */
    .slider-area {
        position: relative; width: 100%; height: 100vh !important;
        background: #0f172a; overflow: hidden; padding: 0; margin: 0; z-index: 1;
    }

    .nivoSlider { position: relative; width: 100% !important; height: 100vh !important; overflow: hidden; }
    .nivoSlider img {
        width: 100vw !important; height: 100vh !important;
        object-fit: cover !important; object-position: center !important;
        position: absolute !important; top: 0; left: 0; max-width: none !important;
        filter: blur(6px) !important; -webkit-filter: blur(6px) !important; transform: scale(1.1); 
    }
    .nivo-slice, .nivo-box { display: none !important; }
    .nivo-main-image { display: block !important; width: 100vw !important; height: 100vh !important; opacity: 1 !important; }
    .slider-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.4); z-index: 2; pointer-events: none;
    }
    .nivo-controlNav {
        z-index: 100 !important; position: absolute; bottom: 40px; width: 100%;
        text-align: center; padding: 0; pointer-events: auto !important;
    }
    .nivo-controlNav a {
        display: inline-block; width: 40px; height: 4px; background: rgba(255,255,255,0.4);
        border-radius: 4px; margin: 0 5px; cursor: pointer; text-indent: -9999px; border: none; transition: all 0.3s;
    }
    .nivo-controlNav a.active { background: #00c6fb; width: 50px; }

    /* 3. CARD SLIDER TENGAH */
    .nivo-caption {
        background: transparent !important; width: 100%; height: 100%; top: 0; left: 0; padding: 0;
        position: absolute !important; z-index: 20; display: flex !important;
        align-items: center; justify-content: center; pointer-events: none;
    }
    .nivo-caption .container { position: relative; z-index: 25; width: 100%; display: flex; justify-content: center; pointer-events: none; }
    .slider-content { pointer-events: auto; }

    /* CARD SLIDER */
    .slider-glass-card {
        background: rgba(15, 23, 42, 0.22); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.28); border-radius: 26px;
        width: 90%; max-width: 760px; min-height: auto; padding: 48px 36px;
        display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;
        box-shadow: 0 25px 60px rgba(0,0,0,0.5); animation: cardZoom 0.8s ease-out;
    }
    @keyframes cardZoom { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .title1-hero {
        font-size: 13px; font-weight: 700; letter-spacing: 2.5px; text-transform: uppercase; color: #00c6fb;
        margin-bottom: 20px; display: inline-block; background: rgba(0, 198, 251, 0.15); padding: 8px 24px; border-radius: 50px; border: 1px solid rgba(0, 198, 251, 0.45);
    }
    .title2-hero {
        font-size: 40px; font-weight: 800; color: #ffffff; line-height: 1.3; margin-bottom: 30px; letter-spacing: -0.3px; text-shadow: 0 4px 18px rgba(0,0,0,0.6);
    }
    .btn-action-wrapper { 
        display: flex; justify-content: center; align-items: center; gap: 16px; width: 100%; max-width: 450px; flex-wrap: wrap; margin-top: auto; 
    }
    .btn-world-class {
        background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%); border: none; color: white !important; 
        padding: 12px 28px; border-radius: 50px; font-size: 13.5px;
        font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; text-decoration: none; 
        display: inline-flex; align-items: center; justify-content: center; min-width: 160px;
        box-shadow: 0 8px 25px -4px rgba(0, 91, 234, 0.45); transition: all 0.3s ease;
    }
    .btn-world-class:hover { transform: translateY(-2px); box-shadow: 0 12px 28px -4px rgba(0, 91, 234, 0.65); }
    .btn-glass-outline {
        background: rgba(255, 255, 255, 0.12); border: 1.5px solid rgba(255, 255, 255, 0.8); color: #fff !important; 
        padding: 11px 28px; border-radius: 50px; font-size: 13.5px;
        font-weight: 700; letter-spacing: 0.8px; text-transform: uppercase; text-decoration: none; 
        display: inline-flex; align-items: center; justify-content: center; min-width: 160px;
        backdrop-filter: blur(8px); transition: all 0.3s ease;
    }
    .btn-glass-outline:hover { background: #fff; color: #005bea !important; transform: translateY(-2px); }

    /* 4. CONTENT STYLE (FIXED) */
    .glass-card {
        background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 1); box-shadow: 0 10px 40px -10px rgba(0, 91, 234, 0.1);
        padding: 35px; margin-bottom: 25px; position: relative; 
        height: 100%; display: flex; flex-direction: column; 
        justify-content: flex-start;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }
    .glass-card:hover { 
        transform: translateY(-15px) !important; box-shadow: 0 30px 60px -12px rgba(0, 91, 234, 0.25) !important; border-color: #00c6fb !important; z-index: 10;
    }

    .section-headline {
        margin-bottom: 50px; width: 100%; display: flex; justify-content: center;
    }
    .section-headline h2 {
        font-size: 40px; font-weight: 800;
        background: linear-gradient(135deg, #004e92 0%, #00c6fb 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        margin: 0; display: flex; flex-direction: column; align-items: center; gap: 15px; 
    }
    .section-headline h2::after {
        content: ''; display: block; width: 70px; height: 5px; 
        background: linear-gradient(90deg, #005bea, #00c6fb); border-radius: 10px;
    }

    /* === KODE PERBAIKAN JUSTIFY AKHIR === */
    .text-rapi-justify {
        text-align: justify;
        -webkit-hyphens: auto;
        -ms-hyphens: auto;
        hyphens: auto;
    }
    /* === END KODE PERBAIKAN === */

    .floating-img-container {
        border-radius: 20px; overflow: hidden; box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        width: 100%; min-height: 400px; 
    }
    .floating-img-container img { width: 100%; height: 100%; object-fit: cover; }
    
    #portfolio .floating-img-container { min-height: 250px !important; height: 250px !important; }
    #portfolio .floating-img { width: 100%; height: 100%; object-fit: cover; }
    #blog .floating-img-container { min-height: 220px !important; height: 220px !important; border-radius: 20px 20px 0 0; }

    .icon-box-modern {
        width: 70px; height: 70px; background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; color: #0284c7; font-size: 28px;
        transition: all 0.5s ease; flex-shrink: 0;
    }
    .glass-card:hover .icon-box-modern { 
        transform: rotate(15deg) scale(1.1); background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%); 
        color: #fff; box-shadow: 0 10px 20px rgba(2, 132, 199, 0.35);
    }

    .animasi-masuk { opacity: 0; transform: translateY(40px); transition: 0.8s cubic-bezier(0.22, 1, 0.36, 1); }
    .animasi-masuk.aktif { opacity: 1; transform: translateY(0); }
    .delay-100 { transition-delay: 0.1s; } .delay-200 { transition-delay: 0.2s; } 
    .area-padding { padding: 80px 0; }

    .row-flex { display: flex; flex-wrap: wrap; }
    .col-flex { display: flex; align-items: stretch; }
    .w-100-flex { width: 100%; display: flex; flex-direction: column; }

    @media (max-width: 768px) {
        .slider-area, .nivoSlider img { height: 100vh !important; }
        .slider-glass-card { 
            width: 92% !important; 
            max-width: 420px !important;
            padding: 36px 20px !important; 
            min-height: auto !important; 
            height: auto !important; 
        }
        .title1-hero { 
            font-size: 11px !important; 
            padding: 6px 18px !important; 
            margin-bottom: 16px !important; 
            letter-spacing: 1.5px !important;
        }
        .title2-hero { 
            font-size: 26px !important; 
            line-height: 1.3 !important; 
            font-weight: 800 !important;
            margin-bottom: 24px !important; 
        }
        .btn-action-wrapper { 
            width: 100% !important; 
            margin-top: 15px !important; 
            gap: 10px !important;
        }
        .btn-world-class, .btn-glass-outline {
            min-width: 130px !important;
            font-size: 12px !important;
            padding: 10px 18px !important;
        }
        .glass-card { padding: 25px; margin-bottom: 20px; }
    }

    @media (max-width: 400px) {
        .title2-hero { font-size: 22px !important; }
        .btn-world-class, .btn-glass-outline {
            width: 100% !important;
        }
    }
</style>

<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('assets') }}/img/slider/banner1.jpg" alt="" title="#slider-direction-1" />
        <img src="{{ asset('assets') }}/img/slider/banner2.jpg" alt="" title="#slider-direction-2" />
        <img src="{{ asset('assets') }}/img/slider/banner3.jpg" alt="" title="#slider-direction-3" />
      </div>
      <div class="slider-overlay"></div>
      
      {{-- SLIDE 1 --}}
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content text-center">
                <div class="slider-glass-card">
                    <span class="title1-hero">PT Media Balai Nusa</span>
                    <h1 class="title2-hero">
                        Selamat Datang di <br> 
                        <span style="color: #00c6fb;">PT. MEDIA BALAI NUSA <br> astro net</span>
                    </h1>
                    <div class="btn-action-wrapper">
                      <a class="btn-world-class ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">REGISTRASI</a>
                      <a class="btn-glass-outline ready-btn page-scroll" href="#contact">CONTACT US</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- SLIDE 2 --}}
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content text-center">
                <div class="slider-glass-card">
                    <span class="title1-hero">PENGALAMAN KERJA NYATA</span>
                    <h1 class="title2-hero">
                        Bangun Pengalaman Kerja <br> 
                        <span style="color: #00c6fb;">Raih Masa Depan Gemilang</span>
                    </h1>
                    <div class="btn-action-wrapper">
                      <a class="btn-world-class ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">REGISTRASI</a>
                      <a class="btn-glass-outline ready-btn page-scroll" href="#contact">CONTACT US</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- SLIDE 3 --}}
      <div id="slider-direction-3" class="slider-direction slider-three">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content text-center">
                <div class="slider-glass-card">
                    <span class="title1-hero">KOLABORASI & TEKNOLOGI</span>
                    <h1 class="title2-hero">
                        Asah Keahlian Praktis <br> 
                        <span style="color: #00c6fb;">Bersama Mentor Profesional</span>
                    </h1>
                    <div class="btn-action-wrapper">
                        <a class="btn-world-class ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">REGISTRASI</a>
                        <a class="btn-glass-outline ready-btn page-scroll" href="#contact">CONTACT US</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<main id="main">

    <div id="about" class="about-area area-padding">
      <div class="container">
        {{-- SECTION TITLE --}}
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        
        {{-- 1. KARTU PROFIL PERUSAHAAN (BANNER UTAMA DENGAN LOGO) --}}
        <div class="row animasi-masuk" style="margin-bottom: 25px;">
          <div class="col-md-12">
            <div class="glass-card" style="padding: 35px 30px; margin-bottom: 0;">
              <div class="row align-items-center">
                
                {{-- BINGKAI LOGO --}}
                <div class="col-md-4 col-sm-12 text-center mb-4 mb-md-0">
                  <div style="background: #ffffff; border-radius: 20px; padding: 25px 20px; border: 1px solid rgba(0, 91, 234, 0.1); box-shadow: 0 10px 30px rgba(0, 91, 234, 0.08); display: inline-flex; align-items: center; justify-content: center; width: 100%; max-width: 280px; min-height: 200px;">
                    <img src="{{ asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan) }}" 
                         alt="Logo PT Media Balai Nusa" 
                         style="max-width: 100%; max-height: 160px; height: auto; object-fit: contain; filter: drop-shadow(0 4px 8px rgba(0,0,0,0.05));">
                  </div>
                </div>

                {{-- DESKRIPSI PROFIL --}}
                <div class="col-md-8 col-sm-12">
                  <div style="padding-left: 10px;">
                    <span style="display: inline-block; background: rgba(0, 91, 234, 0.1); color: #005bea; font-weight: 700; padding: 6px 16px; border-radius: 30px; font-size: 12px; letter-spacing: 0.8px; text-transform: uppercase; margin-bottom: 12px;">
                      <i class="fas fa-building mr-1"></i> Profil Perusahaan
                    </span>
                    <h3 style="font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 14px; letter-spacing: -0.5px;">
                      PT Media Balai Nusa
                    </h3>
                    <p style="font-size: 15.5px; line-height: 1.8; color: #475569; margin-bottom: 20px; text-align: left;">
                      {{ $data['profile']->deskripsi }}
                    </p>
                    
                    {{-- HIGHLIGHT FITUR / TAG --}}
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                      <span style="display: inline-flex; align-items: center; background: #f1f5f9; color: #334155; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                        <i class="fas fa-bolt text-warning" style="margin-right: 6px;"></i> Internet Serat Optik Cepat
                      </span>
                      <span style="display: inline-flex; align-items: center; background: #f1f5f9; color: #334155; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                        <i class="fas fa-map-marker-alt text-danger" style="margin-right: 6px;"></i> Tanjungbalai &amp; Bengkalis
                      </span>
                      <span style="display: inline-flex; align-items: center; background: #f1f5f9; color: #334155; padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600;">
                        <i class="fas fa-shield-alt text-success" style="margin-right: 6px;"></i> Stabil &amp; Terpercaya
                      </span>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>

        {{-- 2. KARTU VISI & MISI (2 KOLOM SEJAJAR: 50% - 50%) --}}
        <div class="row row-flex" style="display: flex; flex-wrap: wrap;">
          
          {{-- KARTU VISI --}}
          <div class="col-md-6 col-sm-6 col-xs-12 col-flex mb-4">
            <div class="animasi-masuk delay-100 w-100-flex" style="height: 100%;">
              <div class="glass-card" style="height: 100%; margin-bottom: 0; padding: 30px; display: flex; flex-direction: column;">
                <div style="display: flex; align-items: center; margin-bottom: 18px;">
                  <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 8px 18px rgba(0, 91, 234, 0.3); margin-right: 15px; flex-shrink: 0;">
                    <i class="fas fa-eye"></i>
                  </div>
                  <div>
                    <h4 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0;">Visi Perusahaan</h4>
                    <span style="font-size: 12px; color: #64748b; font-weight: 500;">Arah &amp; Tujuan Masa Depan</span>
                  </div>
                </div>
                <div style="font-size: 15px; line-height: 1.75; color: #475569; text-align: left; flex-grow: 1;">
                  {{ $data['profile']->visi ?? '-' }}
                </div>
              </div>
            </div>
          </div>

          {{-- KARTU MISI --}}
          <div class="col-md-6 col-sm-6 col-xs-12 col-flex mb-4">
            <div class="animasi-masuk delay-200 w-100-flex" style="height: 100%;">
              <div class="glass-card" style="height: 100%; margin-bottom: 0; padding: 30px; display: flex; flex-direction: column;">
                <div style="display: flex; align-items: center; margin-bottom: 18px;">
                  <div style="width: 48px; height: 48px; border-radius: 14px; background: linear-gradient(135deg, #00c6fb 0%, #005bea 100%); color: #ffffff; display: flex; align-items: center; justify-content: center; font-size: 20px; box-shadow: 0 8px 18px rgba(0, 198, 251, 0.3); margin-right: 15px; flex-shrink: 0;">
                    <i class="fas fa-bullseye"></i>
                  </div>
                  <div>
                    <h4 style="font-size: 22px; font-weight: 800; color: #0f172a; margin: 0;">Misi Perusahaan</h4>
                    <span style="font-size: 12px; color: #64748b; font-weight: 500;">Langkah &amp; Komitmen Pelayanan</span>
                  </div>
                </div>
                <div style="font-size: 15px; line-height: 1.75; color: #475569; text-align: left; flex-grow: 1;">
                  {{ $data['profile']->misi ?? '-' }}
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div id="services" class="services-area area-padding" style="position: relative;">
        <div style="position: absolute; top: 10%; left: -5%; width: 400px; height: 400px; background: rgba(0, 91, 234, 0.05); border-radius: 50%; filter: blur(80px); z-index: -1;"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline services-head text-center animasi-masuk">
              <h2>Alur Proses Pendaftaran</h2>
            </div>
          </div>
        </div>
        <div class="row row-flex text-center justify-content-center">
          @foreach ($data['alur'] as $key => $value) 
            <div class="col-md-4 col-sm-6 col-xs-12 col-flex mb-4">
              <div class="animasi-masuk delay-{{ ($loop->iteration % 3) * 100 }} w-100-flex">
                <div class="glass-card" style="justify-content: flex-start;">
                    <div class="icon-box-modern">
                      <img src="{{ asset('assets_admin/img/alur/'.$value->gambar_alur) }}" alt="" style="max-width: 45px;">
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: #0f172a;">{{ $value->judul }}</h4>
                    <p class="text-rapi-justify" style="font-size: 15px; color: #64748b;">
                      {{ $value->deskripsi }}
                    </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Galeri</h2>
            </div>
          </div>
        </div>
        <div class="row row-flex">
          @foreach ($data['galeri'] as $key => $value)
            <div class="col-md-4 col-sm-4 col-xs-12 col-flex mb-4">
              <div class="animasi-masuk delay-{{ ($loop->iteration % 3) * 100 }} w-100-flex">
                <div class="glass-card" style="padding: 10px; justify-content: flex-start;">
                    <div class="floating-img-container">
                        <a class="venobox" data-gall="myGallery" href="{{ asset('assets_admin/img/galeri/'.$value->galeri_gambar) }}">
                            <img src="{{ asset('assets_admin/img/galeri/'.$value->galeri_gambar) }}" class="floating-img" alt=""/>
                        </a>
                    </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div id="blog" class="blog-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Informasi Berita</h2>
            </div>
          </div>
        </div>
        <div class="row row-flex">
          @foreach ($data['informasi'] as $value)
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 col-flex mb-4"> 
              <div class="animasi-masuk delay-{{ ($loop->iteration % 3) * 100 }} w-100-flex">
                <div class="glass-card" style="padding: 0; overflow: hidden; justify-content: flex-start;">
                    <div class="floating-img-container" style="border-radius: 20px 20px 0 0; box-shadow: none;">
                        <img src="{{ asset('assets_admin/img/informasi/'.$value->gambar_informasi) }}" class="floating-img" style="height: 220px;" alt="">
                    </div>
                    <div style="padding: 30px; display: flex; flex-direction: column; flex-grow: 1; justify-content: flex-start;">
                        <div class="blog-meta" style="margin-bottom: 15px;">
                            <span style="background: rgba(0, 91, 234, 0.1); color: #005bea; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                <i class="fa fa-calendar"></i> {{ $value->tgl_informasi }}
                            </span>
                        </div>
                        <h4 style="font-size: 18px; margin-bottom: 15px; line-height: 1.5; font-weight: 700;">
                            <a href="#" style="color: #0f172a; text-decoration: none;">{{ $value->judul }}</a>
                        </h4>
                        <p class="text-rapi-justify" style="margin-bottom: 25px; font-size: 14px; color: #64748b; flex-grow: 1;"> 
                            {{(str_word_count("$value->deskripsi") > 15 ? substr("$value->deskripsi",0,100)."..." : "$value->deskripsi") }}
                        </p>
                        <div style="text-align: right; margin-top: auto;"> 
                            <a href="{{ url('detail-informasi/'.$value->id_informasi) }}" class="btn-world-class" style="font-size: 12px; padding: 10px 25px;">Read more</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <div id="contact" class="contact-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Kontak Kami</h2>
            </div>
          </div>
        </div>
        <div class="row row-flex justify-content-center">
          <div class="col-md-4 col-sm-4 col-xs-12 col-flex mb-4">
            <div class="animasi-masuk w-100-flex">
                <div class="glass-card" style="text-align: center; justify-content: flex-start;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa fa-mobile" style="font-size: 30px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">No telepon</h4>
                    <p style="font-weight: 600; font-size: 16px; color: #0284c7;">{{ $data['profile']->no_hp }}</p>
                </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 col-flex mb-4">
            <div class="animasi-masuk delay-100 w-100-flex">
                <div class="glass-card" style="text-align: center; justify-content: flex-start;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa fa-envelope" style="font-size: 26px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Email & Sosmed</h4>
                    <p style="font-size: 14px; margin-bottom: 5px;">{{ $data['profile']->email }}</p>
                    <p style="font-size: 14px; color: #0284c7; font-weight: 600;">Facebook: {{ $data['profile']->facebook }}</p>
                </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 col-flex mb-4">
            <div class="animasi-masuk delay-200 w-100-flex">
                <div class="glass-card" style="text-align: center; justify-content: flex-start;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa fa-map-marker" style="font-size: 26px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Alamat</h4>
                    <p style="font-size: 14px; color: #64748b;">{{ $data['profile']->alamat }}</p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll('.animasi-masuk');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aktif');
                }
            });
        }, { threshold: 0.1 });
        elements.forEach(el => observer.observe(el));

        if (typeof jQuery != 'undefined') {
            jQuery('#ensign-nivoslider').nivoSlider({
                effect: 'fade', slices: 1, animSpeed: 500, pauseTime: 3000, startSlide: 0,
                directionNav: true, controlNav: true, controlNavThumbs: false,
                pauseOnHover: false, manualAdvance: false, 
                prevText: '<i class="fa fa-angle-left"></i>', nextText: '<i class="fa fa-angle-right"></i>',
                afterLoad: function() { window.dispatchEvent(new Event('resize')); },
                afterChange: function() { window.dispatchEvent(new Event('resize')); }
            });
        }
    });
</script>

@endsection