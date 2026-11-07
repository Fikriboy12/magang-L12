<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Atur Ulang Kata Sandi - PT. MEDIA BALAI NUSA</title>

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
        max-width: 350px;   
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
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .input-group {
        position: relative;
        margin-bottom: 12px;
        text-align: left;
    }

    .input-group > i.input-icon-left,
    .input-group > i:first-child {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #3CB9E0;
        font-size: 13px;
        pointer-events: none;
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

    .input-group input[type="password"],
    .input-group input.has-toggle {
        padding-right: 38px;
    }

    .input-group input:focus {
        border-color: #3CB9E0;
        box-shadow: 0 0 6px rgba(74, 193, 224, 0.4);
    }

    /* Toggle Show/Hide Password */
    .toggle-password-btn {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #8fa0b5;
        font-size: 14px;
        padding: 5px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease;
        z-index: 5;
        background: transparent;
        border: none;
        outline: none;
        user-select: none;
    }

    .toggle-password-btn:hover {
        color: #3CB9E0;
    }

    .toggle-password-btn i {
        position: static !important;
        transform: none !important;
        font-size: 14px !important;
        color: inherit !important;
    }

    /* Style Khusus Input OTP */
    .otp-input {
        text-align: center !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        letter-spacing: 8px !important;
        padding-left: 12px !important;
        background-color: #f8fafc;
        border: 2px dashed #3CB9E0 !important;
    }

    .auth-card button.btn-submit {
        width: 100%;
        padding: 11px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #4AC1E0, #3CB9E0);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
        font-size: 13px;
        transition: 0.3s;
    }

    .auth-card button.btn-submit:hover {
        background: linear-gradient(135deg, #3CB9E0, #4AC1E0);
        transform: translateY(-2px);
    }

    .btn-resend {
        background: transparent;
        border: none;
        color: #0284c7;
        font-size: 12px;
        cursor: pointer;
        text-decoration: underline;
        padding: 0;
        margin-top: 8px;
        display: inline-block;
    }
    .btn-resend:hover {
        color: #0369a1;
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

    .password-hint {
        font-size: 11px;
        color: #64748b;
        text-align: left;
        margin-top: -6px;
        margin-bottom: 12px;
        display: block;
        line-height: 1.4;
    }
</style>
</head>
<body>

<div class="auth-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT.MEDIA BALAI NUSA astro net</div>
    <h2>Atur Ulang Kata Sandi</h2>
    <p class="subtitle">
        Kode verifikasi telah dikirim ke: <br>
        <b style="color: #0369a1;">{{ $email }}</b>
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

    <form method="POST" action="{{ route('password.update.otp') }}">
        @csrf
        
        <div class="form-group mb-2" style="text-align: left;">
            <label style="font-size: 12px; font-weight: 600; color: #475569; display: block; margin-bottom: 5px;">
                Masukkan 4 Digit Kode OTP:
            </label>
            <input type="number" name="otp" id="otp" class="otp-input" placeholder="0000" maxlength="4" required autofocus value="{{ old('otp') }}" style="width: 100%; border-radius: 8px; box-sizing: border-box; height: 42px;">
        </div>

        <div class="input-group mt-3">
            <i class="fas fa-lock input-icon-left"></i>
            <input type="password" name="password" id="reset_password" class="has-toggle" placeholder="Kata Sandi Baru" required minlength="8" autocomplete="new-password">
            <span class="toggle-password-btn" onclick="togglePasswordVisibility('reset_password', this)" role="button" tabindex="0" title="Tampilkan Kata Sandi">
                <i class="fas fa-eye"></i>
            </span>
        </div>

        <span class="password-hint">
            <i class="fas fa-info-circle text-primary"></i> Wajib minimal 8 karakter, kombinasi huruf dan angka.
        </span>

        <div class="input-group">
            <i class="fas fa-check-double input-icon-left"></i>
            <input type="password" name="password_confirmation" id="reset_password_confirmation" class="has-toggle" placeholder="Ulangi Kata Sandi Baru" required minlength="8" autocomplete="new-password">
            <span class="toggle-password-btn" onclick="togglePasswordVisibility('reset_password_confirmation', this)" role="button" tabindex="0" title="Tampilkan Konfirmasi Kata Sandi">
                <i class="fas fa-eye"></i>
            </span>
        </div>
        
        <button type="submit" class="btn-submit">
            <i class="fas fa-key mr-1"></i> Simpan Kata Sandi Baru
        </button>
    </form>

    <div style="margin-top: 10px;">
        <form method="POST" action="{{ route('password.resend_otp') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-resend">
                <i class="fas fa-sync-alt"></i> Belum menerima kode? Kirim Ulang OTP
            </button>
        </form>
    </div>

    <div class="links">
        <a href="{{ route('login') }}"><i class="fas fa-arrow-left"></i> Kembali ke Login</a> | 
        <a href="{{ route('home') }}">Beranda</a>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
            btn.style.color = '#3CB9E0';
            btn.setAttribute('title', 'Sembunyikan Kata Sandi');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
            btn.style.color = '#8fa0b5';
            btn.setAttribute('title', 'Tampilkan Kata Sandi');
        }
    }
</script>
</body>
</html>
