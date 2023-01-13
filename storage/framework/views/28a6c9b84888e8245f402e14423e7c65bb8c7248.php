<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('posts.page', $post)); ?>


        <div class="bg-white p-3 rounded shadow post-show">
        <?php echo html_entity_decode( $post->description ); ?>


        </div>

<!--     --><?php
//      $data = json_decode(file_get_contents('http://sklad.102.kg/api.php?action=select_stores'));
//        ?>











    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sklads/resources/views/posts/page.blade.php ENDPATH**/ ?>