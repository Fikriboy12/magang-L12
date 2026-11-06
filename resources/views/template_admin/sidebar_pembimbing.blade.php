<style>
  /* --- CUSTOM STYLE MODERN --- */
  
  /* Header Sidebar (Area Logo) */
  .sidebar-brand {
    background: #ffffff;
    height: auto !important;
    padding: 25px 0 15px;
    border-bottom: 1px solid #f4f4f4;
  }
  
  .sidebar-brand a {
    color: #1e3c72 !important;
    font-weight: 700;
    font-size: 15px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
  }

  /* Styling Menu Item */
  .sidebar-menu li {
    margin-bottom: 8px;
  }

  .sidebar-menu li a {
    border-radius: 12px;
    margin: 0 12px;
    padding: 12px 15px;
    font-weight: 500;
    transition: all 0.3s ease;
    color: #6c757d;
  }

  /* Hover Effect */
  .sidebar-menu li a:hover {
    background-color: #eef2f6;
    color: #1e3c72;
    transform: translateX(5px);
  }

  /* Menu Aktif */
  .sidebar-menu li.active a {
    background: linear-gradient(135deg, #1e3c72, #2a5298) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 15px rgba(30, 60, 114, 0.3);
  }

  .sidebar-menu li.active a i {
    color: #ffffff !important;
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
    
    <div class="sidebar-brand">
      <img src="{{ asset('gambar/ANMS-logo.png') }}" width="110px" alt="Logo ANMS" class="mb-2 shadow-sm rounded" style="height: auto;">
      <br>
      <a href="{{ route('pembimbing.dashboard') }}">Aplikasi Magang</a>
    </div>
    
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('pembimbing.dashboard') }}" style="background: linear-gradient(135deg, #1e3c72, #2a5298); color: white; border-radius: 50%; padding: 8px 12px;">AM</a>
    </div>

    <ul class="sidebar-menu mt-4">
      
      <li class="menu-header">Menu Utama</li>

      {{-- 1. DASHBOARD --}}
      <li class="{{ request()->routeIs('pembimbing.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing.dashboard') }}">
          <i class="fas fa-fire"></i> 
          <span>Dashboard</span>
        </a>
      </li>

      {{-- 2. MAHASISWA BIMBINGAN --}}
      <li class="{{ request()->is('pembimbing/laporan*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing.dashboard') }}">
          <i class="fas fa-user-graduate"></i> 
          <span>Siswa Bimbingan</span>
        </a>
      </li>

      {{-- 3. MONITORING ABSENSI (BARU) --}}
      <li class="{{ request()->routeIs('pembimbing.absensi.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing.absensi.index') }}">
          <i class="fas fa-user-clock"></i> 
          <span>Monitoring Absensi</span>
        </a>
      </li>

    </ul>

  </aside>
</div>