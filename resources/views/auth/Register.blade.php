<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PT. MEDIA BALAI NUSA</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets_admin/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_admin/modules/fontawesome/css/all.min.css') }}">

    <style>
        /* BACKGROUND GRADIENT SEPERTI LOGIN */
        body {
            background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                        radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                        radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                        linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
            font-family: 'Roboto', sans-serif;
            box-sizing: border-box;
        }

        /* CARD REGISTER: UKURAN SEMULA 500PX & PADDING 40PX DENGAN AKSEN LOGIN */
        .card-register {
            background: #ffffff;
            border-radius: 15px; 
            padding: 40px;
            max-width: 500px;
            width: 100%;
            border: 1px solid rgba(226, 232, 240, 0.9);
            border-top: 4px solid #3ECCE9; /* Aksen Cyan Logo */
            box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.12), 0 0 25px rgba(62, 204, 233, 0.12);
        }

        /* HEADER */
        .register-header h4 {
            color: #0f172a;
            font-weight: 800;
            letter-spacing: 0.5px;
        }

        /* FORM INPUT STANDAR: UKURAN SEMULA TINGGI 48PX */
        .form-group label {
            font-weight: 600;
            color: #334155;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 12px 15px;
            height: 48px; 
            font-size: 0.95rem;
            background: #f8fafc;
            color: #1e293b;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: #0284c7;
            box-shadow: 0 0 0 0.2rem rgba(62, 204, 233, 0.28);
        }

        /* TOGGLE PASSWORD */
        .password-field-wrapper {
            position: relative;
        }
        .password-field-wrapper input {
            padding-right: 40px !important;
        }
        .password-field-wrapper .btn-toggle-eye {
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #8fa0b5;
            background: transparent;
            border: none;
            padding: 4px;
            font-size: 14px;
            line-height: 1;
            z-index: 5;
            transition: color 0.2s;
        }
        .password-field-wrapper .btn-toggle-eye:hover {
            color: #0284c7;
        }

        /* TOMBOL KIRIM OTP (WARNA LOGIN) */
        .btn-otp {
            background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%); 
            color: white;
            font-weight: 700;
            border: none;
            border-radius: 0 8px 8px 0 !important; 
            padding: 0 20px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        .btn-otp:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%); 
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
            color: #0284c7;
            background-color: #f0f9ff; 
            border: 1.5px dashed #0284c7;
        }
        
        .otp-input-style:focus {
            background-color: #fff;
            border-color: #0284c7;
        }

        /* TOMBOL DAFTAR (WARNA GRADASI LOGIN) */
        .btn-register {
            background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
            border: none;
            color: white;
            font-weight: 700;
            padding: 12px;
            border-radius: 50px;
            width: 100%;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
            transition: all 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.95rem;
            margin-top: 20px;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.4);
            color: white;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .login-footer a {
            color: #0284c7;
            font-weight: 700;
            text-decoration: none;
        }
        .login-footer a:hover {
            color: #0369a1;
            text-decoration: underline;
        }
        
        textarea.form-control {
            height: 100px !important;
            resize: none;
        }

        .section-title {
            color: #0284c7;
            font-weight: bold;
            border-bottom: 2px solid #3ECCE9;
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
             <div class="company-name" style="font-size: 13.5px; font-weight: 700; color: #0f172a; margin-top: 6px; margin-bottom: 2px;">PT. MEDIA BALAI NUSA <span style="color: #0284c7; font-weight: 600;">astro net</span></div>
             <h4 class="mt-2">Form Registrasi Akun Siswa</h4>
             <p class="text-muted small">Silakan lengkapi data diri Anda dan verifikasi wajah</p>
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center">
                <strong>Berhasil!</strong> {{ session('success') }} <br>
                <a href="{{ route('login') }}" class="btn btn-sm btn-primary mt-2" style="background: #0284c7; border: none;">Login Sekarang</a>
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
                    <i class="fas fa-info-circle text-info"></i> Klik <b>Kirim OTP</b> untuk menerima kode verifikasi di Gmail Anda (periksa juga folder Spam).
                </small>
            </div>

            <div class="form-group">
                <label>Kode Verifikasi (OTP)</label>
                <input type="number" name="otp_input" class="form-control otp-input-style" placeholder="0000" maxlength="4" required>
            </div>

            <div class="row">
                <div class="col-6">
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
                <div class="col-6">
                    <div class="form-group mb-1">
                        <label>Konfirmasi Password</label>
                        <div class="password-field-wrapper">
                            <input type="password" name="password_confirmation" id="reg_password_confirmation" class="form-control" placeholder="Ulangi" required>
                            <button type="button" class="btn-toggle-eye" onclick="toggleRegPassword('reg_password_confirmation', this)" title="Tampilkan Konfirmasi Password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <small class="text-muted d-block mb-3" style="font-size: 11px;">
                <i class="fas fa-info-circle text-info"></i> Minimal 8 karakter, wajib kombinasi huruf dan angka.
            </small>

            <div class="form-group">
                <label>Nomor HP Siswa</label>
                <input type="number" name="no_hp_siswa" class="form-control" placeholder="08xxxxxxxxxx" value="{{ old('no_hp_siswa') }}" required>
            </div>

            <h5 class="section-title">Verifikasi Biometrik</h5>

            <div class="form-group text-center">
                {{-- KAMERA UKURAN BESAR ASLI --}}
                <div style="position: relative; display: inline-block; width: 100%; max-width: 380px; background: #e9ecef; border-radius: 8px; overflow: hidden; border: 2px solid #0284c7; box-shadow: 0 4px 10px rgba(0,0,0,0.08);">
                    <video id="video-webcam" style="width: 100%; height: auto; display: block;" autoplay muted playsinline></video>
                    <canvas id="overlay-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10; pointer-events: none;"></canvas>
                </div>

                {{-- Status Bar 68 Landmark & Pose Menghadap Depan --}}
                <div style="display: flex; justify-content: space-between; align-items: center; max-width: 380px; margin: 8px auto 0; padding: 6px 12px; background: #f8fafc; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 11.5px;">
                    <span id="landmark-badge" style="background: #e2e8f0; color: #475569; padding: 3px 8px; border-radius: 12px; font-weight: 700;">
                        <i class="fas fa-dot-circle"></i> Landmark: <span id="landmark-count-text">--/68 Titik</span>
                    </span>
                    <span id="pose-badge" style="background: #e2e8f0; color: #475569; padding: 3px 8px; border-radius: 12px; font-weight: 700;">
                        <i class="fas fa-user"></i> Pose: Menunggu...
                    </span>
                </div>
                
                <p id="biometric-status" class="mt-2 text-danger font-weight-bold" style="font-size: 12px; line-height: 1.4;">
                    Posisikan wajah Anda tepat di depan kamera menghadap lurus...
                </p>

                <button type="button" class="btn btn-outline-info mt-1 font-weight-bold" id="btn-capture-face" style="border-color: #0284c7; color: #0284c7;">
                    <i class="fas fa-camera"></i> Ambil Foto Wajah (Biometrik)
                </button>

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
                                    btn.prop('disabled', false).removeClass('btn-secondary').addClass('btn-otp').text('Kirim Ulang');
                                }
                            }, 1000);
                        } else {
                            status.html('<span class="text-danger font-weight-bold"><i class="fas fa-exclamation-circle"></i> ' + response.message + '</span>');
                            btn.prop('disabled', false).html('Kirim OTP');
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

        // 2. Muat Model AI (SSD Mobilenet, 68 Landmarks, Face Recognition) & Nyalakan Kamera
        async function initBiometricCamera() {
            if (!window.isSecureContext || !navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                statusText.innerText = "Kamera diblokir browser karena tidak memakai HTTPS. Gunakan https:// atau localhost.";
                return;
            }

            try {
                await Promise.all([
                    faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
                    faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                    faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
                ]);
            } catch (err) {
                console.error("Gagal load model face-api:", err);
                statusText.innerText = "Error memuat sistem AI biometrik. Pastikan folder public/models tersedia.";
                return;
            }

            await startVideo();
        }

        async function startVideo() {
            video.addEventListener('loadedmetadata', startDetection);
            video.addEventListener('play', startDetection);
            video.addEventListener('playing', startDetection);

            try {
                let stream;
                try {
                    stream = await navigator.mediaDevices.getUserMedia({
                        video: { facingMode: { ideal: 'user' } },
                        audio: false
                    });
                } catch (constraintErr) {
                    if (constraintErr.name === 'OverconstrainedError' || constraintErr.name === 'ConstraintNotSatisfiedError') {
                        stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                    } else {
                        throw constraintErr;
                    }
                }

                video.srcObject = stream;
                await video.play().catch(() => {});

                setTimeout(() => {
                    if (video.srcObject && !video.paused && video.videoWidth > 0) {
                        startDetection();
                    }
                }, 500);
            } catch (err) {
                console.error("Gagal akses kamera:", err);
                let errorMessage = "Kamera gagal dimuat. Refresh halaman.";
                if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                    errorMessage = "Izin kamera ditolak. Izinkan akses kamera di pengaturan browser lalu refresh.";
                } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                    errorMessage = "Kamera tidak ditemukan pada perangkat ini.";
                } else if (err.name === 'NotReadableError' || err.name === 'TrackStartError') {
                    errorMessage = "Kamera sedang digunakan aplikasi lain. Tutup aplikasi lain lalu refresh.";
                }
                statusText.innerText = errorMessage;
            }
        }

        initBiometricCamera();

        // 3. Pelacakan Real-Time (68 Landmark & Pose Menghadap Depan)
        function startDetection() {
            if (detectionStarted || !video.videoWidth || !video.videoHeight) return;
            detectionStarted = true;

            const displaySize = { width: video.videoWidth, height: video.videoHeight };
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
                            captureBtn.className = "btn btn-info mt-1 font-weight-bold shadow-sm";
                            captureBtn.style.background = "#0284c7";
                            captureBtn.style.borderColor = "#0284c7";
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
                            captureBtn.className = "btn btn-outline-secondary mt-1 font-weight-bold";
                            captureBtn.style.background = "transparent";
                            captureBtn.style.borderColor = "#6c757d";
                            captureBtn.style.color = "#6c757d";
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
                        captureBtn.className = "btn btn-outline-info mt-1 font-weight-bold";
                        captureBtn.style.background = "transparent";
                        captureBtn.style.borderColor = "#0284c7";
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
                captureBtn.innerHTML = '<i class="fas fa-camera"></i> Ambil Foto Wajah (Biometrik)';
                captureBtn.className = "btn btn-outline-info mt-1 font-weight-bold";
                captureBtn.style.background = "transparent";
                captureBtn.style.borderColor = "#0284c7";
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
            captureBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengekstrak 68 Landmark...';

            try {
                const fullDetection = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();

                if (fullDetection && fullDetection.descriptor) {
                    isCaptured = true;
                    faceDescriptorInput.value = JSON.stringify(Array.from(fullDetection.descriptor));

                    statusText.innerHTML = '<span class="text-success font-weight-bold"><i class="fas fa-check-double"></i> Wajah Berhasil Diverifikasi & Disimpan (68 Titik Frontal)!</span>';

                    const displaySize = { width: video.videoWidth || 320, height: video.videoHeight || 240 };
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
                    captureBtn.innerHTML = '<i class="fas fa-undo"></i> Ambil Ulang Foto Wajah';
                    captureBtn.className = "btn btn-outline-warning mt-1 font-weight-bold";
                    captureBtn.style.background = "#fef3c7";
                    captureBtn.style.borderColor = "#f59e0b";
                    captureBtn.style.color = "#b45309";
                } else {
                    captureBtn.disabled = false;
                    captureBtn.innerHTML = '<i class="fas fa-camera"></i> Ambil Foto Wajah (Biometrik)';
                    alert("Gagal membaca deskriptor wajah. Silakan coba kembali menghadap kamera.");
                }
            } catch (err) {
                console.error("Gagal ekstrak descriptor:", err);
                captureBtn.disabled = false;
                captureBtn.innerHTML = '<i class="fas fa-camera"></i> Ambil Foto Wajah (Biometrik)';
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
