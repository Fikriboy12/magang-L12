<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PT. MEDIA BALAI NUSA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('assets_admin/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/modules/fontawesome/css/all.min.css') }}">

    <style>
        /* BACKGROUND GRADIENT BIRU CERAH DARI LOGO */
        body {
            background: linear-gradient(135deg, #4AC1E0 0%, #3CB9E0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            font-family: 'Nunito', sans-serif;
        }

        /* CARD REGISTER */
        .card-register {
            background: #ffffff;
            border-radius: 15px; 
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: none;
        }

        /* HEADER */
        .register-header h4 {
            color: #000000;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        /* FORM INPUT STANDAR */
        .form-group label {
            font-weight: 600;
            color: #444;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #d1d3e2;
            padding: 12px 15px;
            height: 48px; 
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #3CB9E0;
            box-shadow: 0 0 0 3px rgba(60, 185, 224, 0.1);
        }

        /* TOMBOL KIRIM OTP (BIRU CERAH LOGO) */
        .btn-otp {
            background-color: #3CB9E0; 
            color: white;
            font-weight: 600;
            border: 1px solid #3CB9E0;
            border-radius: 0 8px 8px 0 !important; 
            padding: 0 20px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .btn-otp:hover {
            background-color: #4AC1E0; 
            color: white;
        }
        .btn-otp:disabled {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        /* INPUT KODE OTP (4 DIGIT STYLE) */
        .otp-input-style {
            text-align: center;
            letter-spacing: 15px; 
            font-weight: bold;
            font-size: 1.4rem; 
            color: #3CB9E0;
            background-color: #f8f9fc; 
            border: 1px solid #b7b9cc;
        }
        
        .otp-input-style:focus {
            background-color: #fff;
            border-color: #3CB9E0;
        }

        /* TOMBOL DAFTAR */
        .btn-register {
            background: linear-gradient(135deg, #4AC1E0 0%, #3CB9E0 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 50px;
            width: 100%;
            box-shadow: 0 4px 15px rgba(60, 185, 224, 0.3);
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.95rem;
            margin-top: 20px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(60, 185, 224, 0.4);
            color: white;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .login-footer a {
            color: #3CB9E0;
            font-weight: 700;
            text-decoration: none;
        }
        
        textarea.form-control {
            height: 100px !important;
            resize: none;
        }

        .section-title {
            color: #3CB9E0;
            font-weight: bold;
            border-bottom: 2px solid #3CB9E0;
            padding-bottom: 5px;
            margin-bottom: 20px;
            margin-top: 30px;
        }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
</head>

<body>
    
    <div class="card-register">
        <div class="text-center mb-4 register-header">
             <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="logo" width="90">
             <h4 class="mt-3">Form Registrasi Akun Siswa</h4>
             <p class="text-muted small">Silakan lengkapi data diri Anda dan verifikasi wajah</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                <strong>Berhasil!</strong> {{ session('success') }} <br>
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary mt-2">Login Sekarang</a>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 small pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!session('success'))
        <form method="POST" action="{{ route('register.store') }}" id="registerForm">
            @csrf

            <h5 class="section-title">Data Akun</h5>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" required>
            </div>

            <div class="form-group">
                <label>Email Siswa</label>
                <div class="input-group">
                    <input type="email" name="email" id="emailInput" class="form-control" placeholder="contoh@email.com" value="{{ old('email') }}" required style="border-radius: 8px 0 0 8px;">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-otp" id="btnKirimOtp">
                            Kirim OTP
                        </button>
                    </div>
                </div>
                <small class="text-muted d-block mt-1" id="otpStatus" style="font-size: 12px;">
                    <i class="fas fa-info-circle"></i> Klik tombol biru untuk menerima kode.
                </small>
            </div>

            <div class="form-group">
                <label>Kode Verifikasi (OTP)</label>
                <input type="number" name="otp_input" class="form-control otp-input-style" placeholder="0000" maxlength="4" required>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Min 8 karakter" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Nomor HP Siswa</label>
                <input type="number" name="no_hp_siswa" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_siswa') }}" required>
            </div>


            <h5 class="section-title">Data Orang Tua/Wali</h5>

            <div class="form-group">
                <label>Nama Orang Tua/Wali</label>
                <input type="text" name="nama_wali" class="form-control" placeholder="Nama Lengkap Orang Tua/Wali" value="{{ old('nama_wali') }}" required>
            </div>

            <div class="form-group">
                <label>Email Orang Tua/Wali</label>
                <input type="email" name="email_wali" class="form-control" placeholder="Email Orang Tua/Wali" value="{{ old('email_wali') }}" required>
            </div>

            <div class="form-group">
                <label>Nomor HP Orang Tua/Wali</label>
                <input type="number" name="no_hp_wali" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_wali') }}" required>
            </div>


            <h5 class="section-title">Verifikasi Biometrik</h5>

            <div class="form-group text-center">
                <div style="position: relative; display: inline-block; background: #e9ecef; border-radius: 8px; overflow: hidden; border: 2px solid #3CB9E0;">
                    <video id="video-webcam" width="320" height="240" autoplay muted></video>
                    <canvas id="overlay-canvas" style="position: absolute; top: 0; left: 0; z-index: 10; pointer-events: none;"></canvas>
                </div>
                
                <br>
                <button type="button" class="btn btn-outline-info mt-3 font-weight-bold" id="btn-capture-face">
                    <i class="fas fa-camera"></i> Ambil Foto Wajah (Biometrik)
                </button>
                <p id="biometric-status" class="mt-2 text-danger font-weight-bold">Wajah belum dipindai.</p>

                <input type="hidden" name="face_descriptor" id="face_descriptor">
            </div>


            <button type="submit" class="btn-register">
                Daftar Akun
            </button>

            <div class="login-footer">
                Sudah punya akun? <a href="{{ url('login') }}">Login Disini</a>
            </div>

        </form>
        @endif
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('#btnKirimOtp').click(function() {
                var email = $('#emailInput').val();
                var btn = $(this);
                var status = $('#otpStatus');

                if(email == '') {
                    alert('Isi email dulu bos!');
                    $('#emailInput').focus();
                    return;
                }

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
                status.text('Mengirim kode...').css('color', '#3CB9E0'); 

                $.ajax({
                    url: "{{ route('send.otp.ajax') }}",
                    type: "POST",
                    data: { email: email },
                    success: function(response) {
                        if(response.status == 'success') {
                            alert('Kode OTP 4 Digit Terkirim!');
                            status.html('<span class="text-success"><i class="fas fa-check"></i> Cek Email Anda.</span>');
                            btn.html('Terkirim').removeClass('btn-otp').addClass('btn-secondary');
                        } else {
                            alert(response.message);
                            status.text(response.message).css('color', 'red');
                            btn.prop('disabled', false).text('Kirim Ulang');
                        }
                    },
                    error: function() {
                        alert('Gagal koneksi.');
                        status.text('Gagal mengirim.').css('color', 'red');
                        btn.prop('disabled', false).text('Kirim Ulang');
                    }
                });
            });
        });
    </script>

    <script>
        const video = document.getElementById('video-webcam');
        const captureBtn = document.getElementById('btn-capture-face');
        const statusText = document.getElementById('biometric-status');
        const faceDescriptorInput = document.getElementById('face_descriptor');
        const canvas = document.getElementById('overlay-canvas');

        // URL ke folder model yang harus Anda siapkan di public/models
        const MODEL_URL = '/models'; 

        let latestDetection = null;
        let isCaptured = false;
        let scanInterval = null;
        let detectionStarted = false;

        // Load Model secara async (SSD Mobilenet, 68 Landmarks, Face Recognition)
        Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
            faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
            faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
        ]).then(startVideo).catch(err => {
            console.error("Gagal load model. Pastikan folder public/models berisi file model face-api.", err);
            statusText.innerText = "Error memuat sistem kamera.";
        });

        function startVideo() {
            // Bind events ke video terlebih dahulu untuk menghindari race condition
            video.addEventListener('play', startDetection);
            video.addEventListener('playing', startDetection);

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    
                    // Backup pemicu jika event play/playing terlewat oleh browser
                    setTimeout(() => {
                        if (video.srcObject && !video.paused) {
                            startDetection();
                        }
                    }, 500);
                })
                .catch(err => {
                    console.error("Gagal akses kamera:", err);
                    statusText.innerText = "Kamera tidak diizinkan atau tidak ditemukan.";
                });
        }

        // Mulai pemindaian dan render landmarks secara real-time
        function startDetection() {
            if (detectionStarted) return;
            detectionStarted = true;

            const displaySize = { width: video.width || 320, height: video.height || 240 };
            faceapi.matchDimensions(canvas, displaySize);

            scanInterval = setInterval(async () => {
                if (isCaptured) return;

                const detection = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                if (detection) {
                    latestDetection = detection;
                    const resizedDetection = faceapi.resizeResults(detection, displaySize);
                    
                    // Gambar Kotak Deteksi & 68 Titik Karakteristik Wajah (Landmarks) secara real-time
                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { label: 'Wajah' });
                    drawBox.draw(canvas);
                    faceapi.draw.drawFaceLandmarks(canvas, resizedDetection);

                    if (faceDescriptorInput.value === "") {
                        statusText.innerText = "Wajah terdeteksi! Silakan klik 'Ambil Foto Wajah'.";
                        statusText.className = "mt-2 text-info font-weight-bold";
                    }
                } else {
                    latestDetection = null;
                    if (faceDescriptorInput.value === "") {
                        statusText.innerText = "Posisikan wajah Anda di depan kamera...";
                        statusText.className = "mt-2 text-danger font-weight-bold";
                    }
                }
            }, 150); // Scan setiap 150ms agar visualisasi real-time lancar
        }

        captureBtn.addEventListener('click', () => {
            if (!video.srcObject) {
                alert("Kamera belum siap atau tidak menyala.");
                return;
            }

            // Jika sedang dalam status ter-capture, tombol berfungsi untuk membatalkan/mengulang
            if (isCaptured) {
                isCaptured = false;
                faceDescriptorInput.value = "";
                statusText.innerText = "Posisikan wajah Anda di depan kamera...";
                statusText.className = "mt-2 text-danger font-weight-bold";
                captureBtn.innerHTML = '<i class="fas fa-camera"></i> Ambil Foto Wajah (Biometrik)';
                captureBtn.className = "btn btn-outline-info mt-3 font-weight-bold";
                return;
            }

            if (latestDetection) {
                isCaptured = true;
                const descriptor = latestDetection.descriptor;
                
                // Simpan descriptor wajah 128 dimensi sebagai string JSON
                faceDescriptorInput.value = JSON.stringify(Array.from(descriptor));
                
                statusText.innerText = "Wajah berhasil dipindai dan disimpan!";
                statusText.className = "mt-2 text-success font-weight-bold";

                // Gambarkan visual terakhir di canvas agar membeku (freeze) sebagai konfirmasi
                const displaySize = { width: video.width || 320, height: video.height || 240 };
                faceapi.matchDimensions(canvas, displaySize);
                const resizedDetection = faceapi.resizeResults(latestDetection, displaySize);
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { label: 'Wajah' });
                drawBox.draw(canvas);
                faceapi.draw.drawFaceLandmarks(canvas, resizedDetection);

                // Ubah tampilan tombol untuk opsi ambil ulang
                captureBtn.innerHTML = '<i class="fas fa-undo"></i> Ambil Ulang Foto Wajah';
                captureBtn.className = "btn btn-outline-warning mt-3 font-weight-bold";
            } else {
                alert("Wajah tidak terdeteksi! Mohon sejajarkan wajah Anda di depan kamera sebelum mengambil foto.");
            }
        });

        // Validasi form agar tidak submit jika data biometrik kosong
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            if (!faceDescriptorInput.value) {
                e.preventDefault();
                alert('Peringatan: Anda wajib melakukan Verifikasi Biometrik (Ambil Foto Wajah) sebelum mendaftar!');
                statusText.innerText = "WAJIB: Silakan ambil foto wajah terlebih dahulu!";
                statusText.className = "mt-2 text-danger font-weight-bold";
            }
        });
    </script>
</body>
</html>