<style>
  /* --- 1. CSS SIDEBAR (LEBAR SIDEBAR UTAMA) --- */
  @media (min-width: 768px) {
    .main-sidebar, .main-sidebar .sidebar-brand {
      width: 280px !important; /* Lebar sidebar kita pas-kan 280px */
    }
    
    /* Geser konten utama menyesuaikan sidebar */
    .main-content, .navbar {
      padding-left: 295px !important; 
    }
  }

  /* --- 2. CSS TAMPILAN MENU (AGAR BIRU TIDAK KEPANJANGAN) --- */
  
  /* Header Logo */
  .main-sidebar .sidebar-brand {
    margin-bottom: 20px;
    padding: 30px 0;
    background: #ffffff;
    border-bottom: 1px solid #f0f2f5;
  }
  
  .sidebar-brand a {
    color: #2c3e50 !important;
    font-weight: 800;
    font-size: 14px;
    letter-spacing: 1px;
    text-transform: uppercase;
  }

  /* ITEM MENU UTAMA */
  .main-sidebar .sidebar-menu li a {
    /* --- PENGATURAN PANJANG TOMBOL --- */
    margin-left: 15px !important;  /* Jarak dari Kiri */
    margin-right: 30px !important; /* Jarak dari Kanan (DIBESARKAN BIAR LEBIH PENDEK) */
    /* ---------------------------------- */
    
    padding: 12px 15px;
    border-radius: 10px 10px 10px 10px; /* Sudut membulat semua sisi (Pill Shape) */
    
    font-weight: 500;
    color: #555;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    width: auto !important; /* Biar lebarnya ikut margin, bukan 100% mentok */
  }

  .main-sidebar .sidebar-menu li a i {
    font-size: 16px;
    margin-right: 12px;
    width: 20px;
    text-align: center;
  }

  /* Hover Effect */
  .main-sidebar .sidebar-menu li a:hover {
    background-color: #f1f5f9;
    color: #0284c7;
    transform: translateX(5px);
  }

  /* MENU AKTIF (TOMBOL BIRU "MASTER WEBSITE") */
  .main-sidebar .sidebar-menu li.active > a {
    background: linear-gradient(135deg, #0284c7, #3CB9E0); /* Warna Biru Cyan Gradasi Logo */
    color: #ffffff !important;
    box-shadow: 0 5px 15px rgba(60, 185, 224, 0.35);
    
    /* Pastikan sudutnya tetap membulat seperti gambar */
    border-radius: 10px !important; 
  }

  .main-sidebar .sidebar-menu li.active > a i {
    color: #ffffff !important;
  }

  /* Dropdown Menu */
  .main-sidebar .sidebar-menu li .dropdown-menu li a {
    padding: 8px 15px;
    margin-left: 20px !important;  /* Anak menu geser ke dalam */
    margin-right: 30px !important; /* Anak menu juga dipendekkan kanannya */
    border-radius: 5px;
    font-size: 13px;
    border-left: 2px solid #eee;
  }
  
  .main-sidebar .sidebar-menu li .dropdown-menu li.active a {
    color: #0284c7 !important;
    background: transparent !important;
    border-left: 2px solid #0284c7;
    font-weight: 700;
    box-shadow: none;
  }

  /* Header Kategori */
  .main-sidebar .sidebar-menu li.menu-header {
    font-size: 11px;
    letter-spacing: 1.2px;
    font-weight: 700;
    color: #a0a4a8;
    padding: 10px 25px;
    text-transform: uppercase;
    margin-top: 5px;
  }

  /* Badge Notifikasi */
  .badge-sidebar {
    padding: 5px 8px;
    border-radius: 6px;
    font-size: 11px;
    font-weight: 700;
    margin-left: auto;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  
  .badge-primary-soft { background: #e0f2fe; color: #0284c7; }
  .badge-danger-soft { background: #ffebee; color: #c62828; }
</style>

<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    
    <div class="sidebar-brand">
      <img src="<?php echo e(asset('gambar/ANMS-logo.png')); ?>" width="60px" alt="Logo" class="mb-2 shadow-sm rounded-circle">
      <br>
      <a href="<?php echo e(url('admin/dashboard')); ?>">Admin Panel</a>
    </div>
    
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="<?php echo e(url('admin/dashboard')); ?>" style="background: linear-gradient(135deg, #0284c7, #3CB9E0); color: white; padding: 5px 10px; border-radius: 5px;">AP</a>
    </div>

    <ul class="sidebar-menu">
      
      <li class="menu-header">Utama</li>
      <li class="<?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
          <i class="fas fa-th-large"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="menu-header">Data Master</li>
      
      <li class="nav-item dropdown <?php echo e(request()->is('data-profile*', 'data-galeri*', 'data-alur*', 'data-informasi*') ? 'active' : ''); ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-layer-group"></i> <span>Master Website</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo e(request()->is('data-profile*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-profile')); ?>">Profile & Info</a></li>
          <li class="<?php echo e(request()->is('data-galeri*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-galeri')); ?>">Galeri Foto</a></li>
          <li class="<?php echo e(request()->is('data-alur*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-alur')); ?>">Alur Magang</a></li>
          <li class="<?php echo e(request()->is('data-informasi*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-informasi')); ?>">Berita & Info</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown <?php echo e(request()->is('data-admin*', 'data-pelamar*', 'data-pembimbing*') ? 'active' : ''); ?>">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-users-cog"></i> <span>Manajemen User</span></a>
        <ul class="dropdown-menu">
          <li class="<?php echo e(request()->is('data-admin*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-admin')); ?>">Admin</a></li>
          <li class="<?php echo e(request()->is('data-pembimbing*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-pembimbing')); ?>">Pembimbing</a></li>
          <li class="<?php echo e(request()->is('data-pelamar*') ? 'active' : ''); ?>"><a class="nav-link" href="<?php echo e(url('/data-pelamar')); ?>">Mahasiswa</a></li>
        </ul>
      </li>

      <li class="menu-header">Administrasi</li>
      
      <li class="<?php echo e(request()->is('data-pendaftaran*') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/data-pendaftaran')); ?>">
          <i class="fas fa-file-signature"></i> 
          <span>Pendaftaran Baru</span>
          <?php $countPengajuan = \App\Models\Pendaftaran::where('status_pendaftaran', 'pengajuan')->count(); ?>
          <?php if($countPengajuan > 0): ?>
            <span class="badge-sidebar badge-primary-soft"><?php echo e($countPengajuan); ?></span>
          <?php endif; ?>
        </a>
      </li>

      <li class="<?php echo e(request()->is('data-sertifikat*') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/data-sertifikat')); ?>">
          <i class="fas fa-certificate"></i> 
          <span>E-Sertifikat</span>
        </a>
      </li>

      <li class="menu-header">Monitoring</li>

      <li class="<?php echo e(request()->routeIs('admin.absensi.*') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(route('admin.absensi.index')); ?>">
          <i class="fas fa-clock"></i> 
          <span>Data Absensi</span>
        </a>
      </li>

      <li class="<?php echo e(request()->is('data-diterima*') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('/data-diterima')); ?>">
          <i class="fas fa-check-circle"></i> 
          <span>Riwayat Diterima</span>
          <?php $countAktif = \App\Models\Pendaftaran::where('status_pendaftaran', 'diterima')->count(); ?>
          <?php if($countAktif > 0): ?>
            <span class="badge-sidebar badge-primary-soft"><?php echo e($countAktif); ?></span>
          <?php endif; ?>
        </a>
      </li>

      <li class="<?php echo e(request()->is('data-tidak-diterima*') ? 'active' : ''); ?>">
        <a class="nav-link" href="<?php echo e(url('data-tidak-diterima')); ?>">
          <i class="fas fa-times-circle"></i> 
          <span>Riwayat Ditolak</span>
          <?php $countTolak = \App\Models\Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count(); ?>
          <?php if($countTolak > 0): ?>
            <span class="badge-sidebar badge-danger-soft"><?php echo e($countTolak); ?></span>
          <?php endif; ?>
        </a>
      </li>

    </ul>
  </aside>
</div><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template_admin/sidebar.blade.php ENDPATH**/ ?>