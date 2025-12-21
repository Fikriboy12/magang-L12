<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #e1e1e1; border-radius: 8px; }
        .header { font-size: 18px; font-weight: bold; margin-bottom: 20px; color: #2d3748; }
        .button-container { text-align: center; margin: 30px 0; }
        .button { background-color: #2d3748; color: #ffffff !important; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .footer { margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        @if($data['status'] == 'terima')
            <div class="header">Selamat! Anda dinyatakan diterima untuk mengikuti program magang yang telah Anda lamar.</div>
            <p>Terima kasih atas ketertarikan Anda untuk bergabung bersama kami. Setelah melalui proses peninjauan profil dan berkas lamaran, dengan senang hati kami informasikan bahwa Anda dinyatakan diterima sebagai peserta magang pada posisi yang telah Anda lamar.</p>
            <p>Kami mengucapkan selamat bergabung dan berharap Anda dapat memperoleh pengalaman serta pembelajaran yang bermanfaat selama menjalani program magang bersama PT Media Balai Nusa.</p>
            <p>Untuk informasi lebih lanjut terkait detail magang, silakan mengakses dashboard magang melalui tombol di bawah ini:</p>
        @else
            <div class="header">Informasi Mengenai Pendaftaran Program Magang Anda</div>
            <p>Terima kasih atas ketertarikan Anda untuk bergabung bersama PT Media Balai Nusa. Kami telah meninjau profil dan berkas lamaran yang Anda kirimkan dengan saksama.</p>
            <p>Namun, mohon maaf saat ini kami belum dapat menerima Anda untuk bergabung dalam program magang kami. Kami sangat menghargai antusiasme Anda dan mendoakan kesuksesan dalam perjalanan karier serta pendidikan Anda di masa mendatang.</p>
            <p>Untuk informasi lebih lanjut, Anda dapat mengakses dashboard melalui tombol di bawah ini:</p>
        @endif

        <div class="button-container">
            <a href="{{ $data['url'] }}" class="button">Dashboard Magang</a>
        </div>

        <p>Apabila terdapat pertanyaan, jangan ragu untuk menghubungi kami melalui kanal komunikasi yang tersedia.</p>
        <p>Terima kasih atas kepercayaan Anda.</p>

        <div class="footer">
            Hormat kami,<br>
            <strong>PT Media Balai Nusa</strong>
        </div>
    </div>
</body>
</html>