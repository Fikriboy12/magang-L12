<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    
    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <title>@yield('title', 'Portal Orang Tua') - PT. MEDIA BALAI NUSA</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('assets_admin/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets_admin/css/components.css')}}">

    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/datatables/buttons.dataTables.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

    <style>
        /* Styling Dasar Tabel DataTables */
        .table.dataTable {
            border-collapse: collapse !important;
            width: 100% !important;
            margin-top: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        .table.dataTable thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            border-top: none !important;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            color: #495057;
            vertical-align: middle;
        }

        .table.dataTable tbody td {
            padding: 10px 15px;
            border-top: 1px solid #e9ecef;
            vertical-align: middle;
            color: #495057;
        }

        .table.dataTable tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>

            {{-- Navbar Atas --}}
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <div class="d-sm-none d-lg-inline-block">Halo, {{ Auth::user()->name }} (Wali Siswa)</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-title">Akun Orang Tua</div>
                            <div class="dropdown-divider"></div>

                            <a href="{{ url('logout') }}"
                                class="dropdown-item has-icon text-danger"
                                onclick="event.preventDefault(); document.getElementById('logout-form-orangtua').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                            <form id="logout-form-orangtua" action="{{ url('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </nav>

            {{-- Include Sidebar Orang Tua --}}
            @include('template_admin.sidebar_orangtua')

            {{-- Main Content --}}
            <div class="main-content">
                @yield('contents')
            </div>

            {{-- Include Footer --}}
            @include('template_admin.footer')

            {{-- JS Scripts --}}
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

            <script src="{{ asset('assets_admin/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('assets_admin/datatables/datatables.min.js') }}"></script>
            <script src="{{ asset('assets_admin/datatables/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('assets_admin/datatables/dataTables.buttons.min.js') }}"></script>

            <script src="{{ asset('assets_admin/js/stisla.js') }}"></script>
            <script src="{{ asset('assets_admin/js/scripts.js') }}"></script>
            <script src="{{ asset('assets_admin/js/custom.js') }}"></script>
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            <script>
            $(document).ready(function() {
                $('.datatable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
                    }
                });
            });
            </script>

            @yield('scripts')
        </div>
    </div>
</body>
</html>
