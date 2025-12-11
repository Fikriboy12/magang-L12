<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - PT. MEDIA BALAI NUSA</title>

    <link rel="icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">
    <link rel="shortcut icon" href="<?php echo e(asset('gambar/AMS-logo.png')); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/modules/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/modules/fontawesome/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/modules/jquery-selectric/selectric.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/components.css')); ?>">

    <style>
        /* BACKGROUND GRADIENT BIRU (Sesuai Logo) */
        body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* UBAH 1: Tambahkan padding kiri-kanan (15px) agar tidak mentok layar HP */
            padding: 30px 15px; 
            font-family: 'Nunito', sans-serif;
        }

        /* CARD REGISTER */
        .card-register {
            background: #ffffff;
            border-radius: 20px; /* Lebih rounded */
            padding: 40px;
            max-width: 450px; /* <--- LEBAR CARD SESUAI */
            width: 100%;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2); /* Shadow lebih dalam */
            border: none;
        }

        /* UBAH 2: Media Query Khusus HP */
        @media (max-width: 576px) {
            .card-register {
                /* Padding card dikecilkan sedikit di HP agar area input lebih lega */
                padding: 30px 20px; 
            }
            
            h4 {
                font-size: 1.2rem; /* Ukuran font judul sedikit disesuaikan */
            }
        }

        /* INPUT FIELDS */
        .form-group label {
            font-weight: 700;
            color: #5a5c69;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #e3e6f0;
            padding: 12px 15px;
            height: 48px; /* Tinggi input konsisten */
            font-size: 0.95rem;
            background-color: #fdfdfd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #1e3c72; /* Warna Biru Logo */
            box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.1); /* Glow biru */
        }

        /* TEXTAREA ALAMAT LENGKAP (CUSTOM BAGUS) */
        textarea.form-control {
            height: 120px !important; /* Lebih tinggi */
            resize: none; /* Tidak bisa ditarik manual agar tetap rapi */
            line-height: 1.5;
        }

        /* DROPDOWN */
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%231e3c72' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px 12px;
            padding-right: 40px;
            cursor: pointer;
        }

        /* TOMBOL REGISTER */
        .btn-register {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            color: white;
            font-weight: 800;
            font-size: 1rem;
            padding: 14px;
            border-radius: 50px;
            width: 100%;
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 20px;
        }

        .btn-register:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.4);
            color: white;
        }

        /* LINK LOGIN */
        .login-footer {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95rem;
            color: #6c757d;
        }

        .login-footer a {
            color: #1e3c72;
            font-weight: 800;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
            color: #2a5298;
        }
        
        /* Style untuk tombol login manual di notifikasi */
        .btn-manual-login {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); /* <--- DIUBAH: Warna biru sesuai logo */
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            transition: background-color 0.2s;
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3); /* Tambahkan shadow */
        }
        .btn-manual-login:hover {
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%); /* Efek hover kebalik */
            color: white;
            text-decoration: none;
            transform: translateY(-2px); /* Efek sedikit naik */
            box-shadow: 0 8px 20px rgba(30, 60, 114, 0.4);
        }

    </style>
</head>

<body>
    
    <div class="card-register">
        <div class="text-center mb-4">
             
             <img src="<?php echo e(asset('gambar/ANMS-logo.png')); ?>" alt="logo" width="100" style="height: auto;">
             
             <h4 class="mt-3" style="color: #1e3c72; font-weight: 800;">Daftar Akun Baru</h4>
             <p class="text-muted small">Silakan lengkapi data diri Anda di bawah ini</p>
        </div>

        
        <?php if(session('success')): ?>
        <div class="alert alert-success fade show shadow-sm border-0 mb-4" role="alert" style="background-color: #d1fae5; color: #065f46; border-radius: 10px;">
            <div class="d-flex align-items-center mb-2">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>Berhasil!</strong> &nbsp; <?php echo e(session('success')); ?>

            </div>
            
            <p class="mb-0">
                <i class="fas fa-arrow-right mr-2"></i> Silakan klik tombol di bawah ini untuk masuk ke akun Anda.
            </p>
            
            
            <a href="<?php echo e(route('login')); ?>" class="btn-manual-login">
                <i class="fas fa-sign-in-alt mr-1"></i> Masuk (Login) Sekarang
            </a>
            
        </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
        <div class="alert alert-danger fade show shadow-sm border-0 mb-4" role="alert" style="background-color: #fee2e2; color: #991b1b; border-radius: 10px;">
            <ul class="mb-0 pl-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        
        
        <?php if(!session('success')): ?>
        <form method="POST" action="<?php echo e(route('register.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" value="<?php echo e(old('nama_lengkap')); ?>" required>
            </div>

            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" name="email" class="form-control" placeholder="contoh@email.com" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Min. 8 karakter" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>No. WhatsApp / Telepon</label>
                <input type="number" name="no_telp" class="form-control" placeholder="08xxxxxxxxxx" value="<?php echo e(old('no_telp')); ?>" required>
            </div>

            
            <div class="form-group">
                <label>NIM (Nomor Induk Mahasiswa)</label>
                <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" value="<?php echo e(old('nim')); ?>" required>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota Kelahiran" value="<?php echo e(old('tempat_lahir')); ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo e(old('tanggal_lahir')); ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_lengkap" class="form-control" placeholder="Masukkan alamat lengkap anda" required><?php echo e(old('alamat_lengkap')); ?></textarea>
            </div>

            <div class="form-group mt-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="agree" class="custom-control-input" id="agree" required>
                    <label class="custom-control-label text-muted small" for="agree">
                        Saya menyetujui <a href="#">Syarat & Ketentuan</a> yang berlaku.
                    </label>
                </div>
            </div>

            <button type="submit" class="btn-register">
                Daftar Sekarang
            </button>

            <div class="login-footer">
                Sudah punya akun? <a href="<?php echo e(url('login')); ?>">Masuk Disini</a>
            </div>

        </form>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/auth/register.blade.php ENDPATH**/ ?>