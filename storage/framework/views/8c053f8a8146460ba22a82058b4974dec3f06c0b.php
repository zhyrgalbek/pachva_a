<button class="btn btn-sm btn-secondary" data-toggle="modal"
        data-target="#applicationDetail<?php echo e($application->id); ?>"><?php echo e(__('More details')); ?></button>

<?php $__env->startPush('page-modals'); ?>
    <!-- Application detail -->
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade modal-service-detail" id="applicationDetail<?php echo e($application->id); ?>" tabindex="-1"
         aria-labelledby="applicationDetailTitle<?php echo e($application->id); ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                                <div class="modal-logo"><i class="fas fa-edit"></i></div>
                            </div>
                            <div class=" col-9 col-md-10">
                                <h5 class="modal-title"
                                    id="applicationDetailTitle<?php echo e($application->id); ?>"><?php echo e($application->service_name); ?></h5>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="far fa-times-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8 col-12">
                                <p>Получатель заявки: <?php echo e($application->member_name); ?></p>
                                <p>Статус: <?php echo e(trans(ucfirst($application->status_str))); ?></p>
                            </div>
                            <?php if($application->status_str=='approved'): ?>
                                <div class="col-md-4 col-12 text-right">
                                    <img src="<?php echo e(asset('storage/' . $application->path_to_QR)); ?>" width="200"
                                         alt="qr-code">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if($application->status_str=='approved'): ?>
                        <a class="btn btn-link" target="_blank" href="<?php echo e(route('applications.showByQrcode', $application->code)); ?>"><?php echo e('Show document'); ?></a>
                    <?php endif; ?>
                    
                    
                    
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    
                    
                    
                </div>
                <i class="modal-background-icon fas fa-paper-plane"></i>
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/applications/detail.blade.php ENDPATH**/ ?>