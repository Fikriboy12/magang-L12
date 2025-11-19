{{-- 
  File ini adalah menu sidebar HANYA UNTUK PEMBIMBING.
  (Versi Final: Logo disesuaikan, Bersih, Rapi)
--}}
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('pembimbing.dashboard') }}" class="brand-link">
      
      <img src="{{ asset('gambar/ANMS-logo.png') }}" 
           alt="ANMS Logo" 
           class="brand-image img-circle elevation-3" 
           style="opacity: .8; max-height: 90px; width: auto; margin-left: 20px;">
           
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          {{-- (Menu Dashboard dihapus agar langsung fokus ke mahasiswa) --}}

       

          <li class="nav-item">
            {{-- Link ini aktif jika sedang di halaman pembimbing --}}
            <a href="{{ route('pembimbing.dashboard') }}" class="nav-link {{ request()->routeIs('pembimbing.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Mahasiswa Bimbingan
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>