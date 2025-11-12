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
          
            <li><a class="nav-link" href="<?= url('dashboard')?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="menu-header">Data Master</li>
            <li class="nav-item dropdown ">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Data Profile</span></a>
              <ul class="dropdown-menu">

                <li class=""><a class="nav-link" href="<?= url('data-profile')?>">Data Profile</a></li>
                <li class=""><a class="nav-link" href="<?= url('data-galeri')?>">Data Galeri</a></li>
                <li class=""><a class="nav-link" href="<?= url('data-alur')?>">Data Alur</a></li>
                <li class=""><a class="nav-link" href="<?= url('data-informasi')?>">Data Informasi</a></li>
              </ul>
            </li>
            <li class="nav-item dropdown ">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Users</span></a>
              <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="<?= url('data-admin')?>">Data Admin</a></li>
                <li class=""><a class="nav-link" href="<?= url('data-pelamar')?>">Data Pelamar</a></li>
              </ul>
            </li>
            {{-- <li class="nav-item dropdown">
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i> <span>Data Master</span></a>
              <ul class="dropdown-menu">
                <li class=""><a class="nav-link" href="<?= url('data-kelas')?>">Data Kelas</a></li>
                <li class=""><a class="nav-link" href="<?= url('data-kategori')?>">Data Kategori</a></li>
              
              </ul>
            </li> --}}
            <li class="menu-header">Data Pendaftaran</li>
            {{-- Perbaikan: Menggunakan ?? 0 untuk mencegah error jika kunci 'pengajuan' tidak ada --}}
            <li class = ""><a class="nav-link" href="<?= url('data-pendaftaran')?>"><i class="fas fa-calendar-check"></i> <span>Data Pendaftaran  <sup><span class="subatas">{{ $data['pengajuan'] ?? 0 }}</span></sup> </a></li>
            <li class = ""><a class="nav-link" href="<?= url('data-sertifikat')?>"><i class="fas fa-calendar-check"></i> <span>Data Sertifikat </a></li>
            
            <li class="menu-header">Data Laporan</li>
            {{-- Perbaikan: Menggunakan ?? 0 untuk mencegah error jika kunci 'diterima' tidak ada --}}
            <li class = ""><a class="nav-link" href="<?= url('data-diterima')?>"><i class="fas fa-calendar-check"></i> <span>Data Diterima  <sup><span class="subatas">{{ $data['diterima'] ?? 0 }}</span></sup></span></a></li>
            {{-- Perbaikan: Menggunakan ?? 0 untuk mencegah error jika kunci 'tidak_diterima' tidak ada --}}
            <li class = ""><a class="nav-link" href="<?= url('data-tidak-diterima')?>"><i class="fas fa-calendar-check"></i> <span>Data Tidak Diterima  <sup><span class="subatas">{{ $data['tidak_diterima'] ?? 0 }}</span></sup></span></a></li>
          </ul>

        
    </aside>
  </div>