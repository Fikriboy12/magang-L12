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
        /* Background Ambient Light Tech: Lembut, berdimensi, tidak silau & harmonis presisi dengan warna logo */
        background: radial-gradient(circle at 12% 18%, rgba(62, 204, 233, 0.22) 0%, transparent 45%),
                    radial-gradient(circle at 88% 82%, rgba(2, 132, 199, 0.18) 0%, transparent 45%),
                    radial-gradient(circle at 50% 50%, rgba(240, 249, 255, 0.5) 0%, transparent 70%),
                    linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 45%, #e2e8f0 100%);
        min-height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px; 
        box-sizing: border-box;
    }

    /* Card Login Modern, Elegan & Berdimensi */
    .login-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.9);
        border-top: 4px solid #3ECCE9; /* Garis aksen atas warna Cyan Logo ANMS */
        border-radius: 16px;
        padding: 34px 26px;
        width: 100%;        
        max-width: 350px; /* Ukuran proporsional & mantap di layar */
        box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.12), 0 0 25px rgba(62, 204, 233, 0.12);
        text-align: center;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        position: relative;
    }

    /* Logo ANMS */
    .login-card img {
        width: 82px;
        height: auto;
        margin-bottom: 12px;
        filter: drop-shadow(0 4px 10px rgba(62, 204, 233, 0.25));
    }

    .company-name {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a; /* Warna Navy Korporat - Kontras tinggi, tegas & mudah dibaca */
        margin-bottom: 4px;
        letter-spacing: 0.3px;
    }

    .company-name span {
        color: #0284c7; /* Warna Cyan Biru Logo */
        font-weight: 600;
    }

    .login-card h2 {
        margin-bottom: 18px;
        color: #0f172a; /* Warna Navy Gelap */
        font-weight: 800;
        font-size: 21px;
        letter-spacing: -0.3px;
    }

    /* Input */
    .input-group {
        position: relative;
        margin-bottom: 13px;
        max-width: 100%;
    }

    .input-group > i.input-icon-left,
    .input-group > i:first-child {
        position: absolute;
        top: 50%;
        left: 13px;
        transform: translateY(-50%);
        color: #0284c7; /* Biru logo tegas */
        font-size: 13.5px;
        pointer-events: none;
    }

    .input-group input {
        width: 100%;
        padding: 10px 12px 10px 38px;
        border-radius: 9px;
        border: 1px solid #cbd5e1;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
        background: #f8fafc;
        color: #1e293b;
    }

    .input-group input#password {
        padding-right: 38px;
    }

    .input-group input:focus {
        background: #ffffff;
        border-color: #0284c7;
        box-shadow: 0 0 0 3px rgba(62, 204, 233, 0.28);
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
        color: #0284c7;
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

    /* Button Utama Login */
    .login-card button {
        width: 100%;
        padding: 11px;
        border: none;
        border-radius: 9px;
        /* Gradasi presisi palet logo: dari Cyan Cerah ke Biru Royal */
        background: linear-gradient(135deg, #3ECCE9 0%, #0284c7 100%);
        color: #ffffff;
        font-weight: 700;
        cursor: pointer;
        margin-top: 10px;
        font-size: 13.5px;
        letter-spacing: 0.3px;
        box-shadow: 0 4px 14px rgba(2, 132, 199, 0.3);
        transition: all 0.3s ease;
    }

    .login-card button:hover {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(2, 132, 199, 0.4);
    }

    /* Style Button Login Biometrik */
    .btn-face {
        background: #f0f9ff !important;
        border: 1.5px solid #0284c7 !important;
        color: #0284c7 !important;
        margin-top: 10px !important;
        box-shadow: none !important;
        font-weight: 600 !important;
    }
    .btn-face:hover {
        background: #0284c7 !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(2, 132, 199, 0.25) !important;
    }

    /* Links */
    .login-card .links {
        margin-top: 18px;
        font-size: 12.5px;
    }
    .login-card .links a {
        color: #0284c7;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.2s;
    }
    .login-card .links a:hover {
        color: #0369a1;
        text-decoration: underline;
    }

    /* Alert Style Modern */
    .alert {
        padding: 9px 12px;
        margin-bottom: 14px;
        border-radius: 8px;
        font-size: 11.5px;
        text-align: left;
        display: flex;
        align-items: center;
        gap: 8px;
        line-height: 1.4;
    }
    .alert-danger {
        background: #fef2f2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }
    .alert-success {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }
</style>
</head>
<body>

<div class="login-card">
    <img src="{{ asset('gambar/ANMS-logo.png') }}" alt="Logo ANMS">
    <div class="company-name">PT. MEDIA BALAI NUSA <span>astro net</span></div>
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

        <div style="text-align: right; margin-top: -4px; margin-bottom: 12px;">
            <a href="{{ route('password.request') }}" style="color: #0284c7; font-size: 11.5px; text-decoration: none; font-weight: 600;">
                Lupa Kata Sandi?
            </a>
        </div>
        
        <button type="submit" id="btn-login-normal">Login</button>
    </form>

    <button type="button" class="btn-face" id="btn-show-camera">
        <i class="fas fa-camera"></i> Login dengan Wajah
    </button>

    <div id="camera-section" style="display: none; margin-top: 15px;">
        <div style="position: relative; display: inline-block; width: 100%; border-radius: 10px; overflow: hidden; border: 2px solid #0284c7; background: #eee;">
            <video id="video-webcam" style="width: 100%; height: auto; display: block;" autoplay muted playsinline></video>
            <canvas id="overlay-canvas" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
        </div>

        {{-- Panel Indikator Euclidean Distance & Liveness EAR --}}
        <div id="liveness-indicator" style="display: flex; align-items: center; justify-content: space-between; margin-top: 8px; padding: 6px 10px; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 11px;">
            <span id="liveness-badge" style="background: #e0f2fe; color: #0284c7; padding: 4px 10px; border-radius: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px;">
                <i class="fas fa-calculator"></i> Tahap 1: Euclidean Distance
            </span>
            <span id="metric-value" style="color: #64748b; font-weight: 700; font-family: monospace;">Jarak: --</span>
        </div>

        <p id="biometric-status" style="font-size: 11.5px; color: #0284c7; margin-top: 8px; font-weight: bold; line-height: 1.4;">Menyiapkan kamera...</p>
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
                btnTogglePassword.style.color = '#0284c7';
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
    const livenessBadge = document.getElementById('liveness-badge');
    const metricValueText = document.getElementById('metric-value');
    
    const emailInput = document.getElementById('email');
    const passwordGroup = document.getElementById('password-group');
    const btnLoginNormal = document.getElementById('btn-login-normal');
    const formBiometric = document.getElementById('form-login-biometric');

    const MODEL_URL = '/models'; 

    btnShowCamera.addEventListener('click', async () => {
        // 1. Validasi email tidak boleh kosong
        if (!emailInput.value.trim()) {
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

        statusText.innerText = "Mengambil data biometrik akun Anda...";
        statusText.style.color = "#0284c7";

        // 3. Ambil Stored Descriptor dari database via endpoint aman
        let storedDescriptor = null;
        let userName = '';
        try {
            const csrfToken = document.querySelector('input[name="_token"]').value;
            const res = await fetch("{{ route('login.get_descriptor') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ email: emailInput.value.trim() })
            });

            const data = await res.json();
            if (!res.ok || !data.success) {
                alert(data.message || "Gagal memverifikasi akun.");
                // Kembalikan form jika akun tidak valid/belum daftar
                passwordGroup.style.display = '';
                btnLoginNormal.style.display = '';
                btnShowCamera.style.display = '';
                cameraSection.style.display = 'none';
                emailInput.readOnly = false;
                return;
            }

            storedDescriptor = new Float32Array(data.descriptor);
            userName = data.name;
        } catch (err) {
            console.error("Gagal ambil descriptor:", err);
            alert("Terjadi kendala koneksi saat mengambil data biometrik.");
            passwordGroup.style.display = '';
            btnLoginNormal.style.display = '';
            btnShowCamera.style.display = '';
            cameraSection.style.display = 'none';
            emailInput.readOnly = false;
            return;
        }

        statusText.innerText = `Memuat Sistem AI untuk ${userName}...`;

        try {
            // 4. Pastikan konteks aman (HTTPS / localhost) agar API kamera tersedia di mobile
            if (!window.isSecureContext || !navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                const err = new Error("Akses kamera membutuhkan koneksi HTTPS (Secure Context).");
                err.name = "InsecureContextError";
                throw err;
            }

            // 5. Muat Model (SSD Mobilenet, Tiny Face Detector untuk FPS tinggi saat liveness, 68 Landmarks, Face Recognition)
            await Promise.all([
                faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
                faceapi.nets.tinyFaceDetector.loadFromUri(MODEL_URL),
                faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
            ]);

            // 6. Nyalakan Kamera (prioritaskan kamera depan pada HP, fallback ke default jika tidak didukung)
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
            statusText.innerText = "Arahkan wajah ke kamera untuk verifikasi Euclidean Distance...";

            // Fungsi Pembantu: Jarak Euclidean 2D antar titik koordinat
            function euclideanDist2D(p1, p2) {
                return Math.hypot(p1.x - p2.x, p1.y - p2.y);
            }

            // Fungsi Pembantu: Hitung Eye Aspect Ratio (EAR) dari 6 titik landmark mata (Subbab 2.2.9)
            // Rumus: EAR = ((P2 - P6) + (P3 - P5)) / (2 * (P1 - P4))
            function calculateEyeEAR(eye) {
                const v1 = euclideanDist2D(eye[1], eye[5]); // |P2 - P6|
                const v2 = euclideanDist2D(eye[2], eye[4]); // |P3 - P5|
                const h  = euclideanDist2D(eye[0], eye[3]); // |P1 - P4|
                if (h === 0) return 0;
                return (v1 + v2) / (2.0 * h);
            }

            // Fungsi Pembantu: Rumus Euclidean Distance 128 Dimensi (Tabel 2.3 Skripsi)
            // d = sqrt( sum( (p_i - q_i)^2 ) )
            function calculateEuclideanDistance(desc1, desc2) {
                let sum = 0;
                for (let i = 0; i < 128; i++) {
                    const diff = desc1[i] - desc2[i];
                    sum += diff * diff;
                }
                return Math.sqrt(sum);
            }

            // Fungsi Pembantu: Gambar titik HANYA pada mata (NO titik wajah / rahang / hidung)
            function drawEyeLandmarks(ctx, eyePoints, color = '#38bdf8') {
                ctx.save();
                for (let i = 0; i < eyePoints.length; i++) {
                    const pt = eyePoints[i];
                    ctx.beginPath();
                    ctx.arc(pt.x, pt.y, 2.5, 0, 2 * Math.PI);
                    ctx.fillStyle = color;
                    ctx.fill();
                    ctx.strokeStyle = '#ffffff';
                    ctx.lineWidth = 1;
                    ctx.stroke();
                }
                // Hubungkan garis kelopak mata halus
                ctx.beginPath();
                ctx.moveTo(eyePoints[0].x, eyePoints[0].y);
                for (let i = 1; i < eyePoints.length; i++) {
                    ctx.lineTo(eyePoints[i].x, eyePoints[i].y);
                }
                ctx.closePath();
                ctx.strokeStyle = color;
                ctx.lineWidth = 1.5;
                ctx.stroke();
                ctx.restore();
            }

            // 7. Mulai pemindaian saat metadata & video siap berjalan
            let scannerStarted = false;
            function startScanner() {
                if (scannerStarted || !video.videoWidth || !video.videoHeight) return;
                scannerStarted = true;
                const displaySize = { width: video.videoWidth, height: video.videoHeight };
                faceapi.matchDimensions(canvas, displaySize);

                let isSubmitted = false;
                let isLoopRunning = true;

                // =========================================================================
                // THRESHOLD PENELITIAN SKRIPSI:
                // - Euclidean Distance: Threshold <= 0.60 (Tabel 2.3)
                // - Eye Aspect Ratio (EAR): Threshold <= 0.20 (Tabel 2.4)
                // =========================================================================
                const EUCLIDEAN_THRESHOLD = 0.60;
                const EAR_THRESHOLD = 0.20;

                // Status Alur: 'EUCLIDEAN' (Tahap 1) -> 'LIVENESS' (Tahap 2)
                let currentPhase = 'EUCLIDEAN';
                let matchedFrames = 0;
                const REQUIRED_MATCH_FRAMES = 3; // 3 frame stabil di bawah threshold 0.60
                let validatedDescriptor = null;

                let eyeWasClosed = false;
                let closedTimestamp = 0;
                let baselineEAR = null;
                let consecutiveLostFrames = 0;

                // Detector ringan untuk fase Liveness agar FPS tinggi dan kedipan cepat tidak terlewat di laptop maupun HP
                const livenessDetectorOptions = new faceapi.TinyFaceDetectorOptions({
                    inputSize: 224,
                    scoreThreshold: 0.4
                });

                async function loop() {
                    if (!isLoopRunning || isSubmitted) return;

                    try {
                        const ctx = canvas.getContext('2d');

                        if (currentPhase === 'EUCLIDEAN') {
                            // ========================================================
                            // TAHAP 1: METODE EUCLIDEAN DISTANCE (PENCOCOKAN WAJAH)
                            // HANYA KOTAK SEGI 4 DI MUKA + NILAI THRESHOLD BERUBAH-UBAH
                            // ========================================================
                            const detection = await faceapi.detectSingleFace(video)
                                .withFaceLandmarks()
                                .withFaceDescriptor();

                            ctx.clearRect(0, 0, canvas.width, canvas.height);

                            if (detection) {
                                consecutiveLostFrames = 0;
                                const resizedDetection = faceapi.resizeResults(detection, displaySize);
                                const liveDescriptor = detection.descriptor;

                                // Kalibrasi awal baseline EAR mata terbuka sejak Tahap 1
                                const initLeftEAR = calculateEyeEAR(resizedDetection.landmarks.getLeftEye());
                                const initRightEAR = calculateEyeEAR(resizedDetection.landmarks.getRightEye());
                                const initAvgEAR = (initLeftEAR + initRightEAR) / 2.0;
                                if (initAvgEAR >= 0.24) {
                                    baselineEAR = baselineEAR === null
                                        ? initAvgEAR
                                        : (baselineEAR * 0.7) + (initAvgEAR * 0.3);
                                }

                                // Hitung Jarak Euclidean 128 Dimensi secara real-time
                                const distance = calculateEuclideanDistance(storedDescriptor, liveDescriptor);

                                if (metricValueText) {
                                    metricValueText.innerText = `Jarak: ${distance.toFixed(4)} | Th: ≤ 0.60`;
                                }

                                // HANYA KOTAK SEGI 4 (TANPA TITIK-TITIK SAMA SEKALI)
                                if (distance <= EUCLIDEAN_THRESHOLD) {
                                    // DI BAWAH THRESHOLD (<= 0.60) -> BERHASIL
                                    matchedFrames++;
                                    const boxColor = '#16a34a'; // Hijau
                                    const labelText = `Euclidean: ${distance.toFixed(4)} (≤ 0.60 Berhasil)`;

                                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, {
                                        label: labelText,
                                        boxColor: boxColor,
                                        lineWidth: 2
                                    });
                                    drawBox.draw(canvas);

                                    statusText.innerText = `Wajah Cocok! Skor: ${distance.toFixed(4)} ≤ 0.60 (Validasi: ${matchedFrames}/${REQUIRED_MATCH_FRAMES})`;
                                    statusText.style.color = '#16a34a';

                                    if (livenessBadge) {
                                        livenessBadge.innerHTML = `<i class="fas fa-check-circle"></i> Wajah Cocok (≤ 0.60)`;
                                        livenessBadge.style.background = '#dcfce7';
                                        livenessBadge.style.color = '#15803d';
                                    }

                                    // Jika stabil di bawah 0.60: TAHAP 1 SELESAI, LANJUT KE TAHAP 2
                                    if (matchedFrames >= REQUIRED_MATCH_FRAMES) {
                                        validatedDescriptor = Array.from(liveDescriptor);
                                        currentPhase = 'LIVENESS';

                                        statusText.innerText = "Tahap 1 Euclidean Lolos! Sekarang Uji Anti-Spoofing: Silakan KEDIPKAN MATA...";
                                        statusText.style.color = "#0284c7";

                                        if (livenessBadge) {
                                            livenessBadge.innerHTML = `<i class="fas fa-eye"></i> Tahap 2: Anti-Spoofing (Kedip Mata)`;
                                            livenessBadge.style.background = '#e0f2fe';
                                            livenessBadge.style.color = '#0284c7';
                                        }
                                    }
                                } else {
                                    // DI ATAS THRESHOLD (> 0.60) -> TIDAK BERHASIL / TIDAK COCOK
                                    matchedFrames = 0;
                                    const boxColor = '#ef4444'; // Merah
                                    const labelText = `Euclidean: ${distance.toFixed(4)} (> 0.60 Tidak Cocok)`;

                                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, {
                                        label: labelText,
                                        boxColor: boxColor,
                                        lineWidth: 2
                                    });
                                    drawBox.draw(canvas);

                                    statusText.innerText = `Wajah Tidak Cocok! Skor: ${distance.toFixed(4)} (Melebihi ambang batas skripsi 0.60)`;
                                    statusText.style.color = '#dc2626';

                                    if (livenessBadge) {
                                        livenessBadge.innerHTML = `<i class="fas fa-times-circle"></i> Jarak > 0.60 (Tidak Cocok)`;
                                        livenessBadge.style.background = '#fee2e2';
                                        livenessBadge.style.color = '#b91c1c';
                                    }
                                }
                            } else {
                                matchedFrames = 0;
                                statusText.innerText = "Posisikan wajah Anda tepat di depan kamera...";
                                statusText.style.color = "#64748b";
                                if (metricValueText) metricValueText.innerText = "Jarak: --";
                            }

                        } else if (currentPhase === 'LIVENESS') {
                            // ========================================================
                            // TAHAP 2: METODE ANTI-SPOOFING (UJI KEDIP MATA / EAR)
                            // (BARU MUNCUL SETELAH TAHAP 1 EUCLIDEAN DISTANCE SELESAI)
                            // ========================================================
                            const detection = await faceapi.detectSingleFace(video, livenessDetectorOptions).withFaceLandmarks();

                            ctx.clearRect(0, 0, canvas.width, canvas.height);

                            if (detection) {
                                consecutiveLostFrames = 0;
                                const resizedDetection = faceapi.resizeResults(detection, displaySize);
                                const landmarks = resizedDetection.landmarks;
                                const leftEye  = landmarks.getLeftEye();
                                const rightEye = landmarks.getRightEye();

                                const leftEAR  = calculateEyeEAR(leftEye);
                                const rightEAR = calculateEyeEAR(rightEye);
                                const avgEAR   = (leftEAR + rightEAR) / 2.0;

                                const effectiveBaseline = baselineEAR || 0.30;
                                const dynamicClosedThreshold = Math.min(0.275, effectiveBaseline * 0.80);
                                const activeThreshold = Math.max(EAR_THRESHOLD, dynamicClosedThreshold);
                                const reopenThreshold = Math.max(EAR_THRESHOLD + 0.02, effectiveBaseline * 0.88);

                                if (metricValueText) {
                                    metricValueText.innerText = `EAR: ${avgEAR.toFixed(2)} | Target: ≤ ${activeThreshold.toFixed(2)}`;
                                }

                                // Perbarui baseline hanya saat mata terbuka normal (hindari ikut turun saat mulai berkedip)
                                if (baselineEAR === null && avgEAR >= 0.24) {
                                    baselineEAR = avgEAR;
                                } else if (!eyeWasClosed && avgEAR >= 0.24 && avgEAR >= effectiveBaseline * 0.90) {
                                    baselineEAR = (baselineEAR * 0.9) + (avgEAR * 0.1);
                                }

                                const isEyesClosed = (avgEAR <= EAR_THRESHOLD) ||
                                                     (avgEAR <= dynamicClosedThreshold) ||
                                                     (Math.min(leftEAR, rightEAR) <= Math.min(0.26, effectiveBaseline * 0.78));

                                // TITIK-TITIK HANYA MUNCUL DI MATA (BUKAN SELURUH WAJAH!)
                                drawEyeLandmarks(ctx, leftEye, isEyesClosed ? '#f59e0b' : '#38bdf8');
                                drawEyeLandmarks(ctx, rightEye, isEyesClosed ? '#f59e0b' : '#38bdf8');

                                if (isEyesClosed) {
                                    if (!eyeWasClosed) {
                                        eyeWasClosed = true;
                                        closedTimestamp = Date.now();
                                    }

                                    statusText.innerText = `Kedip terdeteksi (EAR: ${avgEAR.toFixed(2)} ≤ ${activeThreshold.toFixed(2)})! Silakan buka kembali mata Anda...`;
                                    statusText.style.color = "#f59e0b"; // Oranye

                                    if (livenessBadge) {
                                        livenessBadge.innerHTML = '<i class="fas fa-eye-slash"></i> Mata Menutup (Kedip Terdeteksi)';
                                        livenessBadge.style.background = '#fef3c7';
                                        livenessBadge.style.color = '#b45309';
                                    }

                                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                        label: `Mata Menutup (EAR: ${avgEAR.toFixed(2)})`, 
                                        boxColor: '#f59e0b',
                                        lineWidth: 2
                                    });
                                    drawBox.draw(canvas);

                                } else if (eyeWasClosed && avgEAR >= reopenThreshold) {
                                    // SIKLUS KEDIP LENGKAP: Terbuka -> Tertutup -> Terbuka kembali (minimal >= reopenThreshold)
                                    const blinkDuration = Date.now() - closedTimestamp;

                                    if (blinkDuration >= 80 && blinkDuration <= 3000) {
                                        isLoopRunning = false;
                                        isSubmitted = true;

                                        statusText.innerText = "Liveness Valid (Manusia Asli)! Wajah dan kedipan terverifikasi...";
                                        statusText.style.color = "#16a34a"; // Hijau

                                        if (livenessBadge) {
                                            livenessBadge.innerHTML = '<i class="fas fa-shield-alt"></i> Anti-Spoofing: Terverifikasi (Asli)';
                                            livenessBadge.style.background = '#dcfce7';
                                            livenessBadge.style.color = '#15803d';
                                        }

                                        const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                            label: 'Anti-Spoofing: TERVERIFIKASI (Asli)', 
                                            boxColor: '#22c55e',
                                            lineWidth: 2
                                        });
                                        drawBox.draw(canvas);

                                        // Submit form login biometrik
                                        document.getElementById('bio_email').value = emailInput.value.trim();
                                        document.getElementById('bio_face_descriptor').value = JSON.stringify(validatedDescriptor || []);
                                        document.getElementById('bio_liveness_status').value = "1";

                                        setTimeout(() => {
                                            formBiometric.submit();
                                        }, 400);
                                        return;

                                    } else {
                                        // Terlalu singkat (< 80ms noise) atau terlalu lama (> 3000ms): reset status kedipan
                                        eyeWasClosed = false;
                                    }

                                } else {
                                    statusText.innerText = "UJI ANTI-SPOOFING: Silakan KEDIPKAN MATA Anda sekali...";
                                    statusText.style.color = "#0284c7";

                                    if (livenessBadge) {
                                        livenessBadge.innerHTML = `<i class="fas fa-eye"></i> Uji Liveness: Menunggu Kedipan (EAR > ${activeThreshold.toFixed(2)})`;
                                        livenessBadge.style.background = '#e0f2fe';
                                        livenessBadge.style.color = '#0284c7';
                                    }

                                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                        label: `Anti-Spoofing: Kedipkan Mata (EAR: ${avgEAR.toFixed(2)})`, 
                                        boxColor: '#0284c7',
                                        lineWidth: 2
                                    });
                                    drawBox.draw(canvas);
                                }
                            } else {
                                consecutiveLostFrames++;
                                if (consecutiveLostFrames > 12) {
                                    statusText.innerText = "Posisikan wajah Anda tetap di kamera...";
                                    statusText.style.color = "#cc0000";
                                }
                            }
                        }
                    } catch (e) {
                        console.error("Kesalahan pemindaian:", e);
                    } finally {
                        if (isLoopRunning && !isSubmitted) {
                            if (currentPhase === 'LIVENESS') {
                                requestAnimationFrame(loop);
                            } else {
                                setTimeout(loop, 60);
                            }
                        }
                    }
                }

                loop();
            }

            video.addEventListener('loadedmetadata', startScanner);
            video.addEventListener('playing', startScanner);
            video.addEventListener('play', startScanner);
            if (!video.paused && video.readyState >= 2 && video.videoWidth > 0) {
                startScanner();
            }

        } catch (err) {
            console.error("Error Kamera:", err);
            let errorMessage = "Kamera gagal dimuat. Refresh halaman.";
            if (err.name === 'InsecureContextError') {
                errorMessage = "Kamera diblokir browser karena tidak memakai HTTPS. Gunakan https:// atau localhost.";
            } else if (err.name === 'NotAllowedError' || err.name === 'PermissionDeniedError') {
                errorMessage = "Izin kamera ditolak. Izinkan akses kamera di pengaturan browser lalu refresh.";
            } else if (err.name === 'NotFoundError' || err.name === 'DevicesNotFoundError') {
                errorMessage = "Kamera tidak ditemukan pada perangkat ini.";
            } else if (err.name === 'NotReadableError' || err.name === 'TrackStartError') {
                errorMessage = "Kamera sedang digunakan aplikasi lain. Tutup aplikasi lain lalu refresh.";
            }
            statusText.innerText = errorMessage;
            statusText.style.color = "#cc0000";
        }
    });
</script>

</body>
</html>