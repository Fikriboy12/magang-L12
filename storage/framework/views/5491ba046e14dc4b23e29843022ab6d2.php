<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>PT. MEDIA BALAI NUSA - Admin Panel</title>
    
    <link rel="icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">
    <link rel="shortcut icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/components.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/datatables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/summernote/summernote-bs4.css')); ?>">

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <style>
        /* =========================================================
           MODERN ADMIN THEME - GLASSMORPHISM & CLEAN UI
           ========================================================= */
        
        :root {
            --primary-color: #6777ef;
            --primary-soft: rgba(103, 119, 239, 0.1);
            --bg-body: #f4f7fc;
            --card-shadow: 0 10px 30px rgba(103, 119, 239, 0.08);
        }

        body {
            background-color: var(--bg-body);
            font-family: 'Plus Jakarta Sans', sans-serif; /* Pastikan font ini terload jika ingin dipakai */
        }

        /* 1. NAVBAR MODERN (GLASS EFFECT) */
        .navbar-bg {
            content: ' ';
            position: fixed; /* Fixed agar stabil saat zoom */
            top: 0; left: 0; width: 100%;
            height: 80px; /* Tinggi tetap */
            background: rgba(103, 119, 239, 0.9) !important; /* Warna primer transparan */
            backdrop-filter: blur(10px); /* Efek Kaca Buram */
            z-index: 800;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .main-navbar {
            position: fixed;
            top: 0; right: 0; left: 0;
            height: 80px;
            z-index: 900;
            background: transparent !important; /* Transparan karena bg sudah dihandle navbar-bg */
            padding: 0 30px;
        }

        /* 2. PERBAIKAN LAYOUT KONTEN (AGAR TIDAK HANCUR SAAT ZOOM) */
        .main-wrapper {
            padding-top: 80px !important; /* Dorong konten ke bawah setinggi navbar */
        }
        
        .main-content {
            padding-top: 30px;
            padding-left: 30px;
            padding-right: 30px;
        }

        /* 3. MODERN CARDS & SECTIONS */
        .card, .section-header, .monitoring-header-card {
            border-radius: 16px !important; /* Sudut lebih bulat */
            border: none !important;
            box-shadow: var(--card-shadow) !important; /* Bayangan halus modern */
            background: #ffffff;
        }

        .section-header {
            margin-bottom: 25px !important;
            padding: 20px 25px !important;
        }

        /* 4. FLOATING MENU BUTTON YANG KEREN */
        #floating-hamburger {
            position: fixed !important;
            top: 22px !important; left: 25px !important;
            z-index: 1000;
            width: 48px; height: 48px;
            border-radius: 14px; /* Rounded square modern */
            background: #ffffff;
            color: var(--primary-color);
            display: flex; align-items: center; justify-content: center;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        #floating-hamburger:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 25px rgba(103, 119, 239, 0.25);
            background: var(--primary-color);
            color: #ffffff;
        }
        
        #floating-hamburger i { font-size: 20px; }

        /* 5. UI ELEMENTS LAINNYA */
        /* Kursor Modern */
        html, body, a, button, input, select, .btn { cursor: none !important; }
        .cursor-trail-dot { position: fixed; width: 10px; height: 10px; background: rgba(103, 119, 239, 0.5); border-radius: 50%; pointer-events: none; z-index: 99999; transform: translate(-50%, -50%); transition: background 0.3s; }
        .cursor-trail-dot.trail-leader { width: 14px; height: 14px; background: var(--primary-color); box-shadow: 0 0 10px var(--primary-color); }

        /* Dropdown User yang Lebih Bersih */
        .dropdown-menu {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
            margin-top: 10px !important;
        }
        
        /* DataTable Modern */
        .table.dataTable {
            border-collapse: separate !important;
            border-spacing: 0 8px !important; /* Jarak antar baris */
            margin-top: 0 !important;
        }
        .table.dataTable thead th {
            border-bottom: none !important;
            background: var(--bg-body) !important;
            color: #6c757d;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 15px !important;
        }
        .table.dataTable tbody tr {
            background: #ffffff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.02);
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .table.dataTable tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .table.dataTable td {
            padding: 15px !important;
            border-top: none !important;
            border-bottom: none !important;
        }
        .table.dataTable td:first-child { border-top-left-radius: 10px; border-bottom-left-radius: 10px; }
        .table.dataTable td:last-child { border-top-right-radius: 10px; border-bottom-right-radius: 10px; }

        @media (max-width: 991px) {
            #floating-hamburger { top: 18px !important; left: 15px !important; width: 42px; height: 42px; }
            .navbar-bg, .main-navbar { height: 70px; }
            .main-wrapper { padding-top: 70px !important; }
        }
    </style>
</head>

<body>
    <div id="app">
        
        <a href="#" data-toggle="sidebar" id="floating-hamburger">
            <i class="fas fa-bars"></i>
        </a>

        <div class="navbar-bg"></div>
            
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto"></form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        
                        <div class="d-sm-none d-lg-inline-block text-white font-weight-bold" style="font-size: 15px;">
                            Hi, <?php echo e(Auth::user()->name); ?>

                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right animate slideIn">
                        <div class="dropdown-title">Administrator Panel</div>
                        
                        
                        
                        <a href="<?php echo e(url('logout')); ?>" class="dropdown-item has-icon text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                        <form id="logout-form-admin" action="<?php echo e(url('logout')); ?>" method="POST" style="display: none;"><?php echo csrf_field(); ?></form>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="main-wrapper">
            
            <?php echo $__env->make('template_admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <div class="main-content">
                <?php echo $__env->yieldContent('contents'); ?>
            </div>

            
            <?php echo $__env->make('template_admin.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

    <script src="<?php echo e(asset('assets_admin/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/summernote/summernote-bs4.js')); ?>"></script>

    <script src="<?php echo e(asset('assets_admin/js/stisla.js')); ?>"></script>
    <script src="<?php echo e(asset('assets_admin/js/scripts.js')); ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // SCRIPT KURSOR ULAR MODERN (LEBIH SMOOTH)
            (function() {
                const trailLength = 10; const dots = []; let mouseX = window.innerWidth/2; let mouseY = window.innerHeight/2;
                for (let i = 0; i < trailLength; i++) {
                    const dot = document.createElement('div'); dot.classList.add('cursor-trail-dot');
                    if (i === 0) dot.classList.add('trail-leader'); document.body.appendChild(dot);
                    dots.push({ element: dot, x: mouseX, y: mouseY });
                }
                window.addEventListener('mousemove', e => { mouseX = e.clientX; mouseY = e.clientY; });
                function animateTrail() {
                    let x = mouseX; let y = mouseY;
                    dots.forEach((dot, index) => {
                        dot.x += (x - dot.x) * 0.25; /* Lebih smooth */
                        dot.y += (y - dot.y) * 0.25;
                        dot.element.style.left = dot.x + 'px'; dot.element.style.top = dot.y + 'px';
                        x = dot.x; y = dot.y;
                        const scale = 1 - (index * 0.07); dot.element.style.transform = `translate(-50%, -50%) scale(${scale})`;
                    });
                    requestAnimationFrame(animateTrail);
                }
                animateTrail();
            })();

            // SweetAlert Global Delete
            $(document).on('click', '.btn-delete', function(e) {
                e.preventDefault(); const url = $(this).attr("href");
                Swal.fire({
                    title: 'Anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#6777ef',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#fff',
                    borderRadius: '16px',
                    customClass: { popup: 'swal-wide' }
                }).then((result) => { if (result.isConfirmed) window.location.href = url; });
            });
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template_admin/master.blade.php ENDPATH**/ ?>