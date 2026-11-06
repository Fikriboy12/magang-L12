<style>
  /* Header Sidebar */
  .sidebar-brand {
    background: #ffffff;
    height: auto !important;
    padding: 22px 0 15px;
    border-bottom: 1px solid #f0f3f6;
  }
  
  .sidebar-brand a {
    color: #0d47a1 !important;
    font-weight: 700;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-decoration: none;
  }

  .sidebar-brand .badge-mentor {
    background: #e3f2fd;
    color: #0d47a1;
    font-size: 11px;
    font-weight: 700;
    padding: 3px 8px;
    border-radius: 6px;
    display: inline-block;
    margin-top: 4px;
  }

  /* Styling Menu Item */
  .sidebar-menu li {
    margin-bottom: 6px;
  }

  .sidebar-menu li a {
    border-radius: 10px;
    margin: 0 12px;
    padding: 12px 16px;
    font-weight: 500;
    transition: all 0.25s ease;
    color: #5a6a85;
    display: flex;
    align-items: center;
  }

  .sidebar-menu li a i {
    width: 22px;
    font-size: 16px;
    margin-right: 12px;
    text-align: center;
  }

  .sidebar-menu li a span {
    flex: 1;
  }

  /* Hover */
  .sidebar-menu li a:hover {
    background-color: #f1f5f9;
    color: #0d47a1;
    transform: translateX(4px);
  }

  /* Active */
  .sidebar-menu li.active a {
    background: linear-gradient(135deg, #0d47a1, #1976d2) !important;
    color: #ffffff !important;
    box-shadow: 0 4px 14px rgba(13, 71, 161, 0.35);
  }

  .sidebar-menu li.active a i {
    color: #ffffff !important;
  }

  .sidebar-menu li.active a .badge {
    background-color: #ffffff !important;
    color: #0d47a1 !important;
  }

  /* Section Header */
  .menu-header {
    text-transform: uppercase;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.2px;
    color: #94a3b8;
    margin: 18px 24px 8px !important;
  }

  .badge-counter {
    font-size: 11px;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 10px;
  }
</style>

@php
  $mentorId = Auth::id();
  $sidebarSiswaIds = \App\Models\User::where('role', 'pelamar')->where('pembimbing_lapangan_id', $mentorId)->pluck('id')->toArray();
  if (empty($sidebarSiswaIds)) {
      $sidebarSiswaIds = \App\Models\Pendaftaran::where('status_pendaftaran', 'diterima')->pluck('id_users')->toArray();
  }
  $sidebarPendingIzin = \App\Models\Absensi::whereIn('id_users', $sidebarSiswaIds)
                          ->whereIn('status', ['Izin', 'Sakit'])
                          ->where(function($q) {
                              $q->whereNull('status_validasi')->orWhere('status_validasi', 'pending');
                          })->count();
  $sidebarPendingLaporan = \App\Models\LaporanHarian::whereIn('user_id', $sidebarSiswaIds)->where('status', 'pending')->count();
  $sidebarPendingSertifikat = \App\Models\Sertifikat::whereIn('created_by', $sidebarSiswaIds)->whereIn('status_pengajuan', ['pending', 'menunggu_verifikasi'])->count();
  $sidebarUnreadChats = \App\Models\Chat::where('receiver_id', $mentorId)->where('is_read', false)->count();
@endphp

<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    
    <div class="sidebar-brand">
      <img src="{{ asset('gambar/ANMS-logo.png') }}" width="115px" alt="Logo ANMS" class="mb-1" style="height: auto;">
      <br>
      <span class="badge-mentor"><i class="fas fa-user-tie mr-1"></i> Pembimbing Lapangan</span>
    </div>
    
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('pembimbing_lapangan.dashboard') }}" style="background: linear-gradient(135deg, #0d47a1, #1976d2); color: white; border-radius: 8px; padding: 6px 10px;">PL</a>
    </div>

    <ul class="sidebar-menu mt-3">
      
      <li class="menu-header">Menu Utama</li>

      {{-- 1. DASHBOARD --}}
      <li class="{{ request()->routeIs('pembimbing_lapangan.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing_lapangan.dashboard') }}">
          <i class="fas fa-th-large"></i> 
          <span>Dashboard</span>
        </a>
      </li>

      <li class="menu-header">Bimbingan & Verifikasi</li>

      {{-- 2. ACC IZIN SISWA --}}
      <li class="{{ request()->routeIs('pembimbing_lapangan.izin.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing_lapangan.izin.index') }}">
          <i class="fas fa-calendar-check"></i> 
          <span>ACC Izin Siswa</span>
          @if($sidebarPendingIzin > 0)
            <span class="badge badge-warning badge-counter ml-auto">{{ $sidebarPendingIzin }}</span>
          @endif
        </a>
      </li>

      {{-- 3. DATA LAPORAN HARIAN --}}
      <li class="{{ request()->routeIs('pembimbing_lapangan.laporan.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing_lapangan.laporan.index') }}">
          <i class="fas fa-book-open"></i> 
          <span>Data Laporan</span>
          @if($sidebarPendingLaporan > 0)
            <span class="badge badge-primary badge-counter ml-auto">{{ $sidebarPendingLaporan }}</span>
          @endif
        </a>
      </li>

      {{-- 4. ABSENSI SISWA --}}
      <li class="{{ request()->routeIs('pembimbing_lapangan.absensi.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing_lapangan.absensi.index') }}">
          <i class="fas fa-user-clock"></i> 
          <span>Absensi Siswa</span>
        </a>
      </li>

      {{-- 5. PENGAJUAN SERTIFIKAT --}}
      <li class="{{ request()->routeIs('pembimbing_lapangan.sertifikat.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing_lapangan.sertifikat.index') }}">
          <i class="fas fa-award"></i> 
          <span>Pengajuan Sertifikat</span>
          @if($sidebarPendingSertifikat > 0)
            <span class="badge badge-danger badge-counter ml-auto">{{ $sidebarPendingSertifikat }}</span>
          @endif
        </a>
      </li>

      <li class="menu-header">Komunikasi</li>

      {{-- 6. CHAT DENGAN SISWA --}}
      <li class="{{ request()->routeIs('pembimbing_lapangan.chat.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('pembimbing_lapangan.chat.index') }}">
          <i class="fas fa-comments"></i> 
          <span>Chat Siswa</span>
          @if($sidebarUnreadChats > 0)
            <span class="badge badge-success badge-counter ml-auto">{{ $sidebarUnreadChats }}</span>
          @endif
        </a>
      </li>

    </ul>

    <div class="p-3 mt-4 text-center">
      <div class="card bg-light border-0 py-2 px-3 shadow-none text-muted small" style="border-radius: 10px;">
        <i class="fas fa-building text-primary mb-1"></i>
        <div class="font-weight-bold text-dark">PT. Media Balai Nusa</div>
        <div>Mentor Industri SMK</div>
      </div>
    </div>

  </aside>
</div>
