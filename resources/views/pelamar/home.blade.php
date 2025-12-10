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
        margin: 0 !important;
        padding: 0 !important;
        width: 100%;
        height: 100%;
        overflow-x: hidden;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: #f0f7ff; 
        background-attachment: fixed;
        color: #334155;
    }

    /* ======================================================== */
    /* 2. SLIDER AREA (FIX BACKGROUND BLUR & RESPONSIF) */
    /* ======================================================== */
    .slider-area {
        position: relative;
        width: 100%;
        height: 100vh !important;
        background: #0f172a;
        overflow: hidden;
        padding: 0; margin: 0;
        z-index: 1;
    }

    .nivoSlider {
        position: relative;
        width: 100% !important;
        height: 100vh !important;
        overflow: hidden;
    }

    /* GAMBAR BACKGROUND: Blur dikembalikan & Responsif */
    .nivoSlider img {
        width: 100vw !important;
        height: 100vh !important;
        object-fit: cover !important;
        object-position: center !important;
        position: absolute !important;
        top: 0; left: 0;
        max-width: none !important;
        
        /* [FIX] EFEK BLUR DIKEMBALIKAN LEBIH KUAT */
        filter: blur(6px) !important; 
        -webkit-filter: blur(6px) !important;
        transform: scale(1.1); /* Zoom dikit biar pinggiran blur aman */
    }

    .nivo-slice, .nivo-box { display: none !important; }
    .nivo-main-image { display: block !important; width: 100vw !important; height: 100vh !important; opacity: 1 !important; }

    /* Overlay Gelap */
    .slider-overlay {
        position: absolute; top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(15, 23, 42, 0.4); z-index: 2; pointer-events: none;
    }

    /* NAVIGASI GARIS */
    .nivo-controlNav {
        z-index: 100 !important;
        position: absolute;
        bottom: 40px;
        width: 100%;
        text-align: center;
        padding: 0;
        pointer-events: auto !important;
    }
    .nivo-controlNav a {
        display: inline-block;
        width: 40px; height: 4px;
        background: rgba(255,255,255,0.4);
        border-radius: 4px; margin: 0 5px;
        cursor: pointer; text-indent: -9999px; border: none; 
        transition: all 0.3s;
    }
    .nivo-controlNav a.active { background: #00c6fb; width: 50px; }

    /* ======================================================== */
    /* 3. CARD SLIDER TENGAH (UKURAN SAMA & TITLE KONSISTEN) */
    /* ======================================================== */
    .nivo-caption {
        background: transparent !important;
        width: 100%; height: 100%; top: 0; left: 0; padding: 0;
        position: absolute !important;
        z-index: 20; 
        display: flex !important;
        align-items: center; justify-content: center;
        pointer-events: none;
    }
    .nivo-caption .container {
        position: relative; z-index: 25; width: 100%; display: flex; justify-content: center; pointer-events: none;
    }
    .slider-content { pointer-events: auto; }

    .slider-glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 30px;
        
        /* [FIX] UKURAN CARD DIBUAT TETAP (MIN-HEIGHT) AGAR TIDAK BERUBAH SIZE */
        width: 90%;
        max-width: 700px; 
        min-height: 500px; /* Tinggi Minimal Tetap */
        padding: 60px 40px;
        
        display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;
        box-shadow: 0 30px 60px rgba(0,0,0,0.5);
        animation: cardZoom 0.8s ease-out;
    }
    @keyframes cardZoom { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    /* [FIX] UKURAN TITLE KONSISTEN */
    .title1-hero {
        font-size: 16px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #00c6fb;
        margin-bottom: 25px; display: inline-block;
        background: rgba(0, 198, 251, 0.15); padding: 10px 30px; border-radius: 50px;
        border: 1px solid rgba(0, 198, 251, 0.5);
    }
    .title2-hero {
        font-size: 42px; font-weight: 800; color: #ffffff; line-height: 1.2; margin-bottom: 40px;
        text-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }

    .btn-action-wrapper {
        display: flex; justify-content: center; gap: 15px; width: 100%; max-width: 400px; flex-wrap: wrap; margin-top: auto;
    }
    .btn-world-class {
        background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%);
        border: none; color: white !important; padding: 16px 0; border-radius: 50px;
        font-weight: 700; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; 
        width: 100%; display: block; box-shadow: 0 10px 30px -5px rgba(0, 91, 234, 0.5);
    }
    .btn-world-class:hover { transform: translateY(-3px); box-shadow: 0 20px 40px -5px rgba(0, 91, 234, 0.7); }

    .btn-glass-outline {
        background: rgba(255, 255, 255, 0.1); border: 2px solid #fff;
        color: #fff !important; padding: 14px 0; border-radius: 50px;
        font-weight: 600; text-transform: uppercase; text-decoration: none; 
        width: 100%; display: block; backdrop-filter: blur(4px);
    }
    .btn-glass-outline:hover { background: #fff; color: #005bea !important; }

    /* ======================================================== */
    /* 4. CONTENT STYLE (GLASS CARD, DLL) */
    /* ======================================================== */
    
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px); border-radius: 20px; 
        border: 1px solid rgba(255, 255, 255, 1);
        box-shadow: 0 10px 40px -10px rgba(0, 91, 234, 0.1);
        padding: 35px; 
        margin-bottom: 25px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; 
        height: auto; 
    }
    .glass-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px -12px rgba(0, 91, 234, 0.2); border-color: #cce4ff; }
    
    .section-headline h2 {
        font-size: 40px; font-weight: 800;
        background: linear-gradient(135deg, #004e92 0%, #00c6fb 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        margin-bottom: 50px; position: relative; display: inline-block;
    }
    .section-headline h2::after {
        content: ''; position: absolute; width: 80px; height: 5px; 
        background: linear-gradient(90deg, #005bea, #00c6fb);
        bottom: -15px; left: 50%; transform: translateX(-50%); border-radius: 10px;
    }

    .floating-img-container {
        border-radius: 20px; overflow: hidden; box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        height: 100%; min-height: 400px; 
    }
    .floating-img-container img { width: 100%; height: 100%; object-fit: cover; }
    .floating-img { width: 100%; height: 250px; object-fit: cover; } 

    .icon-box-modern {
        width: 70px; height: 70px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; color: #005bea; font-size: 28px;
    }

    .animasi-masuk { opacity: 0; transform: translateY(40px); transition: 0.8s cubic-bezier(0.22, 1, 0.36, 1); }
    .animasi-masuk.aktif { opacity: 1; transform: translateY(0); }
    .delay-100 { transition-delay: 0.1s; } .delay-200 { transition-delay: 0.2s; } 
    .area-padding { padding: 80px 0; }

    /* RESPONSIVE HP */
    @media (max-width: 768px) {
        .slider-area, .nivoSlider img { height: 100vh !important; }
        .slider-glass-card { width: 90%; padding: 40px 20px; min-height: auto; }
        .title1-hero { font-size: 11px; padding: 6px 15px; }
        .title2-hero { font-size: 28px; line-height: 1.3; }
        .btn-action-wrapper { width: 100%; }
        .glass-card { padding: 25px; margin-bottom: 20px; }
    }
</style>

<!-- ======= SLIDER SECTION ======= -->
<div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('assets') }}/img/slider/banner1.jpg" alt="" title="#slider-direction-1" />
        <img src="{{ asset('assets') }}/img/slider/banner2.jpg" alt="" title="#slider-direction-2" />
        <img src="{{ asset('assets') }}/img/slider/banner3.jpg" alt="" title="#slider-direction-3" />
      </div>

      <div class="slider-overlay"></div>

      <!-- SLIDE 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content">
                <div class="slider-glass-card">
                    <span class="title1-hero">PT Media Balai Nusa astro net</span>
                    <h1 class="title2-hero">Selamat Datang di <br> <span style="color: #00c6fb;">PT Media Balai Nusa astro net</span></h1>
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

      <!-- SLIDE 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content text-center">
                <div class="slider-glass-card">
                    <span class="title1-hero">DAFTARKAN DIRI ANDA</span>
                    <h1 class="title2-hero">Bangun Pengalaman <br> dan Wujudkan Masa Depan</h1>
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

      <!-- SLIDE 3 -->
      <div id="slider-direction-3" class="slider-direction slider-three">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content">
                <div class="slider-glass-card">
                    <span class="title1-hero">IKUTI PETUNJUK YANG ADA</span>
                    <h1 class="title2-hero">Lebih Cepat, Lebih Baik <br> Daftar Dari Rumah</h1>
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

    <!-- ======= ABOUT SECTION ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <!-- Headline -->
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        
        <div class="row">
          <!-- KIRI: GAMBAR BESAR -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="animasi-masuk" style="height: 100%;">
                <div class="glass-card" style="padding: 15px; height: 100%;">
                    <div class="floating-img-container">
                        <img src="{{ asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan) }}" alt="Profil Perusahaan">
                    </div>
                </div>
            </div>
          </div>

          <!-- KANAN: PROFIL, VISI, MISI -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            
            <!-- 1. BOX PROFILE -->
            <div class="animasi-masuk delay-200">
              <div class="glass-card">
                  <h4 style="font-size: 26px; font-weight: 700; color: #0f172a; margin-bottom: 20px; border-left: 5px solid #005bea; padding-left: 15px;">
                      Profile
                  </h4>
                  <p class="text-justify" style="font-size: 16px; color: #555;">
                      {{ $data['profile']->deskripsi }}
                  </p>
              </div>
            </div>

            <!-- 2. ROW BARU: VISI & MISI (BERDAMPINGAN) -->
            <div class="row" style="margin-top: 25px;">
                <!-- Visi (Kiri) -->
                <div class="col-md-6 col-sm-6 col-xs-6"> 
                    <div class="animasi-masuk delay-100">
                        <div class="glass-card" style="margin-bottom: 0;"> 
                            <h4 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 15px; border-left: 5px solid #005bea; padding-left: 15px;">
                                Visi
                            </h4>
                            <p class="text-justify" style="font-size: 14px; color: #555;">
                                {{ $data['profile']->visi ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Misi (Kanan) -->
                <div class="col-md-6 col-sm-6 col-xs-6">
                    <div class="animasi-masuk delay-200">
                        <div class="glass-card" style="margin-bottom: 0;">
                            <h4 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 15px; border-left: 5px solid #005bea; padding-left: 15px;">
                                Misi
                            </h4>
                            <p class="text-justify" style="font-size: 14px; color: #555;">
                                {{ $data['profile']->misi ?? '-' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    <!-- ======= SERVICES (ALUR) SECTION ======= -->
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
        <div class="row text-center">
          @foreach ($data['alur'] as $key => $value) 
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="animasi-masuk delay-{{ ($loop->iteration % 3) * 100 }}">
                <div class="glass-card">
                    <div class="icon-box-modern">
                      <img src="{{ asset('assets_admin/img/alur/'.$value->gambar_alur) }}" alt="" style="max-width: 45px;">
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: #0f172a;">{{ $value->judul }}</h4>
                    <p style="font-size: 15px; color: #64748b;">
                      {{ $value->deskripsi }}
                    </p>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>

    <!-- ======= GALERI SECTION ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Galeri</h2>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($data['galeri'] as $key => $value)
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="animasi-masuk delay-{{ ($loop->iteration % 3) * 100 }}">
                <div class="glass-card" style="padding: 10px;">
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

    <!-- ======= BLOG SECTION ======= -->
    <div id="blog" class="blog-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Informasi berita</h2>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($data['informasi'] as $value)
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="animasi-masuk delay-{{ ($loop->iteration % 3) * 100 }}">
                <div class="glass-card" style="padding: 0; display: flex; flex-direction: column;">
                    <div class="floating-img-container" style="border-radius: 20px 20px 0 0; box-shadow: none;">
                        <img src="{{ asset('assets_admin/img/informasi/'.$value->gambar_informasi) }}" class="floating-img" style="height: 220px;" alt="">
                    </div>
                    <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column;">
                        <div class="blog-meta" style="margin-bottom: 15px;">
                            <span style="background: rgba(0, 91, 234, 0.1); color: #005bea; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                <i class="fa fa-calendar"></i> {{ $value->tgl_informasi }}
                            </span>
                        </div>
                        <h4 style="font-size: 18px; margin-bottom: 15px; line-height: 1.5; font-weight: 700;">
                            <a href="#" style="color: #0f172a; text-decoration: none;">{{ $value->judul }}</a>
                        </h4>
                        <p style="margin-bottom: 25px; font-size: 14px; flex-grow: 1; color: #64748b;">
                            {{(str_word_count("$value->deskripsi") > 15 ? substr("$value->deskripsi",0,100)."..." : "$value->deskripsi") }}
                        </p>
                        <div style="text-align: right;">
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

    <!-- ======= CONTACT SECTION ======= -->
    <div id="contact" class="contact-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Kontak kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="animasi-masuk">
                <div class="glass-card" style="text-align: center;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa fa-mobile" style="font-size: 30px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">No telepon</h4>
                    <p style="font-weight: 600; font-size: 16px; color: #005bea;">{{ $data['profile']->no_hp }}</p>
                </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="animasi-masuk delay-100">
                <div class="glass-card" style="text-align: center;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa fa-envelope" style="font-size: 26px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Email & Sosmed</h4>
                    <p style="font-size: 14px; margin-bottom: 5px;">{{ $data['profile']->email }}</p>
                    <p style="font-size: 14px; color: #005bea; font-weight: 600;">Facebook: {{ $data['profile']->facebook }}</p>
                </div>
            </div>
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="animasi-masuk delay-200">
                <div class="glass-card" style="text-align: center;">
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
        // 1. Script Animasi Masuk
        const elements = document.querySelectorAll('.animasi-masuk');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aktif');
                }
            });
        }, { threshold: 0.1 });
        elements.forEach(el => observer.observe(el));

        // 2. Script Nivo Slider (Stabil)
        if (typeof jQuery != 'undefined') {
            jQuery('#ensign-nivoslider').nivoSlider({
                effect: 'fade', 
                slices: 1, 
                animSpeed: 500, 
                pauseTime: 3000, 
                startSlide: 0,
                directionNav: true,
                controlNav: true,
                controlNavThumbs: false,
                pauseOnHover: false, 
                manualAdvance: false, 
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>',
                afterLoad: function() { window.dispatchEvent(new Event('resize')); },
                afterChange: function() { window.dispatchEvent(new Event('resize')); }
            });
        }
    });
</script>

@endsection