

<?php $__env->startSection('title', 'Buat Laporan Harian'); ?>

<?php $__env->startSection('contents'); ?>
<div class="content-wrapper">
    <!-- Header -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Form Laporan Harian</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            
            
            <div class="col-12 mb-4">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Isi Laporan Harian</h3>
                    </div>
                    
                    
                    
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger m-3">
                            <strong>Gagal Upload!</strong> Silakan periksa inputan Anda:<br>
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    
                    <form action="<?php echo e(route('mahasiswa.laporan.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            
                            
                            <div class="form-group">
                                <label>Tanggal Kegiatan</label>
                                <input type="date" name="tanggal" class="form-control" value="<?php echo e(old('tanggal', date('Y-m-d'))); ?>" required>
                            </div>

                            
                            <div class="form-group">
                                <label>Deskripsi Kegiatan </label>
                                <textarea name="kegiatan" class="form-control" rows="3" placeholder="Ceritakan kegiatan hari ini..." required><?php echo e(old('kegiatan')); ?></textarea>
                                <small class="text-muted">.</small>
                            </div>

                            
                            <div class="form-group">
                                <label>Foto Dokumentasi (Wajib, Max 2MB)</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        
                                        <input type="file" name="foto" class="custom-file-input" id="fotoInput" accept="image/*" required>
                                        <label class="custom-file-label" for="fotoInput">Pilih file foto...</label>
                                    </div>
                                </div>
                                <small class="text-danger">* Pastikan format jpg, jpeg, atau png.</small>
                            </div>

                            
                            <div class="form-group">
                                <label>Catatan Tambahan (Opsional)</label>
                                <textarea name="catatan" class="form-control" rows="2"><?php echo e(old('catatan')); ?></textarea>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Laporan</button>
                            <a href="<?php echo e(route('mahasiswa.laporan.index')); ?>" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Riwayat Laporan Sebelumnya</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kegiatan</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $laporanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($laporan->tanggal)->format('d M Y')); ?></td>
                                        <td><?php echo e(Str::limit($laporan->kegiatan, 70)); ?></td>
                                        <td>
                                            <?php
                                                $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                            ?>
                                            <a href="<?php echo e($fotoUrl); ?>" target="_blank" class="btn btn-info btn-sm">
                                                <i class="fas fa-image"></i> Lihat
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Belum ada laporan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
      </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Script agar nama file muncul saat dipilih -->
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/mahasiswa/laporan_create.blade.php ENDPATH**/ ?>