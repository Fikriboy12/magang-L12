

<?php $__env->startSection('content'); ?>
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center rounded-top-4" style="background-color: #370cf3ff;">
                    <h4 class="mb-0 fw-bold" style="f@extends('layouts.app')

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 rounded-4" style="max-width: 650px; width: 100%;">
        <div class="card-header text-white text-center rounded-top-4" style="background-color: #370cf3ff;">
            <h4 class="mb-0 fw-semibold">Form Pendaftaran Magang</h4>
        </div>

        <div class="card-body p-4" style="background-color: #f8faff;">

            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            
            <?php if(session('err_message')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <?php echo e(session('err_message')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

            
            <form method="POST" action="<?php echo e(url('insert-pendaftaran')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Universitas</label>
                    <input type="text" name="universitas" class="form-control" value="<?php echo e(old('universitas')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Jurusan</label>
                    <input type="text" name="jurusan" class="form-control" value="<?php echo e(old('jurusan')); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Program Studi</label>
                    <input type="text" name="program_studi" class="form-control" value="<?php echo e(old('program_studi')); ?>" required>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col">
                        <label class="form-label fw-semibold">Dari Tanggal</label>
                        <input type="date" name="dari_tanggal" class="form-control" value="<?php echo e(old('dari_tanggal')); ?>" required>
                    </div>
                    <div class="col">
                        <label class="form-label fw-semibold">Sampai Tanggal</label>
                        <input type="date" name="sampai_tanggal" class="form-control" value="<?php echo e(old('sampai_tanggal')); ?>" required>
                    </div>
                </div>

                <?php $__currentLoopData = ['gambar'=>'Gambar','cv'=>'CV','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal','sertifikat'=>'Sertifikat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="mb-3">
                        <label class="form-label fw-semibold"><?php echo e($label); ?></label>
                        <input type="file" name="<?php echo e($name); ?>" class="form-control">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Daftar Sekarang</button>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
ont-size: 1.2rem;">Form Pendaftaran Magang</h4>
                </div>
                <div class="card-body p-4" style="background-color: #e7f0ff;">

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    
                    <?php if(session('err_message')): ?> 
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?php echo e(session('err_message')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

                    <form method="POST" action="<?php echo e(url('insert-pendaftaran')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="mb-3">
                            <label>Universitas</label>
                            <input type="text" name="universitas" class="form-control" value="<?php echo e(old('universitas')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Jurusan</label>
                            <input type="text" name="jurusan" class="form-control" value="<?php echo e(old('jurusan')); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label>Program Studi</label>
                            <input type="text" name="program_studi" class="form-control" value="<?php echo e(old('program_studi')); ?>" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label>Dari Tanggal</label>
                                <input type="date" name="dari_tanggal" class="form-control" value="<?php echo e(old('dari_tanggal')); ?>" required>
                            </div>
                            <div class="col">
                                <label>Sampai Tanggal</label>
                                <input type="date" name="sampai_tanggal" class="form-control" value="<?php echo e(old('sampai_tanggal')); ?>" required>
                            </div>
                        </div>

                        <?php $__currentLoopData = ['gambar'=>'Gambar','cv'=>'CV','surat_rekomendasi'=>'Surat Rekomendasi','ktp'=>'KTP / KTM','proposal'=>'Proposal','sertifikat'=>'Sertifikat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-3">
                                <label><?php echo e($label); ?></label>
                                <input type="file" name="<?php echo e($name); ?>" class="form-control">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Daftar Sekarang</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pelamar/pendaftaran.blade.php ENDPATH**/ ?>