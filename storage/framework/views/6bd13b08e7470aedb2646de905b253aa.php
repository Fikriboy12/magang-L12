<?php $__env->startSection('contents'); ?>

<!-- ============================================ -->
<!-- 💎 WORLD CLASS UI: BLUE OCEAN + BLURRED HERO -->
<!-- ============================================ -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- 1. GLOBAL SETTINGS --- */
    :root {
        --primary-blue: #005bea;
        --secondary-cyan: #00c6fb;
        --dark-navy: #0f172a;
        --glass-bg: rgba(255, 255, 255, 0.9);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: #f0f7ff; 
        background-image: 
            radial-gradient(at 0% 0%, rgba(0, 91, 234, 0.08) 0, transparent 50%), 
            radial-gradient(at 100% 0%, rgba(0, 198, 251, 0.08) 0, transparent 50%);
        background-attachment: fixed;
        color: #334155;
        overflow-x: hidden;
    }

    /* --- 2. PENGATURAN SLIDER (BLUR BACKGROUND) --- */
    .slider-area {
        position: relative;
        height: 100vh; /* Full Layar */
        min-height: 600px;
        overflow: hidden;
        background: #000;
    }

    /* GAMBAR DIBUAT BLUR */
    .nivoSlider img {
        width: 100% !important;
        height: 100vh !important;
        object-fit: cover !important;
        filter: blur(8px); 
        -webkit-filter: blur(8px);
        transform: scale(1.1); 
    }

    /* Overlay Gelap Transparan */
    .slider-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(0, 0, 0, 0.4); /* Gelap 40% */
        z-index: 2;
        pointer-events: none;
    }

    /* Posisi Caption di Tengah */
    .nivo-caption {
        background: transparent !important;
        width: 100%; height: 100%;
        top: 0; left: 0; padding: 0;
        display: flex !important; align-items: center; justify-content: center;
        opacity: 1 !important;
        z-index: 10;
        pointer-events: none; 
    }
    .nivo-caption .container {
        position: relative; z-index: 20; display: flex; justify-content: center;
    }

    /* KOTAK KACA UNTUK TEKS SLIDER */
    .slider-glass-card {
        background: rgba(255, 255, 255, 0.1); /* Transparan */
        backdrop-filter: blur(0px); 
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 30px;
        padding: 60px 50px;
        text-align: center;
        box-shadow: 0 30px 60px rgba(0,0,0,0.4);
        max-width: 950px;
        width: 90%;
        pointer-events: auto;
        animation: cardZoom 1s ease-out;
    }
    @keyframes cardZoom { from { transform: scale(0.9); opacity: 0; } to { transform: scale(1); opacity: 1; } }

    /* ANIMASI TEKS SATU PER SATU */
    .stagger-word {
        display: inline-block;
        opacity: 0;
        transform: translateY(30px);
        animation: wordUp 0.5s ease forwards;
        text-shadow: 0 2px 10px rgba(0,0,0,0.5);
    }
    @keyframes wordUp { to { opacity: 1; transform: translateY(0); } }

    /* Style Judul */
    .title1-hero {
        font-size: 16px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; color: #00c6fb;
        margin-bottom: 20px; display: inline-block;
        background: rgba(0, 198, 251, 0.15); padding: 8px 25px; border-radius: 50px;
        border: 1px solid rgba(0, 198, 251, 0.5);
        animation: fadeIn 0.5s 0.2s forwards; opacity: 0;
    }
    .title2-hero {
        font-size: 48px; font-weight: 800; color: #ffffff; line-height: 1.2; margin-bottom: 35px;
    }
    @keyframes fadeIn { to { opacity: 1; } }


    /* --- 3. TOMBOL & RESPONSIVE FIX --- */
    .btn-world-class {
        background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%);
        border: none; color: white !important; padding: 14px 35px; border-radius: 50px;
        font-weight: 700; letter-spacing: 0.5px;
        box-shadow: 0 10px 25px -10px rgba(0, 91, 234, 0.5);
        transition: all 0.3s ease; text-transform: uppercase; font-size: 14px;
        display: inline-block; text-decoration: none; margin: 0 5px;
    }
    .btn-world-class:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 40px -10px rgba(0, 91, 234, 0.6);
        background: linear-gradient(135deg, #004e92 0%, #005bea 100%);
    }

    .btn-glass-outline {
        background: rgba(255, 255, 255, 0.2); border: 2px solid #fff;
        color: #fff !important; padding: 12px 35px; border-radius: 50px;
        font-weight: 600; transition: all 0.3s ease; text-transform: uppercase;
        font-size: 14px; text-decoration: none; display: inline-block; backdrop-filter: blur(4px);
        margin: 0 5px;
    }
    .btn-glass-outline:hover { background: #fff; color: #005bea !important; }

    /* ========================================== */
    /* 📱 FIX KHUSUS HP (TOMBOL GAK BERSATU) 📱 */
    /* ========================================== */
    @media (max-width: 768px) {
        .title1-hero { font-size: 10px; padding: 5px 15px; }
        .title2-hero { font-size: 24px; line-height: 1.3; margin-bottom: 20px; }
        .slider-glass-card { padding: 30px 20px; width: 90%; }
        
        /* INI PERBAIKANNYA: Tombol Disusun ke Bawah & Dikasih Jarak */
        .btn-world-class, 
        .btn-glass-outline { 
            display: block;       /* Paksa turun baris */
            width: 100%;          /* Lebar penuh */
            margin: 10px 0 !important; /* Jarak antar tombol */
            padding: 12px 0;
            font-size: 13px;
        }
    }

    /* --- STYLE KONTEN BAWAH (TETAP SAMA) --- */
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px); border-radius: 24px; border: 1px solid rgba(255, 255, 255, 1);
        box-shadow: 0 10px 40px -10px rgba(0, 91, 234, 0.1);
        padding: 40px; margin-bottom: 30px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative; overflow: hidden; height: 100%;
    }
    .glass-card:hover { transform: translateY(-10px) scale(1.01); box-shadow: 0 20px 50px -12px rgba(0, 91, 234, 0.2); border-color: #cce4ff; }
    
    .section-headline h2 {
        font-size: 42px; font-weight: 800;
        background: linear-gradient(135deg, #004e92 0%, #00c6fb 100%);
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        margin-bottom: 50px; position: relative; display: inline-block; letter-spacing: -1px;
    }
    .section-headline h2::after {
        content: ''; position: absolute; width: 80px; height: 6px;
        background: linear-gradient(90deg, #005bea, #00c6fb);
        bottom: -15px; left: 50%; transform: translateX(-50%); border-radius: 10px;
    }

    .floating-img-container {
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        transform: perspective(1000px) rotateY(0deg); transition: transform 0.5s ease;
    }
    .floating-img { width: 100%; height: 280px; object-fit: cover; transition: transform 0.8s ease; }
    .glass-card:hover .floating-img { transform: scale(1.1); }

    .icon-box-modern {
        width: 80px; height: 80px; background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border-radius: 20px; display: flex; align-items: center; justify-content: center;
        margin: 0 auto 25px; transition: transform 0.5s; color: #005bea;
    }
    .glass-card:hover .icon-box-modern { transform: rotate(15deg) scale(1.1); background: linear-gradient(135deg, #005bea 0%, #00c6fb 100%); color: #fff; }

    .animasi-masuk { opacity: 0; transform: translateY(60px) scale(0.9); transition: 0.8s cubic-bezier(0.22, 1, 0.36, 1); }
    .animasi-masuk.aktif { opacity: 1; transform: translateY(0) scale(1); }
    .delay-100 { transition-delay: 0.1s; } .delay-200 { transition-delay: 0.2s; } .delay-300 { transition-delay: 0.3s; }
    .area-padding { padding: 80px 0; }
</style>

 <!-- ======= SLIDER SECTION (GAMBAR BLUR + TEKS ANIMASI) ======= -->
 <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <!-- 3 Gambar Slider -->
      <div id="ensign-nivoslider" class="slides">
        <img src="<?php echo e(asset('assets')); ?>/img/slider/banner1.jpg" alt="" title="#slider-direction-1" />
        <img src="<?php echo e(asset('assets')); ?>/img/slider/banner2.jpg" alt="" title="#slider-direction-2" />
        <img src="<?php echo e(asset('assets')); ?>/img/slider/banner3.jpg" alt="" title="#slider-direction-3" />
      </div>

      <!-- OVERLAY GELAP -->
      <div class="slider-overlay"></div>

      <!-- SLIDER 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <div class="slider-glass-card">
                    <!-- Judul Kecil -->
                    <span class="title1-hero">PT. ADITAMA NET MEDIA SOLUSINDO</span>
                    
                    <!-- Animasi Teks Satu per Satu -->
                    <h1 class="title2-hero">
                        <span class="stagger-word" style="animation-delay: 0.3s">Selamat</span> 
                        <span class="stagger-word" style="animation-delay: 0.4s">Datang</span> 
                        <span class="stagger-word" style="animation-delay: 0.5s">di</span> <br>
                        <span class="stagger-word" style="animation-delay: 0.6s; color: #00c6fb;">PT.</span> 
                        <span class="stagger-word" style="animation-delay: 0.7s; color: #00c6fb;">Aditama</span> 
                        <span class="stagger-word" style="animation-delay: 0.8s; color: #00c6fb;">Net</span> 
                        <span class="stagger-word" style="animation-delay: 0.9s; color: #00c6fb;">Media</span> 
                        <span class="stagger-word" style="animation-delay: 1.0s; color: #00c6fb;">Solusindo</span>
                    </h1>
                    
                    <div>
                      <a class="btn-world-class ready-btn right-btn page-scroll" href="<?php echo e(url('register')); ?>">REGISTRATION</a>
                      <a class="btn-glass-outline ready-btn page-scroll" href="#contact">CONTACT US</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SLIDER 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <div class="slider-glass-card">
                    <span class="title1-hero">DAFTARKAN DIRI ANDA</span>
                    <h1 class="title2-hero">
                        <span class="stagger-word" style="animation-delay: 0.3s">Mudah</span> 
                        <span class="stagger-word" style="animation-delay: 0.4s">Cepat</span> 
                        <span class="stagger-word" style="animation-delay: 0.5s">dan</span> 
                        <span class="stagger-word" style="animation-delay: 0.6s">Efisien</span>
                    </h1>
                    <div>
                      <a class="btn-world-class ready-btn right-btn page-scroll" href="<?php echo e(url('registrasi')); ?>">DAFTAR</a>
                      <a class="btn-glass-outline ready-btn page-scroll" href="#contact">CONTACT US</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SLIDER 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <div class="slider-glass-card">
                    <span class="title1-hero">IKUTI PETUNJUK YANG ADA</span>
                    <h1 class="title2-hero">
                        <span class="stagger-word" style="animation-delay: 0.3s">Lebih</span> 
                        <span class="stagger-word" style="animation-delay: 0.4s">Cepat,</span> 
                        <span class="stagger-word" style="animation-delay: 0.5s">Lebih</span> 
                        <span class="stagger-word" style="animation-delay: 0.6s">Baik</span>
                    </h1>
                    <div>
                        <a class="btn-world-class ready-btn right-btn page-scroll" href="<?php echo e(url('register')); ?>">DAFTAR</a>
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
 <!-- End Slider -->

 <main id="main">

    <!-- ======= About Section (Blue Ocean) ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Gambar -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="animasi-masuk">
                <div class="glass-card" style="padding: 15px;">
                    <div class="floating-img-container" style="height: auto;">
                        <img src="<?php echo e(asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan)); ?>" alt="" style="width: 100%; border-radius: 15px;">
                    </div>
                </div>
            </div>
          </div>
          <!-- Teks -->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="animasi-masuk delay-200">
              <div class="glass-card">
                  <h4 style="font-size: 26px; font-weight: 700; color: #0f172a; margin-bottom: 20px; border-left: 5px solid #005bea; padding-left: 15px;">
                      Profile
                  </h4>
                  <p class="text-justify" style="font-size: 16px; color: #555;">
                      <?php echo e($data['profile']->deskripsi); ?>

                  </p>
                  <br>
                  <ul></ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End About Section -->

    <!-- ======= Services (Alur) Section ======= -->
    <div id="services" class="services-area area-padding" style="position: relative;">
        <div style="position: absolute; top: 10%; left: -5%; width: 400px; height: 400px; background: rgba(0, 91, 234, 0.05); border-radius: 50%; filter: blur(80px); z-index: -1;"></div>

      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center animasi-masuk">
              <h2>Alur Proses Pendaftaran</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <?php $__currentLoopData = $data['alur']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="animasi-masuk delay-<?php echo e(($loop->iteration % 3) * 100); ?>">
                <div class="glass-card">
                    <div class="icon-box-modern">
                      <img src="<?php echo e(asset('assets_admin/img/alur/'.$value->gambar_alur)); ?>" alt="" style="max-width: 50px; max-height: 50px;">
                    </div>
                    <h4 style="font-size: 20px; font-weight: 700; margin-bottom: 15px; color: #0f172a;"><?php echo e($value->judul); ?></h4>
                    <p style="font-size: 15px; color: #64748b;">
                      <?php echo e($value->deskripsi); ?>

                    </p>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div><!-- End Services Section -->

    <!-- ======= Portfolio (Galeri) Section ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Galeri</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <?php $__currentLoopData = $data['galeri']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="animasi-masuk delay-<?php echo e(($loop->iteration % 3) * 100); ?>">
                <div class="glass-card" style="padding: 10px;">
                    <div class="floating-img-container">
                        <a class="venobox" data-gall="myGallery" href="<?php echo e(asset('assets_admin/img/galeri/'.$value->galeri_gambar)); ?>">
                            <img src="<?php echo e(asset('assets_admin/img/galeri/'.$value->galeri_gambar)); ?>" class="floating-img" alt=""/>
                        </a>
                    </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div><!-- End Portfolio Section -->

    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Informasi berita</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <?php $__currentLoopData = $data['informasi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="animasi-masuk delay-<?php echo e(($loop->iteration % 3) * 100); ?>" style="height: 100%;">
                <div class="glass-card" style="padding: 0; display: flex; flex-direction: column;">
                    <!-- Gambar Berita -->
                    <div class="floating-img-container" style="border-radius: 20px 20px 0 0; box-shadow: none;">
                        <img src="<?php echo e(asset('assets_admin/img/informasi/'.$value->gambar_informasi)); ?>" class="floating-img" style="height: 220px;" alt="">
                    </div>
                    <!-- Konten Berita -->
                    <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column;">
                        <div class="blog-meta" style="margin-bottom: 15px;">
                            <span style="background: rgba(0, 91, 234, 0.1); color: #005bea; padding: 5px 15px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                                <i class="fa-solid fa-calendar-days"></i> <?php echo e($value->tgl_informasi); ?>

                            </span>
                        </div>
                        <h4 style="font-size: 18px; margin-bottom: 15px; line-height: 1.5; font-weight: 700;">
                            <a href="#" style="color: #0f172a; text-decoration: none;"><?php echo e($value->judul); ?></a>
                        </h4>
                        <p style="margin-bottom: 25px; font-size: 14px; flex-grow: 1; color: #64748b;">
                            <?php echo e((str_word_count("$value->deskripsi") > 15 ? substr("$value->deskripsi",0,100)."..." : "$value->deskripsi")); ?>

                        </p>
                        <div style="text-align: right;">
                            <a href="<?php echo e(url('detail-informasi/'.$value->id_informasi)); ?>" class="btn-world-class" style="font-size: 12px; padding: 10px 25px;">Read more</a>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div>

    <!-- ======= Contact Section ======= -->
    <div id="contact" class="contact-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center animasi-masuk">
              <h2>Kontak kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Telepon -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="animasi-masuk">
                <div class="glass-card" style="text-align: center;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa-solid fa-mobile-screen-button" style="font-size: 30px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">No telepon</h4>
                    <p style="font-weight: 600; font-size: 16px; color: #005bea;"><?php echo e($data['profile']->no_hp); ?></p>
                </div>
            </div>
          </div>
          <!-- Email -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="animasi-masuk delay-100">
                <div class="glass-card" style="text-align: center;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa-solid fa-envelope" style="font-size: 26px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Email & Sosmed</h4>
                    <p style="font-size: 14px; margin-bottom: 5px;"><?php echo e($data['profile']->email); ?></p>
                    <p style="font-size: 14px; color: #005bea; font-weight: 600;">Facebook: <?php echo e($data['profile']->facebook); ?></p>
                </div>
            </div>
          </div>
          <!-- Alamat -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="animasi-masuk delay-200">
                <div class="glass-card" style="text-align: center;">
                    <div class="icon-box-modern" style="border-radius: 50%;">
                        <i class="fa-solid fa-location-dot" style="font-size: 26px;"></i>
                    </div>
                    <h4 style="font-size: 18px; font-weight: 700; color: #0f172a;">Alamat</h4>
                    <p style="font-size: 14px; color: #64748b;"><?php echo e($data['profile']->alamat); ?></p>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->

<!-- SCRIPT PENGGERAK SLIDER (AUTO 2 DETIK) & AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 1. Init Animasi Scroll (AOS)
        const elements = document.querySelectorAll('.animasi-masuk');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('aktif');
                } else {
                    entry.target.classList.remove('aktif');
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });
        elements.forEach(el => observer.observe(el));

        // 2. Init Nivo Slider (Otomatis 2 Detik)
        if (typeof jQuery != 'undefined') {
            jQuery('#ensign-nivoslider').nivoSlider({
                effect: 'fade', // Efek Fade biar halus saat ganti gambar blur
                slices: 15,
                boxCols: 8,
                boxRows: 4,
                animSpeed: 500,
                pauseTime: 2000, // GANTI FOTO TIAP 2 DETIK
                startSlide: 0,
                directionNav: true,
                controlNav: false,
                controlNavThumbs: false,
                pauseOnHover: false, // Tetap jalan walau mouse nempel
                manualAdvance: false, // OTOMATIS
                prevText: '<i class="fa fa-angle-left"></i>',
                nextText: '<i class="fa fa-angle-right"></i>'
            });
        }
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pelamar/home.blade.php ENDPATH**/ ?>