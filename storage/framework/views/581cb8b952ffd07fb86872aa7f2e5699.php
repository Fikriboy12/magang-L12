<header id="header" class="fixed-top">
    
    <div class="container-fluid d-flex align-items-center px-5">

        
        <div class="logo mr-auto">
            <a href="<?php echo e(url('/')); ?>" style="text-decoration: none; display: flex; align-items: center;">
                <div style="width: 40px; height: 40px; background: #2563eb; color: white; font-size: 24px; font-weight: 800; display: flex; align-items: center; justify-content: center; border-radius: 8px; margin-right: 10px;">
                    E
                </div>
                <span style="font-size: 22px; font-weight: 800; color: #0f172a; text-transform: uppercase;">
                    MAGANG
                </span>
            </a>
        </div>

        
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="<?php echo e(request()->is('/') ? 'active' : ''); ?>">
                    <a class="page-scroll" href="<?php echo e(request()->is('/') ? '#home' : url('/#home')); ?>">Beranda</a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php echo e(request()->is('/') ? '#about' : url('/#about')); ?>">Tentang</a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php echo e(request()->is('/') ? '#services' : url('/#services')); ?>">Alur Proses</a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php echo e(request()->is('/') ? '#portfolio' : url('/#portfolio')); ?>">Galeri</a>
                </li>
                <li>
                    <a class="page-scroll" href="<?php echo e(request()->is('/') ? '#blog' : url('/#blog')); ?>">Berita</a>
                </li>
                
                
                <?php
                    $showPendaftaran = true; 
                    if(Auth::check()){
                        $dataPendaftaran = \App\Models\Pendaftaran::where('id_users', Auth::id())->first();
                        if($dataPendaftaran && strtolower($dataPendaftaran->status_pendaftaran) == 'diterima'){
                            $showPendaftaran = false;
                        }
                    }
                ?>

                <?php if($showPendaftaran): ?>
                    <li class="<?php echo e(request()->is('registrasi') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('registrasi')); ?>">REGISTRASI</a>
                    </li>
                <?php endif; ?>
                
                
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::user()->role == 'pelamar'): ?>
                     <li class="<?php echo e(request()->is('pelamar/lamaran*') ? 'active' : ''); ?>"> 
                        <a href="<?php echo e(route('pelamar.lamaran.index')); ?>">Lamaran</a>
                     </li>
                    <?php endif; ?>
                
                    <?php if(!$showPendaftaran || (Auth::user()->role == 'pelamar' && Auth::user()->status == 'diterima')): ?> 
                        <li class="<?php echo e(request()->routeIs('mahasiswa.laporan*') ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('mahasiswa.laporan.index')); ?>">Laporan Harian</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(url('login')); ?>">Masuk</a></li>
                <?php else: ?>
                    <li class="drop-down">
                        <a href="#"><?php echo e(Auth::user()->name); ?></a>
                        <ul>
                            <li><a href="<?php echo e(route('profile.view')); ?>">Profile</a></li>
                            <li>
                                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Keluar
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        
        
        <?php if(auth()->guard()->guest()): ?>
             <a href="<?php echo e(request()->is('/') ? '#contact' : url('/#contact')); ?>" class="header-right-btn page-scroll" style="background: #0f172a; color: white; padding: 8px 20px; border-radius: 50px; font-size: 13px; font-weight: 700; text-decoration: none; margin-left: 15px;">Hubungi Kami</a>
        <?php endif; ?>

    </div>
</header><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/template/navbar.blade.php ENDPATH**/ ?>