<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $details['subject'] ?? 'Kode OTP Magang' }}</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 30px 15px;">
    <div style="max-width: 500px; margin: 0 auto; background: #ffffff; border-radius: 12px; padding: 35px 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #2563eb;">
        
        <div style="text-align: center; margin-bottom: 25px;">
            <h2 style="color: #1e293b; margin: 0 0 5px 0; font-size: 22px;">{{ $details['judul'] ?? 'Verifikasi Akun Magang' }}</h2>
            <p style="color: #64748b; font-size: 13px; margin: 0;">PT. MEDIA BALAI NUSA (ASTRONET.ID)</p>
        </div>

        <p style="color: #334155; font-size: 15px; line-height: 1.5;">Halo, <b>{{ $details['nama'] }}</b></p>
        <p style="color: #475569; font-size: 14px; line-height: 1.6;">
            {{ $details['pesan'] ?? 'Terima kasih sudah mendaftar. Untuk mengaktifkan akun Anda, gunakan kode OTP berikut:' }}
        </p>
        
        <div style="background: #eff6ff; border: 2px dashed #93c5fd; padding: 18px 20px; text-align: center; font-size: 32px; font-weight: 800; letter-spacing: 8px; border-radius: 10px; margin: 25px 0; color: #1d4ed8;">
            {{ $details['otp'] }}
        </div>

        <p style="color: #64748b; font-size: 13px; line-height: 1.5; margin-bottom: 25px;">
            <i style="color: #dc2626;">Penting:</i> Kode ini bersifat rahasia dan hanya berlaku selama <b>10 menit</b>. Jangan berikan kode ini kepada siapa pun.
        </p>

        <hr style="border: none; border-top: 1px solid #f1f5f9; margin: 20px 0;">

        <p style="color: #94a3b8; font-size: 12px; text-align: center; margin: 0;">
            Jika Anda tidak meminta email ini, silakan abaikan pesan ini dengan aman.<br>
            &copy; {{ date('Y') }} PT. MEDIA BALAI NUSA. All Rights Reserved.
        </p>
    </div>
</body>
</html>