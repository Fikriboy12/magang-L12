<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>E-Magang</title>
  
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
      }
      .logo-container { display: flex; align-items: center; text-decoration: none !important; }
      .logo-box {
          width: 40px; height: 40px; background: #2563eb; color: white;
          font-size: 24px; font-weight: 800; display: flex; align-items: center; justify-content: center;
          border-radius: 8px; margin-right: 10px;
      }
      .logo-text { font-size: 22px; font-weight: 800; color: #0f172a; text-transform: uppercase; }

      /* MENU TENGAH */
      .nav-menu { margin-left: 40px; }
      .nav-menu ul { margin: 0; padding: 0; list-style: none; display: flex; }
      .nav-menu li { margin: 0 5px; }
      .nav-menu a {
          color: #64748b; font-size: 14px; font-weight: 600;
          text-decoration: none; display: flex; align-items: center; gap: 5px;
      }
      .nav-menu a:hover, .nav-menu .active > a { color: #2563eb; }

      /* TOMBOL USER LOGIN */
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

      /* ======================================= */
      /* 💎 FOOTER SESUAI GAMBAR 💎              */
      /* ======================================= */
      #footer {
          /* Warna Biru Solid Cerah */
          background-color: #2563eb !important; 
          background: #2563eb !important;
          padding: 70px 0 0 0;
          color: #ffffff;
          position: relative;
          z-index: 10;
          border-top: none;
      }
      
      .footer-row { display: flex; flex-wrap: wrap; align-items: flex-start; }
      .footer-col { padding-bottom: 40px; }

      /* Logo Footer Putih */
      .footer-logo-text { 
          font-size: 28px; font-weight: 800; color: #ffffff; 
          display: flex; align-items: center; gap: 10px; margin-bottom: 20px; 
      }
      /* Kotak E Putih, Huruf Biru */
      .footer-logo-box {
          width: 45px; height: 45px; background: #ffffff; color: #2563eb;
          display: flex; align-items: center; justify-content: center;
          border-radius: 8px; font-size: 26px; font-weight: 900;
      }

      /* Judul Kolom (INFORMASI, KONTAK KAMI) */
      .footer-title {
          font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;
          color: #e0f2fe; /* Putih agak biru dikit */
          margin-bottom: 20px; display: block; border-bottom: 1px solid rgba(255,255,255,0.2);
          padding-bottom: 10px; width: fit-content;
      }

      /* Teks Deskripsi */
      .footer-desc { font-size: 14px; color: #ffffff; line-height: 1.8; margin-bottom: 20px; text-align: justify; }

      /* Tombol Login Admin (Kotak Putih, Teks Biru) */
      .btn-admin-footer {
          display: inline-flex; align-items: center; gap: 10px;
          background: #ffffff; color: #2563eb !important; /* Warna Teks Biru */
          padding: 12px 25px;
          border-radius: 8px; font-size: 14px; font-weight: 700;
          text-decoration: none; transition: 0.3s; 
          box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      }
      .btn-admin-footer:hover { background: #f1f5f9; transform: translateY(-2px); }
      .btn-admin-footer i { color: #2563eb; font-size: 16px; }

      /* List Kontak */
      .footer-links { list-style: none; padding: 0; margin: 0; }
      .footer-links li { margin-bottom: 15px; }
      .footer-links a {
          color: #ffffff; font-size: 14px; text-decoration: none; transition: 0.2s;
          display: flex; align-items: flex-start; gap: 15px;
      }
      .footer-links a:hover { opacity: 0.8; }
      
      /* Ikon Lingkaran Putih, Simbol Biru */
      .footer-links i { 
          color: #2563eb; font-size: 16px; margin-top: 2px; 
          background: #ffffff; padding: 8px; border-radius: 50%; 
          width: 32px; height: 32px; flex-shrink: 0;
          display: flex; align-items: center; justify-content: center;
      }

      /* Copyright */
      .footer-bottom {
          background: rgba(0, 0, 0, 0.1); /* Sedikit lebih gelap */
          padding: 25px 0; margin-top: 20px;
          text-align: center; font-size: 13px; color: #ffffff;
          border-top: 1px solid rgba(255,255,255,0.1);
      }
      .footer-bottom strong { color: #ffffff; }

      /* ======================================= */
      /* 📱 MOBILE FIX (Tombol Biru & Rapi) 📱   */
      /* ======================================= */
      @media (max-width: 991px) {
          #header { height: 60px; padding: 10px 0; }
          .nav-menu { display: none; }
          .header-right-btn { display: none; } 
          
          /* TOMBOL BURGER MENU HP */
          .mobile-nav-toggle {
              display: block !important;
              color: #2563eb !important; /* WARNA BIRU AGAR KELIHATAN */
              font-size: 28px;
              cursor: pointer;
              position: fixed; right: 20px; top: 18px; z-index: 9999;
              background: transparent; border: none;
          }
          .mobile-nav-toggle i { color: #2563eb !important; }

          .logo-text { font-size: 18px; }
          .logo-box { width: 32px; height: 32px; font-size: 16px; }

          /* Footer HP Rata Tengah */
          #footer { padding-top: 40px; }
          .footer-col { text-align: center !important; margin-bottom: 40px; padding: 0 20px; }
          .footer-logo-text { justify-content: center; }
          .footer-desc { text-align: center; font-size: 13px; }
          .footer-links a { justify-content: center; font-size: 13px; align-items: center; }
          .btn-admin-footer { margin: 0 auto; }
          .footer-title { margin: 0 auto 20px auto; }
      }
  </style>

  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>

  <button type="button" class="mobile-nav-toggle d-lg-none">
      <i class="fa-solid fa-bars"></i>
  </button>

  <header id="header">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
      <a href="<?php echo e(url('/')); ?>" class="logo-container">
          <div class="logo-box">E</div>
          <span class="logo-text">MAGANG</span>
      </a>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?php echo e(url('/')); ?>#home"><i class="fa-solid fa-house"></i> Beranda</a></li>
          <li><a href="<?php echo e(url('/')); ?>#about"><i class="fa-solid fa-circle-info"></i> Tentang</a></li>
          <li><a href="<?php echo e(url('/')); ?>#services"><i class="fa-solid fa-list-check"></i> Alur Proses</a></li>
          <li><a href="<?php echo e(url('/')); ?>#portfolio"><i class="fa-solid fa-images"></i> Galeri</a></li>
          <li><a href="<?php echo e(url('/')); ?>#blog"><i class="fa-solid fa-newspaper"></i> Berita</a></li>
          <?php if(auth()->guard()->check()): ?>
            <?php
                $bolehDaftar = true;
                $cek = \App\Models\Pendaftaran::where('id_users', Auth::id())->first();
                if($cek && (strtolower($cek->status_pendaftaran) == 'diterima')) { $bolehDaftar = false; }
            ?>
            <?php if($bolehDaftar): ?> <li><a href="<?php echo e(route('pendaftaran.index')); ?>">Pendaftaran</a></li> <?php endif; ?>
            <li><a href="<?php echo e(route('pelamar.lamaran.index')); ?>">Lamaran</a></li>
            <li><a href="<?php echo e(route('mahasiswa.laporan.index')); ?>">Laporan</a></li>
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
              <a href="#contact" class="header-right-btn">Hubungi Kami</a>
          <?php endif; ?>
      </div>
    </div>
  </header>

  <?php echo $__env->yieldContent('contents'); ?>

  <footer id="footer">
      <div class="container">
          <div class="footer-row row">
              
              <div class="col-lg-5 col-md-5 col-sm-12 footer-col">
                  <div class="footer-logo-text">
                      <div class="footer-logo-box">E</div>
                      MAGANG
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
                      PT. Aditama Net Media Solusindo di Bengkalis merupakan perusahaan nasional yang bergerak di bidang teknologi informasi dan media.
                  </p>
              </div>

              <div class="col-lg-3 col-md-3 col-sm-12 footer-col">
                  <span class="footer-title">KONTAK KAMI</span>
                  <ul class="footer-links">
                      <li>
                          <a href="#">
                              <i class="fa-solid fa-location-dot"></i> 
                              <span>Jl. Wonosari Timur, Bengkalis</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <i class="fa-solid fa-clock"></i> 
                              <span>07.00 - 15.00 WIB</span>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <i class="fa-solid fa-phone"></i> 
                              <span>+62 812 3456 7890</span>
                          </a>
                      </li>
                  </ul>
              </div>

          </div>
      </div>

      <div class="footer-bottom">
          <div class="container">
             
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
    $(document).ready(function() {
        if ($('.table').length > 0) {
            $('.table').DataTable({
                dom: 'lBfrtip',
                buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            });
        }
    });
  </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template/master.blade.php ENDPATH**/ ?>