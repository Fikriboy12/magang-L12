



<?php $__env->startSection('title', 'Detail Laporan Mahasiswa'); ?>


<?php $__env->startSection('contents'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Detail Laporan Harian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo e(route('pembimbing.dashboard')); ?>">Dashboard</a></li>
              <li class="breadcrumb-item active">Detail Laporan</li>
            </ol>
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
                    <div class="card-header">
                        <h3 class="card-title">Mahasiswa: <strong><?php echo e($mahasiswa->name); ?></strong></h3>
                    </div>
                    <div class="card-body">
                        <?php if($laporanList->isEmpty()): ?>
                            <div class="alert alert-warning text-center">
                                Mahasiswa ini belum meng-upload laporan harian.
                            </div>
                        <?php else: ?>
                            
                            <div class="timeline">
                                <?php $__currentLoopData = $laporanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-primary"><?php echo e(\Carbon\Carbon::parse($laporan->tanggal)->format('d F Y')); ?></span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-check bg-green"></i>
                                        <div class="timeline-item">
                                            <span class="time"><i class="fas fa-clock"></i> <?php echo e($laporan->created_at->format('H:i')); ?></span>
                                            <h3 class="timeline-header"><strong>Kegiatan:</strong></h3>

                                            <div class="timeline-body">
                                                <?php echo e($laporan->kegiatan); ?>


                                                <?php if($laporan->catatan): ?>
                                                    <hr>
                                                    <p><strong>Catatan:</strong> <?php echo e($laporan->catatan); ?></p>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="timeline-footer">
                                                <?php
                                                    // Mengubah path 'public/laporan_harian/file.jpg' menjadi 'storage/laporan_harian/file.jpg'
                                                    $fotoUrl = asset('storage/'... str_replace('public/', '', $laporan->foto));
                                                ?>
                                                <a href="<?php echo e($fotoUrl); ?>" target="_blank" class="btn btn-info btn-sm">
                                                    <i class="fas fa-image"></i> Lihat Foto
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <div>
                                    <i class="fas fa-clock bg-gray"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template_admin.master_pembimbing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pembimbing/laporan_detail.blade.php ENDPATH**/ ?>