<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT. MEDIA BALAI NUSA</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        /* Latar Belakang Biru Solid (KOREKSI WARNA) */
        body { 
            background-color: #3b5998; /* Warna biru solid yang paling mendekati */
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #4a5568;
            height: 100vh;
            margin: 0;
        } 
        /* CONTAINER UTAMA (Memaksa Rata Tengah Sempurna) */
        .login-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Card container */
        .card { 
            border: none; 
            border-radius: 10px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.4); 
            padding: 20px 15px; 
            width: 100%;
            max-width: 380px; 
            margin: 0 auto; 
        }
        .card-body {
            padding: 1.5rem !important;
        }
        
        /* Style Tombol */
        .btn-primary { 
            background-color: #2563eb; 
            border-color: #2563eb; 
            font-weight: bold;
            letter-spacing: 1px;
            padding: 8px 0; 
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #1d4ed8;
            border-color: #1d4ed8;
        }
        
        /* === INPUT FIELD (Icon Inside) === */
        .input-group {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #ffffff;
            overflow: hidden;
            height: 40px; 
            margin-bottom: 15px; 
        }
        .input-group-text {
            background-color: #ffffff;
            border: none;
            color: #64748b;
            padding: 0.375rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .form-control {
            border: none;
            box-shadow: none;
            height: 100%;
        }
        
        /* Style Judul dan Logo */
        .pt-title {
            color: #2563eb; 
            font-weight: bold;
            font-size: 0.9rem; 
            margin-bottom: 3px;
        }
        .main-login-title {
            color: #0f172a;
            font-weight: bold;
            margin-bottom: 15px; 
            font-size: 1.4rem;
        }
        .logo-img {
             max-width: 100px; 
             margin-bottom: 8px;
        }
        .text-secondary {
            color: #6c757d !important;
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
                    
                    <h5 class="pt-title">PT. MEDIA BALAI NUSA astro net</h5>
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

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block mt-4">
                        {{ Request::is('admin/login') ? 'MASUK SEBAGAI ADMIN' : 'LOGIN' }}
                    </button>
                    
                    <hr>
                    
                    <div class="text-center">
                        @if (Request::is('admin/login'))
                            <small>
                                <a href="{{ route('login') }}" class="text-secondary">Kembali ke Login Pelamar</a>
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
</body>
</html>