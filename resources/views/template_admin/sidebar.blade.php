<style>
    .subatas{
        font-weight: bold;
        font-size: 10px;
        background-color: #6777ef;
        border-radius: 21px;
        color: white;
        padding: 6px;
    }
</style>
<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img src="<?= asset('') ?>assets_admin/img/logonew.png" width = "80px" alt="" class = "mt-3">
            <br>
            <a href="" class = "">Aplikasi Magang</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">RA</a>
        </div>

        <ul class="sidebar-menu mt-3">
            <li class="menu-header">Dashboard</li>
            
            {{-- PERBAIKAN 1: Menggunakan route('admin.dashboard') --}}
            <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            
            <li class="menu-header">Data Master</li>
            
            {{-- Data Profile --}}
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Data Profile</span></a>
                <ul class="dropdown-menu">
                    {{-- PERBAIKAN 2: Data Profile --}}
                    <li class=""><a class="nav-link" href="{{ route('admin.profile.index') }}">Data Profile</a></li>
                    {{-- PERBAIKAN 3: Data Galeri --}}
                    <li class=""><a class="nav-link" href="{{ route('admin.galeri.index') }}">Data Galeri</a></li>
                    {{-- PERBAIKAN 4: Data Alur --}}
                    <li class=""><a class="nav-link" href="{{ route('admin.alur.index') }}">Data Alur</a></li>
                    {{-- PERBAIKAN 5: Data Informasi --}}
                    <li class=""><a class="nav-link" href="{{ route('admin.informasi.index') }}">Data Informasi</a></li>
                </ul>
            </li>
            
            {{-- Data Users --}}
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Users</span></a>
                <ul class="dropdown-menu">
                    {{-- PERBAIKAN 6: Data Admin --}}
                    <li class=""><a class="nav-link" href="{{ route('admin.data.index') }}">Data Admin</a></li>
                    {{-- PERBAIKAN 7: Data Pelamar --}}
                    <li class=""><a class="nav-link" href="{{ route('admin.pelamar.index') }}">Data Pelamar</a></li>
                </ul>
            </li>
            
            <li class="menu-header">Data Pendaftaran</li>
            
            {{-- PERBAIKAN 8: Data Pendaftaran --}}
            <li class = "">
                <a class="nav-link" href="{{ route('admin.pendaftaran.index') }}">
                    <i class="fas fa-calendar-check"></i> 
                    <span>Data Pendaftaran  <sup><span class="subatas">{{ $data['pengajuan'] ?? 0 }}</span></sup> </span>
                </a>
            </li>
            {{-- PERBAIKAN 9: Data Sertifikat --}}
            <li class = "">
                <a class="nav-link" href="{{ route('admin.sertifikat.index') }}">
                    <i class="fas fa-calendar-check"></i> 
                    <span>Data Sertifikat </span>
                </a>
            </li>
            
            <li class="menu-header">Data Laporan</li>
            
            {{-- PERBAIKAN 10: Data Diterima --}}
            <li class = "">
                <a class="nav-link" href="{{ route('admin.diterima.index') }}">
                    <i class="fas fa-calendar-check"></i> 
                    <span>Data Diterima  <sup><span class="subatas">{{ $data['diterima'] ?? 0 }}</span></sup></span>
                </a>
            </li>
            {{-- PERBAIKAN 11: Data Tidak Diterima --}}
            <li class = "">
                <a class="nav-link" href="{{ route('admin.tidak_diterima.index') }}">
                    <i class="fas fa-calendar-check"></i> 
                    <span>Data Tidak Diterima  <sup><span class="subatas">{{ $data['tidak_diterima'] ?? 0 }}</span></sup></span>
                </a>
            </li>
        </ul>

    </aside>
</div>