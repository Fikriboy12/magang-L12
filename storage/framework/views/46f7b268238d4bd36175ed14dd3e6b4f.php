<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PT. MEDIA BALAI NUSA</title>

    <link rel="icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">
    <link rel="shortcut icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">

    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="<?php echo e(asset('assets')); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/vendor/venobox/venobox.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/datatables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <link href="<?php echo e(asset('assets')); ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo e(asset('assets')); ?>/css/responsive.css" rel="stylesheet">
    
    <style>
        /* =========================================
           1. CSS KURSOR SNAKE TRAIL (ASLI)
           ========================================= */
        html, body, a, button, input, select, textarea, .nav-menu a, .user-toggle, .mobile-nav-toggle, .mm-item, .mm-btn {
            cursor: none !important;
        }
        .cursor-trail-dot {
            position: fixed; top: 0; left: 0; width: 12px; height: 12px;
            background-color: rgba(37, 99, 235, 0.6); border-radius: 50%;
            pointer-events: none; z-index: 2147483647; transform: translate(-50%, -50%);
        }
        .cursor-trail-dot.trail-leader {
            width: 18px; height: 18px; background-color: #2563eb;
            box-shadow: 0 0 10px rgba(37, 99, 235, 0.5);
        }
        .cursor-trail-dot.trail-leader.is-clicking {
            background-color: #60a5fa; transform: translate(-50%, -50%) scale(1.2);
            transition: transform 0.1s, background-color 0.1s;
        }

        /* =========================================
           2. CSS MENU POPUP BARU (FIX RAPAT NAVBAR)
           ========================================= */
        .menu-backdrop {
            position: fixed; top: 80px; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.4); 
            z-index: 2147483600; 
            opacity: 0; visibility: hidden; transition: all 0.3s ease;
        }
        .menu-backdrop.show { opacity: 1; visibility: visible; }

        /* Kotak Menu Putih */
        .mobile-menu-popup {
            position: fixed; top: 80px; left: 0; width: 100%; 
            max-height: calc(100vh - 80px); background: #ffffff; 
            z-index: 2147483601; 
            border-radius: 0 0 15px 15px; 
            padding: 10px 20px 20px 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: flex; flex-direction: column; opacity: 0; visibility: hidden; 
            transform: translateY(-10px); transition: all 0.3s ease-out;
            overflow-y: auto; font-family: 'Plus Jakarta Sans', sans-serif;
        }
        .mobile-menu-popup.show { opacity: 1; visibility: visible; transform: translateY(0); }

        .mm-list { list-style: none; padding: 0; margin: 0; } 
        .mm-item { display: flex; align-items: center; padding: 15px 10px; text-decoration: none !important; color: #334155; font-weight: 700; font-size: 15px; border-bottom: 1px solid #f1f5f9; transition: 0.2s; }
        .mm-item:last-child { border-bottom: none; }
        .mm-item i { width: 35px; font-size: 18px; color: #2563eb; }
        .mm-item:active, .mm-item:hover { background: #eff6ff; color: #2563eb; }

        .mm-actions { display: flex; justify-content: center; margin-top: 15px; padding-top: 15px; border-top: 1px solid #f1f5f9; }
        .mm-btn { width: auto; min-width: 150px; padding: 10px 25px; text-align: center; border-radius: 50px; text-decoration: none !important; font-weight: 700; font-size: 14px; display: block; background: #2563eb; color: #fff; box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2); }

        /* =========================================
           3. CSS GLOBAL & HEADER
           ========================================= */
        #preloader-custom { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: #ffffff; display: flex; justify-content: center; align-items: center; z-index: 2147483647; opacity: 1; transition: opacity 0.5s ease; }
        #preloader-custom img { width: 120px; height: auto; }
        html, body { width: 100%; overflow-x: hidden; background-color: #f8fafc; scroll-behavior: auto !important; height: auto !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif !important; color: #334155; }
        img { max-width: 100%; height: auto; }
        .logo-text-styled { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 26px; color: #0f172a; display: flex; align-items: center; letter-spacing: -0.5px; text-decoration: none !important; }
        .logo-planet-icon { font-size: 22px; margin: 0 1px; color: #2563eb; position: relative; top: 0px; }
        
        /* HEADER: TINGGI 80px */
        #header { 
            background: #ffffff !important; height: 80px; 
            transition: all 0.5s; 
            z-index: 2147483640;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05); 
            padding: 10px 0; position: fixed; top: 0; width: 100%; display: flex; align-items: center; 
        }

        /* --- UKURAN LOGO HEADER (Desktop 45px) --- */
        .logo-image {
            max-height: 45px; 
            width: auto; 
            display: block;
        }
        
        .logo-container-custom { display: flex; align-items: center; text-decoration: none !important; }
        .nav-menu { margin-left: 40px; }
        .nav-menu ul { margin: 0; padding: 0; list-style: none; display: flex; }
        .nav-menu li { margin: 0 5px; }
        .nav-menu a { color: #64748b !important; font-size: 14px; font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 5px; cursor: pointer; }
        .nav-menu a:hover, .nav-menu .active > a { color: #2563eb !important; }
        
        .header-right-btn { background: #0f172a; color: white !important; padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 700; text-decoration: none; display: flex; align-items: center; gap: 5px; transition: 0.3s; }
        .header-right-btn:hover { background: #2563eb; transform: translateY(-2px); }

        .user-dropdown { position: relative; display: inline-block; }
        .user-toggle { display: flex; align-items: center; gap: 8px; padding: 5px 12px; border-radius: 50px; background: #f1f5f9; color: #0f172a !important; font-weight: 700; font-size: 13px; cursor: pointer; text-decoration: none; }
        .user-avatar { width: 28px; height: 28px; background: #2563eb; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .dropdown-menu-custom { position: absolute; right: 0; top: 110%; background: white; min-width: 180px; box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-radius: 10px; padding: 5px 0; opacity: 0; visibility: hidden; transform: translateY(10px); transition: 0.3s; border: 1px solid #f1f5f9; z-index: 9999; }
        .user-dropdown:hover .dropdown-menu-custom { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item-custom { display: flex; align-items: center; gap: 8px; padding: 8px 15px; color: #64748b; font-size: 13px; font-weight: 500; text-decoration: none; }
        .dropdown-item-custom:hover { background: #f8fafc; color: #2563eb; }

        /* FOOTER & LAINNYA */
        #footer { background-color: #2563eb !important; padding: 60px 0 0 0; color: #ffffff; position: relative; z-index: 10; width: 100%; }
        .footer-row { display: flex; flex-wrap: wrap; align-items: flex-start; }
        .footer-col { padding-bottom: 40px; }
        
        /* LOGO FOOTER */
        .footer-logo-image { 
            max-height: 45px; 
            width: auto; 
            display: block; 
            margin-bottom: 20px; 
            background: #ffffff; 
            padding: 8px;        
            border-radius: 8px;  
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .footer-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #bfdbfe; margin-bottom: 25px; display: block; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; width: fit-content; }
        .footer-desc { font-size: 14px; color: #f1f5f9; line-height: 1.7; margin-bottom: 20px; text-align: justify; }
        .btn-admin-footer { display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #2563eb; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-admin-footer:hover { background: #f1f5f9; transform: translateY(-2px); }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { color: #f1f5f9; font-size: 14px; text-decoration: none; display: flex; align-items: flex-start; gap: 10px; }
        .footer-links i { color: #2563eb; font-size: 14px; margin-top: 3px; background: #ffffff; padding: 6px; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; }
        .footer-bottom { background: rgba(0, 0, 0, 0.2); padding: 20px 0; margin-top: 20px; text-align: center; font-size: 13px; color: #e2e8f0; width: 100%; }

        #about .col-md-6 img { max-width: 150px !important; display: block; margin: 0 auto 20px auto; }
        .slider-content { height: 100%; display: flex; align-items: center; justify-content: center; text-align: center; }
        #home, #about, #services, #portfolio, #blog, #contact { scroll-margin-top: 90px; }

        @media (max-width: 991px) {
            #header { height: 70px; padding: 10px 0; } 
            
            /* --- LOGO HP DIBESARKAN JADI 45px --- */
            .logo-image { max-height: 45px; } 
            /* ------------------------------------ */

            .nav-menu, .header-right-btn, .login-link-mobile { display: none !important; }
            .mobile-nav-toggle { display: none !important; } 

            .custom-mobile-toggle { 
                display: block !important; 
                color: #2563eb !important; 
                font-size: 28px; 
                cursor: pointer; 
                position: fixed; right: 20px; top: 18px; 
                z-index: 2147483647; 
                background: transparent; border: none; padding: 0;
                outline: none !important;
                -webkit-tap-highlight-color: transparent;
            }
            .custom-mobile-toggle:focus { outline: none !important; }

            .header-right .user-toggle { position: fixed; right: 65px; top: 15px; z-index: 9998; }
            
            .mobile-menu-popup, .menu-backdrop { 
                top: 60px !important; 
                max-height: calc(100vh - 60px);
            }
            
            .mobile-nav, .mobile-nav-overly, #mobile-nav { display: none !important; opacity: 0 !important; visibility: hidden !important; }
            .footer-col { text-align: center !important; width: 100%; }
            .footer-logo-image { margin: 0 auto 20px auto; }
            .footer-desc { text-align: center; }
            .footer-links a { justify-content: center; }
            .btn-admin-footer, .footer-title { margin: 0 auto 20px auto; }
            
            .slider-glass-card { padding: 20px 15px !important; margin: 40px auto 0 auto !important; background: rgba(255, 255, 255, 0.18) !important; backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1.5px solid rgba(255, 255, 255, 0.4) !important; border-radius: 20px; max-width: 85% !important; height: auto !important; display: flex; flex-direction: column; align-items: center; }
            .slider-glass-card h2 { font-size: 36px !important; color: #fff !important; text-shadow: 0 2px 4px rgba(0,0,0,0.2); line-height: 1.1 !important; }
            .slider-glass-card strong { font-size: 30px !important; color: #38bdf8 !important; display: block; margin-top: 10px; }
            .slider-glass-card .btn, .slider-glass-card a[class*="btn"] { width: 130px !important; padding: 8px 10px !important; font-size: 10px !important; border-radius: 8px !important; margin: 5px auto !important; display: block !important; font-weight: 700 !important; text-transform: uppercase; }
            .slider-glass-card .btn-info, a[href*="registrasi"] { background-color: #38bdf8 !important; color: #ffffff !important; border: none !important; }
            .slider-glass-card .btn-secondary, a[href*="contact"] { background-color: transparent !important; color: #ffffff !important; border: 1.5px solid #ffffff !important; }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script>
        function forceHidePreloader() { var loader = document.getElementById('preloader-custom'); if (loader) { loader.style.opacity = '0'; setTimeout(function() { loader.style.display = 'none'; }, 500); } }
        setTimeout(forceHidePreloader, 1500); window.onload = forceHidePreloader;
    </script>
</head>

<body>
    <div id="preloader-custom"><img src="<?php echo e(asset('assets/img/preloader.gif')); ?>" alt="Loading..."></div>

    <header id="header">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center h-100">
            
            
            <a href="<?php echo e(url('/')); ?>" class="logo-container-custom">
                <img src="<?php echo e(asset('gambar/logohome.jpeg')); ?>?v=<?php echo e(time()); ?>" alt="Logo Astronet" class="logo-image">
            </a>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a class="page-scroll" href="<?php echo e(url('/')); ?>#home"><i class="fa-solid fa-house"></i> Beranda</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>#about"><i class="fa-solid fa-circle-info"></i> Tentang</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>#services"><i class="fa-solid fa-list-check"></i> Alur Proses</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>#portfolio"><i class="fa-solid fa-images"></i> Galeri</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>#blog"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php $cek = \App\Models\Pendaftaran::where('id_users', Auth::id())->first(); $statusDiterima = ($cek && strtolower($cek->status_pendaftaran) == 'diterima'); ?>
                        <?php if(!$statusDiterima): ?> <li><a href="<?php echo e(route('pendaftaran.index')); ?>"><i class="fa-solid fa-file-signature"></i> Pendaftaran</a></li> <?php endif; ?>
                        <li><a href="<?php echo e(route('pelamar.lamaran.index')); ?>"><i class="fa-solid fa-briefcase"></i> Lamaran</a></li>
                        <?php if($statusDiterima): ?> 
                            <li><a href="<?php echo e(route('mahasiswa.laporan.index')); ?>"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                            
                            <li><a href="<?php echo e(route('mahasiswa.absensi.index')); ?>"><i class="fa-solid fa-clock"></i> Absensi</a></li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="header-right d-flex align-items-center">
                <?php if(auth()->guard()->check()): ?>
                    <div class="user-dropdown d-none d-lg-block">
                        <a href="#" class="user-toggle"><div class="user-avatar"><i class="fa-solid fa-user"></i></div> <span class="d-none d-md-block"><?php echo e(Auth::user()->name); ?></span></a>
                        <div class="dropdown-menu-custom">
                            <a href="<?php echo e(route('profile.view')); ?>" class="dropdown-item-custom"><i class="fa-regular fa-id-card"></i> Profil Saya</a>
                            <div style="border-top: 1px solid #f1f5f9; margin: 5px 0;"></div>
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item-custom" style="color: #ef4444;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
                        </div>
                    </div>
                    <a href="<?php echo e(route('profile.view')); ?>" class="user-toggle d-flex d-lg-none"><div class="user-avatar"><i class="fa-solid fa-user"></i></div></a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="d-none d-lg-block" style="font-weight: 700; color: #2563eb; margin-right: 25px; text-decoration: none;">Masuk</a>
                    <a href="<?php echo e(url('/')); ?>#contact" class="page-scroll header-right-btn">Hubungi Kami</a>
                <?php endif; ?>
                
                
                <button class="custom-mobile-toggle d-lg-none" onclick="toggleMobileMenu()"><i class="fa-solid fa-bars"></i></button>
            </div>
        </div>
    </header>

    <?php echo $__env->yieldContent('contents'); ?>

    <footer id="footer">
        <div class="container">
            <div class="footer-row row">
                <div class="col-lg-5 col-md-5 col-sm-12 footer-col">
                    <div class="footer-logo-text">
                        <a href="<?php echo e(url('/')); ?>" class="logo-container-custom">
                            
                            <img src="<?php echo e(asset('gambar/logohome.jpeg')); ?>?v=<?php echo e(time()); ?>" alt="Logo Astronet" class="footer-logo-image">
                        </a>
                    </div>
                    <p class="footer-desc">PT MEDIA BALAI NUSA (ASTRONET.ID) merupakan perusahaan penyedia layanan internet (ISP) berbasis fiber optik yang resmi dan terpercaya.</p>
                    <a href="<?php echo e(url('login')); ?>" class="btn-admin-footer"><i class="fa-solid fa-user-shield"></i> Login Admin</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 footer-col"><span class="footer-title">INFORMASI</span><p class="footer-desc">Kelola data magang dengan mudah dan efisien.</p></div>
                <div class="col-lg-3 col-md-3 col-sm-12 footer-col"><span class="footer-title">KONTAK KAMI</span><ul class="footer-links"><li><a href="#"><i class="fa-solid fa-location-dot"></i><span>Jl. Letjend. Kec. Teluk Nibung, Kota Tanjung Balai.</span></a></li><li><a href="#"><i class="fa-solid fa-clock"></i><span>08.00 - 17.00 WIB</span></a></li><li><a href="#"><i class="fa-solid fa-phone"></i><span>+62 851-5712-7721</span></a></li></ul></div>
            </div>
        </div>
        <div class="footer-bottom"><div class="container">&copy; 2025 <strong>astronet.id</strong>. All Rights Reserved.</div></div>
    </footer>

    <div id="menuBackdrop" class="menu-backdrop" onclick="toggleMobileMenu()"></div>
    <div id="mobileMenuPopup" class="mobile-menu-popup">
        <ul class="mm-list">
            <li><a href="<?php echo e(url('/')); ?>#home" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-house"></i> <span>Beranda</span></a></li>
            <li><a href="<?php echo e(url('/')); ?>#about" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-circle-info"></i> <span>Tentang</span></a></li>
            <li><a href="<?php echo e(url('/')); ?>#services" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-list-check"></i> <span>Alur Proses</span></a></li>
            <li><a href="<?php echo e(url('/')); ?>#portfolio" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-images"></i> <span>Galeri</span></a></li>
            <li><a href="<?php echo e(url('/')); ?>#blog" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-newspaper"></i> <span>Berita</span></a></li>
            <?php if(auth()->guard()->check()): ?>
                <?php if(!$statusDiterima): ?> <li><a href="<?php echo e(route('pendaftaran.index')); ?>" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-file-signature"></i> <span>Pendaftaran</span></a></li> <?php endif; ?>
                <li><a href="<?php echo e(route('pelamar.lamaran.index')); ?>" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-briefcase"></i> <span>Lamaran</span></a></li>
                <?php if($statusDiterima): ?> 
                    <li><a href="<?php echo e(route('mahasiswa.laporan.index')); ?>" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-file-lines"></i> <span>Laporan</span></a></li>
                    
                    <li><a href="<?php echo e(route('mahasiswa.absensi.index')); ?>" class="mm-item" onclick="toggleMobileMenu()"><i class="fa-solid fa-clock"></i> <span>Absensi</span></a></li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <div class="mm-actions">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mm-btn">Keluar</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="mm-btn">Masuk</a>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?php echo e(asset('assets')); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/owl.carousel/assets/owl.carousel.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/venobox/venobox.min.js"></script>
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

    <script>
        // FUNGSI GLOBAL DI LUAR DOCUMENT READY AGAR BISA DIPANGGIL ONCLICK
        function toggleMobileMenu() { 
            var backdrop = document.getElementById('menuBackdrop');
            var popup = document.getElementById('mobileMenuPopup');
            
            if (backdrop.classList.contains('show')) {
                backdrop.classList.remove('show');
                popup.classList.remove('show');
            } else {
                backdrop.classList.add('show');
                popup.classList.add('show');
            }
        }

        $(document).ready(function() {
            // SNAKE TRAIL ASLI
            (function() {
                const trailLength = 10; const dots = []; let mouseX = window.innerWidth/2; let mouseY = window.innerHeight/2;
                for (let i = 0; i < trailLength; i++) { 
                    const dot = document.createElement('div'); dot.classList.add('cursor-trail-dot'); 
                    if (i === 0) dot.classList.add('trail-leader'); document.body.appendChild(dot); 
                    dots.push({ element: dot, x: mouseX, y: mouseY }); 
                }
                document.addEventListener('mousemove', (e) => { mouseX = e.clientX; mouseY = e.clientY; });
                document.addEventListener('mousedown', () => dots[0].element.classList.add('is-clicking'));
                document.addEventListener('mouseup', () => dots[0].element.classList.remove('is-clicking'));
                document.addEventListener('touchmove', (e) => { mouseX = e.touches[0].clientX; mouseY = e.touches[0].clientY; });
                document.addEventListener('touchstart', (e) => { mouseX = e.touches[0].clientX; mouseY = e.touches[0].clientY; dots[0].element.classList.add('is-clicking'); });
                document.addEventListener('touchend', () => dots[0].element.classList.remove('is-clicking'));
                function animateTrail() { 
                    let targetX = mouseX; let targetY = mouseY; 
                    dots.forEach((dot, index) => { 
                        if (index === 0) { dot.x = targetX; dot.y = targetY; } 
                        else { const prevDot = dots[index - 1]; dot.x += (prevDot.x - dot.x) * 0.35; dot.y += (prevDot.y - dot.y) * 0.35; const scale = 1 - (index * 0.05); dot.element.style.transform = `translate(-50%, -50%) scale(${scale})`; } 
                        dot.element.style.left = dot.x + 'px'; dot.element.style.top = dot.y + 'px'; 
                    }); requestAnimationFrame(animateTrail); 
                } animateTrail();
            })();

            if ($('.table').length > 0) { $('.table').DataTable({ dom: 'lBfrtip', buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'], "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ] }); }

            // KLIK LINK MENU
            $(document).on('click', 'a.page-scroll, .mm-item', function(e) {
                var href = $(this).attr('href');
                if(href && href.includes('#')) {
                    var hash = href.substring(href.indexOf('#'));
                    if($(hash).length && (window.location.pathname === '/' || window.location.pathname === '')) {
                        e.preventDefault();
                        var popup = document.getElementById('mobileMenuPopup');
                        if (popup && popup.classList.contains('show')) { toggleMobileMenu(); }
                        $('html, body').stop().animate({ scrollTop: $(hash).offset().top - 80 }, 1200, 'easeInOutExpo');
                    }
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template/master.blade.php ENDPATH**/ ?>