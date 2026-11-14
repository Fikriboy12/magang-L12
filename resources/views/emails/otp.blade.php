<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $details['subject'] ?? 'Kode Verifikasi' }}</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f6f9; margin: 0; padding: 25px 15px; color: #333333;">
    <div style="max-width: 480px; margin: 0 auto; background: #ffffff; border-radius: 8px; padding: 30px 25px; border: 1px solid #e2e8f0;">
        <h3 style="color: #0284c7; margin-top: 0; font-size: 20px;">{{ $details['judul'] ?? 'Verifikasi Akun' }}</h3>
        <p style="font-size: 14px; line-height: 1.5;">Halo <b>{{ $details['nama'] ?? 'Pengguna' }}</b>,</p>
        <p style="font-size: 14px; line-height: 1.5;">{{ $details['pesan'] ?? 'Berikut adalah kode verifikasi akun Anda:' }}</p>
        
        <div style="background: #f0f9ff; border: 1px solid #bae6fd; padding: 15px; text-align: center; font-size: 28px; font-weight: bold; letter-spacing: 6px; color: #0284c7; border-radius: 6px; margin: 20px 0;">
            {{ $details['otp'] }}
        </div>

        <p style="font-size: 13px; color: #64748b; line-height: 1.5;">
            Kode verifikasi ini berlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.
        </p>
        <hr style="border: none; border-top: 1px solid #eeeeee; margin: 20px 0;">
        <p style="font-size: 12px; color: #94a3b8; margin: 0;">
            Pesan otomatis dari Sistem Magang PT. MEDIA BALAI NUSA.
        </p>
    </div>
</body>
</html>