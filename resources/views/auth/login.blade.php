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
                                    statusText.style.color = "#0284c7";

                                    const drawBox = new faceapi.draw.DrawBox(resizedDetection.detection.box, { 
                                        label: 'Wajah Terdeteksi', 
                                        boxColor: '#0284c7' 
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
                                            boxColor: '#0284c7' 
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