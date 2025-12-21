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
        padding: 20px; 
        box-sizing: border-box;
    }

    /* Card Login diperkecil lagi */
    .login-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px 20px;
        
        /* --- PERUBAHAN: Lebar maksimal diperkecil menjadi 300px agar lebih mungil --- */
        width: 100%;        
        max-width: 300px;   
        
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        text-align: center;
    }

    /* Logo juga disesuaikan ukurannya */
    .login-card img {
        width: 80px; /* Diperkecil sedikit agar proporsional dengan kotak baru */
        height: auto;
        margin-bottom: 15px;
    }

    .company-name {
        font-size: 13px; /* Font diperkecil sedikit */
        font-weight: 500;
        color: #1e3c72;
        margin-bottom: 12px;
    }

    .login-card h2 {
        margin-bottom: 18px;
        color: #1e3c72;
        font-weight: 700;
        font-size: 20px; /* Judul diperkecil sedikit */
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
        font-size: 13px;
    }

    .input-group input {
        width: 100%;
        padding: 9px 12px 9px 35px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 13px;
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
        margin-top: 10px;
        font-size: 13px;
        transition: 0.3s;
    }

    .login-card button:hover {
        background: linear-gradient(135deg, #2a5298, #1e3c72);
        transform: translateY(-2px);
    }

    /* Links */
    .login-card .links {
        margin-top: 15px;
        font-size: 12px;
    }
    .login-card .links a {
        color: #1e3c72;
        text-decoration: none;
        font-weight: 500;
    }

    /* Alert Style */
    .alert {
        padding: 8px;
        margin-bottom: 12px;
        border-radius: 6px;
        font-size: 11px;
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
</style>
</head>
<body>

<div class="login-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT.MEDIA BALAI NUSA astro net</div>
    <h2>Login</h2>

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
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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