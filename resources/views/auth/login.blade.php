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

    .login-card {
        background: #fff;
        border-radius: 12px;
        padding: 35px 25px;
        width: 100%;
        max-width: 360px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        text-align: center;
    }

    .login-card img {
        width: 90px;
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

    .links {
        margin-top: 12px;
        font-size: 14px;
    }
    .links a {
        color: #1e3c72;
        text-decoration: none;
    }
    .links a:hover {
        color: #2a5298;
        text-decoration: underline;
    }

    .alert {
        background: #ffe6e6;
        color: #cc0000;
        padding: 10px;
        margin-bottom: 12px;
        border-radius: 6px;
        font-size: 14px;
        text-align: left;
    }
</style>
</head>
<body>

<div class="login-card">

    <img src="{{ asset('assets_admin/img/logolama.png') }}" alt="Logo">
    <div class="company-name">PT. Aditama Net media Solusindo</div>
    <h2>Login</h2>

    @if ($errors->any())
        <div class="alert">
            <ul style="margin: 0; padding-left: 15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ✅ PERBAIKAN: Arahkan ke /action-login --}}
    <form method="POST" action="{{ url('/action-login') }}">
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
