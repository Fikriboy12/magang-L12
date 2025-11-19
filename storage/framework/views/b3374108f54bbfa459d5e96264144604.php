
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('pembimbing.dashboard')); ?>" class="brand-link">
      
      <img src="<?php echo e(asset('gambar/ANMS-logo.png')); ?>" 
           alt="ANMS Logo" 
           class="brand-image img-circle elevation-3" 
           style="opacity: .8; max-height: 90px; width: auto; margin-left: 20px;">
           
      
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      
   

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          

       

          <li class="nav-item">
            
            <a href="<?php echo e(route('pembimbing.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('pembimbing.*') ? 'active' : ''); ?>">
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
  </aside><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template_admin/sidebar_pembimbing.blade.php ENDPATH**/ ?>