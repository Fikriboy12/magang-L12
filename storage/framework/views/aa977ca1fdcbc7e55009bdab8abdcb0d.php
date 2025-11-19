


<?php $__env->startSection('title', 'Dashboard Pembimbing'); ?>

<?php $__env->startSection('contents'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          
          
          
          
          <div class="col-sm-6">
            
          </div>

          
          
          
          <div class="col-sm-6">
            
          </div>
        
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" style="margin-top: -20px;"> 
      <div class="container-fluid">
        
   
        <div class="row">
            <div class="col-12">
                
                <div class="card text-white" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
                    <div class="card-body">
                        <h4 class="card-title text-white">Selamat Datang, <?php echo e(Auth::user()->name); ?>!</h4>
                        <p class="card-text">
                            Di sini Anda dapat memantau laporan harian dari mahasiswa bimbingan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kartu Info -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Mahasiswa Bimbingan</span>
                <span class="info-box-number">
                  <?php echo e($mahasiswaList->count()); ?> <small>Orang</small>
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.row -->


        <!-- Tabel Mahasiswa -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Mahasiswa Bimbingan Anda</h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $mahasiswaList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mahasiswa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($mahasiswa->name); ?></td>
                                    <td><?php echo e($mahasiswa->email); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('pembimbing.laporan.mahasiswa', $mahasiswa->id)); ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Lihat Laporan Harian
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada mahasiswa bimbingan.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('template_admin.master_pembimbing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pembimbing/dashboard.blade.php ENDPATH**/ ?>