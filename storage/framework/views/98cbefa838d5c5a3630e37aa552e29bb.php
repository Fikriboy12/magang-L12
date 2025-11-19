<?php $__env->startSection('contents'); ?>
<div class="blog-page area-padding">
    <div class="container">
        <div class="card mt-5">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="text-center"><h2>HASIL LAMARAN</h2></div>
                    <hr>
                    <?php if(session()->has('err_message')): ?>
                        <div class="alert alert-danger alert-dismissible" role="alert" auto-close="120">
                            <strong>Error! </strong><?php echo e(session()->get('err_message')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php if(session()->has('suc_message')): ?>
                        <div class="alert alert-success alert-dismissible" role="alert" auto-close="120">
                            <strong>Success! </strong><?php echo e(session()->get('suc_message')); ?>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead >
                            <tr >
                                <th width = "5%">No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th class="text-center" width = "20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php $__currentLoopData = $data['data_lamaran']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($item->nama_lengkap); ?></td>
                                 
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->no_telp); ?></td>
                                    <td><?php echo e($item->dari_tanggal); ?></td>
                                    <td><?php echo e($item->sampai_tanggal); ?></td>
                                    <td><?php echo e($item->keterangan); ?></td>
                                    <td><?php echo e($item->status_pendaftaran); ?></td>
                                    <td width = "20%" class="text-center">
                                        <a href="<?= url('detail-lamaran/' . $item->id_pendaftaran) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <?php if($item->status_pendaftaran == 'diterima'): ?>
                                            <a href="<?= url('cetak-lamaran/' . $item->id_pendaftaran) ?>" class="btn btn-warning btn-sm" target = "_BLANK"><i class="fas fa-print"></i></a>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-placement="top" title="Pengajuan Sertifikat" data-target="#Update">
                                                <i class="fa fa-file"></i> 
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="text-center"><h2>Hasil Sertifikat</h2></div>
                    <hr>
                  
                    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead >
                            <tr >
                                <th width = "5%">No.</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th class="text-center" width = "20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php $__currentLoopData = $data['data_sertifikat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($item->nama_sertifikat); ?></td>
                                    <td><?php echo e($item->status_pengajuan); ?></td>
                                    <td class="text-center">
                                        <?php if($item->status_pengajuan == 'acc'): ?>
                                            <a href="<?= url('cetak-sertifikat/' . $item->id_sertifikat) ?>" class="btn btn-warning btn-sm" target = "_BLANK"><i class="fas fa-print"></i></a>
                                        
                                        <?php else: ?>
                                            <a href="<?= url('delete-sertifikat/' . $item->id_sertifikat) ?>" class="btn btn-danger btn-sm" target = "_BLANK"><i class="fas fa-trash"></i></a>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-placement="top" title="Pengajuan Sertifikat" data-target="#Edit<?php echo e($item->id_sertifikat); ?>">
                                                <i class="fa fa-edit"></i> 
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="Update">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Pengajuan Sertifikat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo e(url('insert-sertifikat')); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Masukkan Nama Untuk Sertifikat</label>
                        <input type="text" name = "nama_sertifikat" class="form-control" required>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php $__currentLoopData = $data['data_sertifikat']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="Edit<?php echo e($item->id_sertifikat); ?>">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Pengajuan Sertifikat</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="<?php echo e(url('update-sertifikat')); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Masukkan Nama Untuk Sertifikat</label>
                        <input type="text" name = "nama_sertifikat" class="form-control" value = "<?php echo e($item->nama_sertifikat); ?>" required>
                    </div>
                    
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pelamar/datalamaran.blade.php ENDPATH**/ ?>