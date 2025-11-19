 

<?php $__env->startSection('contents'); ?>
 <!-- ======= Slider Section ======= -->
 
 <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="<?php echo e(asset('assets')); ?>/img/slider/banner1.jpg" alt="" title="#slider-direction-1" />
        <img src="<?php echo e(asset('assets')); ?>/img/slider/banner2.jpg" alt="" title="#slider-direction-2" />
        <img src="<?php echo e(asset('assets')); ?>/img/slider/banner3.jpg" alt="" title="#slider-direction-3" />
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInDown animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">PT. Aditama Net Media Solusindo </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h1 class="title2">Selamat Datang di PT.Aditama Net Media Solusindo </h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="<?php echo e(url('register')); ?>">Registration</a>
                  <a class="ready-btn page-scroll" href="#contact">Contact us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 2 -->
      <div id="slider-direction-2" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content text-center">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Daftarkan Diri Anda </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Mudah cepat dan efisien</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="<?php echo e(url('registrasi')); ?>">Daftar</a>
                  <a class="ready-btn page-scroll" href="#contact">Contact us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- direction 3 -->
      <div id="slider-direction-3" class="slider-direction slider-two">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">Ikuti Petunjuk Yang Ada </h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow animate__fadeIn animate__animated" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">Lebih Cepat, Lebih baik dan Bisa Mendaftar Dirumah</h1>
                </div>
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow animate__slideInUp animate__animated" data-wow-duration="2s" data-wow-delay=".2s">
                    <a class="ready-btn right-btn page-scroll" href="<?php echo e(url('register')); ?>">Daftar</a>
                    <a class="ready-btn page-scroll" href="#contact">Contact us</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Slider -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <div id="about" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Tentang Kami</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- single-well start-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-left">
              <div class="single-well">
                <a href="#">
                  <img src="<?php echo e(asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan)); ?>" alt="" style = "width : 500px">
                </a>
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <div class="single-well">
                <a href="#">
                  <h4 class="sec-head">Profile</h4>
                </a>
                <p>
                    <?php echo e($data['profile']->deskripsi); ?>

                </p>
                <ul>

                </ul>
              </div>
            </div>
          </div>
          <!-- End col-->
        </div>
      </div>
    </div><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <div id="services" class="services-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline services-head text-center">
              <h2>Alur Proses Pendaftaran</h2>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <!-- Start Left services -->
          
          <?php $__currentLoopData = $data['alur']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <div class="col-md-4 col-sm-4 col-xs-12 ">
              <center>
              <div class="about-move">
                <div class="services-details">
                  <div class="single-services">
                    <a class="services-icon" href="#">
                      <img src="<?php echo e(asset('assets_admin/img/alur/'.$value->gambar_alur)); ?>" alt="" style = "height: 113px; width: 142px;">
                    </a>
                    <h4><?php echo e($value->judul); ?></h4>
                    <p>
                      <?php echo e($value->deskripsi); ?>

                    </p>
                  </div>
                </div>
                <!-- end about-details -->
              </div>
              </center>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </div><!-- End Services Section -->


    <!-- <div id="" class="about-area area-padding">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Data Pendaftaran</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
    </div> -->

    <!-- ======= Portfolio Section ======= -->
    <div id="portfolio" class="portfolio-area area-padding fix">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Galeri</h2>
            </div>
          </div>
        </div>
  
        <div class="row awesome-project-content">
          <!-- single-awesome-project start -->
          <?php $__currentLoopData = $data['galeri']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 col-sm-4 col-xs-12 design development">
              <div class="single-awesome-project">
                <div class="awesome-img">
                  <a href="#"><img src="<?php echo e(asset('assets_admin/img/galeri/'.$value->galeri_gambar)); ?>" alt="" style ="width:500px; height :300px;"/></a>
                  <div class="add-actions text-center">
                    <div class="project-dec">
                      <a class="venobox" data-gall="myGallery" href="<?php echo e(asset('assets_admin/img/galeri/'.$value->galeri_gambar)); ?>">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <!-- single-awesome-project end -->
        </div>
      </div>
    </div><!-- End Portfolio Section -->

    <!-- ======= Blog Section ======= -->
    <div id="blog" class="blog-area">
      <div class="blog-inner area-padding">
        <div class="blog-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Informasi berita</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start Left Blog -->
            <?php $__currentLoopData = $data['informasi']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="single-blog">
                  <div class="single-blog-img">
                    <a href="">
                      <img src="<?php echo e(asset('assets_admin/img/informasi/'.$value->gambar_informasi)); ?>" alt="" style = "width: 360px; height:300px;">
                    </a>
                  </div>
                  <div class="blog-meta">
                    <span class="date-type">
                      <i class="fa fa-calendar"></i><?php echo e($value->tgl_informasi); ?>

                    </span>
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href=""><?php echo e($value->judul); ?></a>
                    </h4>
                    <p class = "text-justify">
                    <?php echo e((str_word_count("$value->deskripsi") > 10 ? substr("$value->deskripsi",0,240)." ...." : "$value->deskripsi")); ?>

                    </p>
                  </div>
                  <span>
                    <a href="<?php echo e(url('detail-informasi/'.$value->id_informasi)); ?>" class="ready-btn">Read more</a>
                  </span>
                </div>
              </div>
    
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </div><!-- End Blog Section -->

    <div id="contact" class="contact-area">
      <div class="contact-inner area-padding">
        <div class="contact-overly"></div>
        <div class="container ">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="section-headline text-center">
                <h2>Kontak kami</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-mobile"></i>
                  <p>
                    No telepon
                    <br>
                    <span><?php echo e($data['profile']->no_hp); ?></span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-envelope-o"></i>
                  <p>
                    Email: <?php echo e($data['profile']->email); ?><br>
                    <span>Facebook: <?php echo e($data['profile']->facebook); ?></span>
                  </p>
                </div>
              </div>
            </div>
            <!-- Start contact icon column -->
            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="contact-icon text-center">
                <div class="single-icon">
                  <i class="fa fa-map-marker"></i>
                  <p>
                    Alamat<br>
                    <span><?php echo e($data['profile']->alamat); ?></span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pelamar/home.blade.php ENDPATH**/ ?>