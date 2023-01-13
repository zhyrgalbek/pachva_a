<?php $__env->startSection('content'); ?>
    <div class="container">

        <?php echo e(Breadcrumbs::render('aboutPage')); ?>



        <div class="row" style="padding: 20px;
            border: 1px solid #0000001a;
            box-shadow: 0 0 10px #bfbaba;
            background: white;
" >
            <div class="col">
                <div class="card-body">
                    <div class="lead">
                        <br/>
                        <h3 class="text-center"><strong><?php echo e($data[0]->title); ?></strong></h3>
                        <br/>
                    </div>
                    <div class="lead">
                        <?php echo html_entity_decode( $data[0]->description ); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sklads/resources/views/vendor/about.blade.php ENDPATH**/ ?>