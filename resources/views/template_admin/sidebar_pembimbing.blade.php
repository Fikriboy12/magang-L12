<style>
  /* --- CUSTOM STYLE MODERN --- */
  
  /* Header Sidebar (Area Logo) */
  .sidebar-brand {
    background: #ffffff;
    height: auto !important;
    padding: 25px 0 15px;
    border-bottom: 1px solid #f4f4f4; /* Garis pemisah halus */
  }
  
  .sidebar-brand a {
    color: #1e3c72 !important; /* Warna Biru Tua Elegan */
    font-weight: 700;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
  }

  /* Styling Menu Item */
  .sidebar-menu li {
    margin-bottom: 8px; /* Jarak antar menu */
  }

  .sidebar-menu li a {
    border-radius: 12px; /* Sudut membulat modern */
    margin: 0 12px;      /* Jarak kiri kanan agar tidak mepet */
    padding: 12px 15px;  /* Padding dalam tombol */
    font-weight: 500;
    transition: all 0.3s ease; /* Efek transisi halus */
    color: #6c757d;
  }

  /* Efek saat mouse diarahkan (Hover) */
  .sidebar-menu li a:hover {
    background-color: #eef2f6;
    color: #1e3c72;
    transform: translateX(5px); /* Animasi geser ke kanan sedikit */
  }

  /* Styling Menu yang sedang AKTIF */
  .sidebar-menu li.active a {
    /* Gradient Biru Modern (Sesuai tema login) */
    background: linear-gradient(135deg, #1e3c72, #2a5298) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 15px rgba(30, 60, 114, 0.3); /* Bayangan lembut */
  }

  .sidebar-menu li.active a i {
    color: #ffffff !important; /* Ikon jadi putih saat aktif */
  }

  /* Judul Header Kecil */
  .menu-header {
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1px;
    color: #b0b0b0;
    margin: 20px 25px 10px !important;
  }
</style>

<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    
    <!-- BAGIAN LOGO -->
    <div class="sidebar-brand">
      <img src="{{ asset('gambar/ANMS-logo.png') }}" width="110px" alt="Logo ANMS" class="mb-2 shadow-sm rounded" style="height: auto;">
      <br>
      <a href="{{ route('pembimbing.dashboard') }}">Aplikasi Magang</a>
    </div>
    
    <!-- LOGO KECIL (Saat sidebar ditutup/minimize) -->
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('pembimbing.dashboard') }}" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-radius: 50%; padding: 8px 12px;">AM</a>
    </div>

    <!-- MENU SIDEBAR -->
    <ul class="sidebar-menu mt-4">
      
      <li class="menu-header">Menu Utama</li>

      {{-- Menu Dashboard --}}
      <li class="{{ request()->routeIs('pembimbing.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing.dashboard') }}">
          <i class="fas fa-fire"></i> 
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Menu Mahasiswa Bimbingan --}}
      {{-- Gunakan logika request()->is() agar menu tetap aktif saat di halaman detail --}}
      <li class="{{ request()->is('pembimbing/laporan*') || request()->routeIs('pembimbing.mahasiswa*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing.dashboard') }}">
          <i class="fas fa-user-graduate"></i> 
          <span>Mahasiswa Bimbingan</span>
        </a>
      </li>

    </ul>

  </aside>
</div>