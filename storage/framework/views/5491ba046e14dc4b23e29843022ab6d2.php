<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo e(asset('')); ?>assets_admin/img/logonew.png" type="image/x-icon">
    <title>Aplikasi Pendaftaran Magang</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" xintegrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" xintegrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/components.css')); ?>">

    <!-- CSS Libraries (Datatables, Select2, Summernote) -->
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/datatables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/datatables/buttons.dataTables.min.css')); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/summernote/summernote-bs4.css')); ?>">

    <!-- jQuery and Select2 JS (Load in head for compatibility) -->
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->

    <!-- CSS MODERNISASI TABEL DIMASUKKAN DI SINI -->
    <style>
        /* Styling Dasar Tabel DataTables */
        .table.dataTable {
            border-collapse: collapse !important; /* Pastikan border tidak dobel */
            width: 100% !important;
            margin-top: 15px; /* Jarak dari atas */
            box-shadow: 0 4px 12px rgba(0,0,0,0.05); /* Shadow halus */
            border-radius: 8px; /* Sudut sedikit bulat */
            overflow: hidden; /* Agar sudut bulat terlihat */
        }

        /* Header Tabel */
        .table.dataTable thead th {
            background-color: #f8f9fa; /* Warna latar header abu-abu muda */
            border-bottom: 2px solid #dee2e6; /* Garis bawah header lebih tebal */
            border-top: none !important; /* Hapus border atas default */
            padding: 12px 15px; /* Padding di dalam header */
            text-align: left; /* Rata kiri */
            font-weight: 600; /* Teks header tebal */
            color: #495057; /* Warna teks header */
            vertical-align: middle; /* Teks di tengah vertikal */
        }

        /* Hapus border vertikal di header */
        .table.dataTable thead th:not(:last-child) {
            border-right: none !important;
        }
        .table.dataTable thead th:not(:first-child) {
            border-left: none !important;
        }


        /* Isi Tabel (Sel) */
        .table.dataTable tbody td {
            padding: 10px 15px; /* Padding di dalam sel */
            border-top: 1px solid #e9ecef; /* Garis horizontal halus antar baris */
            vertical-align: middle; /* Teks di tengah vertikal */
            border-right: none !important; /* Hapus border vertikal */
            border-left: none !important; /* Hapus border vertikal */
            color: #495057; /* Warna teks isi */
        }

        /* Zebra Striping (Warna Belang) */
        .table.dataTable tbody tr:nth-of-type(even) {
            background-color: #fdfdfe; /* Warna sedikit beda untuk baris genap */
        }

        /* Efek Hover pada Baris */
        .table.dataTable tbody tr:hover {
            background-color: #e9ecef; /* Warna latar saat mouse hover */
            cursor: pointer; /* Ubah cursor */
        }

        /* Styling Tombol Aksi (Edit, Delete, Detail) */
        .table.dataTable .btn-action {
            padding: 5px 10px; /* Ukuran tombol lebih kecil */
            font-size: 12px; /* Ukuran font tombol */
            margin-right: 5px; /* Jarak antar tombol */
            border-radius: 6px; /* Sudut tombol */
            transition: all 0.2s ease; /* Transisi halus */
        }
        /* Hilangkan margin kanan di tombol terakhir */
        .table.dataTable .btn-action:last-child {
            margin-right: 0;
        }

        /* Styling untuk Ikon di dalam tombol (jika Anda pakai ikon) */
        .table.dataTable .btn-action i {
            font-size: 14px; /* Sesuaikan ukuran ikon */
            vertical-align: middle; /* Ikon sejajar tengah */
        }

        /* Tombol Primary (misal: Edit, Detail) */
        .table.dataTable .btn-primary.btn-action {
            background-color: #6777ef;
            border-color: #6777ef;
        }
        .table.dataTable .btn-primary.btn-action:hover {
            background-color: #4f5fd7;
            border-color: #4f5fd7;
        }

        /* Tombol Danger (misal: Delete) */
        .table.dataTable .btn-danger.btn-action {
            background-color: #fc544b;
            border-color: #fc544b;
        }
        .table.dataTable .btn-danger.btn-action:hover {
            background-color: #e7443b;
            border-color: #e7443b;
        }

        /* Tombol Info/Secondary (misal: View) */
        .table.dataTable .btn-info.btn-action {
            background-color: #3abaf4;
            border-color: #3abaf4;
        }
        .table.dataTable .btn-info.btn-action:hover {
            background-color: #28a1d7;
            border-color: #28a1d7;
        }


        /* Styling untuk Badge Status */
        .badge-status {
            padding: 6px 10px;
            border-radius: 15px; /* Bentuk pil */
            font-size: 11px;
            font-weight: 600;
            text-transform: capitalize; /* Huruf pertama besar */
            display: inline-block; /* Agar padding berfungsi */
        }

        .badge-status.status-pengajuan {
            background-color: #e6f7ff; /* Latar biru muda */
            color: #1890ff; /* Teks biru */
        }
        .badge-status.status-diterima {
            background-color: #f6ffed; /* Latar hijau muda */
            color: #52c41a; /* Teks hijau */
        }
        .badge-status.status-ditolak,
        .badge-status.status-tidak-diterima { /* Menambahkan 'tidak diterima' */
            background-color: #fff1f0; /* Latar merah muda */
            color: #f5222d; /* Teks merah */
        }
        .badge-status.status-selesai { /* Contoh status lain */
            background-color: #fafafa; /* Latar abu-abu */
            color: #595959; /* Teks abu-abu */
        }
    </style>
    <!-- AKHIR CSS MODERNISASI TABEL -->
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <!-- menu drop down sebelah kanan untuk lougout -->
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        
                        
                        <div class="d-sm-none d-lg-inline-block">Hi, <?php echo e(Auth::user()->name); ?></div></a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Logged in</div>
                            
                            
                            <div class="dropdown-divider"></div>

                            
                            <a href="<?php echo e(url('logout')); ?>"
                                class="dropdown-item has-icon text-danger"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form-admin-master').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form-admin-master" action="<?php echo e(url('logout')); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                            </form>
                            
                        </div>
                    </li>
                </ul>
            </nav>

            
            <?php echo $__env->make('template_admin.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <div class="main-content">
                <?php echo $__env->yieldContent('contents'); ?>
            </div>

            
            <?php echo $__env->make('template_admin.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" xintegrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" xintegrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

            
            <script src="<?php echo e(asset('assets_admin/datatables/jquery.dataTables.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/datatables.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/dataTables.bootstrap4.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/dataTables.buttons.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/jszip.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/pdfmake.min.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/vfs_fonts.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/datatables/buttons.html5.min.js')); ?>"></script>

            
            <script src="<?php echo e(asset('assets_admin/js/stisla.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/summernote/summernote-bs4.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/js/scripts.js')); ?>"></script>
            <script src="<?php echo e(asset('assets_admin/js/custom.js')); ?>"></script>

            
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            
            <script>
                $(document).ready(function() {
                    $(document).on('click', '.btn-delete', function(event) { // Selector lebih umum '.btn-delete'
                        event.preventDefault();
                        const url = $(this).attr("href"); // Ambil href dari link
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data ini akan dihapus permanen!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = url; // Redirect ke URL delete
                            }
                        })
                    });
                });
            </script>

            
            <script>
            $(document).ready(function() {
                // Gunakan selector yang lebih spesifik jika ada banyak tabel
                $('.datatable').DataTable({ // Ganti #table menjadi .datatable atau ID spesifik
                dom: 'lBfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ],
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                });
            });
            </script>

            
            <script>
            $(document).ready(function(){
                // Gunakan selector yang lebih spesifik jika ada banyak textarea
                $('.summernote').summernote({ // Ganti #summernote menjadi .summernote atau ID spesifik
                    height: "200px",
                    toolbar:[
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'hr']],
                        ['view', ['fullscreen', 'codeview']],
                        ['help', ['help']]
                    ],
                });
            });
            </script>

            
            <?php echo $__env->yieldContent('scripts'); ?>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template_admin/master.blade.php ENDPATH**/ ?>