<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi OTP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { background: #f4f6f9; }
        .otp-card { margin-top: 100px; border: none; border-radius: 15px; }
        .otp-input { font-size: 30px; letter-spacing: 10px; text-align: center; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card otp-card shadow-lg p-4">
                    <div class="text-center mb-4">
                        <h4 class="font-weight-bold text-primary">Verifikasi Email</h4>
                        <p class="text-muted small">Cek email Anda, kami telah mengirimkan kode OTP.</p>
                    </div>

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('otp.verify') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ session('email_otp') }}">
                        
                        <div class="form-group">
                            <input type="text" name="otp" class="form-control otp-input" placeholder="000000" maxlength="6" required autofocus>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg rounded-pill shadow-sm">Verifikasi Akun</button>
                    </form>
                    
                    <div class="text-center mt-3">
                        <small class="text-muted">Salah email? <a href="{{ route('register') }}">Daftar Ulang</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>