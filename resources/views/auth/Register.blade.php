<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Siswa - PT. MEDIA BALAI NUSA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets_admin/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Ambient Light Tech: Presisi & Harmonis dengan Warna Login & Logo ANMS */
        body {
            font-family: 'Roboto', sans-serif;
            background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                        radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                        radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                        linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%);
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
            box-sizing: border-box;
        }

        /* Card Register: 2 Kolom Kompak, Tidak Panjang ke Bawah */
        .card-register {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-top: 4px solid #3ECCE9; /* Garis aksen Cyan Logo */
            border-radius: 16px;
            padding: 26px 30px;
            max-width: 880px;
            width: 100%;
            box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.12), 0 0 25px rgba(62, 204, 233, 0.12);
            position: relative;
        }

        /* Header Form */
        .register-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .register-header img {
            width: 72px;
            height: auto;
            margin-bottom: 6px;
            filter: drop-shadow(0 4px 10px rgba(62, 204, 233, 0.25));
        }
        .company-name {
            font-size: 13px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: 0.3px;
            margin-bottom: 2px;
        }
        .company-name span {
            color: #0284c7;
            font-weight: 600;
        }
        .register-header h2 {
            color: #0f172a;
            font-weight: 800;
            font-size: 20px;
            margin-bottom: 2px;
            letter-spacing: -0.3px;
        }
        .register-header p {
            color: #64748b;
            font-size: 12px;
            margin-bottom: 0;
        }

        /* Sub-Judul Kolom */
        .column-title {
            color: #0f172a;
            font-weight: 700;
            font-size: 13.5px;
            margin-bottom: 14px;
            padding-bottom: 6px;
            border-bottom: 2px solid #e0f2fe;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .column-title i {
            color: #0284c7;
        }

        /* Form Control */
        .form-group {
            margin-bottom: 12px;
        }
        .form-group label {
            font-weight: 600;
            color: #334155;
            font-size: 11.5px;
            margin-bottom: 4px;
            display: block;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 8px 12px;
            height: 40px;
            font-size: 12.5px;
            background: #f8fafc;
            color: #1e293b;
            transition: all 0.2s ease;
        }
        .form-control:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(62, 204, 233, 0.28);
            outline: none;
        }

        /* Input OTP Style */
        .btn-otp {
            background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 0 8px 8px 0 !important;
            padding: 0 14px;
            font-size: 12px;
            transition: all 0.2s;
        }
        .btn-otp:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            color: #ffffff;
        }
        .otp-input-style {
            text-align: center;
            letter-spacing: 12px;
            font-weight: 800;
            font-size: 1.25rem;
            color: #0284c7;
            background: #f0f9ff;
            border: 1.5px dashed #0284c7;
            height: 42px;
        }

        /* Toggle Password */
        .password-field-wrapper {
            position: relative;
        }
        .password-field-wrapper input {
            padding-right: 36px !important;
        }
        .password-field-wrapper .btn-toggle-eye {
            position: absolute;
            top: 50%;
            right: 8px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8fa0b5;
            background: transparent;
            border: none;
            padding: 4px;
            font-size: 13px;
            line-height: 1;
            z-index: 5;
            transition: color 0.2s;
        }
        .password-field-wrapper .btn-toggle-eye:hover {
            color: #0284c7;
        }

        /* Area Kamera Biometrik */
        .camera-box-wrapper {
            position: relative;
            width: 100%;
            border-radius: 10px;
            overflow: hidden;
            border: 2px solid #0284c7;
            background: #0f172a;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.18);
        }
        #video-webcam {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        #overlay-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 10;
            pointer-events: none;
        }

        /* Status Badge */
        .biometric-badges {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 8px;
            padding: 5px 10px;
            background: #f8fafc;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            font-size: 11px;
        }

        /* Button Biometrik */
        .btn-capture {
            background: #f0f9ff;
            border: 1.5px solid #0284c7;
            color: #0284c7;
            font-weight: 700;
            border-radius: 8px;
            font-size: 12px;
            padding: 8px 16px;
            width: 100%;
            transition: all 0.2s;
            cursor: pointer;
            margin-top: 8px;
        }
        .btn-capture:hover {
            background: #0284c7;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(2, 132, 199, 0.25);
        }

        /* Tombol Submit Utama */
        .btn-register-submit {
            background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
            border: none;
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 9px;
            width: 100%;
            box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
            transition: all 0.3s ease;
            font-size: 13.5px;
            letter-spacing: 0.3px;
            cursor: pointer;
            margin-top: 15px;
        }
        .btn-register-submit:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(2, 132, 199, 0.4);
        }

        /* Footer Link */
        .login-footer {
            text-align: center;
            margin-top: 14px;
            font-size: 12px;
            color: #64748b;
        }
        .login-footer a {
            color: #0284c7;
            font-weight: 700;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
            color: #0369a1;
        }

        /* Responsif Mobile (<768px) */
        @media (max-width: 767px) {
            .card-register {
                padding: 20px 18px;
            }
            #video-webcam {
                height: 190px;
            }
            .col-biometric {
                margin-top: 15px;
            }
        }
    </style>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>
