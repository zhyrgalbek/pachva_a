<div class="card mb-3" data-toggle="modal" data-target="#serviceDetail<?php echo e($service->id); ?>">
    <div class="row no-gutters">
        <div class="col-3 card-left">
            <div class="card-logo"><i class="<?php echo e($service->icon); ?>"></i></div>
        </div>
        <div class="col-9">
            <div class="card-body">
                <h5 class="card-title"><?php echo e($service->name); ?></h5>
                <p class="card-text"><?php echo $service->description; ?></p>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('page-modals'); ?>
    <!-- Service detail -->
    <!-- Vertically centered scrollable modal -->
    <div class="modal fade modal-service-detail" id="serviceDetail<?php echo e($service->id); ?>" tabindex="-1" aria-labelledby="serviceDetailTitle<?php echo e($service->id); ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                                <div class="modal-logo"><i class="<?php echo e($service->icon); ?>"></i></div>
                            </div>
                            <div class=" col-9 col-md-10">
                                <h5 class="modal-title" id="serviceDetailTitle<?php echo e($service->id); ?>"><?php echo e($service->name); ?></h5>
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
                            <div class="col-md-8 m-auto">
                                <p class="modal-text"><?php echo $service->description; ?></p>
                                <p class="modal-text">Описание услуги, давно выяснено, что при оценке дизайна и композиции читаемый текст мешает сосредоточиться. Lorem Ipsum используют потому, что тот обеспечивает более или менее стандартное заполнение шаблона.</p>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-3 ml-auto">
                                <ul class="modal-list">
                                    <li>Поле для текста</li>
                                    <li>Поле для текста</li>
                                    <li>Поле для текста</li>
                                    <li>Поле для текста</li>
                                </ul>
                            </div>
                            <div class="col-md-12" id="members-<?php echo e($service->id); ?>"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if(auth()->guard()->check()): ?>
                    <a class="btn btn-secondary" href="<?php echo e(route('services.detail', [$service->id])); ?>"><?php echo e(__('More details')); ?></a>
                    <?php elseif(request()->routeIs('*account*')): ?>
                    <a class="btn btn-secondary" href="<?php echo e(route('services.detail', [$service->id, 'utype'=>'j'])); ?>"><?php echo e(__('More details')); ?></a>
                    <?php else: ?>
                    <a class="btn btn-secondary" href="<?php echo e(route('services.detail', [$service->id, 'utype'=>'i'])); ?>"><?php echo e(__('More details')); ?></a>
                    <?php endif; ?>
                    <button type="button" class="btn btn-primary"><?php echo e(__('Subscribe')); ?></button>
                </div>
                <i class="modal-background-icon <?php echo e($service->icon); ?>"></i>
            </div>
        </div>
    </div>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('page-scripts'); ?>
    <script type="application/javascript">
        setTimeout(function(){
            $('#serviceDetail<?php echo e($service->id); ?>').on('show.bs.modal', function(event){
                if ($('#members-<?php echo e($service->id); ?>').is(':empty')) {
                    $.ajax({
                        type: 'GET', //THIS NEEDS TO BE GET
                        url: '<?php echo e(route('services.members', $service->id)); ?>',
                        success: function (members) {
                            $('#members-<?php echo e($service->id); ?>').html(members);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }
            });
        }, 0);
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/layouts/serviceCard.blade.php ENDPATH**/ ?>