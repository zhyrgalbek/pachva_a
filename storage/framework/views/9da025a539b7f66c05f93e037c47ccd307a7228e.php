<h5 class="modal-body-title"><?php echo e(__('The service is provided by')); ?></h5>
<div class="form-row align-items-center">
    <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <div class="col-md-3">
        <div class="form-row align-items-center" style="opacity: <?php echo e($member->active?'1':'0.3'); ?>">
            <div class="col-auto">
                <img class="company-logo" src="<?php echo e($member->image); ?>" alt="..."/>
            </div>
            <div class="col">
                <span class="modal-company-text"><?php echo $member->name; ?></span>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <span class="badge badge-warning"><?php echo e(__('No members')); ?></span>
    <?php endif; ?>
</div>
<?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/layouts/serviceMembers.blade.php ENDPATH**/ ?>