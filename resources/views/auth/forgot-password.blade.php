<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Lupa Kata Sandi - PT. MEDIA BALAI NUSA</title>

<link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #4AC1E0, #3CB9E0);
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px; 
        box-sizing: border-box;
    }

    .auth-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px 22px;
        width: 100%;        
        max-width: 340px;   
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        text-align: center;
    }

    .auth-card img {
        width: 80px;
        height: auto;
        margin-bottom: 12px;
    }

    .company-name {
        font-size: 13px;
        font-weight: 500;
        color: #3CB9E0;
        margin-bottom: 10px;
    }

    .auth-card h2 {
        margin-bottom: 8px;
        color: #3CB9E0;
        font-weight: 700;
        font-size: 20px;
    }

    .subtitle {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 18px;
        line-height: 1.5;
    }

    .input-group {
        position: relative;
        margin-bottom: 15px;
        text-align: left;
    }

    .input-group i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #3CB9E0;
        font-size: 13px;
    }

    .input-group input {
        width: 100%;
        padding: 10px 12px 10px 35px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
    }

    .input-group input:focus {
        border-color: #3CB9E0;
        box-shadow: 0 0 6px rgba(74, 193, 224, 0.4);
    }

    .auth-card button {
        width: 100%;
        padding: 11px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #4AC1E0, #3CB9E0);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        margin-top: 5px;
        font-size: 13px;
        transition: 0.3s;
    }

    .auth-card button:hover {
        background: linear-gradient(135deg, #3CB9E0, #4AC1E0);
        transform: translateY(-2px);
    }

    .auth-card .links {
        margin-top: 18px;
        font-size: 12px;
    }

    .auth-card .links a {
        color: #3CB9E0;
        text-decoration: none;
        font-weight: 500;
    }

    .alert {
        padding: 9px 12px;
        margin-bottom: 15px;
        border-radius: 6px;
        font-size: 12px;
        text-align: left;
        line-height: 1.4;
    }
    .alert-danger {
        background: #ffe6e6;
        color: #cc0000;
        border: 1px solid #ffcccc;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>
</head>
<body>

<div class="auth-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT.MEDIA BALAI NUSA astro net</div>
    <h2>Lupa Kata Sandi</h2>
    <p class="subtitle">
        Masukkan alamat email akun Anda. Kami akan mengirimkan kode OTP 4 digit untuk mengatur ulang kata sandi.
    </p>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="padding-left: 18px; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.send_otp') }}">
        @csrf
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Alamat Email Terdaftar" required value="{{ old('email') }}" autofocus>
        </div>
        
        <button type="submit">
            <i class="fas fa-paper-plane mr-1"></i> Kirim Kode OTP
        </button>
    </form>

    <div class="links">
        <a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Kembali ke Login</a> | 
        <a href="{{ route('home') }}">Beranda</a>
    </div>
</div>

</body>
</html>
