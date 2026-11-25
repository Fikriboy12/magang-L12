<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuka Aplikasi Mobile - PT. Media Balai Nusa</title>
    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <style>
        * {
            box-sizing: border-box;
            margin: 0; padding: 0;
            font-family: 'Poppins', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e3c72 50%, #0284c7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #ffffff;
        }
        .launcher-card {
            background: #ffffff;
            color: #1e293b;
            border-radius: 24px;
            padding: 40px 32px;
            max-width: 460px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
        }
        .launcher-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 6px;
            background: linear-gradient(90deg, #1e3c72, #0284c7, #38bdf8);
        }
        .phone-pulse-icon {
            width: 80px; height: 80px;
            border-radius: 50%;
            background: #e0f2fe;
            color: #0284c7;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            margin-bottom: 20px;
            box-shadow: 0 0 0 rgba(2, 132, 199, 0.4);
            animation: pulseBlue 2s infinite;
        }
        @keyframes pulseBlue {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(2, 132, 199, 0.4); }
            70% { transform: scale(1); box-shadow: 0 0 0 16px rgba(2, 132, 199, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(2, 132, 199, 0); }
        }
        .btn-launch-app {
            background: linear-gradient(135deg, #1e3c72 0%, #0284c7 100%);
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-weight: 700;
            font-size: 15px;
            padding: 14px 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.35);
            transition: all 0.2s ease;
            margin-bottom: 12px;
        }
        .btn-launch-app:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 25px rgba(2, 132, 199, 0.45);
            color: #ffffff;
        }
        .btn-back-web {
            background: #f1f5f9;
            color: #475569;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 600;
            padding: 10px 20px;
            display: inline-block;
            text-decoration: none;
            transition: background 0.2s;
            width: 100%;
        }
        .btn-back-web:hover {
            background: #e2e8f0;
            color: #1e293b;
        }
        .user-pill {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 10px 14px;
            margin-bottom: 24px;
            font-size: 13px;
            color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .spinner {
            width: 20px; height: 20px;
            border: 3px solid rgba(2, 132, 199, 0.2);
            border-top-color: #0284c7;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            display: inline-block;
            vertical-align: middle;
            margin-right: 8px;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

<div class="launcher-card">
    <div class="phone-pulse-icon">
        <i class="fas fa-mobile-alt"></i>
    </div>

    <h3 style="font-weight: 800; color: #0f172a; margin-bottom: 6px;">
        Membuka Aplikasi Mobile
    </h3>
    <p style="font-size: 13px; color: #64748b; margin-bottom: 20px;">
        Menghubungkan akun web Anda langsung ke aplikasi mobile tanpa perlu login ulang.
    </p>

    <div class="user-pill">
        <i class="fas fa-user-check text-success"></i>
        <span>Login sebagai: <strong>{{ $user->name }}</strong> ({{ ucfirst($user->role) }})</span>
    </div>

    <p style="font-size: 12.5px; color: #0284c7; font-weight: 600; margin-bottom: 18px;">
        <span class="spinner"></span> Mengarahkan ke aplikasi mobile...
    </p>

    {{-- Tombol Buka Manual jika auto-redirect tidak terpicu --}}
    <a href="{{ $intentUrl ?? $deepLinkUrl }}" id="btnLaunch" class="btn-launch-app">
        <i class="fas fa-external-link-alt mr-2" style="margin-right: 8px;"></i> Buka di Aplikasi Mobile
    </a>

    <a href="{{ url('/') }}" class="btn-back-web">
        <i class="fas fa-globe mr-1" style="margin-right: 6px;"></i> Tetap di Browser Web
    </a>

    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px dashed #e2e8f0; font-size: 11px; color: #94a3b8;">
        PT. MEDIA BALAI NUSA (ASTRONET) &bull; Sistem Presensi & Magang
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const intentUrl = "{{ $intentUrl ?? $deepLinkUrl }}";
        const deepLink = "{{ $deepLinkUrl }}";

        // Coba luncurkan otomatis
        setTimeout(function() {
            window.location.href = intentUrl;
        }, 300);

        setTimeout(function() {
            window.location.href = deepLink;
        }, 1200);
    });
</script>

</body>
</html>
