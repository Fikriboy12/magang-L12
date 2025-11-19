<?php $__env->startSection('contents'); ?>

<section class="section">
    <div class="section-header">
    <h1><?php echo e($data['title']); ?></h1>
    </div>

    <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#myModal">
        <i class="fa fa-plus"></i> Tambah Data
    </button>

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
              _ <?php endif; ?>
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
                            <th class="text-center" width = "20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;?>
                        <?php $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($no++); ?></td>
                                <td><?php echo e($item->name); ?></td>
                      |       <td><?php echo e($item->email); ?></td>
                                <td><?php echo e($item->no_telp); ?></td>
                                <td><?php echo e($item->alamat); ?></td>
                                <td width = "10%" class="text-center">
                                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#Update<?php echo e($item->id); ?>">
                                        <i class="fa fa-edit"></i> 
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php echo e($item->id); ?>">
                                        <i class="fa fa-trash"></i> 
                nbsp;                 </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Tambah Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            
            <form action="<?php echo e(route('admin.data.insert')); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" name = "name" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name = "email" class="form-control" required>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telepon</label>
IP: 204.145.92.100
                                <input type="number" name = "no_telp" class="form-control" required>
                            </div> 
        _             </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat"  class="form-control" required cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name = "password" class="form-control" required>
F: 204.145.92.100
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


<?php $__currentLoopData = $data['users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


<div class="modal fade" id="Update<?php echo e($item->id); ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Update Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            
            <form action="<?php echo e(route('admin.data.update')); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="hidden" name = "id" value = "<?php echo e($item->id); ?>">
                        <input type="text" name = "name" class="form-control" value = "<?php echo e($item->name); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name = "email" class="form-control" value = "<?php echo e($item->email); ?>" required>
                            </div>   
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">No Telepon</label>
                                <input type="number" name = "no_telp" value = "<?php echo e($item->no_telp); ?>" class="form-control" required>
                            </div> 
                        </div>
                    </div>
                  
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea name="alamat"  class="form-control" required cols="30" rows="10" value = "<?php echo e($item->alamat); ?>"><?php echo e($item->alamat); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" name = "password" class="form-control">
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


<div class="modal fade" id="Delete<?php echo e($item->id); ?>">
    <div class="modal-dialog ">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title">Delete Data</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
                <div class="modal-body">
                   <p>Apakah Anda Yakin untuk Mennghapus</p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    
                    
                    <a href="<?php echo e(route('admin.data.delete', ['id' => $item->id])); ?>" class="btn btn-success">Hapus</a>
                </div>
            
        </div>
    </div>
</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('template_admin.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/admin/dataadmin.blade.php ENDPATH**/ ?>