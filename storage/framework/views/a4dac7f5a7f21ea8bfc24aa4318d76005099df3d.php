<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th style="width: 60px;"><?php echo e(__('#')); ?></th>
            <th><?php echo e(__('Name')); ?></th>
            <th><?php echo e(__('Organization')); ?></th>
            <th><?php echo e(__('Status')); ?></th>
            <th style="width: 180px;"><?php echo e(__('Action')); ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($application->id); ?></td>
                <td><?php echo e($application->service_name); ?></td>
                <td><?php echo e($application->member_name); ?></td>
                <td>
                    <?php switch($application->status_str):
                        case ('sent'): ?>
                        <span class="text-info font-weight-bold text-nowrap"><i class="fas fa-paper-plane"></i> <?php echo e(__('Sent')); ?></span>
                        <?php break; ?>
                        <?php case ('canceled'): ?>
                        <span class="text-secondary font-weight-bold text-nowrap"><i class="far fa-times-circle"></i> <?php echo e(__('Cancelled')); ?></span>
                        <?php break; ?>
                        <?php case ('approved'): ?>
                        <span class="text-success font-weight-bold text-nowrap"><i class="fas fa-check"></i> <?php echo e(__('Approved')); ?></span>
                        <?php break; ?>
                        <?php case ('rejected'): ?>
                        <span class="text-danger font-weight-bold text-nowrap"><i class="fas fa-times"></i> <?php echo e(__('Rejected')); ?></span>
                        <?php break; ?>
                    <?php endswitch; ?>
                </td>
                <td>
                    <?php echo $__env->make('applications.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="100%">
                    <div class="alert alert-info" role="alert">
                        <?php echo e(__('No applications!')); ?>

                    </div>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="pagination-content text-right mt-3">
    <?php echo e($applications->appends($_GET)->links('pagination::bootstrap-4')); ?>

</div>
<?php /**PATH C:\OSPanel\domains\ga\resources\views/applications/table.blade.php ENDPATH**/ ?>