<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PT. MEDIA BALAI NUSA</title>
    
    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        /* Background Ambient Light Tech: Lembut, berdimensi, harmonis dengan logo */
        body { 
            background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                        radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                        radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                        linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%);
            font-family: 'Roboto', 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            box-sizing: border-box;
        } 
        /* CONTAINER UTAMA */
        .login-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Card Login Modern, Elegan & Berdimensi */
        .card { 
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-top: 4px solid #3ECCE9; /* Garis aksen atas warna Cyan Logo ANMS */
            border-radius: 16px; 
            box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.12), 0 0 25px rgba(62, 204, 233, 0.12); 
            padding: 10px 5px; 
            width: 100%;
            max-width: 360px; 
            margin: 0 auto; 
            background: #ffffff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card-body {
            padding: 1.5rem !important;
        }
        
        /* Style Tombol Gradasi Presisi Logo */
        .btn-primary { 
            background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%); 
            border: none;
            border-radius: 9px;
            color: #ffffff; 
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 11px 0; 
            font-size: 13.5px;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.4);
            color: #ffffff;
        }
        
        /* === INPUT FIELD (Icon Inside) === */
        .input-group {
            border: 1px solid #cbd5e1;
            border-radius: 9px;
            background-color: #f8fafc;
            overflow: hidden;
            height: 42px; 
            margin-bottom: 14px; 
            transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        }
        .input-group:focus-within {
            border-color: #0284c7;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(62, 204, 233, 0.28);
        }
        .input-group-text {
            background-color: transparent;
            border: none;
            color: #0284c7; /* Biru logo tegas */
            padding: 0.375rem 0.85rem;
            font-size: 13.5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-control {
            border: none;
            box-shadow: none;
            height: 100%;
            background-color: transparent;
            font-size: 13px;
            color: #1e293b;
        }
        .form-control:focus {
            background-color: transparent;
            outline: none;
            box-shadow: none;
        }
        
        /* Style Judul dan Logo */
        .pt-title {
            color: #0f172a; /* Warna Navy Korporat - Kontras tinggi */
            font-weight: 700;
            font-size: 13.5px; 
            margin-bottom: 4px;
            letter-spacing: 0.3px;
        }
        .pt-title span {
            color: #0284c7; /* Aksen Biru Logo */
            font-weight: 600;
        }
        .main-login-title {
            color: #0f172a;
            font-weight: 800;
            margin-bottom: 18px; 
            font-size: 21px;
            letter-spacing: -0.3px;
        }
        .logo-img {
             width: 82px;
             max-width: 82px; 
             height: auto;
             margin-bottom: 12px;
             filter: drop-shadow(0 4px 10px rgba(62, 204, 233, 0.25));
        }
        .text-secondary {
            color: #0284c7 !important;
            font-weight: 600;
            font-size: 12.5px;
            transition: color 0.2s;
            text-decoration: none;
        }
        .text-secondary:hover {
            color: #0369a1 !important;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="col-12 d-flex justify-content-center">
        <div class="card bg-white">
            <div class="card-body p-4">
                
                <div class="text-center mb-4">
                    <img src="{{ asset('gambar/ANMS-logo.png') }}" class="logo-img" alt="Logo PT Media Balai Nusa"> 
                    
                    <h5 class="pt-title">PT. MEDIA BALAI NUSA <span>astro net</span></h5>
                    <h4 class="main-login-title">Login</h4>
                </div>

                {{-- Notifikasi Error/Success --}}
                @if (session('error') || session('err_message'))
                    <div class="alert alert-danger text-center mb-3">
                        <i class="fas fa-exclamation-triangle"></i> 
                        {{ session('error') }}
                        {{ session('err_message') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success text-center mb-3">
                        <i class="fas fa-check-circle"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ Request::is('admin/login') ? route('admin.login.action') : route('login.action') }}">
                    @csrf

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input id="admin_password" type="password" class="form-control" name="password" placeholder="Password" required autocomplete="current-password">
                            <div class="input-group-append">
                                <button type="button" class="btn input-group-text" id="btnToggleAdminPassword" style="cursor: pointer; border: none; background: transparent; color: #8fa0b5;" title="Tampilkan kata sandi">
                                    <i class="fas fa-eye" id="iconToggleAdminPassword"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4">
                        {{ Request::is('admin/login') ? 'MASUK SEBAGAI ADMIN' : 'LOGIN' }}
                    </button>
                    
                    <hr style="border-top: 1px solid #e2e8f0; margin-top: 18px; margin-bottom: 14px;">
                    
                    <div class="text-center">
                        @if (Request::is('admin/login'))
                            <small>
                                <a href="{{ route('login') }}" class="text-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login Portal Utama
                                </a>
                            </small>
                        @else
                            <small>
                                <a href="{{ url('/') }}" class="text-secondary">Halaman Utama</a> | 
                                <a href="{{ route('register') }}" class="text-secondary">Registrasi</a>
                            </small>
                        @endif
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const btnToggleAdmin = document.getElementById('btnToggleAdminPassword');
    const inputAdminPass = document.getElementById('admin_password');
    const iconToggleAdmin = document.getElementById('iconToggleAdminPassword');

    if (btnToggleAdmin && inputAdminPass && iconToggleAdmin) {
        btnToggleAdmin.addEventListener('click', function(e) {
            e.preventDefault();
            if (inputAdminPass.type === 'password') {
                inputAdminPass.type = 'text';
                iconToggleAdmin.classList.remove('fa-eye');
                iconToggleAdmin.classList.add('fa-eye-slash');
                btnToggleAdmin.style.color = '#0284c7';
                btnToggleAdmin.setAttribute('title', 'Sembunyikan kata sandi');
            } else {
                inputAdminPass.type = 'password';
                iconToggleAdmin.classList.remove('fa-eye-slash');
                iconToggleAdmin.classList.add('fa-eye');
                btnToggleAdmin.style.color = '#8fa0b5';
                btnToggleAdmin.setAttribute('title', 'Tampilkan kata sandi');
            }
        });
    }
</script>
</body>
</html>