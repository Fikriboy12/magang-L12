<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<title>Login-PT. MEDIA BALAI NUSA</title>

<link rel="icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">
<link rel="shortcut icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">
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

    .input-group i {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #3CB9E0; /* --- BERUBAH: Ikon menggunakan warna biru cerah logo --- */
        font-size: 13px;
    }

    .input-group input {
        width: 100%;
        padding: 9px 12px 9px 35px;
        border-radius: 8px;
        border: 1px solid #ccc;
        outline: none;
        font-size: 13px;
        box-sizing: border-box;
    }

    .input-group input:focus {
        border-color: #3CB9E0; /* --- BERUBAH: Border focus menggunakan warna biru cerah logo --- */
        box-shadow: 0 0 6px rgba(74, 193, 224, 0.4); /* --- BERUBAH: Shadow focus menggunakan warna biru logo yang transparan --- */
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
    <img src="<?php echo e(asset('gambar/ANMS-logo.png')); ?>" alt="Logo ANMS">
    <div class="company-name">PT.MEDIA BALAI NUSA astro net</div>
    <h2>Login</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul style="padding-left: 20px; margin: 0;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login.action')); ?>" id="form-login-normal">
        <?php echo csrf_field(); ?>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required value="<?php echo e(old('email')); ?>">
        </div>
        <div class="input-group" id="password-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password">
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
        <p id="biometric-status" style="font-size: 11px; color: #3CB9E0; margin-top: 8px; font-weight: bold;">Menyiapkan kamera...</p>
    </div>

    <form method="POST" action="<?php echo e(route('login.biometric')); ?>" id="form-login-biometric" style="display: none;">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="email" id="bio_email">
        <input type="hidden" name="face_descriptor" id="bio_face_descriptor">
    </form>

    <div class="links">
        <a href="<?php echo e(route('home')); ?>">Halaman Utama</a> | 
        <a href="<?php echo e(route('register')); ?>">Registrasi</a>
    </div>
</div>

<script>
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
            // 3. Muat Model
            await Promise.all([
                faceapi.nets.ssdMobilenetv1.loadFromUri(MODEL_URL),
                faceapi.nets.faceLandmark68Net.loadFromUri(MODEL_URL),
                faceapi.nets.faceRecognitionNet.loadFromUri(MODEL_URL)
            ]);

            // 4. Nyalakan Kamera
            const stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
            statusText.innerText = "Arahkan wajah ke kamera...";

            // 5. Mulai pemindaian saat video berjalan
            video.addEventListener('play', () => {
                const displaySize = { width: video.videoWidth, height: video.videoHeight };
                faceapi.matchDimensions(canvas, displaySize);

                const scanInterval = setInterval(async () => {
                    const detection = await faceapi.detectSingleFace(video).withFaceLandmarks().withFaceDescriptor();
                    
                    if (detection) {
                        clearInterval(scanInterval); // Hentikan scan jika sudah terdeteksi
                        
                        statusText.innerText = "Wajah diproses. Mohon tunggu...";
                        statusText.style.color = "#28a745"; // Warna hijau
                        
                        const resizedDetection = faceapi.resizeResults(detection, displaySize);
                        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
                        faceapi.draw.drawDetections(canvas, resizedDetection);

                        // Kirim data ke controller
                        document.getElementById('bio_email').value = emailInput.value;
                        document.getElementById('bio_face_descriptor').value = JSON.stringify(Array.from(detection.descriptor));
                        
                        formBiometric.submit();
                    }
                }, 500); 
            });

        } catch (err) {
            console.error("Error Kamera:", err);
            statusText.innerText = "Kamera gagal dimuat. Refresh halaman.";
            statusText.style.color = "#cc0000"; // Warna merah
        }
    });
</script>

</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/auth/login.blade.php ENDPATH**/ ?>