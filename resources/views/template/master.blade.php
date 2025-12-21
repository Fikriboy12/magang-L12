<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PT. MEDIA BALAI NUSA</title>

    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">

    {{-- FONT & CSS LIBRARY --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="{{ asset('assets') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/vendor/venobox/venobox.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/dataTables.bootstrap4.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet">
    <link href="{{ asset('assets') }}/css/responsive.css" rel="stylesheet">
    
    <style>
        /* --- CSS PRELOADER CUSTOM --- */
        #preloader-custom {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999999;
            opacity: 1;
            transition: opacity 0.5s ease;
        }
        #preloader-custom img {
            width: 120px;
            height: auto;
        }

        /* --- GLOBAL --- */
        html, body {
            width: 100%;
            overflow-x: hidden;
            background-color: #f8fafc;
            scroll-behavior: auto !important; 
            height: auto !important;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif !important;
            color: #334155;
        }

        img { max-width: 100%; height: auto; }

        /* --- PERBAIKAN TAMPILAN --- */
        .container .row {
            justify-content: center; 
        }
        .footer-desc {
            text-align: justify;
        }

        /* HANYA MENGUBAH UKURAN LOGO TENTANG KAMI */
        #about .col-md-6 img {
            max-width: 150px !important; 
            display: block;
            margin: 0 auto 20px auto;
        }

        .slider-content {
            height: 100%; 
            display: flex;
            align-items: center; 
            justify-content: center; 
            text-align: center;
        }
        .slider-glass-card {
            text-align: center;
            max-width: 380px; 
            padding: 25px 20px; 
            margin-top: 60px; 
        }
        
        #home, #about, #services, #portfolio, #blog, #contact {
            scroll-margin-top: 90px; 
        }

        #header {
            background: #ffffff !important; 
            height: 80px;
            transition: all 0.5s;
            z-index: 997;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            padding: 15px 0;
            position: fixed;
            top: 0; width: 100%;
            display: flex; align-items: center;
        }
        .logo-container-custom { display: flex; align-items: center; text-decoration: none !important; }
        .logo-box-custom {
            width: 40px; height: 40px; background: #2563eb; color: #ffffff;
            font-size: 24px; font-weight: 800; display: flex; align-items: center; justify-content: center;
            border-radius: 8px; margin-right: 10px;
        }
        #header .logo-text-custom { font-size: 22px; font-weight: 800; color: #0f172a !important; text-transform: uppercase; }
        #footer .logo-text-custom { font-size: 22px; font-weight: 800; color: #ffffff; text-transform: uppercase; }
        #footer .logo-box-custom { background: #ffffff; color: #2563eb; }

        .nav-menu { margin-left: 40px; }
        .nav-menu ul { margin: 0; padding: 0; list-style: none; display: flex; }
        .nav-menu li { margin: 0 5px; }
        .nav-menu a {
            color: #64748b !important;
            font-size: 14px; font-weight: 600;
            text-decoration: none; display: flex; align-items: center; gap: 5px;
            cursor: pointer;
        }
        .nav-menu a:hover, .nav-menu .active > a { color: #2563eb !important; }

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

        #footer {
            background-color: #2563eb !important; 
            padding: 60px 0 0 0;
            color: #ffffff;
            position: relative;
            z-index: 10;
            width: 100%;
        }
        .footer-row { display: flex; flex-wrap: wrap; align-items: flex-start; }
        .footer-col { padding-bottom: 40px; }
        .footer-logo-text { display: flex; align-items: center; margin-bottom: 20px; }
        .footer-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #bfdbfe; margin-bottom: 25px; display: block; border-bottom: 1px solid rgba(255,255,255,0.2); padding-bottom: 10px; width: fit-content; }
        .footer-desc { font-size: 14px; color: #f1f5f9; line-height: 1.7; margin-bottom: 20px; text-align: justify; }
        .btn-admin-footer { display: inline-flex; align-items: center; gap: 8px; background: #ffffff; color: #2563eb; padding: 10px 20px; border-radius: 8px; font-size: 13px; font-weight: 700; text-decoration: none; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-admin-footer:hover { background: #f1f5f9; transform: translateY(-2px); }
        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 15px; }
        .footer-links a { color: #f1f5f9; font-size: 14px; text-decoration: none; display: flex; align-items: flex-start; gap: 10px; }
        .footer-links i { color: #2563eb; font-size: 14px; margin-top: 3px; background: #ffffff; padding: 6px; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; }
        .footer-bottom { background: rgba(0, 0, 0, 0.2); padding: 20px 0; margin-top: 20px; text-align: center; font-size: 13px; color: #e2e8f0; width: 100%; }

        @media (max-width: 991px) {
            #header { height: 70px; padding: 10px 0; }
            .nav-menu { display: none; }
            .header-right-btn { display: none; } 
            
            .mobile-nav-toggle {
                display: block !important;
                color: #2563eb !important; 
                font-size: 30px; cursor: pointer;
                position: fixed; right: 15px; top: 20px; z-index: 9999;
                background: transparent; border: none; padding: 0;
            }
            .mobile-nav-toggle i { color: #2563eb !important; }

            .user-dropdown { position: fixed; right: 65px; top: 18px; z-index: 9998; }
            .login-link-mobile { font-size: 13px !important; margin-right: 55px !important; font-weight: 700 !important; color: #2563eb !important; }

            .mobile-nav-active .mobile-nav {
                background: #ffffff !important;
                width: 260px !important;
                top: 80px !important; 
                right: 15px !important; 
                left: auto !important;
                border-radius: 12px !important; 
                box-shadow: 0 10px 30px rgba(0,0,0,0.15); 
                padding: 15px !important;
            }
            .mobile-nav a {
                color: #38bdf8 !important; 
                font-weight: 600 !important;
                padding: 12px 0 !important;
                border-bottom: 1px solid #f1f5f9;
                display: block;
            }

            .logo-box-custom {
                width: 32px !important; 
                height: 32px !important; 
                font-size: 20px !important; 
                border-radius: 6px !important; 
                margin-right: 6px !important;
            }
            #header .logo-text-custom { 
                font-size: 14px !important;
                margin-top: 5px !important; 
            }

            #about .col-md-6 img {
                max-width: 100px !important;
            }

            .slider-glass-card {
                padding: 20px 15px !important;
                margin: 40px auto 0 auto !important; 
                background: rgba(255, 255, 255, 0.18) !important; 
                backdrop-filter: blur(12px); 
                -webkit-backdrop-filter: blur(12px);
                border: 1.5px solid rgba(255, 255, 255, 0.4) !important; 
                border-radius: 20px;
                max-width: 85% !important; 
                height: auto !important; 
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .slider-glass-card h2 { 
                font-size: 36px !important; 
                color: #fff !important; 
                text-shadow: 0 2px 4px rgba(0,0,0,0.2); 
                line-height: 1.1 !important;
            }
            .slider-glass-card strong { 
                font-size: 30px !important; 
                color: #38bdf8 !important; 
                display: block; 
                margin-top: 10px;
            }

            .slider-glass-card .btn,
            .slider-glass-card a[class*="btn"] {
                width: 130px !important; 
                padding: 8px 10px !important; 
                font-size: 10px !important; 
                border-radius: 8px !important; 
                margin: 5px auto !important;
                display: block !important;
                font-weight: 700 !important;
                text-transform: uppercase;
            }
            .slider-glass-card .btn-info, a[href*="registrasi"] { background-color: #38bdf8 !important; color: #ffffff !important; border: none !important; }
            .slider-glass-card .btn-secondary, a[href*="contact"] { background-color: transparent !important; color: #ffffff !important; border: 1.5px solid #ffffff !important; }

            .footer-col { text-align: center !important; width: 100%; }
            .footer-logo-text { justify-content: center; }
            .footer-desc { text-align: center; }
            .footer-links a { justify-content: center; }
            .btn-admin-footer { margin: 0 auto; }
            .footer-title { margin: 0 auto 20px auto; }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <script>
        // FUNGSI INI DITARUH DI ATAS AGAR LANGSUNG JALAN DI HP
        function forceHidePreloader() {
            var loader = document.getElementById('preloader-custom');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(function() {
                    loader.style.display = 'none';
                }, 500);
            }
        }
        // Jika 1.5 detik belum selesai load, paksa hilangkan preloader (Sangat penting untuk HP)
        setTimeout(forceHidePreloader, 1500);
        // Tetap jalankan saat load normal selesai
        window.onload = forceHidePreloader;
    </script>
</head>

<body>

    <div id="preloader-custom">
        <img src="{{ asset('assets/img/preloader.gif') }}" alt="Loading...">
    </div>

    <button type="button" class="mobile-nav-toggle d-lg-none">
        <i class="fa-solid fa-bars"></i>
    </button>

    {{-- HEADER START --}}
    <header id="header">
        <div class="container-fluid px-4 d-flex justify-content-between align-items-center h-100">
            
            <a href="{{ url('/') }}" class="logo-container-custom">
                <div class="logo-box-custom">A</div>
                <span class="logo-text-custom">STRONET.ID</span>
            </a>

            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li class="active"><a class="page-scroll" href="{{ url('/') }}#home"><i class="fa-solid fa-house"></i> Beranda</a></li>
                    <li><a class="page-scroll" href="{{ url('/') }}#about"><i class="fa-solid fa-circle-info"></i> Tentang</a></li>
                    <li><a class="page-scroll" href="{{ url('/') }}#services"><i class="fa-solid fa-list-check"></i> Alur Proses</a></li>
                    <li><a class="page-scroll" href="{{ url('/') }}#portfolio"><i class="fa-solid fa-images"></i> Galeri</a></li>
                    <li><a class="page-scroll" href="{{ url('/') }}#blog"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
                    
                    @auth
                        @php
                            $cek = \App\Models\Pendaftaran::where('id_users', Auth::id())->first();
                            $statusDiterima = ($cek && strtolower($cek->status_pendaftaran) == 'diterima');
                        @endphp

                        @if(!$statusDiterima) 
                            <li><a href="{{ route('pendaftaran.index') }}"><i class="fa-solid fa-file-signature"></i> Pendaftaran</a></li> 
                        @endif

                        <li><a href="{{ route('pelamar.lamaran.index') }}"><i class="fa-solid fa-briefcase"></i> Lamaran</a></li>

                        @if($statusDiterima)
                            <li><a href="{{ route('mahasiswa.laporan.index') }}"><i class="fa-solid fa-file-lines"></i> Laporan</a></li>
                        @endif
                    @endauth
                </ul>
            </nav>

            <div class="header-right d-flex align-items-center">
                @auth
                    <div class="user-dropdown">
                        <a href="#" class="user-toggle">
                            <div class="user-avatar"><i class="fa-solid fa-user"></i></div>
                            <span class="d-none d-md-block">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu-custom">
                            <a href="{{ route('profile.view') }}" class="dropdown-item-custom"><i class="fa-regular fa-id-card"></i> Profil Saya</a>
                            <div style="border-top: 1px solid #f1f5f9; margin: 5px 0;"></div>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item-custom" style="color: #ef4444;"><i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="login-link-mobile" style="font-weight: 600; color: #2563eb; margin-right: 50px; text-decoration: none;">Masuk</a>
                    <a href="{{ url('/') }}#contact" class="page-scroll header-right-btn">Hubungi Kami</a>
                @endauth
            </div>
        </div>
    </header>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show alert-floating" role="alert" style="position: fixed; top: 100px; right: 20px; z-index: 99999;">
            <i class="fa-solid fa-check-circle"></i> <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @yield('contents')

    <footer id="footer">
        <div class="container">
            <div class="footer-row row">
                <div class="col-lg-5 col-md-5 col-sm-12 footer-col">
                    <div class="footer-logo-text">
                        <a href="{{ url('/') }}" class="logo-container-custom">
                            <div class="logo-box-custom">A</div>
                            <span class="logo-text-custom">STRONET.ID</span>
                        </a>
                    </div>
                    <p class="footer-desc">Silahkan Masuk ke admin jika anda adalah admin dari website ini. Kelola data magang dengan mudah dan efisien.</p>
                    <a href="{{ url('login') }}" class="btn-admin-footer"><i class="fa-solid fa-user-shield"></i> Login Admin</a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12 footer-col">
                    <span class="footer-title">INFORMASI</span>
                    <p class="footer-desc">PT MEDIA BALAI NUSA (ASTRONET.ID) merupakan perusahaan penyedia layanan internet (ISP) berbasis fiber optik yang resmi dan terpercaya.</p>
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
            <div class="container">&copy; 2025 <strong>ASTRONET.ID</strong>. All Rights Reserved.</div>
        </div>
    </footer>

    <script src="{{ asset('assets') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/jquery.easing/jquery.easing.min.js"></script>
    <script src="{{ asset('assets') }}/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script>
        $(document).ready(function() {
            if ($('.table').length > 0) {
                $('.table').DataTable({ dom: 'lBfrtip', buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'], "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ] });
            }

            $(document).on('click', 'a.page-scroll, .header-right-btn.page-scroll', function(e) {
                var href = $(this).attr('href');
                if(href && href.includes('#')) {
                    var hash = href.substring(href.indexOf('#'));
                    var target = $(hash);
                    if(target.length && (window.location.pathname === '/' || window.location.pathname === '')) {
                        e.preventDefault();
                        $('html, body').stop().animate({ scrollTop: target.offset().top - 80 }, 1200, 'easeInOutExpo');
                    }
                }
            });
        });
    </script>
</body>
</html>