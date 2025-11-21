<header id="header" class="fixed-top">
    
    <div class="container-fluid d-flex align-items-center px-5">

        <div class="logo mr-auto">
            
            <h1 class="text-light"><a href="<?php echo e(url('/')); ?>" style="text-decoration: none;"><span>E</span>-Magang</a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                
                <li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>"><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li><a href="<?php echo e(url('/#services')); ?>">Instruction</a></li>
                <li><a href="<?php echo e(url('/#blog')); ?>">Information</a></li>
                <li><a href="<?php echo e(url('/#contact')); ?>">Contact</a></li>
                <li><a href="<?php echo e(url('/#portfolio')); ?>">Gallery</a></li>
                <li class="<?php echo e(request()->is('pendaftaran') ? 'active' : ''); ?>"><a href="<?php echo e(url('pendaftaran')); ?>">Pendaftaran</a></li>
                <li class="<?php echo e(request()->is('data-lamaran') ? 'active' : ''); ?>"><a href="<?php echo e(url('data-lamaran')); ?>">Lamaran</a></li>

                
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->role == 'pelamar' && Auth::user()->status == 'diterima'): ?>
                        <li class="<?php echo e(request()->routeIs('mahasiswa.laporan*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('mahasiswa.laporan.index')); ?>">Laporan Harian</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(url('login')); ?>">Login</a></li>
                <?php else: ?>
                    <li class="drop-down">
                        <a href="#"><?php echo e(Auth::user()->name); ?></a>
                        <ul>
                            <li><a href="<?php echo e(url('profile')); ?>">Profile</a></li>
                            <li>
                                <a href="<?php echo e(url('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="<?php echo e(url('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</header><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template/navbar.blade.php ENDPATH**/ ?>