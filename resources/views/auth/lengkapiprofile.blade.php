<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Register Perseorangan &mdash; Aplikasi Magang</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('')}}assets_admin/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('')}}assets_admin/modules/fontawesome/css/all.min.css">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('')}}assets_admin/modules/jquery-selectric/selectric.css">

  <!-- assets_admin CSS -->
  <link rel="stylesheet" href="{{asset('')}}assets_admin/css/style.css">
  <link rel="stylesheet" href="{{asset('')}}assets_admin/css/components.css">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
                <img src="{{ asset('') }}assets_admin/img/logonew.png" alt="logo" width="350" class="shadow-light">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Lengkapi Profile </h4></div>

              <div class="card-body">
                <form class="user" method = "POST" enctype='multipart/form-data' action = "{{url('insert-lengkapi-profile')}}">
                    @csrf
                    <div class="row">
                      <div class="form-group col-6">
                          <label>NIM</label>
                          <input type="text" name = "nim" class="form-control" required>
                      </div>
                      <div class="form-group col-6">
                          <label>NIK</label>
                          <input type="text" name = "nik" class="form-control" required>
                      </div>
                    </div>
                    <div class="form-group ">
                        <label for="frist_name">Nama Lengkap</label>
                        <input id="frist_name" type="text" class="form-control" name="nama_lengkap" autofocus required>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label>Tempat Lahir</label>
                            <input type="text" name = "tempat_lahir" class="form-control" required>
                        </div>
                        <div class="form-group col-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name = "tanggal_lahir" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control selectric" name = "jenis_kelamin" required>
                            <option>--Pilih Jenis Kelamin--</option>
                            <option value ="laki-laki">Laki-laki</option>
                            <option value = "perempuan">Perempuan</option>
                        </select>
                    </div>

      
                    <div class="form-group">
                        <label>Agama</label>
                        <select name="agama" class="form-control" required id="">
                            <option>--Pilih Agama--</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                      <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" id="" required class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                        Lengkapi Data
                        </button>
                    </div>
                </form>

                <div class="mt-5 text-muted text-center">
                    Sudah Punya Akun? <a href="{{url('login')}}">Login</a>
                  </div>
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; Magang 2023
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{asset('')}}assets_admin/modules/jquery.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/popper.js"></script>
  <script src="{{asset('')}}assets_admin/modules/tooltip.js"></script>
  <script src="{{asset('')}}assets_admin/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/moment.min.js"></script>
  <script src="{{asset('')}}assets_admin/js/stisla.js"></script>
  
  <!-- JS Libraies -->
  <script src="{{asset('')}}assets_admin/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="{{asset('')}}assets_admin/modules/jquery-selectric/jquery.selectric.min.js"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('')}}assets_admin/js/page/auth-register.js"></script>
  
  <!-- assets_admin JS File -->
  <script src="{{asset('')}}assets_admin/js/scripts.js"></script>
  <script src="{{asset('')}}assets_admin/js/custom.js"></script>
</body>
</html>