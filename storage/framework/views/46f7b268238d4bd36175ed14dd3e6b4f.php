<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>E-Magang</title>
  
  <!-- Font Keren -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- CDN Font Awesome 6 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Vendor CSS Files -->
  <link href="<?php echo e(asset('assets')); ?>/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets')); ?>/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets')); ?>/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets')); ?>/vendor/nivo-slider/css/nivo-slider.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets')); ?>/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets')); ?>/vendor/venobox/venobox.css" rel="stylesheet">
  
  <!-- CSS Library Tambahan -->
  <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/datatables.min.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.css')); ?>">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="<?php echo e(asset('assets')); ?>/css/style.css" rel="stylesheet">
  <link href="<?php echo e(asset('assets')); ?>/css/responsive.css" rel="stylesheet">
  
  <!-- Custom Style Navbar (RESPONSIF FIXED) -->
  <style>
      /* --- 1. SETTING UTAMA --- */
      :root {
          --nav-blue: #005bea;
          --nav-cyan: #00c6fb;
          --nav-dark: #0f172a;
      }

      body {
          font-family: 'Plus Jakarta Sans', sans-serif !important;
          overflow-x: hidden;
      }

      /* --- 2. NAVBAR UTAMA --- */
      #header {
          transition: all 0.4s ease-in-out;
          background: rgba(0,0,0,0.6); 
          padding: 0;
          height: auto;
          min-height: 70px;
          z-index: 999;
          position: fixed;
          width: 100%;
          top: 0;
          backdrop-filter: blur(5px);
      }

      /* Saat Scroll */
      #header.header-scrolled {
          background: rgba(255, 255, 255, 0.98);
          box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      }

      /* --- 3. LOGO --- */
      .navbar-brand {
          color: #fff !important;
          font-size: 24px;
          font-weight: 800;
          letter-spacing: 0.5px;
          text-transform: uppercase;
      }
      .navbar-brand span { color: var(--nav-cyan); }
      
      #header.header-scrolled .navbar-brand { color: var(--nav-dark) !important; }

      /* --- 4. MENU NAVIGASI (DESKTOP) --- */
      .navbar-nav .nav-item {
          padding: 0 5px;
      }

      .navbar-nav .nav-link {
          color: #fff !important;
          font-size: 12px;
          font-weight: 700;
          text-transform: uppercase;
          transition: 0.3s;
          letter-spacing: 0.3px;
          position: relative;
      }

      #header.header-scrolled .navbar-nav .nav-link { color: #444 !important; }

      /* Hover Effect */
      .navbar-nav .nav-link:hover, .navbar-nav .active > .nav-link { color: var(--nav-cyan) !important; }
      #header.header-scrolled .navbar-nav .nav-link:hover { color: var(--nav-blue) !important; }

      /* --- 5. DROPDOWN USER (RESPONSIF) --- */
      .dropdown-menu {
          border: none;
          border-top: 3px solid var(--nav-cyan);
          box-shadow: 0 10px 30px rgba(0,0,0,0.1);
          border-radius: 8px;
          font-size: 13px;
          min-width: 180px;
          margin-top: 10px;
      }

      .dropdown-item {
          padding: 10px 20px;
          font-weight: 600;
          color: #333;
      }
      
      .dropdown-item:hover {
          background: #f8f9fa;
          color: var(--nav-blue);
      }

      /* --- 6. TOMBOL TOGGLER (HAMBURGER MENU HP) --- */
      .navbar-toggler {
          border: none;
          outline: none !important;
      }
      .navbar-toggler-icon {
          background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(255, 255, 255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }
      #header.header-scrolled .navbar-toggler-icon {
          background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(0, 0, 0, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
      }

      /* --- 7. TOMBOL LOGIN --- */
      .btn-login-nav {
          border: 1px solid #fff; 
          padding: 5px 20px !important;
          border-radius: 50px; 
          margin-left: 10px; 
          font-size: 12px !important;
      }
      .btn-login-nav:hover { background: #fff; color: var(--nav-blue) !important; }
      
      #header.header-scrolled .btn-login-nav { border-color: var(--nav-blue); color: var(--nav-blue) !important; }
      #header.header-scrolled .btn-login-nav:hover { background: var(--nav-blue); color: #fff !important; }

      /* PENGATURAN MODE HP (MOBILE) */
      @media (max-width: 991px) {
          #header { background: rgba(15, 23, 42, 0.95); } /* Background gelap di HP biar menu kebaca */
          .navbar-collapse {
              background: #fff;
              padding: 20px;
              border-radius: 10px;
              margin-top: 15px;
              box-shadow: 0 10px 30px rgba(0,0,0,0.2);
          }
          .navbar-nav .nav-link { color: #333 !important; padding: 10px 0; }
          .btn-login-nav { margin-left: 0; margin-top: 10px; display: inline-block; border-color: var(--nav-blue); color: var(--nav-blue) !important; }
      }
  </style>

  <!-- Script Jquery & Plugins -->
  <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
</head>

<body data-spy="scroll" data-target="#navbar-example">

  <!-- ============================================ -->
  <!-- NAVBAR BOOTSTRAP (RESPONSIF) -->
  <!-- ============================================ -->
  <header id="header">
    <div class="container-fluid" style="padding-left: 40px; padding-right: 40px;">
        <nav class="navbar navbar-expand-lg navbar-dark p-0">
            
            <!-- LOGO -->
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
                <span>E</span>-Magang
            </a>

            <!-- TOMBOL HAMBURGER (MUNCUL DI HP) -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU ITEM -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto align-items-lg-center">
                    <li class="nav-item active"><a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#about">About</a></li>
                    <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#services">Information</a></li>
                    <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#portfolio">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(url('/')); ?>#contact">Contact</a></li>

                    <?php if(auth()->guard()->check()): ?>
                        <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(route('pendaftaran.index')); ?>">Pendaftaran</a></li>
                        <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(route('pelamar.lamaran.index')); ?>">Lamaran</a></li>
                        <li class="nav-item"><a class="nav-link page-scroll" href="<?php echo e(route('mahasiswa.laporan.index')); ?>">Laporan</a></li>

                        <!-- DROPDOWN USER (NO RIPPLE / ANIMASI BERLEBIH) -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: flex; align-items: center;">
                                <?php echo e(Auth::user()->name); ?>

                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="<?php echo e(route('profile.view')); ?>">
                                    <i class="fa-solid fa-user mr-2"></i> My Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link btn-login-nav" href="<?php echo e(route('login')); ?>">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
    </div>
  </header>
  <!-- End Header -->

  <?php echo $__env->yieldContent('contents'); ?>

  <?php echo $__env->make('template.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="<?php echo e(asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/jquery.easing/jquery.easing.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/php-email-form/validate.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/appear/jquery.appear.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/knob/jquery.knob.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/parallax/parallax.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/wow/wow.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/nivo-slider/js/jquery.nivo.slider.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/owl.carousel/owl.carousel.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/vendor/venobox/venobox.min.js')); ?>"></script>

  <!-- DataTables JS -->
  <script src="<?php echo e(asset('assets_admin/js/plugin/datatables/datatables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/dataTables.buttons.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/jszip.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/pdfmake.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/vfs_fonts.js')); ?>"></script>
  <script src="<?php echo e(asset('assets_admin/datatables/buttons.html5.min.js')); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?php echo e(asset('assets/js/main.js')); ?>"></script>

  <script>
    // Inisialisasi DataTable
    $(document).ready(function() {
        if ($('.table').length > 0) {
            $('.table').DataTable({
                dom: 'lBfrtip',
                buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5'],
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
            });
        }
    });

    // Script Animasi Navbar (Ganti Warna saat Scroll)
    window.addEventListener('scroll', function() {
        const header = document.getElementById('header');
        if (window.scrollY > 50) {
            header.classList.add('header-scrolled');
        } else {
            header.classList.remove('header-scrolled');
        }
    });
  </script>

</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template/master.blade.php ENDPATH**/ ?>