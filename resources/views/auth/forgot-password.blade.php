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
        background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                    radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                    radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                    linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%);
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px; 
        box-sizing: border-box;
    }

    .auth-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-top: 4px solid #3ECCE9;
        border-radius: 16px;
        padding: 34px 26px;
        width: 100%;        
        max-width: 350px;   
        box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.12), 0 0 25px rgba(62, 204, 233, 0.12);
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
    }

    .auth-card img {
        width: 82px;
        height: auto;
        margin-bottom: 12px;
        filter: drop-shadow(0 4px 10px rgba(62, 204, 233, 0.25));
    }

    .company-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
        letter-spacing: 0.3px;
    }

    .company-name span {
        color: #0284c7;
        font-weight: 600;
    }

    .auth-card h2 {
        margin-top: 8px;
        margin-bottom: 8px;
        color: #0f172a;
        font-weight: 800;
        font-size: 21px;
        letter-spacing: -0.3px;
    }

    .subtitle {
        font-size: 12px;
        color: #64748b;
        margin-bottom: 18px;
        line-height: 1.5;
    }

    .input-group {
        position: relative;
        margin-bottom: 13px;
        text-align: left;
    }

    .input-group i {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #0284c7;
        font-size: 13.5px;
        pointer-events: none;
    }

    .input-group input {
        width: 100%;
        padding: 10px 12px 10px 38px;
        border-radius: 9px;
        border: 1px solid #cbd5e1;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        background: #f8fafc;
        color: #1e293b;
    }

    .input-group input:focus {
        background: #ffffff;
        border-color: #0284c7;
        box-shadow: 0 0 0 3px rgba(62, 204, 233, 0.28);
    }

    .auth-card button {
        width: 100%;
        padding: 11px;
        border: none;
        border-radius: 9px;
        background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
        color: #ffffff;
        font-weight: 700;
        cursor: pointer;
        margin-top: 10px;
        font-size: 13.5px;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
        transition: all 0.3s ease;
    }

    .auth-card button:hover {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(2, 132, 199, 0.4);
    }

    .auth-card .links {
        margin-top: 18px;
        font-size: 12.5px;
    }

    .auth-card .links a {
        color: #0284c7;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }

    .auth-card .links a:hover {
        color: #0369a1;
        text-decoration: underline;
    }

    .alert {
        padding: 9px 12px;
        margin-bottom: 14px;
        border-radius: 8px;
        font-size: 11.5px;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 8px;
        line-height: 1.4;
    }
    .alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    .alert-success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
</style>
</head>
<body>

<div class="auth-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT. MEDIA BALAI NUSA <span>astro net</span></div>
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

    <form method="POST" action="{{ route('password.send_otp') }}" id="forgotPasswordForm">
        @csrf
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Alamat Email Terdaftar" required value="{{ old('email') }}" autofocus>
        </div>
        
        <button type="submit" id="btnSendOtp">
            <i class="fas fa-paper-plane mr-1"></i> Kirim Kode OTP
        </button>
    </form>

    <div class="links">
        <a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Kembali ke Login</a> | 
        <a href="{{ route('home') }}">Beranda</a>
    </div>
</div>

<script>
    document.getElementById('forgotPasswordForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnSendOtp');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim Kode OTP...';
        }
    });
</script>

</body>
</html>
