

 

<?php $__env->startSection('title', 'Daftar Laporan Harian'); ?>


<?php $__env->startSection('contents'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Laporan Harian Saya</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Daftar Laporan yang Sudah Di-submit</h3>
                        
                        <a href="<?php echo e(route('mahasiswa.laporan.create')); ?>" class="btn btn-success">
                            <i class="fas fa-plus"></i> Tambah Laporan Baru
                        </a>
                    </div>

                    <div class="card-body">
                        
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>

                        
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
                                                // Ubah path 'public/...' menjadi 'storage/...'
                                                $fotoUrl = asset('storage/' . str_replace('public/', '', $laporan->foto));
                                            ?>
                                            <a href="<?php echo e($fotoUrl); ?>" target="_blank" class="btn btn-info btn-sm">
                                                Lihat Foto
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Anda belum membuat laporan harian.</td>
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
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/mahasiswa/laporan_create.blade.php ENDPATH**/ ?>