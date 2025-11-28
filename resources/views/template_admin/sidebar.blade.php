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
    
    <!-- BAGIAN LOGO -->
    <div class="sidebar-brand">
      <img src="{{ asset('gambar/ANMS-logo.png') }}" width="120px" alt="Logo ANMS" class="mt-3" style="height: auto;">
      <br>
      <a href="{{ url('admin/dashboard') }}">Aplikasi Magang</a>
    </div>
    
    <!-- BAGIAN LOGO KECIL (SAAT SIDEBAR DITUTUP) -->
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('admin/dashboard') }}">AM</a>
    </div>

    <!-- MENU SIDEBAR -->
    <ul class="sidebar-menu mt-3">
      
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="{{ url('admin/dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      
      <li class="menu-header">Data Master</li>
      
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Data Profile</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ url('/data-profile') }}">Data Profile</a></li>
          <li><a class="nav-link" href="{{ url('/data-galeri') }}">Data Galeri</a></li>
          <li><a class="nav-link" href="{{ url('/data-alur') }}">Data Alur</a></li>
          <li><a class="nav-link" href="{{ url('/data-informasi') }}">Data Informasi</a></li>
        </ul>
      </li>
      
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Users</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ url('/data-admin') }}">Data Admin</a></li>
          <li><a class="nav-link" href="{{ url('/data-pelamar') }}">Data Pelamar</a></li>
          <li><a class="nav-link" href="{{ url('/data-pembimbing') }}">Data Pembimbing</a></li>
        </ul>
      </li>
      
      <li class="menu-header">Data Pendaftaran</li>
      
      <li>
        <a class="nav-link" href="{{ url('/data-pendaftaran') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Pendaftaran <sup><span class="subatas">{{ $data['pengajuan'] ?? 0 }}</span></sup></span>
        </a>
      </li>
      
      <li>
        <a class="nav-link" href="{{ url('/data-sertifikat') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Sertifikat</span>
        </a>
      </li>
      
      <li class="menu-header">Data Laporan</li>
      
      <li>
        <a class="nav-link" href="{{ url('/data-diterima') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Diterima <sup><span class="subatas">{{ $data['diterima'] ?? 0 }}</span></sup></span>
        </a>
      </li>
      
      <li>
        <a class="nav-link" href="{{ url('data-tidak-diterima') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Tidak Diterima <sup><span class="subatas">{{ $data['tidak_diterima'] ?? 0 }}</span></sup></span>
        </a>
      </li>
    </ul>

  </aside>
</div><style>
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
    
    <!-- BAGIAN LOGO -->
    <div class="sidebar-brand">
      <img src="{{ asset('gambar/ANMS-logo.png') }}" width="120px" alt="Logo ANMS" class="mt-3" style="height: auto;">
      <br>
      <a href="{{ url('admin/dashboard') }}">Aplikasi Magang</a>
    </div>
    
    <!-- BAGIAN LOGO KECIL (SAAT SIDEBAR DITUTUP) -->
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ url('admin/dashboard') }}">AM</a>
    </div>

    <!-- MENU SIDEBAR -->
    <ul class="sidebar-menu mt-3">
      
      <li class="menu-header">Dashboard</li>
      <li><a class="nav-link" href="{{ url('admin/dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
      
      <li class="menu-header">Data Master</li>
      
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Data Profile</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ url('/data-profile') }}">Data Profile</a></li>
          <li><a class="nav-link" href="{{ url('/data-galeri') }}">Data Galeri</a></li>
          <li><a class="nav-link" href="{{ url('/data-alur') }}">Data Alur</a></li>
          <li><a class="nav-link" href="{{ url('/data-informasi') }}">Data Informasi</a></li>
        </ul>
      </li>
      
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Data Users</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ url('/data-admin') }}">Data Admin</a></li>
          <li><a class="nav-link" href="{{ url('/data-pelamar') }}">Data Pelamar</a></li>
          <li><a class="nav-link" href="{{ url('/data-pembimbing') }}">Data Pembimbing</a></li>
        </ul>
      </li>
      
      <li class="menu-header">Data Pendaftaran</li>
      
      <li>
        <a class="nav-link" href="{{ url('/data-pendaftaran') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Pendaftaran 
            <sup>
              <span class="subatas">
                {{-- AMBIL DATA LANGSUNG DARI DATABASE (Status: Pengajuan) --}}
                {{ \App\Models\Pendaftaran::where('status_pendaftaran', 'pengajuan')->count() }}
              </span>
            </sup>
          </span>
        </a>
      </li>
      
      <li>
        <a class="nav-link" href="{{ url('/data-sertifikat') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Sertifikat</span>
        </a>
      </li>
      
      <li class="menu-header">Data Laporan</li>
      
      <li>
        <a class="nav-link" href="{{ url('/data-diterima') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Diterima 
            <sup>
              <span class="subatas">
                 {{-- AMBIL DATA LANGSUNG DARI DATABASE (Status: Diterima) --}}
                 {{ \App\Models\Pendaftaran::where('status_pendaftaran', 'diterima')->count() }}
              </span>
            </sup>
          </span>
        </a>
      </li>
      
      <li>
        <a class="nav-link" href="{{ url('data-tidak-diterima') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>Data Tidak Diterima 
            <sup>
              <span class="subatas">
                 {{-- AMBIL DATA LANGSUNG DARI DATABASE (Status: Tidak Diterima) --}}
                 {{ \App\Models\Pendaftaran::where('status_pendaftaran', 'tidak diterima')->count() }}
              </span>
            </sup>
          </span>
        </a>
      </li>
    </ul>

  </aside>
</div>