</head>

<body>
    
    <div class="card-register">
        <div class="register-header">
             <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="logo">
             <div class="company-name">PT. MEDIA BALAI NUSA <span>astro net</span></div>
             <h2>Form Registrasi Akun Siswa</h2>
             <p>Silakan lengkapi data diri Anda dan verifikasi biometrik wajah</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center py-3" style="border-radius: 8px; font-size: 13px;">
                <i class="fas fa-check-circle mr-1"></i> <strong>Pendaftaran Berhasil!</strong> {{ session('success') }} <br>
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary mt-2 font-weight-bold" style="background: #0284c7; border: none; padding: 6px 16px;">Login Sekarang</a>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger py-2" style="border-radius: 8px; font-size: 12px;">
                <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger py-2" style="border-radius: 8px; font-size: 12px;">
                <ul class="mb-0 pl-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (!session('success'))
        <form method="POST" action="{{ route('register.store') }}" id="registerForm">
            @csrf

            <div class="row align-items-start">
                {{-- KOLOM KIRI: DATA AKUN --}}
                <div class="col-md-6 pr-md-3">
                    <div class="column-title">
                        <i class="fas fa-id-card"></i> 1. Informasi Data Akun
                    </div>

                    <div class="form-group">
                        <label>Nama Lengkap Siswa</label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap sesuai data sekolah" value="{{ old('nama_lengkap') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email Siswa</label>
                        <div class="input-group">
                            <input type="email" name="email" id="emailInput" class="form-control" placeholder="contoh@gmail.com" value="{{ old('email') }}" required style="border-radius: 8px 0 0 8px;">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-otp" id="btnKirimOtp">
                                    <i class="fas fa-paper-plane mr-1"></i> Kirim OTP
                                </button>
                            </div>
                        </div>
                        <small class="text-muted d-block mt-1" id="otpStatus" style="font-size: 11px; line-height: 1.3;">
                            <i class="fas fa-info-circle text-info"></i> Kode OTP akan dikirim ke Gmail Anda.
                        </small>
                    </div>

                    <div class="form-group">
                        <label>Kode Verifikasi (OTP)</label>
                        <input type="number" name="otp_input" class="form-control otp-input-style" placeholder="0 0 0 0" maxlength="4" required>
                    </div>

                    <div class="row">
                        <div class="col-6 pr-1">
                            <div class="form-group mb-1">
                                <label>Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" name="password" id="reg_password" class="form-control" placeholder="Min 8 karakter" required>
                                    <button type="button" class="btn-toggle-eye" onclick="toggleRegPassword('reg_password', this)" title="Tampilkan Password">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 pl-1">
                            <div class="form-group mb-1">
                                <label>Ulangi Password</label>
                                <div class="password-field-wrapper">
                                    <input type="password" name="password_confirmation" id="reg_password_confirmation" class="form-control" placeholder="Konfirmasi" required>
                                    <button type="button" class="btn-toggle-eye" onclick="toggleRegPassword('reg_password_confirmation', this)" title="Tampilkan Konfirmasi">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <small class="text-muted d-block mb-2" style="font-size: 10.5px;">
                        <i class="fas fa-shield-alt text-info"></i> Minimal 8 karakter kombinasi huruf dan angka.
                    </small>

                    <div class="form-group mb-0">
                        <label>Nomor HP / WhatsApp Siswa</label>
                        <input type="number" name="no_hp_siswa" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_siswa') }}" required>
                    </div>
                </div>

                {{-- KOLOM KANAN: VERIFIKASI BIOMETRIK --}}
                <div class="col-md-6 pl-md-3 col-biometric">
                    <div class="column-title">
                        <i class="fas fa-camera"></i> 2. Verifikasi Biometrik Wajah
                    </div>

                    <div class="camera-box-wrapper">
                        <video id="video-webcam" autoplay muted playsinline></video>
                        <canvas id="overlay-canvas"></canvas>
                    </div>

                    {{-- Status Bar 68 Landmark & Pose Menghadap Depan --}}
                    <div class="biometric-badges">
                        <span id="landmark-badge" style="background: #e2e8f0; color: #475569; padding: 2px 7px; border-radius: 10px; font-weight: 700;">
                            <i class="fas fa-dot-circle"></i> Landmark: <span id="landmark-count-text">--/68 Titik</span>
                        </span>
                        <span id="pose-badge" style="background: #e2e8f0; color: #475569; padding: 2px 7px; border-radius: 10px; font-weight: 700;">
                            <i class="fas fa-user"></i> Pose: Menunggu...
                        </span>
                    </div>
                    
                    <p id="biometric-status" class="mt-2 text-danger font-weight-bold text-center" style="font-size: 11.5px; line-height: 1.3; min-height: 30px;">
                        Posisikan wajah Anda tepat di depan kamera menghadap lurus...
                    </p>

                    <button type="button" class="btn-capture font-weight-bold" id="btn-capture-face">
                        <i class="fas fa-camera mr-1"></i> Ambil Foto Wajah (Biometrik)
                    </button>

                    <input type="hidden" name="face_descriptor" id="face_descriptor">
                </div>
            </div>

            {{-- TOMBOL DAFTAR FULL WIDTH --}}
            <button type="submit" class="btn-register-submit">
                <i class="fas fa-user-plus mr-1"></i> Daftar Akun Sekarang
            </button>

            <div class="login-footer">
                Sudah punya akun? <a href="{{ url('login') }}">Login di sini</a> | <a href="{{ url('/') }}">Beranda</a>
            </div>

        </form>
        @endif
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            var countdownTimer = null;

            $('#btnKirimOtp').click(function() {
                var emailInput = $('#emailInput');
                var email = $.trim(emailInput.val()).toLowerCase();
                emailInput.val(email);

                var btn = $(this);
                var status = $('#otpStatus');

                if (!email) {
                    alert('Harap masukkan alamat email Anda terlebih dahulu!');
                    emailInput.focus();
                    return;
                }

                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    alert('Format email tidak valid. Masukkan email yang benar.');
                    emailInput.focus();
                    return;
                }

                btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Mengirim...');
                status.html('<span style="color: #0284c7;"><i class="fas fa-spinner fa-spin"></i> Menghubungkan ke server email...</span>'); 

                $.ajax({
                    url: "{{ route('send.otp.ajax') }}",
                    type: "POST",
                    data: { email: email },
                    timeout: 25000,
                    success: function(response) {
                        if (response.status === 'success') {
                            var msgHtml = '<span class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> ' + response.message + '</span>';
                            status.html(msgHtml);

                            $('input[name="otp_input"]').val('').focus();

                            var remaining = 60;
                            btn.prop('disabled', true).removeClass('btn-otp').addClass('btn-secondary');
                            btn.text('Terkirim (' + remaining + 's)');

                            clearInterval(countdownTimer);
                            countdownTimer = setInterval(function() {
                                remaining--;
                                if (remaining > 0) {
                                    btn.text('Kirim Ulang (' + remaining + 's)');
                                } else {
                                    clearInterval(countdownTimer);
                                    btn.prop('disabled', false).removeClass('btn-secondary').addClass('btn-otp').html('<i class="fas fa-paper-plane mr-1"></i> Kirim Ulang');
                                }
                            }, 1000);
                        } else {
                            status.html('<span class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> ' + response.message + '</span>');
                            btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Kirim OTP');
                        }
                    },
                    error: function(xhr, statusText, errorThrown) {
                        var errDetail = 'Gagal mengirim email OTP.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errDetail = xhr.responseJSON.message;
                        } else if (statusText === 'timeout') {
                            errDetail = 'Koneksi ke server email timeout. Coba periksa koneksi internet Anda.';
                        }
                        status.html('<span class="text-danger font-weight-bold"><i class="fas fa-exclamation-triangle"></i> ' + errDetail + '</span>');
                        btn.prop('disabled', false).html('<i class="fas fa-paper-plane mr-1"></i> Kirim Ulang');
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
        const landmarkBadge = document.getElementById('landmark-badge');
        const landmarkCountText = document.getElementById('landmark-count-text');
        const poseBadge = document.getElementById('pose-badge');

        const MODEL_URL = '/models'; 

        let latestDetection = null;
        let isCaptured = false;
        let scanInterval = null;
        let detectionStarted = false;

        // 1. Evaluasi Pose Frontal & Kelengkapan 68 Titik Landmark
        function evaluateFrontalPose(landmarks) {
            const pts = landmarks ? landmarks.positions : null;
            if (!pts || pts.length !== 68) {
                return {
                    isValid: false,
                    count: pts ? pts.length : 0,
                    reason: "Titik landmark tidak lengkap (Harus persis 68 titik)"
                };
            }

            const p0  = pts[0];  // Ujung kiri garis rahang (cheek/jaw left)
            const p16 = pts[16]; // Ujung kanan garis rahang (cheek/jaw right)
            const p8  = pts[8];  // Ujung dagu (chin)
            const p27 = pts[27]; // Pangkal hidung (nose bridge)
            const p30 = pts[30]; // Ujung hidung (nose tip)
            const p36 = pts[36]; // Sudut luar mata kiri
            const p45 = pts[45]; // Sudut luar mata kanan
            const p39 = pts[39]; // Sudut dalam mata kiri
            const p42 = pts[42]; // Sudut dalam mata kanan

            // Uji A: Roll (Kemiringan kepala ke kiri/kanan berdasarkan garis mata)
            const dy = p45.y - p36.y;
            const dx = p45.x - p36.x;
            const rollAngle = Math.abs(Math.atan2(dy, dx) * (180 / Math.PI));
            if (rollAngle > 8.0) {
                return {
                    isValid: false,
                    count: 68,
                    reason: "Kepala miring! Harap tegakkan posisi kepala Anda."
                };
            }

            // Uji B: Yaw (Menoleh ke kiri/kanan - Simetri hidung terhadap batas rahang)
            const dLeftJaw  = p30.x - p0.x;
            const dRightJaw = p16.x - p30.x;
            if (dLeftJaw <= 0 || dRightJaw <= 0) {
                return {
                    isValid: false,
                    count: 68,
                    reason: "Wajah menoleh! Harap hadap lurus ke kamera."
                };
            }

            const yawRatio = dLeftJaw / dRightJaw;
            if (yawRatio < 0.68) {
                return {
                    isValid: false,
                    count: 68,
                    reason: "Wajah menoleh ke kiri! Harap hadap lurus ke depan."
                };
            }
            if (yawRatio > 1.47) {
                return {
                    isValid: false,
                    count: 68,
                    reason: "Wajah menoleh ke kanan! Harap hadap lurus ke depan."
                };
            }

            // Uji B2: Simetri hidung terhadap jarak kedua mata
            const eyeDist = p42.x - p39.x;
            if (eyeDist > 5) {
                const eyeCenter = (p39.x + p42.x) / 2;
                const noseOffset = Math.abs(p30.x - eyeCenter) / eyeDist;
                if (noseOffset > 0.35) {
                    return {
                        isValid: false,
                        count: 68,
                        reason: "Wajah belum simetris! Harap menghadap lurus ke depan."
                    };
                }
            }

            // Uji C: Pitch (Menunduk atau Mendongak)
            const vNose = p30.y - p27.y;
            const vChin = p8.y - p30.y;
            if (vNose > 0 && vChin > 0) {
                const pitchRatio = vChin / vNose;
                if (pitchRatio < 0.95) {
                    return {
                        isValid: false,
                        count: 68,
                        reason: "Wajah mendongak ke atas! Pandang lurus ke kamera."
                    };
                }
                if (pitchRatio > 2.70) {
                    return {
                        isValid: false,
                        count: 68,
                        reason: "Wajah menunduk! Angkat kepala dan pandang lurus."
                    };
                }
            }

            return {
                isValid: true,
                count: 68,
                reason: "Posisi Sempurna (68 Titik Valid & Menghadap Depan)"
            };
        }

        // 2. Muat Model AI (SSD Mobilenet, 68 Landmarks, Face Recognition)
        Promise.all([
            faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
            faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
            faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
        ]).then(startVideo).catch(err => {
            console.error("Gagal load model face-api:", err);
            statusText.innerText = "Error memuat sistem AI biometrik. Pastikan folder public/models tersedia.";
        });

        function startVideo() {
            video.addEventListener('play', startDetection);
            video.addEventListener('playing', startDetection);

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
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

        // 3. Pelacakan Real-Time (68 Landmark & Pose Menghadap Depan)
        function startDetection() {
            if (detectionStarted) return;
            detectionStarted = true;

            const displaySize = { width: video.videoWidth || 320, height: video.videoHeight || 200 };
            faceapi.matchDimensions(canvas, displaySize);

            scanInterval = setInterval(async () => {
                if (isCaptured) return;

                const detection = await faceapi.detectSingleFace(video).withFaceLandmarks();
                canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                if (detection) {
                    latestDetection = detection;
                    const resizedDetection = faceapi.resizeResults(detection, displaySize);
                    const landmarks = resizedDetection.landmarks;

                    const pose = evaluateFrontalPose(landmarks);

                    if (landmarkCountText) {
                        landmarkCountText.innerText = `${pose.count}/68 Titik`;
                    }
                    if (pose.count === 68) {
                        landmarkBadge.style.background = '#dcfce7';
                        landmarkBadge.style.color = '#15803d';
                        landmarkBadge.innerHTML = '<i class="fas fa-check-circle"></i> 68 Titik Lengkap';
                    } else {
                        landmarkBadge.style.background = '#fee2e2';
                        landmarkBadge.style.color = '#b91c1c';
                        landmarkBadge.innerHTML = `<i class="fas fa-times-circle"></i> ${pose.count}/68 Titik`;
                    }

                    faceapi.draw.drawFaceLandmarks(canvas, resizedDetection);

                    if (pose.isValid) {
                        poseBadge.style.background = '#dcfce7';
                        poseBadge.style.color = '#15803d';
                        poseBadge.innerHTML = '<i class="fas fa-check-circle"></i> Menghadap Depan (OK)';

                        const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                            label: '68 Titik: Menghadap Depan (OK)', 
                            boxColor: '#22c55e' 
                        });
                        drawBox.draw(canvas);

                        if (!faceDescriptorInput.value) {
                            statusText.innerHTML = '<span class="text-success font-weight-bold"><i class="fas fa-check-circle"></i> ' + pose.reason + '. Silakan klik <b>Ambil Foto Wajah</b>!</span>';
                            captureBtn.className = "btn-capture font-weight-bold shadow-sm";
                            captureBtn.style.background = "#0284c7";
                            captureBtn.style.color = "#ffffff";
                        }
                    } else {
                        poseBadge.style.background = '#fef3c7';
                        poseBadge.style.color = '#b45309';
                        poseBadge.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Posisi Belum Pas';

                        const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                            label: pose.reason, 
                            boxColor: '#f59e0b' 
                        });
                        drawBox.draw(canvas);

                        if (!faceDescriptorInput.value) {
                            statusText.innerHTML = '<span class="text-warning font-weight-bold"><i class="fas fa-exclamation-triangle"></i> ' + pose.reason + '</span>';
                            captureBtn.className = "btn-capture font-weight-bold";
                            captureBtn.style.background = "#f0f9ff";
                            captureBtn.style.color = "#0284c7";
                        }
                    }
                } else {
                    latestDetection = null;
                    if (landmarkBadge) {
                        landmarkBadge.style.background = '#e2e8f0';
                        landmarkBadge.style.color = '#475569';
                        landmarkBadge.innerHTML = '<i class="fas fa-dot-circle"></i> Landmark: --/68 Titik';
                    }
                    if (poseBadge) {
                        poseBadge.style.background = '#e2e8f0';
                        poseBadge.style.color = '#475569';
                        poseBadge.innerHTML = '<i class="fas fa-user"></i> Pose: Menunggu...';
                    }
                    if (!faceDescriptorInput.value) {
                        statusText.innerHTML = '<span class="text-danger font-weight-bold"><i class="fas fa-user-times"></i> Posisikan wajah Anda tepat di depan kamera menghadap lurus...</span>';
                        captureBtn.className = "btn-capture font-weight-bold";
                        captureBtn.style.background = "#f0f9ff";
                        captureBtn.style.color = "#0284c7";
                    }
                }
            }, 120);
        }

        // 4. Tombol Ambil Foto Wajah (Wajib 68 Landmark & Menghadap Depan)
        captureBtn.addEventListener('click', async () => {
            if (!video.srcObject) {
                alert("Kamera belum siap atau tidak menyala.");
                return;
            }

            if (isCaptured) {
                isCaptured = false;
                faceDescriptorInput.value = "";
                statusText.innerHTML = '<span class="text-info font-weight-bold">Posisikan wajah Anda tepat di depan kamera menghadap lurus...</span>';
                captureBtn.innerHTML = '<i class="fas fa-camera mr-1"></i> Ambil Foto Wajah (Biometrik)';
                captureBtn.style.background = "#f0f9ff";
                captureBtn.style.color = "#0284c7";
                return;
            }

            if (!latestDetection) {
                alert("Wajah tidak terdeteksi! Mohon posisikan wajah Anda tepat di depan kamera.");
                return;
            }

            const pose = evaluateFrontalPose(latestDetection.landmarks);
            if (!pose.isValid) {
                alert("Foto Wajah Belum Memenuhi Syarat Biometrik:\n\n" + pose.reason + "\n\nSesuai standar biometrik sistem, wajah wajib terdeteksi persis 68 titik landmark dan menghadap lurus ke depan.");
                return;
            }

            captureBtn.disabled = true;
            captureBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Mengekstrak 68 Landmark...';

            try {
                const fullDetection = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();

                if (fullDetection && fullDetection.descriptor) {
                    isCaptured = true;
                    faceDescriptorInput.value = JSON.stringify(Array.from(fullDetection.descriptor));

                    statusText.innerHTML = '<span class="text-success font-weight-bold"><i class="fas fa-check-double mr-1"></i> Wajah Berhasil Diverifikasi (68 Titik Frontal)!</span>';

                    const displaySize = { width: video.videoWidth || 320, height: video.videoHeight || 200 };
                    faceapi.matchDimensions(canvas, displaySize);
                    const resizedDetection = faceapi.resizeResults(fullDetection, displaySize);
                    canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                    
                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                        label: 'Biometrik Terverifikasi (68 Titik Frontal)',
                        boxColor: '#22c55e'
                    });
                    drawBox.draw(canvas);
                    faceapi.draw.drawFaceLandmarks(canvas, resizedDetection);

                    captureBtn.disabled = false;
                    captureBtn.innerHTML = '<i class="fas fa-undo mr-1"></i> Ambil Ulang Foto Wajah';
                    captureBtn.style.background = "#fef3c7";
                    captureBtn.style.color = "#b45309";
                    captureBtn.style.borderColor = "#f59e0b";
                } else {
                    captureBtn.disabled = false;
                    captureBtn.innerHTML = '<i class="fas fa-camera mr-1"></i> Ambil Foto Wajah (Biometrik)';
                    alert("Gagal membaca deskriptor wajah. Silakan coba kembali menghadap kamera.");
                }
            } catch (err) {
                console.error("Gagal ekstrak descriptor:", err);
                captureBtn.disabled = false;
                captureBtn.innerHTML = '<i class="fas fa-camera mr-1"></i> Ambil Foto Wajah (Biometrik)';
                alert("Terjadi kesalahan saat mengekstrak fitur wajah.");
            }
        });

        // 5. Validasi Submit Formulir Registrasi
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            if (!faceDescriptorInput.value) {
                e.preventDefault();
                alert('Peringatan: Anda WAJIB melakukan Verifikasi Biometrik (Ambil Foto Wajah 68 Titik Menghadap Depan) sebelum mendaftar!');
                statusText.innerHTML = '<span class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> WAJIB: Ambil foto wajah 68 titik menghadap depan terlebih dahulu!</span>';
                document.getElementById('video-webcam').scrollIntoView({ behavior: 'smooth' });
                return false;
            }

            const otpVal = $('input[name="otp_input"]').val();
            if (!otpVal || otpVal.length < 4) {
                e.preventDefault();
                alert('Peringatan: Harap masukkan 4 digit Kode OTP verifikasi email Anda!');
                $('input[name="otp_input"]').focus();
                return false;
            }
        });

        // Toggle Show/Hide Password Register
        function toggleRegPassword(inputId, btn) {
            const input = document.getElementById(inputId);
            const icon = btn.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
                btn.style.color = '#0284c7';
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
