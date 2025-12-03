<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Aplikasi Magang</title>
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

    /* Card */
    .login-card {
        background: #fff;
        border-radius: 12px;
        padding: 35px 25px;
        width: 100%;
        max-width: 360px; /* card tidak terlalu lebar */
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        text-align: center;
    }

    .login-card img {
        width: 180px;
        margin-bottom: 10px;
    }

    .company-name {
        font-size: 17px;
        font-weight: 500;
        color: #1e3c72;
        margin-bottom: 20px;
    }

    .login-card h2 {
        margin-bottom: 20px;
        color: #1e3c72;
        font-weight: 700;
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
        left: 10px;
        transform: translateY(-50%);
        color: #1e3c72;
    }

    .input-group input {
        width: 100%;
        padding: 8px 12px 8px 35px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 14px;
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
        font-size: 15px;
    }

    .login-card button:hover {
        background: linear-gradient(135deg, #2a5298, #1e3c72);
    }

    /* Links */
    .login-card .links {
        margin-top: 12px;
        font-size: 14px;
    }
    .login-card .links a {
        color: #1e3c72;
        text-decoration: none;
    }
    .login-card .links a:hover {
        color: #2a5298;
        text-decoration: underline;
    }

    /* Alert Style (Diperbaiki) */
    .alert {
        padding: 10px;
        margin-bottom: 15px;
        border-radius: 6px;
        font-size: 13px;
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
    <div class="company-name">PT. Aditama Net media Solusindo</div>
    <h2>Login</h2>

    {{-- 1. Notifikasi SUKSES (Misal setelah logout atau register) --}}
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- 2. Notifikasi ERROR (Password Salah / Email Tidak Terdaftar) --}}
    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    {{-- 3. Validasi Error (Misal email kosong) --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('action-login') }}">
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
        <a href="{{ url('') }}">Halaman Utama</a> | 
        <a href="{{ url('registrasi') }}">Registrasi</a>
    </div>
</div>

</body>
</html>