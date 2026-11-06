<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    
    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <title>Pembimbing Lapangan — PT. Media Balai Nusa</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets_admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets_admin/css/components.css')}}">

    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/dataTables.bootstrap4.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <style>
        .navbar-bg {
            background: linear-gradient(135deg, #0d47a1, #1976d2) !important;
            height: 70px;
        }

        .main-navbar {
            background-color: transparent !important;
        }

        .main-navbar .nav-link-user {
            color: #ffffff;
            font-weight: 600;
        }

        .table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
            border-radius: 8px;
            overflow: hidden;
        }

        .table.dataTable thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            padding: 12px 14px;
            font-weight: 600;
            color: #334155;
            vertical-align: middle;
        }

        .card {
            border-radius: 12px;
            border: 1px solid #edf2f7;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .stat-card-gradient-1 {
            background: linear-gradient(135deg, #0284c7, #38bdf8);
            color: white;
            border-radius: 14px;
        }
        .stat-card-gradient-2 {
            background: linear-gradient(135deg, #16a34a, #4ade80);
            color: white;
            border-radius: 14px;
        }
        .stat-card-gradient-3 {
            background: linear-gradient(135deg, #d97706, #fbbf24);
            color: white;
            border-radius: 14px;
        }
        .stat-card-gradient-4 {
            background: linear-gradient(135deg, #dc2626, #f87171);
            color: white;
            border-radius: 14px;
        }
        .stat-card-gradient-5 {
            background: linear-gradient(135deg, #7c3aed, #a78bfa);
            color: white;
            border-radius: 14px;
        }

        .avatar-initial {
            width: 36px;
            height: 36px;
            background: #0d47a1;
            color: white;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                    <div class="text-white d-none d-md-block font-weight-bold">
                        <i class="fas fa-building mr-1"></i> PT. MEDIA BALAI NUSA &mdash; PORTAL PEMBIMBING LAPANGAN
                    </div>
                </form>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <span class="avatar-initial mr-2">{{ strtoupper(substr(Auth::user()->name ?? 'P', 0, 1)) }}</span>
                            <div class="d-sm-none d-lg-inline-block text-white font-weight-600">
                                {{ Auth::user()->name }} <small class="badge badge-light text-primary ml-1 font-weight-bold">Mentor</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0">
                            <div class="dropdown-title">Masuk sebagai Pembimbing Lapangan</div>
                            <div class="dropdown-item text-muted small">
                                <i class="fas fa-envelope mr-1"></i> {{ Auth::user()->email }}
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('pembimbing_lapangan.chat.index') }}" class="dropdown-item has-icon">
                                <i class="fas fa-comments"></i> Chat Siswa
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ url('logout') }}"
                                class="dropdown-item has-icon text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form-pl').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form-pl" action="{{ url('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            {{-- Include Sidebar Pembimbing Lapangan --}}
            @include('template_admin.sidebar_pembimbing_lapangan')

            {{-- Main Content --}}
            <div class="main-content">
                @yield('contents')
            </div>

            {{-- Footer --}}
            @include('template_admin.footer')

            {{-- Scripts --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
            <script src="{{ asset('assets_admin/js/stisla.js') }}"></script>
            <script src="{{ asset('assets_admin/js/scripts.js') }}"></script>
            <script src="{{ asset('assets_admin/js/custom.js') }}"></script>

            <script src="{{ asset('assets_admin/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets_admin/datatables/dataTables.bootstrap4.min.js') }}"></script>

            <script>
                $(document).ready(function() {
                    if ($('.datatable-custom').length > 0) {
                        $('.datatable-custom').DataTable({
                            language: {
                                search: "Cari:",
                                lengthMenu: "Tampilkan _MENU_ data",
                                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                                infoEmpty: "Menampilkan 0 data",
                                zeroRecords: "Tidak ada data yang cocok",
                                paginate: {
                                    first: "Awal",
                                    last: "Akhir",
                                    next: "Berikutnya",
                                    previous: "Sebelumnya"
                                }
                            }
                        });
                    }
                });
            </script>

            @yield('scripts')
        </div>
    </div>
</body>
</html>
