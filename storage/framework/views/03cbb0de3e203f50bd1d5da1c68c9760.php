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
                <table id="table" class="table table-striped table-hover" cellspacing="0" width="100%">
                    <thead >
                        <tr >
                            <th width = "5%">No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th class="text-center" width = "20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php $__currentLoopData = $data['data_pelamar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($item->name); ?></td>
                                <td><?php echo e($item->email); ?></td>
                                <td><?php echo e($item->no_telp); ?></td>
                                <td><?php echo e($item->alamat); ?></td>
                                <th>
                                    <?php if($item->status == 1): ?>
                                        <div class="badge badge-primary">Lengkap</div>
                                    <?php else: ?>
                                        <div class="badge badge-warning">Tidak Lengkap</div>
                                    <?php endif; ?>
                                </th>
                                <td width = "10%" class="text-center">
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#Update<?php echo e($item->id); ?>">
                                        <i class="fa fa-eye"></i> 
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>

<?php $__currentLoopData = $data['data_pelamar']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<div class="modal fade" id="Update<?php echo e($item->id); ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Detail Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
       
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="hidden" name = "id" value = "<?php echo e($item->id); ?>">
                        <input type="text" name = "name" class="form-control" value = "<?php echo e($item->name); ?>" required readonly>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name = "email" class="form-control" value = "<?php echo e($item->email); ?>" required readonly>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="number" name = "no_telp" value = "<?php echo e($item->no_telp); ?>" class="form-control" required readonly>
                            </div> 
                        </div>
                    </div>
                  
                    <div class="row">
                        <div class="form-group col-6">
                            <label>NIM</label>
                            <input type="text" name = "nim" class="form-control" required value = "<?php echo e($item->nim); ?>" readonly>
                        </div>
                        <div class="form-group col-6">
                            <label>NIK</label>
                            <input type="text" name = "nik" class="form-control" required value = "<?php echo e($item->nik); ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group ">
                          <label for="frist_name">Nama Lengkap</label>
                          <input id="frist_name" type="text" class="form-control" name="nama_lengkap" autofocus required value = "<?php echo e($item->nama_lengkap); ?>" readonly>
                      </div>
                      <div class="row">
                          <div class="form-group col-6">
                              <label>Tempat Lahir</label>
                              <input type="text" name = "tempat_lahir" class="form-control" required value = "<?php echo e($item->tempat_lahir); ?>" readonly>
                          </div>
                          <div class="form-group col-6">
                              <label>Tanggal Lahir</label>
                              <input type="date" name = "tanggal_lahir" class="form-control" required value = "<?php echo e($item->tanggal_lahir); ?>" readonly>
                          </div>
                      </div>
                      <div class="form-group">
                          <label>Jenis Kelamin</label>
                          <input type="text" name = "jenis_kelamin" class="form-control" required value = "<?php echo e($item->jenis_kelamin); ?>" readonly>
                      </div>
  
        
                      <div class="form-group">
                          <label>Agama</label>
                          <input type="text" name = "agama" class="form-control" required value = "<?php echo e($item->agama); ?>" readonly>
                      </div>
                  
                      <div class="form-group">
                        <label>Alamat Lengkap</label>
                          <textarea name="alamat_lengkap" id="" required value = "<?php echo e($item->alamat_lengkap); ?>" readonly class="form-control" cols="30" rows="10"><?php echo e($item->alamat_lengkap); ?></textarea>
                      </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                 
                </div>
         
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('template_admin.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/admin/datapelamar.blade.php ENDPATH**/ ?>