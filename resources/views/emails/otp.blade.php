<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Magang</title>
</head>
<body style="font-family: Arial, sans-serif;">
    <h3>Verifikasi Akun Magang</h3>
    <p>Halo, <b>{{ $details['nama'] }}</b></p>
    <p>Terima kasih sudah mendaftar. Untuk mengaktifkan akun, masukkan kode berikut:</p>
    
    <div style="background: #f3f3f3; padding: 20px; text-align: center; font-size: 24px; font-weight: bold; letter-spacing: 5px; border-radius: 10px; margin: 20px 0;">
        {{ $details['otp'] }}
    </div>

    <p>Jangan berikan kode ini ke siapa pun.</p>
</body>
</html>