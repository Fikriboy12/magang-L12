 
@extends('template.master')
@section('contents')
 <!-- ======= Slider Section ======= -->
 
 <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
      <div id="ensign-nivoslider" class="slides">
        <img src="{{ asset('assets') }}/img/slider/banner1.jpg" alt="" title="#slider-direction-1" />
        <img src="{{ asset('assets') }}/img/slider/banner2.jpg" alt="" title="#slider-direction-2" />
        <img src="{{ asset('assets') }}/img/slider/banner3.jpg" alt="" title="#slider-direction-3" />
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
                  <a class="ready-btn right-btn page-scroll" href="{{ url('register') }}">Registration</a>
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
                  <a class="ready-btn right-btn page-scroll" href="{{ url('registrasi') }}">Daftar</a>
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
                    <a class="ready-btn right-btn page-scroll" href="{{ url('register') }}">Daftar</a>
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
                  <img src="{{ asset('assets_admin/img/profile_perusahaan/'.$data['profile']->gambar_perusahaan) }}" alt="" style = "width : 500px">
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
                    {{ $data['profile']->deskripsi }}
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
          
          @foreach ($data['alur'] as $value) 
            <div class="col-md-4 col-sm-4 col-xs-12 ">
              <center>
              <div class="about-move">
                <div class="services-details">
                  <div class="single-services">
                    <a class="services-icon" href="#">
                      <img src="{{ asset('assets_admin/img/alur/'.$value->gambar_alur) }}" alt="" style = "height: 113px; width: 142px;">
                    </a>
                    <h4>{{ $value->judul }}</h4>
                    <p>
                      {{ $value->deskripsi }}
                    </p>
                  </div>
                </div>
                <!-- end about-details -->
              </div>
              </center>
            </div>
          @endforeach
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
          @foreach ($data['galeri'] as $value)
            <div class="col-md-4 col-sm-4 col-xs-12 design development">
              <div class="single-awesome-project">
                <div class="awesome-img">
                  <a href="#"><img src="{{ asset('assets_admin/img/galeri/'.$value->galeri_gambar) }}" alt="" style ="width:500px; height :300px;"/></a>
                  <div class="add-actions text-center">
                    <div class="project-dec">
                      <a class="venobox" data-gall="myGallery" href="{{ asset('assets_admin/img/galeri/'.$value->galeri_gambar) }}">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
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
            @foreach ($data['informasi'] as $value)
              <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="single-blog">
                  <div class="single-blog-img">
                    <a href="">
                      <img src="{{ asset('assets_admin/img/informasi/'.$value->gambar_informasi) }}" alt="" style = "width: 360px; height:300px;">
                    </a>
                  </div>
                  <div class="blog-meta">
                    <span class="date-type">
                      <i class="fa fa-calendar"></i>{{ $value->tgl_informasi }}
                    </span>
                  </div>
                  <div class="blog-text">
                    <h4>
                      <a href="">{{ $value->judul }}</a>
                    </h4>
                    <p class = "text-justify">
                    {{(str_word_count("$value->deskripsi") > 10 ? substr("$value->deskripsi",0,240)." ...." : "$value->deskripsi") }}
                    </p>
                  </div>
                  <span>
                    <a href="{{ url('detail-informasi/'.$value->id_informasi) }}" class="ready-btn">Read more</a>
                  </span>
                </div>
              </div>
    
            @endforeach
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
                    <span>{{ $data['profile']->no_hp }}</span>
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
                    Email: {{ $data['profile']->email }}<br>
                    <span>Facebook: {{ $data['profile']->facebook }}</span>
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
                    <span>{{ $data['profile']->alamat }}</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
          {{-- <div class="row">

            <!-- Start Google Map -->
            <div class="col-md-6 col-sm-6 col-xs-12">
      
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d58749.50151125328!2d106.98344347521022!3d-6.288597057174951!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6993b44246b5b5%3A0x14230a9f8fa3c313!2sSchool%20SMK%20Al%20-%20Muhtadin!5e0!3m2!1sen!2sid!4v1693322121171!5m2!1sen!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              <!-- End Map -->
            </div>
            <!-- End Google Map -->

            <!-- Start  contact -->
            <div class="col-md-6 col-sm-6 col-xs-12">
           
              <div class="form contact-form">
                <form action="{{ url('home/insert_pesan')  }}" method="POST">
                  <div class="form-group">
                    <input type="text" name="nama" class="form-control"  placeholder="Your Name"/>
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control" name="email"  placeholder="Your Email"  />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" name="subyek"  placeholder="Subject" />
                    <div class="validate"></div>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" name="pesan" rows="5" data-rule="required" placeholder="Message"></textarea>
                    <div class="validate"></div>
                  </div>
                  <div class="text-center"><button type="submit" class = "btn btn-primary">Send Message</button></div>
                </form>
              </div>
            </div>
            <!-- End Left contact -->
          </div> --}}
        </div>
      </div>
    </div><!-- End Contact Section -->

  </main><!-- End #main -->
  @endsection