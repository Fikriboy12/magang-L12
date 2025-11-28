

<?php $__env->startSection('content'); ?>


<style>
    /* Background Halaman Biru Gradient */
    body {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
        font-family: 'Nunito', sans-serif;
        min-height: 100vh;
    }

    /* Header Kartu */
    .card-header-custom {
        background: #ffffff;
        color: #1e3c72;
        padding: 25px;
        border-radius: 15px 15px 0 0 !important;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
    }

    .card-header-custom h4 {
        font-weight: 800;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        font-size: 1.5rem;
    }

    /* Kartu Utama */
    .card-custom {
        border: none;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        margin-top: 30px;
        margin-bottom: 30px;
        background: white;
        overflow: hidden;
    }

    /* Label Input */
    .form-label {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 6px;
        font-size: 0.85rem;
    }

    /* Input Field Modern */
    .form-control {
        border: 1px solid #d1d3e2;
        border-radius: 8px;
        padding: 10px 15px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        color: #495057;
    }

    .form-control:focus {
        border-color: #1e3c72;
        box-shadow: 0 0 0 4px rgba(30, 60, 114, 0.15);
    }

    /* Input File Ramping */
    input[type="file"] {
        padding: 8px;
        background-color: #f8f9fc;
        font-size: 0.85rem;
    }

    input[type="file"]::-webkit-file-upload-button {
        background-color: #1e3c72;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 10px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: 0.3s;
    }

    input[type="file"]::-webkit-file-upload-button:hover {
        background-color: #2a5298;
    }

    /* Tombol Submit */
    .btn-submit-custom {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        font-weight: 700;
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        width: 100%;
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(30, 60, 114, 0.2);
        margin-top: 15px;
    }

    .btn-submit-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
        color: white;
    }

    .alert-custom {
        border-radius: 10px;
        border: none;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card card-custom">
                
                <div class="card-header-custom">
                    <h4 class="mb-1">Form Pendaftaran Magang</h4>
                    <p class="mb-0 text-muted small">Lengkapi data berkas Anda di bawah ini</p>
                </div>

                <div class="card-body p-4">

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show alert-custom mb-3" role="alert" style="background-color: #d1fae5; color: #065f46;">
                            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('err_message')): ?>
                        <div class="alert alert-danger alert-dismissible fade show alert-custom mb-3" role="alert" style="background-color: #fee2e2; color: #991b1b;">
                            <i class="fas fa-exclamation-circle me-2"></i> <?php echo e(session('err_message')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-custom mb-3" style="background-color: #fee2e2; color: #991b1b;">
                            <ul class="mb-0 ps-3 small">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo e(url('insert-pendaftaran')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label class="form-label">Universitas</label>
                            <input type="text" name="universitas" class="form-control" placeholder="Nama Universitas" value="<?php echo e(old('universitas')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" placeholder="Jurusan" value="<?php echo e(old('jurusan')); ?>" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Program Studi</label>
                            <input type="text" name="prodi" class="form-control" placeholder="Program Studi" value="<?php echo e(old('prodi')); ?>" required>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label">Dari Tanggal</label>
                                <input type="date" name="dari_tanggal" class="form-control" value="<?php echo e(old('dari_tanggal')); ?>" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label">Sampai Tanggal</label>
                                <input type="date" name="sampai_tanggal" class="form-control" value="<?php echo e(old('sampai_tanggal')); ?>" required>
                            </div>
                        </div>

                        <hr class="my-4" style="border-top: 1px dashed #e3e6f0;">
                        
                        <div class="mb-3 text-center">
                            <h6 class="fw-bold" style="color: #1e3c72; font-size: 0.9rem;">
                                <i class="fas fa-cloud-upload-alt me-1"></i> Upload Berkas
                            </h6>
                        </div>

                        <?php $__currentLoopData = ['gambar'=>'Foto Diri','cv'=>'CV','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal Magang']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-3">
                                <label class="form-label"><?php echo e($label); ?></label>
                                <input type="file" name="<?php echo e($name); ?>" class="form-control">
                                <div class="form-text text-muted" style="font-size: 0.7rem;">Max: 2MB (PDF/JPG/PNG)</div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <button type="submit" class="btn btn-submit-custom">
                            Daftar Sekarang <i class="fas fa-arrow-right ms-2"></i>
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pelamar/pendaftaran.blade.php ENDPATH**/ ?>