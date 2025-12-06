<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login-PT. MEDIA BALAI NUSA</title>

<link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Card Login */
    .login-card {
        background: #fff;
        border-radius: 12px;
        padding: 30px 20px; /* Padding dikurangi sedikit biar tidak terlalu gemuk */
        
        /* PERBAIKAN UTAMA AGAR PAS DI HP */
        width: 90%;          /* Agar ada jarak kiri-kanan di HP (tidak full layar) */
        max-width: 340px;    /* Lebar maksimal dikecilkan sedikit (dari 360 ke 340) */
        
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        text-align: center;
    }

    /* Logo */
    .login-card img {
        width: 100px; /* Diperkecil dari 180px jadi 100px agar rapi */
        height: auto;
        margin-bottom: 15px;
    }

    .company-name {
        font-size: 15px; /* Font diperkecil sedikit */
        font-weight: 500;
        color: #1e3c72;
        margin-bottom: 15px;
    }

    .login-card h2 {
        margin-bottom: 20px;
        color: #1e3c72;
        font-weight: 700;
        font-size: 22px;
    }

    /* Input */
    .input-group {
        position: relative;
        margin-bottom: 12px;
        max-width: 100%;
    }

    .input-group i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #1e3c72;
        font-size: 14px;
    }

    .input-group input {
        width: 100%;
        padding: 10px 12px 10px 35px; /* Padding disesuaikan */
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 13px; /* Font input diperkecil agar pas */
        box-sizing: border-box;
    }

    .input-group input:focus {
        border-color: #1e3c72;
        box-shadow: 0 0 6px rgba(30,60,114,0.4);
    }

    /* Button */
    .login-card button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #1e3c72, #2a5298);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        margin-top: 15px;
        font-size: 14px;
        transition: 0.3s;
    }

    .login-card button:hover {
        background: linear-gradient(135deg, #2a5298, #1e3c72);
        transform: translateY(-2px);
    }

    /* Links */
    .login-card .links {
        margin-top: 15px;
        font-size: 13px;
    }
    .login-card .links a {
        color: #1e3c72;
        text-decoration: none;
        font-weight: 500;
    }
    .login-card .links a:hover {
        color: #2a5298;
        text-decoration: underline;
    }

    /* Alert Style */
    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 6px;
        font-size: 12px; /* Font alert diperkecil */
        text-align: left;
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
    .alert ul {
        margin: 0;
        padding-left: 20px;
    }
</style>
</head>
<body>

<div class="login-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT.MEDIA BALAI NUSA astro net</div>
    <h2>Login</h2>

    {{-- 1. Notifikasi SUKSES --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- 2. Notifikasi ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    {{-- 3. Validasi Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM LOGIN --}}
    <form method="POST" action="{{ route('login.action') }}">
        @csrf
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password" required>
        </div>
        <button type="submit">Login</button>
    </form>

    <div class="links">
        <a href="{{ route('home') }}">Halaman Utama</a> | 
        <a href="{{ route('register') }}">Registrasi</a>
    </div>
</div>

</body>
</html>