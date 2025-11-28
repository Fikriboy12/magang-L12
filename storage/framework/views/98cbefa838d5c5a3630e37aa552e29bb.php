 

<?php $__env->startSection('title', 'Hasil Lamaran & Sertifikat'); ?>

<?php $__env->startSection('contents'); ?>


<style>
    /* Header Biru Modern */
    .hd-header {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
        color: white !important;
        padding: 25px 30px;
        border-radius: 15px 15px 0 0;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .card-modern {
        border: none !important;
        border-radius: 15px !important;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08) !important;
        background: #fff;
        overflow: hidden;
        margin-bottom: 40px;
    }

    .table-hd thead th {
        background-color: #f8fafc !important;
        color: #475569 !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-bottom: 2px solid #e2e8f0 !important;
        padding: 15px 10px !important;
        vertical-align: middle !important;
        white-space: nowrap;
    }

    .table-hd tbody td {
        padding: 15px 10px !important;
        vertical-align: middle !important;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        font-size: 0.9rem;
    }

    .date-box {
        display: flex; flex-direction: column; gap: 4px; font-size: 0.85rem;
    }
    
    .date-item {
        display: flex; align-items: center; gap: 6px; white-space: nowrap;
    }

    .badge-status {
        padding: 6px 12px; border-radius: 50px; font-weight: 600;
        font-size: 0.75rem; display: inline-flex; align-items: center; white-space: nowrap;
    }
    
    .bg-success-soft { background-color: #d1fae5; color: #065f46; }
    .bg-danger-soft { background-color: #fee2e2; color: #991b1b; }
    .bg-warning-soft { background-color: #fef3c7; color: #92400e; }

    /* Action Buttons */
    .btn-action {
        width: 32px; height: 32px; display: inline-flex;
        align-items: center; justify-content: center;
        border-radius: 8px; transition: 0.3s; border: none; margin: 0 2px; font-size: 0.85rem;
        text-decoration: none !important;
    }
    
    .btn-view { background: #eff6ff; color: #2563eb; }
    .btn-view:hover { background: #2563eb; color: white; }

    .btn-print { background: #fffbeb; color: #d97706; }
    .btn-print:hover { background: #d97706; color: white; }

    /* Tombol Ajukan Sertifikat */
    .btn-ajukan { background: #ecfdf5; color: #059669; cursor: pointer; }
    .btn-ajukan:hover { background: #059669; color: white; }

</style>

<div class="content-wrapper" style="background-color: #f8fafc; min-height: 90vh;">
    
    <section class="content pt-5 pb-5">
      <div class="container">
        
        
        <div class="row justify-content-center">
            <div class="col-12">
                
                <div class="card card-modern">
                    <div class="hd-header">
                        <div>
                            <h4 class="m-0 font-weight-bold">
                                <i class="fas fa-file-contract mr-2"></i> Hasil Lamaran
                            </h4>
                            <small style="opacity: 0.9;">Status pendaftaran magang Anda saat ini.</small>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        
                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <table id="example1" class="table table-hd table-hover w-100" style="min-width: 900px;">
                                <thead>
                                    <tr>
                                        <th style="width: 5%" class="text-center">No</th>
                                        <th style="width: 20%">Nama Lengkap</th>
                                        <th style="width: 20%">Kontak</th>
                                        <th style="width: 15%">Periode Magang</th>
                                        <th>Keterangan</th>
                                        <th class="text-center" style="width: 10%">Status</th>
                                        <th class="text-center" style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data_lamaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?> 
                                    <tr>
                                        <td class="text-center font-weight-bold text-muted"><?php echo e($loop->iteration); ?></td>
                                        
                                        <td>
                                            <span class="font-weight-bold text-primary" style="font-size: 0.95rem;">
                                                <?php echo e($item->user->name ?? Auth::user()->name); ?>

                                            </span>
                                        </td>
                                        
                                        <td>
                                            <div style="display: flex; flex-direction: column; gap: 3px;">
                                                <span style="font-size: 0.85rem; color: #555;">
                                                    <i class="far fa-envelope mr-1 text-muted"></i> 
                                                    <?php echo e(Str::limit($item->user->email ?? Auth::user()->email, 20)); ?>

                                                </span>
                                                <span style="font-size: 0.85rem; color: #555;">
                                                    <i class="fas fa-phone-alt mr-1 text-muted"></i> 
                                                    <?php echo e($item->user->no_telp ?? '-'); ?>

                                                </span>
                                            </div>
                                        </td>
                                        
                                        <td>
                                            <div class="date-box">
                                                <div class="date-item text-success">
                                                    <i class="fas fa-calendar-check"></i> 
                                                    <span><?php echo e(\Carbon\Carbon::parse($item->dari_tanggal)->format('d M Y')); ?></span>
                                                </div>
                                                <div class="date-item text-danger">
                                                    <i class="fas fa-calendar-times"></i> 
                                                    <span><?php echo e(\Carbon\Carbon::parse($item->sampai_tanggal)->format('d M Y')); ?></span>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <span class="text-muted" style="font-size: 0.85rem; font-style: italic;">
                                                <?php echo e($item->keterangan ?? '-'); ?>

                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <?php if($item->status_pendaftaran == 'diterima'): ?>
                                                <span class="badge-status bg-success-soft">
                                                    <i class="fas fa-check-circle mr-1"></i> Diterima
                                                </span>
                                            <?php elseif($item->status_pendaftaran == 'ditolak'): ?>
                                                <span class="badge-status bg-danger-soft">
                                                    <i class="fas fa-times-circle mr-1"></i> Ditolak
                                                </span>
                                            <?php else: ?>
                                                <span class="badge-status bg-warning-soft">
                                                    <i class="fas fa-clock mr-1"></i> Proses
                                                </span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                
                                                <a href="<?php echo e(url('detail-lamaran/'.$item->id_pendaftaran)); ?>" class="btn-action btn-view" title="Detail" data-toggle="tooltip">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                
                                                
                                                <a href="<?php echo e(url('cetak-lamaran/'.$item->id_pendaftaran)); ?>" class="btn-action btn-print" target="_blank" title="Cetak Bukti" data-toggle="tooltip">
                                                    <i class="fas fa-print"></i>
                                                </a>

                                                
                                                <?php if($item->status_pendaftaran == 'diterima'): ?>
                                                    <button type="button" class="btn-action btn-ajukan" data-toggle="modal" data-target="#modalAjukan<?php echo e($item->id_pendaftaran); ?>" title="Ajukan Sertifikat">
                                                        <i class="fas fa-file-signature"></i>
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn-action btn-secondary" disabled style="cursor: not-allowed; opacity: 0.5;" title="Menunggu Diterima">
                                                        <i class="fas fa-lock"></i>
                                                    </button>
                                                <?php endif; ?>
                                            </div>

                                            
                                            <div class="modal fade" id="modalAjukan<?php echo e($item->id_pendaftaran); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                                        <div class="modal-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                                                            <h5 class="modal-title font-weight-bold">Ajukan Sertifikat</h5>
                                                            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body text-center py-4">
                                                            <i class="fas fa-certificate fa-3x text-warning mb-3"></i>
                                                            <p class="mb-0 font-weight-bold text-dark">Apakah Anda yakin ingin mengajukan sertifikat?</p>
                                                            <p class="small text-muted">Pastikan Anda telah menyelesaikan periode magang.</p>
                                                        </div>
                                                        <div class="modal-footer justify-content-center border-0 pb-4">
                                                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-dismiss="modal">Batal</button>
                                                            
                                                            <form action="<?php echo e(url('insert-sertifikat')); ?>" method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="hidden" name="id_pendaftaran" value="<?php echo e($item->id_pendaftaran); ?>">
                                                                <button type="submit" class="btn btn-primary rounded-pill px-4">Ya, Ajukan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3" style="opacity: 0.3;"></i>
                                                <h5>Belum ada data lamaran.</h5>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-modern">
                    <div class="hd-header">
                        <div>
                            <h4 class="m-0 font-weight-bold">
                                <i class="fas fa-certificate mr-2"></i> Hasil Sertifikat
                            </h4>
                            <small style="opacity: 0.9;">Sertifikat kelulusan program magang.</small>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hd table-hover w-100">
                                <thead>
                                    <tr>
                                        <th style="width: 5%" class="text-center">No</th>
                                        <th>Nama Sertifikat</th>
                                        <th>Tanggal Terbit</th>
                                        <th>File</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $data_sertifikat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sertifikat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td class="text-center"><?php echo e($loop->iteration); ?></td>
                                            <td><?php echo e($sertifikat->nama_sertifikat ?? 'Sertifikat Magang'); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($sertifikat->created_at)->format('d M Y')); ?></td>
                                            <td><span class="badge badge-primary">PDF / Image</span></td>
                                            <td class="text-center">
                                                
                                                
                                                
                                                
                                                
                                                <?php if(!empty($sertifikat->file_path)): ?>
                                                    <a href="<?php echo e(asset('sertifikat/'.$sertifikat->file_path)); ?>" target="_blank" class="btn btn-sm btn-primary shadow-sm px-3" style="border-radius: 20px;">
                                                        <i class="fas fa-download mr-1"></i> Download
                                                    </a>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-secondary shadow-sm px-3" disabled style="border-radius: 20px; opacity: 0.6;">
                                                        <i class="fas fa-spinner mr-1"></i> Proses
                                                    </button>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <span class="text-muted font-italic">Belum ada sertifikat yang diterbitkan.</span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

      </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('template.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\magang-L12\resources\views/pelamar/datalamaran.blade.php ENDPATH**/ ?>