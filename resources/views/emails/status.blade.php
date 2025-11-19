<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['title'] ?? 'Pembaruan Status Pendaftaran' }}</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
        <h2 style="color: #6777ef;">{{ $data['title'] ?? 'Status Pendaftaran Magang' }}</h2>
        
        <p>Yth. Pelamar,</p>

        <p>Dengan email ini, kami memberitahukan bahwa status pendaftaran magang Anda telah diperbarui.</p>
        
        <p style="padding: 10px; background-color: #f4f4f4; border-left: 5px solid #6777ef; margin: 15px 0;">
            Status: <strong>{{ str_contains($data['title'], 'Diterima') ? 'Diterima' : 'Tidak Diterima' }}</strong>
        </p>

        @if(isset($data['keterangan']))
            <p><strong>Pesan dari Admin:</strong> {{ $data['keterangan'] }}</p>
        @endif

        @if(isset($data['url']))
            <p>Untuk detail dan langkah selanjutnya, silakan kunjungi:</p>
            <p style="text-align: center;">
                <a href="{{ $data['url'] }}" style="display: inline-block; padding: 10px 20px; background-color: #6777ef; color: white; text-decoration: none; border-radius: 5px;">Kunjungi Aplikasi Magang</a>
            </p>
        @endif
        
        <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
        <p style="font-size: 0.9em; margin-top: 20px; color: #777;">Hormat Kami,<br>Tim Magang</p>
    </div>
</body>
</html>