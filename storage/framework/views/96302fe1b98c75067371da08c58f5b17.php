<?php $__env->startSection('contents'); ?>


<section class="section">
    <div class="section-header">
    <h1><?php echo e($data['title']); ?></h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-12 col-sm-12">
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
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                
                <!-- PERBAIKAN: Pembungkus Responsif Ditambahkan di sini -->
                <div class="table-responsive">

                    <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                        <thead >
                            <tr >
                                <th width = "5%">No.</th>
                                <th>Nama</th>
                                <th>Universitas</th>
                                <th>Jurusan</th>
                                <th>Gambar</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Dari Tanggal</th>
                                <th>Sampai Tanggal</th>
                                <th>Status</th>
                                <th class="text-center" width = "20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;?>
                            <?php $__currentLoopData = $data['data_pendaftaran']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($no++); ?></td>
                                    <td><?php echo e($item->nama_lengkap); ?></td>
                                    <td><?php echo e($item->universitas); ?></td>
                                    <td><?php echo e($item->jurusan); ?></td>
                                    <td width = "10%" class ="text-center"><img src="<?= asset('')?>gambar/<?= $item->gambar?>" alt="" width ="90%"></td>
                                    <td><?php echo e($item->email); ?></td>
                                    <td><?php echo e($item->no_telp); ?></td>
                                    <td><?php echo e($item->dari_tanggal); ?></td>
                                    <td><?php echo e($item->sampai_tanggal); ?></td>
                                    <td><?php echo e($item->status_pendaftaran); ?></td>
                                    <td width = "10%" class="text-center">
                                        <a href="<?= url('detail-pendaftaran/' . $item->id_pendaftaran) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            
                        </tbody>
                    </table>

                </div>
                <!-- AKHIR Pembungkus Responsif -->

            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('template_admin.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/admin/datapendaftaran.blade.php ENDPATH**/ ?>