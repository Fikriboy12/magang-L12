<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Login-PT. MEDIA BALAI NUSA</title>

<link rel="icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('gambar/AMS-logo.png') }}" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/face-api.js@0.22.2/dist/face-api.min.js"></script>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        /* --- BERUBAH: Background gradient menggunakan warna biru cerah dari logo --- */
        background: linear-gradient(135deg, #4AC1E0, #3CB9E0);
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px; 
        box-sizing: border-box;
    }

    /* Card Login diperkecil lagi */
    .login-card {
        background: #fff;
        border-radius: 12px;
        padding: 25px 20px;
        
        /* --- PERUBAHAN: Lebar maksimal diperkecil menjadi 300px agar lebih mungil --- */
        width: 100%;        
        max-width: 300px;   
        
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
        text-align: center;
    }

    /* Logo juga disesuaikan ukurannya */
    .login-card img {
        width: 80px; /* Diperkecil sedikit agar proporsional dengan kotak baru */
        height: auto;
        margin-bottom: 15px;
    }

    .company-name {
        font-size: 13px; /* Font diperkecil sedikit */
        font-weight: 500;
        color: #3CB9E0; /* --- BERUBAH: Teks menggunakan warna biru cerah logo --- */
        margin-bottom: 12px;
    }

    .login-card h2 {
        margin-bottom: 18px;
        color: #3CB9E0; /* --- BERUBAH: Teks menggunakan warna biru cerah logo --- */
        font-weight: 700;
        font-size: 20px; /* Judul diperkecil sedikit */
    }

    /* Input */
    .input-group {
        position: relative;
        margin-bottom: 12px;
        max-width: 100%;
    }

    .input-group > i.input-icon-left,
    .input-group > i:first-child {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #3CB9E0; /* --- BERUBAH: Ikon menggunakan warna biru cerah logo --- */
        font-size: 13px;
        pointer-events: none;
    }

    .input-group input {
        width: 100%;
        padding: 9px 12px 9px 35px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .input-group input#password {
        padding-right: 38px;
    }

    .input-group input:focus {
        border-color: #3CB9E0; /* --- BERUBAH: Border focus menggunakan warna biru cerah logo --- */
        box-shadow: 0 0 6px rgba(74, 193, 224, 0.4); /* --- BERUBAH: Shadow focus menggunakan warna biru logo yang transparan --- */
    }

    /* Toggle Show/Hide Password */
    .toggle-password-btn {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #8fa0b5;
        font-size: 14px;
        padding: 5px;
        line-height: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s ease, transform 0.1s ease;
        z-index: 5;
        background: transparent;
        border: none;
        outline: none;
        user-select: none;
    }

    .toggle-password-btn:hover {
        color: #3CB9E0;
    }

    .toggle-password-btn:active {
        transform: translateY(-50%) scale(0.92);
    }

    .toggle-password-btn i {
        position: static !important;
        transform: none !important;
        font-size: 14px !important;
        color: inherit !important;
    }

    /* Button */
    .login-card button {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 8px;
        /* --- BERUBAH: Button gradient menggunakan warna biru cerah dari logo --- */
        background: linear-gradient(135deg, #4AC1E0, #3CB9E0);
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        margin-top: 10px;
        font-size: 13px;
        transition: 0.3s;
    }

    .login-card button:hover {
        /* --- BERUBAH: Hover button gradient menggunakan warna biru cerah dari logo --- */
        background: linear-gradient(135deg, #3CB9E0, #4AC1E0);
        transform: translateY(-2px);
    }

    /* --- TAMBAHAN: Style Button Login Biometrik --- */
    .btn-face {
        background: transparent !important;
        border: 2px solid #3CB9E0 !important;
        color: #3CB9E0 !important;
        margin-top: 8px !important;
    }
    .btn-face:hover {
        background: #3CB9E0 !important;
        color: #fff !important;
    }

    /* Links */
    .login-card .links {
        margin-top: 15px;
        font-size: 12px;
    }
    .login-card .links a {
        color: #3CB9E0; /* --- BERUBAH: Link menggunakan warna biru cerah logo --- */
        text-decoration: none;
        font-weight: 500;
    }

    /* Alert Style */
    .alert {
        padding: 8px;
        margin-bottom: 12px;
        border-radius: 6px;
        font-size: 11px;
        text-align: left;
    }
    .alert-danger {
        background: #ffe6e6;
        color: #cc0000;
        border: 1px solid #ffcccc;
    }
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
</style>
</head>
<body>

<div class="login-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT.MEDIA BALAI NUSA astro net</div>
    <h2>Login</h2>

    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul style="padding-left: 20px; margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.action') }}" id="form-login-normal">
        @csrf
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required value="{{ old('email') }}">
        </div>
        <div class="input-group" id="password-group">
            <i class="fas fa-lock input-icon-left"></i>
            <input type="password" name="password" id="password" placeholder="Password" required autocomplete="current-password">
            <span class="toggle-password-btn" id="btnTogglePassword" role="button" tabindex="0" title="Tampilkan Kata Sandi">
                <i class="fas fa-eye" id="iconTogglePassword"></i>
            </span>
        </div>

        <div style="text-align: right; margin-top: -6px; margin-bottom: 10px;">
            <a href="{{ route('password.request') }}" style="color: #3CB9E0; font-size: 11px; text-decoration: none; font-weight: 500;">
                Lupa Kata Sandi?
            </a>
        </div>
        
        <button type="submit" id="btn-login-normal">Login</button>
    </form>

    <button type="button" class="btn-face" id="btn-show-camera">
        <i class="fas fa-camera"></i> Login dengan Wajah
    </button>

    <div id="camera-section" style="display: none; margin-top: 15px;">
        <div style="position: relative; display: inline-block; width: 100%; border-radius: 8px; overflow: hidden; border: 2px solid #3CB9E0; background: #eee;">
            <video id="video-webcam" style="width: 100%; height: auto;" autoplay muted></video>
            <canvas id="overlay-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
        </div>

        {{-- Panel Indikator Liveness & Nilai EAR --}}
        <div id="liveness-indicator" style="display: flex; align-items: center; justify-content: space-between; margin-top: 8px; padding: 5px 8px; background: #f8fafc; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 11px;">
            <span id="liveness-badge" style="background: #e0f2fe; color: #0284c7; padding: 3px 8px; border-radius: 12px; font-weight: 700;">
                <i class="fas fa-shield-alt"></i> Anti-Spoofing: Aktif
            </span>
            <span id="ear-value" style="color: #64748b; font-weight: 700; font-family: monospace;">EAR: --</span>
        </div>

        <p id="biometric-status" style="font-size: 11.5px; color: #3CB9E0; margin-top: 8px; font-weight: bold; line-height: 1.4;">Menyiapkan kamera...</p>
    </div>

    <form method="POST" action="{{ route('login.biometric') }}" id="form-login-biometric" style="display: none;">
        @csrf
        <input type="hidden" name="email" id="bio_email">
        <input type="hidden" name="face_descriptor" id="bio_face_descriptor">
        <input type="hidden" name="liveness_status" id="bio_liveness_status" value="0">
    </form>

    <div class="links">
        <a href="{{ route('register') }}">Registrasi</a> | 
        <a href="{{ route('home') }}">Beranda</a>
    </div>
</div>

<script>
    // Fitur Toggle Lihat / Sembunyikan Password
    const btnTogglePassword = document.getElementById('btnTogglePassword');
    const passwordInput = document.getElementById('password');
    const iconTogglePassword = document.getElementById('iconTogglePassword');

    if (btnTogglePassword && passwordInput && iconTogglePassword) {
        function togglePasswordVisibility() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                iconTogglePassword.classList.remove('fa-eye');
                iconTogglePassword.classList.add('fa-eye-slash');
                btnTogglePassword.style.color = '#3CB9E0';
                btnTogglePassword.setAttribute('title', 'Sembunyikan Kata Sandi');
            } else {
                passwordInput.type = 'password';
                iconTogglePassword.classList.remove('fa-eye-slash');
                iconTogglePassword.classList.add('fa-eye');
                btnTogglePassword.style.color = '#8fa0b5';
                btnTogglePassword.setAttribute('title', 'Tampilkan Kata Sandi');
            }
        }

        btnTogglePassword.addEventListener('click', togglePasswordVisibility);
        btnTogglePassword.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                togglePasswordVisibility();
            }
        });
    }

    const btnShowCamera = document.getElementById('btn-show-camera');
    const cameraSection = document.getElementById('camera-section');
    const video = document.getElementById('video-webcam');
    const canvas = document.getElementById('overlay-canvas');
    const statusText = document.getElementById('biometric-status');
    
    const emailInput = document.getElementById('email');
    const passwordGroup = document.getElementById('password-group');
    const btnLoginNormal = document.getElementById('btn-login-normal');
    const formBiometric = document.getElementById('form-login-biometric');

    const MODEL_URL = '/models'; 

    btnShowCamera.addEventListener('click', async () => {
        // 1. Validasi email tidak boleh kosong
        if (!emailInput.value) {
            alert("Harap masukkan Email Anda terlebih dahulu sebelum login dengan wajah!");
            emailInput.focus();
            return;
        }

        // 2. Sembunyikan form password dan tombol biasa, tampilkan area kamera
        passwordGroup.style.display = 'none';
        btnLoginNormal.style.display = 'none';
        btnShowCamera.style.display = 'none';
        cameraSection.style.display = 'block';
        emailInput.readOnly = true; 

        statusText.innerText = "Memuat Sistem AI...";

        try {
            // 3. Muat Model (SSD Mobilenet, 68 Landmarks, Face Recognition)
            await Promise.all([
                faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
                faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
            ]);

            // 4. Nyalakan Kamera
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
            statusText.innerText = "Arahkan wajah ke kamera...";

            // Fungsi Pembantu: Jarak Euclidean 2D antar titik koordinat
            function euclideanDist2D(p1, p2) {
                return Math.hypot(p1.x - p2.x, p1.y - p2.y);
            }

            // Fungsi Pembantu: Hitung Eye Aspect Ratio (EAR) dari 6 titik landmark mata
            // Formula Soukupová & Čech: EAR = (||p2 - p6|| + ||p3 - p5||) / (2 * ||p1 - p4||)
            function calculateEyeEAR(eye) {
                const v1 = euclideanDist2D(eye[1], eye[5]);
                const v2 = euclideanDist2D(eye[2], eye[4]);
                const h  = euclideanDist2D(eye[0], eye[3]);
                if (h === 0) return 0;
                return (v1 + v2) / (2.0 * h);
            }

            // 5. Mulai pemindaian saat video berjalan
            function startLivenessScanner() {
                const displaySize = { width: video.videoWidth || 320, height: video.videoHeight || 240 };
                faceapi.matchDimensions(canvas, displaySize);

                let isSubmitted = false;
                let isProcessingBlink = false;
                let faceAlignedFrames = 0;
                const REQUIRED_ALIGNED_FRAMES = 3; // 3 frame stabil di awal untuk kalibrasi baseline EAR
                let eyeWasClosed = false;
                let closedTimestamp = 0;
                let baselineEAR = null;
                let consecutiveLostFrames = 0;

                const livenessBadge = document.getElementById('liveness-badge');
                const earValueText  = document.getElementById('ear-value');

                let isLoopRunning = true;

                async function loop() {
                    if (!isLoopRunning || isSubmitted) return;

                    try {
                        // KUNCI PERFORMA: Hanya deteksi landmarks saat loop pelacakan (15-25+ FPS lancar)
                        // TIDAK memanggil withFaceDescriptor() di sini agar tidak membebani CPU!
                        const detection = await faceapi.detectSingleFace(video).withFaceLandmarks();

                        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);

                        if (detection) {
                            consecutiveLostFrames = 0;
                            const resizedDetection = faceapi.resizeResults(detection, displaySize);
                            const landmarks = resizedDetection.landmarks;
                            const leftEye  = landmarks.getLeftEye();
                            const rightEye = landmarks.getRightEye();

                            // 1. Hitung Nilai EAR untuk Kedua Belah Mata
                            const leftEAR  = calculateEyeEAR(leftEye);
                            const rightEAR = calculateEyeEAR(rightEye);
                            const avgEAR   = (leftEAR + rightEAR) / 2.0;

                            if (earValueText) {
                                earValueText.innerText = `EAR: ${avgEAR.toFixed(2)}`;
                            }

                            // 2. Gambar 68 Titik Karakteristik Wajah (Landmarks)
                            faceapi.draw.drawFaceLandmarks(canvas, resizedDetection);

                            if (!isProcessingBlink) {
                                // FASE A: Penyelarasan Posisi Wajah & Kalibrasi Baseline EAR
                                if (faceAlignedFrames < REQUIRED_ALIGNED_FRAMES) {
                                    faceAlignedFrames++;
                                    if (baselineEAR === null) {
                                        baselineEAR = avgEAR;
                                    } else {
                                        baselineEAR = (baselineEAR + avgEAR) / 2.0;
                                    }

                                    statusText.innerText = `Menyelaraskan wajah... (${Math.round((faceAlignedFrames / REQUIRED_ALIGNED_FRAMES) * 100)}%)`;
                                    statusText.style.color = "#3CB9E0";

                                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                        label: 'Wajah Terdeteksi', 
                                        boxColor: '#3CB9E0' 
                                    });
                                    drawBox.draw(canvas);
                                } else {
                                    // FASE B: Uji Liveness Kedipan Mata (Anti-Spoofing)
                                    // Threshold adaptif yang responsif:
                                    const effectiveBaseline = baselineEAR || 0.30;
                                    const earClosedThreshold = Math.min(0.245, effectiveBaseline * 0.82);
                                    const earOpenThreshold   = Math.max(0.255, effectiveBaseline * 0.88);

                                    const isEyesClosed = (avgEAR <= earClosedThreshold) || (leftEAR <= 0.24 && rightEAR <= 0.24);

                                    if (isEyesClosed) {
                                        if (!eyeWasClosed) {
                                            eyeWasClosed = true;
                                            closedTimestamp = Date.now();
                                        }

                                        statusText.innerText = "Kedip terdeteksi! Silakan buka kembali mata Anda...";
                                        statusText.style.color = "#f59e0b"; // Oranye

                                        if (livenessBadge) {
                                            livenessBadge.innerHTML = '<i class="fas fa-eye-slash"></i> Mata Menutup! Buka kembali...';
                                            livenessBadge.style.background = '#fef3c7';
                                            livenessBadge.style.color = '#b45309';
                                        }

                                        const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                            label: 'Mata Menutup (Liveness)', 
                                            boxColor: '#f59e0b' 
                                        });
                                        drawBox.draw(canvas);

                                    } else if (eyeWasClosed && avgEAR >= earOpenThreshold) {
                                        // SIKLUS KEDIP LENGKAP: Terbuka -> Menutup -> Terbuka Kembali (100% Manusia Asli)
                                        const blinkDuration = Date.now() - closedTimestamp;
                                        
                                        // Rentang durasi kedip manusia normal (80ms - 3000ms)
                                        if (blinkDuration >= 80 && blinkDuration <= 3000) {
                                            isProcessingBlink = true;
                                            isLoopRunning = false;

                                            statusText.innerText = "Liveness Valid (Manusia Hidup)! Mengekstrak biometrik wajah...";
                                            statusText.style.color = "#16a34a"; // Hijau

                                            if (livenessBadge) {
                                                livenessBadge.innerHTML = '<i class="fas fa-check-circle"></i> Kedip Valid! Memverifikasi...';
                                                livenessBadge.style.background = '#dcfce7';
                                                livenessBadge.style.color = '#15803d';
                                            }

                                            const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                                label: 'Liveness: TERVERIFIKASI (Asli)', 
                                                boxColor: '#22c55e' 
                                            });
                                            drawBox.draw(canvas);

                                            // FASE C: Ekstraksi Face Descriptor (ResNet-34) 1 Kali Saja
                                            let fullDetection = null;
                                            for (let r = 0; r < 5; r++) {
                                                fullDetection = await faceapi.detectSingleFace(video)
                                                    .withFaceLandmarks()
                                                    .withFaceDescriptor();
                                                if (fullDetection) break;
                                                await new Promise(res => setTimeout(res, 80));
                                            }

                                            if (fullDetection) {
                                                isSubmitted = true;
                                                statusText.innerText = "Verifikasi selesai! Mengalihkan ke sistem...";
                                                
                                                document.getElementById('bio_email').value = emailInput.value;
                                                document.getElementById('bio_face_descriptor').value = JSON.stringify(Array.from(fullDetection.descriptor));
                                                document.getElementById('bio_liveness_status').value = "1";

                                                setTimeout(() => {
                                                    formBiometric.submit();
                                                }, 400);
                                                return;
                                            } else {
                                                // Jika ekstraksi descriptor sesaat terlewat, pulihkan ke loop
                                                isProcessingBlink = false;
                                                isLoopRunning = true;
                                                eyeWasClosed = false;
                                                statusText.innerText = "Posisikan wajah menghadap kamera dan silakan kedip lagi...";
                                            }
                                        } else {
                                            // Terlalu lama tutup mata (>3 detik), reset agar bisa kedip ulang secara alami
                                            eyeWasClosed = false;
                                        }

                                    } else {
                                        // Update baseline perlahan jika mata tetap terbuka
                                        if (!eyeWasClosed && avgEAR >= 0.26) {
                                            baselineEAR = (baselineEAR * 0.9) + (avgEAR * 0.1);
                                        }

                                        statusText.innerText = "UJI LIVENESS: Silakan KEDIPKAN MATA Anda sekali...";
                                        statusText.style.color = "#0284c7"; // Biru

                                        if (livenessBadge) {
                                            livenessBadge.innerHTML = '<i class="fas fa-eye"></i> Menunggu Kedipan Mata';
                                            livenessBadge.style.background = '#e0f2fe';
                                            livenessBadge.style.color = '#0284c7';
                                        }

                                        const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                            label: 'Uji Liveness: Kedipkan Mata', 
                                            boxColor: '#3CB9E0' 
                                        });
                                        drawBox.draw(canvas);
                                    }
                                }
                            }
                        } else {
                            // Toleransi kehilangan deteksi singkat (misal saat kelopak mata menutup cepat)
                            consecutiveLostFrames++;
                            if (consecutiveLostFrames > 8) {
                                faceAlignedFrames = 0;
                                eyeWasClosed = false;
                                baselineEAR = null;
                                statusText.innerText = "Posisikan wajah Anda di tengah kamera...";
                                statusText.style.color = "#cc0000"; // Merah
                                if (earValueText) earValueText.innerText = "EAR: --";
                                if (livenessBadge) {
                                    livenessBadge.innerHTML = '<i class="fas fa-user-times"></i> Wajah Belum Terdeteksi';
                                    livenessBadge.style.background = '#fee2e2';
                                    livenessBadge.style.color = '#b91c1c';
                                }
                            }
                        }
                    } catch (e) {
                        console.error("Kesalahan loop liveness:", e);
                    }

                    if (isLoopRunning && !isSubmitted) {
                        setTimeout(loop, 40); // 40ms interval = ~25 FPS sangat responsif
                    }
                }

                loop();
            }

            video.addEventListener('play', startLivenessScanner);
            // Cadangan jika video sudah berjalan saat event didaftarkan
            if (!video.paused && video.readyState >= 2) {
                startLivenessScanner();
            }

        } catch (err) {
            console.error("Error Kamera:", err);
            statusText.innerText = "Kamera gagal dimuat. Refresh halaman.";
            statusText.style.color = "#cc0000"; // Warna merah
        }
    });
</script>

</body>
</html>