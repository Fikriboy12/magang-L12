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
        background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); 
        border: 1px solid rgba(255, 255, 255, 0.3); border-radius: 30px;
        width: 90%; max-width: 700px; min-height: 500px; padding: 60px 40px;
        display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center;
        box-shadow: 0 30px 60px rgba(0,0,0,0.5); animation: cardZoom 0.8s ease-out;
    }
    @keyframes cardZoom { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }
    .title1-hero {
        font-size: 16px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #00c6fb;
        margin-bottom: 25px; display: inline-block; background: rgba(0, 198, 251, 0.15); padding: 10px 30px; border-radius: 50px; border: 1px solid rgba(0, 198, 251, 0.5);
    }
    .title2-hero {
        font-size: 42px; font-weight: 800; color: #ffffff; line-height: 1.2; margin-bottom: 40px; text-shadow: 0 4px 15px rgba(0,0,0,0.5);
    }
    .btn-action-wrapper { display: flex; justify-content: center; gap: 15px; width: 100%; max-width: 400px; flex-wrap: wrap; margin-top: auto; }
    .btn-world-class {
        background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%); border: none; color: white !important; padding: 16px 0; border-radius: 50px;
        font-weight: 700; letter-spacing: 1px; text-transform: uppercase; text-decoration: none; width: 100%; display: block; box-shadow: 0 10px 30px -5px rgba(0, 91, 234, 0.5);
    }
    .btn-world-class:hover { transform: translateY(-3px); box-shadow: 0 20px 40px -5px rgba(0, 91, 234, 0.7); }
    .btn-glass-outline {
        background: rgba(255, 255, 255, 0.1); border: 2px solid #fff; color: #fff !important; padding: 14px 0; border-radius: 50px;
        font-weight: 600; text-transform: uppercase; text-decoration: none; width: 100%; display: block; backdrop-filter: blur(4px);
    }
    .btn-glass-outline:hover { background: #fff; color: #005bea !important; }

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
        width: 70px; height: 70px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 20px; color: #005bea; font-size: 28px;
        transition: all 0.5s ease; flex-shrink: 0;
    }
    .glass-card:hover .icon-box-modern { 
        transform: rotate(15deg) scale(1.1); background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%); 
        color: #fff; box-shadow: 0 10px 20px rgba(0, 91, 234, 0.3);
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
        .slider-glass-card { width: 90%; padding: 40px 20px; min-height: 450px; }
        .title1-hero { font-size: 11px; padding: 6px 15px; }
        .title2-hero { font-size: 28px; line-height: 1.3; }
        .btn-action-wrapper { width: 100%; }
        .glass-card { padding: 25px; margin-bottom: 20px; }
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
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content">
                <div class="slider-glass-card">
                    <span class="title1-hero">PT Media Balai Nusa</span>
                    <h1 class="title2-hero">Selamat Datang di <br> <span style="color: #00c6fb;">PT.MEDIA BALAI NUSA astro net</span></h1>
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
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content text-center">
                <div class="slider-glass-card">
                    <span class="title1-hero">ASTRONET.ID</span>
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
      <div id="slider-direction-3" class="slider-direction slider-three">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="slider-content">
                <div class="slider-glass-card">
                    <span class="title1-hero">ASTRONET.ID</span>
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

    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        
        <div class="row" style="display: flex; flex-wrap: wrap; align-items: center;">
          
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="animasi-masuk">
                <div class="glass-card" style="padding: 20px; display: flex; justify-content: center; align-items: center;">
                    <div class="floating-img-container" style="min-height: auto; box-shadow: none; height: auto;">
                        <img src="{{ asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan) }}" 
                             alt="Profil Perusahaan" 
                             style="width: 100%; max-width: 450px; height: auto; object-fit: contain;">
                    </div>
                </div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            
            <div class="animasi-masuk delay-200">
              <div class="glass-card" style="justify-content: flex-start; height: auto;">
                  <h4 style="font-size: 26px; font-weight: 700; color: #0f172a; margin-bottom: 20px; border-left: 5px solid #005bea; padding-left: 15px;">
                      Profile
                  </h4>
                  <div class="text-rapi-justify" style="line-height: 1.8; font-size: 16px; color: #555;">
                      {{ $data['profile']->deskripsi }}
                  </div>
              </div>
            </div>

            <div class="row row-flex" style="margin-top: 25px;">
                
                <div class="col-md-6 col-sm-6 col-xs-12 col-flex mb-4"> 
                    <div class="animasi-masuk delay-100 w-100-flex">
                        <div class="glass-card" style="margin-bottom: 0; justify-content: flex-start;"> 
                            <h4 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 15px; border-left: 5px solid #005bea; padding-left: 15px;">
                                Visi
                            </h4>
                            <div class="text-rapi-justify" style="font-size: 14px; line-height: 1.6; color: #555;">
                                {{ $data['profile']->visi ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-xs-12 col-flex mb-4">
                    <div class="animasi-masuk delay-200 w-100-flex">
                        <div class="glass-card" style="margin-bottom: 0; justify-content: flex-start;">
                            <h4 style="font-size: 20px; font-weight: 700; color: #0f172a; margin-bottom: 15px; border-left: 5px solid #005bea; padding-left: 15px;">
                                Misi
                            </h4>
                            <div class="text-rapi-justify" style="font-size: 14px; line-height: 1.6; color: #555;">
                                {{ $data['profile']->misi ?? '-' }}
                            </div>
                        </div>
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
                    <p style="font-weight: 600; font-size: 16px; color: #005bea;">{{ $data['profile']->no_hp }}</p>
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
                    <p style="font-size: 14px; color: #005bea; font-weight: 600;">Facebook: {{ $data['profile']->facebook }}</p>
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