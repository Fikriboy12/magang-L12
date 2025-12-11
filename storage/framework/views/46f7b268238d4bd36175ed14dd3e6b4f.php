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
        /* --- GLOBAL --- */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            color: #334155;
            overflow-x: hidden;
            background-color: #f8fafc;
        }

        img { max-width: 100%; height: auto; }

        /* --- NAVBAR --- */
        #header {
            background: #ffffff;
            height: 80px;
            transition: all 0.5s;
            z-index: 997;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 15px 0;
            position: fixed;
            top: 0; width: 100%;
            display: flex; align-items: center;
        }
        /* Gaya untuk Logo STRONET.ID (Header & Footer) */
        .logo-container-custom { display: flex; align-items: center; text-decoration: none !important; }
        .logo-box-custom {
            width: 40px; height: 40px; background: #2563eb; color: #ffffff; /* Kotak Biru Huruf Putih */
            font-size: 24px; font-weight: 800; display: flex; align-items: center; justify-content: center;
            border-radius: 8px; margin-right: 10px;
        }
        /* Logo text di header */
        #header .logo-text-custom { font-size: 22px; font-weight: 800; color: #0f172a; text-transform: uppercase; }
        /* Logo text di footer */
        #footer .logo-text-custom { font-size: 22px; font-weight: 800; color: #ffffff; text-transform: uppercase; }


        /* MENU DESKTOP */
        .nav-menu { margin-left: 40px; }
        .nav-menu ul { margin: 0; padding: 0; list-style: none; display: flex; }
        .nav-menu li { margin: 0 5px; }
        .nav-menu a {
            color: #64748b; font-size: 14px; font-weight: 600;
            text-decoration: none; display: flex; align-items: center; gap: 5px;
            cursor: pointer;
        }
        .nav-menu a:hover, .nav-menu .active > a { color: #2563eb; }

        /* TOMBOL & USER */
        .header-right-btn {
            background: #0f172a; color: white !important; padding: 8px 20px;
            border-radius: 50px; font-size: 13px; font-weight: 700;
            text-decoration: none; display: flex; align-items: center; gap: 5px;
            transition: 0.3s;
        }
        .header-right-btn:hover { background: #2563eb; transform: translateY(-2px); }

        .user-dropdown { position: relative; display: inline-block; }
        .user-toggle {
            display: flex; align-items: center; gap: 8px; padding: 5px 12px;
            border-radius: 50px; background: #f1f5f9; color: #0f172a !important;
            font-weight: 700; font-size: 13px; cursor: pointer; text-decoration: none;
        }
        .user-avatar {
            width: 28px; height: 28px; background: #2563eb; color: white;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px;
        }
        .dropdown-menu-custom {
            position: absolute; right: 0; top: 110%; background: white; min-width: 180px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1); border-radius: 10px; padding: 5px 0;
            opacity: 0; visibility: hidden; transform: translateY(10px); transition: 0.3s;
            border: 1px solid #f1f5f9; z-index: 9999;
        }
        .user-dropdown:hover .dropdown-menu-custom { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item-custom {
            display: flex; align-items: center; gap: 8px; padding: 8px 15px;
            color: #64748b; font-size: 13px; font-weight: 500; text-decoration: none;
        }
        .dropdown-item-custom:hover { background: #f8fafc; color: #2563eb; }

        /* FOOTER BIRU CERAH (SOLID) */
        #footer {
            background-color: #2563eb !important; 
            background: #2563eb !important;
            padding: 60px 0 0 0;
            color: #ffffff;
            position: relative;
            z-index: 10;
            border-top: none;
            width: 100%;
        }
        .footer-row { display: flex; flex-wrap: wrap; align-items: flex-start; }
        .footer-col { padding-bottom: 40px; }
        
        /* Container Logo Footer */
        .footer-logo-text { 
            display: flex; align-items: center; margin-bottom: 20px; 
        }
        
        .footer-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #bfdbfe; margin-bottom: 25px; display: block; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; width: fit-content; }
        .footer-desc { font-size: 14px; color: #f1f5f9; line-height: 1.7; margin-bottom: 20px; text-align: justify; }
        .btn-admin-footer { display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #2563eb; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-admin-footer:hover { background: #f1f5f9; transform: translateY(-2px); }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { color: #f1f5f9; font-size: 14px; text-decoration: none; display: flex; align-items: flex-start; gap: 10px; }
        .footer-links a:hover { color: #ffffff; padding-left: 5px; }
        .footer-links i { color: #2563eb; font-size: 14px; margin-top: 3px; background: #ffffff; padding: 6px; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; }
        .footer-bottom { background: rgba(0, 0, 0, 0.2); padding: 20px 0; margin-top: 20px; text-align: center; font-size: 13px; color: #e2e8f0; width: 100%; }
        .footer-bottom strong { color: #ffffff; }

        /* ======================================= */
        /* 📱 FIX TAMPILAN HP (MOBILE) 📱          */
        /* ======================================= */
        @media (max-width: 991px) {
            #header { height: 70px; padding: 10px 0; }
            .nav-menu { display: none; }
            .header-right-btn { display: none; } 
            
            /* 1. TOMBOL BURGER MENU */
            .mobile-nav-toggle {
                display: block !important;
                color: #2563eb !important; 
                font-size: 30px; cursor: pointer;
                position: fixed; right: 15px; top: 20px; z-index: 9999;
                background: transparent; border: none; padding: 0;
            }
            .mobile-nav-toggle i { color: #2563eb !important; }

            /* 2. PROFIL USER */
            .user-dropdown { 
                position: fixed; right: 65px; top: 18px; z-index: 9998; 
            }
            .user-toggle span { display: none; } 
            .user-avatar { width: 32px; height: 32px; }

            .login-link-mobile { font-size: 13px !important; margin-right: 55px !important; font-weight: 700 !important; color: #2563eb !important; }

            /* Styling Logo di Mobile */
            .logo-text-custom { font-size: 18px !important; }
            .logo-box-custom { width: 32px; height: 32px; font-size: 16px; }

            /* 3. FIX GAMBAR NGEZOOM */
            .slider-area, #home {
                height: auto !important; min-height: 600px !important; padding-top: 70px;
            }
            .nivoSlider { position: relative; height: 600px !important; }
            .nivoSlider img {
                width: auto !important; height: 100% !important; max-width: none !important;
                position: absolute; left: 50%; transform: translateX(-50%); object-fit: cover !important; 
            }

            /* Fix Konten Hero */
            .slider-content { height: 100%; display: flex; align-items: center; justify-content: center; }
            .slider-glass-card { width: 90% !important; padding: 30px 20px !important; margin-top: 20px !important; }
            .title2-hero { font-size: 28px !important; line-height: 1.3 !important; }

            /* Footer HP */
            #footer { padding-top: 40px; }
            .footer-col { text-align: center !important; margin-bottom: 30px; padding: 0 20px; width: 100%; }
            
            /* Logo Footer Center */
            .footer-logo-text { justify-content: center; }
            
            .footer-desc { text-align: center; font-size: 13px; }
            .footer-links a { justify-content: center; font-size: 13px; align-items: center; }
            .btn-admin-footer { margin: 0 auto; }
            .footer-title { margin: 0 auto 20px auto; }
            
            #hero, #about, #services, #portfolio, #blog, #contact {
                text-align: center !important; padding-left: 15px !important; padding-right: 15px !important;
                width: 100% !important; box-sizing: border-box !important;
            }
            img:not(.nivo-main-image) { max-width: 100% !important; height: auto !important; display: inline-block !important; margin: 0 auto !important; }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>

    <button type="button" class="mobile-nav-toggle d-lg-none">
        <i class="fa-solid fa-bars"></i>
    </button>

    
    <header id="header">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center h-100">
            
            <a href="<?php echo e(url('/')); ?>" class="logo-container-custom">
                <div class="logo-box-custom">A</div>
                <span class="logo-text-custom">STRONET.ID</span>
            </a>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    
                    <li class="active"><a class="page-scroll" href="<?php echo e(url('/')); ?>/#home"><i class="fa-solid fa-house"></i> Beranda</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>/#about"><i class="fa-solid fa-circle-info"></i> Tentang</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>/#services"><i class="fa-solid fa-list-check"></i> Alur Proses</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>/#portfolio"><i class="fa-solid fa-images"></i> Galeri</a></li>
                    <li><a class="page-scroll" href="<?php echo e(url('/')); ?>/#blog"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <?php
                            $bolehDaftar = true;
                            $cek = \App\Models\Pendaftaran::where('id_users', Auth::id())->first();
                            if($cek && (strtolower($cek->status_pendaftaran) == 'diterima')) { $bolehDaftar = false; }
                        ?>
                        <?php if($bolehDaftar): ?> 
                            
                            <li>
                                <a href="<?php echo e(route('pendaftaran.index')); ?>">
                                    <i class="fa-solid fa-file-signature"></i> Pendaftaran
                                </a>
                            </li> 
                        <?php endif; ?>
                        
                        <li>
                            <a href="<?php echo e(route('pelamar.lamaran.index')); ?>">
                                <i class="fa-solid fa-briefcase"></i> Lamaran
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?php echo e(route('mahasiswa.laporan.index')); ?>">
                                <i class="fa-solid fa-file-lines"></i> Laporan
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="header-right d-flex align-items-center">
                <?php if(auth()->guard()->check()): ?>
                    <div class="user-dropdown">
                        <a href="#" class="user-toggle">
                            <div class="user-avatar"><i class="fa-solid fa-user"></i></div>
                            <span class="d-none d-md-block"><?php echo e(Auth::user()->name); ?></span>
                        </a>
                        <div class="dropdown-menu-custom">
                            <a href="<?php echo e(route('profile.view')); ?>" class="dropdown-item-custom"><i class="fa-regular fa-id-card"></i> Profil Saya</a>
                            <div style="border-top: 1px solid #f1f5f9; margin: 5px 0;"></div>
                            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item-custom" style="color: #ef4444;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="login-link-mobile" style="font-weight: 600; color: #2563eb; margin-right: 50px; text-decoration: none;">Masuk</a>
                    <a class="page-scroll header-right-btn" href="<?php echo e(url('/')); ?>/#contact">Hubungi Kami</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show alert-floating" role="alert" style="position: fixed; top: 100px; right: 20px; z-index: 99999;">
            <i class="fa-solid fa-check-circle"></i> <strong>Berhasil!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('contents'); ?>

    <footer id="footer">
        <div class="container">
            <div class="footer-row row">
                
                <div class="col-lg-5 col-md-5 col-sm-12 footer-col">
                    <div class="footer-logo-text">
                        <a href="<?php echo e(url('/')); ?>" class="logo-container-custom">
                            <div class="logo-box-custom" style="background: white; color: #2563eb;">A</div>
                            <span class="logo-text-custom">STRONET.ID</span>
                        </a>
                    </div>
                    <p class="footer-desc">
                        Silahkan Masuk ke admin jika anda adalah admin dari website ini. Kelola data magang dengan mudah dan efisien.
                    </p>
                    <a href="<?php echo e(url('login')); ?>" class="btn-admin-footer">
                        <i class="fa-solid fa-user-shield"></i> Login Admin
                    </a>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 footer-col">
                    <span class="footer-title">INFORMASI</span>
                    <p class="footer-desc">
                        PT MEDIA BALAI NUSA (ASTRONET.ID) merupakan perusahaan penyedia layanan internet (ISP) berbasis fiber optik yang resmi dan terpercaya, melayani kebutuhan internet rumah serta bisnis di wilayah Tanjungbalai dan sekitarnya.
                    </p>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 footer-col">
                    <span class="footer-title">KONTAK KAMI</span>
                    <ul class="footer-links">
                        <li><a href="#"><i class="fa-solid fa-location-dot"></i><span>Jl. Letjend. Kec. Teluk Nibung, Kota Tanjung Balai.</span></a></li>
                        <li><a href="#"><i class="fa-solid fa-clock"></i><span>08.00 - 17.00 WIB</span></a></li>
                        <li><a href="#"><i class="fa-solid fa-phone"></i><span>+62 851-5712-7721</span></a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                &copy; 2025 <strong>ASTRONET.ID</strong>. All Rights Reserved.
            </div>
        </div>
    </footer>
    
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    <div id="preloader"></div>

    <script src="<?php echo e(asset('assets')); ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/php-email-form/validate.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/appear/jquery.appear.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/knob/jquery.knob.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/parallax/parallax.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/wow/wow.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?php echo e(asset('assets')); ?>/vendor/venobox/venobox.min.js"></script>
    
    <script src="<?php echo e(asset('assets_admin/js/plugin/datatables/datatables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/buttons.html5.min.js')); ?>"></script>
    
    <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

    <script>
        // FUNGSI INI BERJALAN SAAT HALAMAN SELESAI DIMUAT
        // Bertugas untuk melakukan smooth scroll jika URL mengandung #hash
        function smoothScrollToTarget() {
            var hash = window.location.hash;
            if (hash) {
                var target = $(hash);
                // Hanya smooth scroll jika target ditemukan di DOM saat ini
                if (target.length) {
                    setTimeout(function() {
                        $('html, body').stop().animate({ 
                            scrollTop: target.offset().top - 80 
                        }, 1000, 'easeInOutExpo');
                    }, 100); 
                }
            }
        }

        $(document).ready(function() {
            // Inisialisasi DataTable jika ada
            if ($('.table').length > 0) { $('.table').DataTable(); }

            // Jalankan smooth scroll jika ada hash di URL (ini penting setelah full reload)
            smoothScrollToTarget();

            // Pasang event handler untuk klik menu scroll
            $(document).on('click', '.nav-menu a.page-scroll, .header-right-btn.page-scroll', function(e) {
                var href = $(this).attr('href');
                
                // Cek apakah link adalah link anchor (#) dan mengandung URL Beranda
                if (href && href.indexOf("#") !== -1 && href.includes('<?php echo e(url('/')); ?>')) {
                    
                    // Ambil bagian hash saja dari URL
                    var tempLink = document.createElement('a');
                    tempLink.href = href;
                    var hashPart = tempLink.hash; 
                    
                    var target = $(hashPart);
                    
                    // Cek apakah kita sudah berada di halaman root
                    var isRoot = window.location.pathname === '/' || window.location.pathname === '';

                    if (target.length && isRoot) {
                        // KASUS A: TARGET DITEMUKAN & SUDAH DI HALAMAN BERANDA (Lokal Scroll Cepat)
                        e.preventDefault(); 
                        
                        $('html, body').stop().animate({ 
                            scrollTop: target.offset().top - 80 
                        }, 1000, 'easeInOutExpo');
                        
                        window.history.pushState(null, null, hashPart); 

                        // Update active menu
                        $('.nav-menu li').removeClass('active');
                        $(this).closest('li').addClass('active');
                        
                        return false; 
                    } else {
                        // KASUS B: TARGET TIDAK DITEMUKAN ATAU TIDAK DI HALAMAN BERANDA
                        // Biarkan navigasi berjalan normal, akan terjadi full reload ke Beranda dengan #hash.
                        return true; 
                    }
                }
            });
        });
    </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template/master.blade.php ENDPATH**/ ?>