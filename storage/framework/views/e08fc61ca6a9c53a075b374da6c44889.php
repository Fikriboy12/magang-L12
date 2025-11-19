<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Aplikasi Magang</title>
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/modules/bootstrap/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/modules/fontawesome/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/modules/jquery-selectric/selectric.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets_admin/css/components.css')); ?>">

    <style>
        :root {
            --logo-color: #1321e9ff;
            --logo-color-dark: #0b0bb9;
        }

        .btn-primary {
            background-color: var(--logo-color) !important;
            border-color: var(--logo-color) !important;
        }

        .btn-primary:hover {
            background-color: var(--logo-color-dark) !important;
            border-color: var(--logo-color-dark) !important;
        }

        p.text-center a {
            color: var(--logo-color);
            font-weight: 500;
        }

        p.text-center a:hover {
            color: var(--logo-color-dark);
        }
    </style>
</head>

<body style="background: linear-gradient(135deg, #1e3c72, #2a5298); min-height:100vh; display:flex; align-items:center; justify-content:center;">
    
    <div class="card" style="background: rgba(255,255,255,0.95); border-radius:15px; padding:30px; max-width:450px; width:100%; box-shadow:0 10px 25px rgba(0,0,0,0.2);">
        <div class="text-center mb-4">
             <img src="<?php echo e(asset('gambar/ANMS-logo.png')); ?>" alt="logo" width="200" style="height: auto;">
            <h3 class="mt-2">Register Akun Pelamar</h3>
        </div>

        
        <?php if(session('register_success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('register_success')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php endif; ?>

        
        <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        
        <form method="POST" action="<?php echo e(route('register.store')); ?>">
            <?php echo csrf_field(); ?>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo e(old('nama_lengkap')); ?>" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo e(old('email')); ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="form-group">
                <label>No. Telp</label>
                <input type="text" name="no_telp" class="form-control" value="<?php echo e(old('no_telp')); ?>" required>
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo e(old('alamat')); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label>NIM</label>
                    <input type="text" name="nim" class="form-control" value="<?php echo e(old('nim')); ?>" required>
                </div>
                <div class="form-group col-6">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" value="<?php echo e(old('nik')); ?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-6">
                    <label>Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="<?php echo e(old('tempat_lahir')); ?>" required>
                </div>
                <div class="form-group col-6">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo e(old('tanggal_lahir')); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">--Pilih--</option>
                    <option value="laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
            </div>

            <div class="form-group">
                <label>Agama</label>
                <select name="agama" class="form-control" required>
                    <option value="">--Pilih--</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Khonghucu">Khonghucu</option>
                </select>
            </div>

            <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea name="alamat_lengkap" class="form-control" rows="3" required><?php echo e(old('alamat_lengkap')); ?></textarea>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" name="agree" class="form-check-input" id="agree" required>
                <label class="form-check-label" for="agree">Saya setuju dengan syarat & ketentuan</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block" style="border-radius:50px;">Register</button>
        </form>

        <p class="text-center mt-3">
            Sudah punya akun? <a href="<?php echo e(url('login')); ?>">Login</a>
        </p>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/auth/register.blade.php ENDPATH**/ ?>