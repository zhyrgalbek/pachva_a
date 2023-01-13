<?php $__env->startSection('content'); ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('news.show', $article)); ?>


        <div class="justify-content-center">
            <?php if(\Session::has('success')): ?>
                <div class="alert alert-success">
                    <p><?php echo e(\Session::get('success')); ?></p>
                </div>
            <?php endif; ?>
            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="lead mb-3 text-center">
                        <img src="<?php echo e($article->photo); ?>" class="news-img-top" alt="...">
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col">
                            <h3 class="section-title"><?php echo e($article->title); ?></h3>
                        </div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-list')): ?>
                            <div class="col-auto text-right">
                                <a class="btn btn-primary btn-sm" href="<?php echo e(route('news.index', ['type'=>Session::get('type', 1), 'page'=>Session::get('page', 1)])); ?>"><?php echo e(__('Back')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="lead mb-3 bg-light p-3">
                        <strong><?php echo e(__('Summary')); ?>:</strong>
                        <?php echo e($article->summary); ?>

                    </div>
                    <div class="lead mb-3">
                        <?php echo html_entity_decode( $article->body ); ?>

                    </div>
                    <div class="lead mb-3">
                        <div class="form-row align-items-center">
                            <div class="col">
                                <div class="text-primary"><?php echo e(\App\Models\Article::getTypeOptions()[$article->type]); ?></div>
                            </div>
                            <div class="col-auto">
                                <?php if($article->published): ?>
                                    <div class="text-muted" data-tooltip="tooltip" title="<?php echo e(__('Published at')); ?>"><?php echo e(date('d.m.Y', strtotime($article->published_at))); ?></div>
                                <?php else: ?>
                                    <div class="text-muted" data-tooltip="tooltip" title="<?php echo e(__('Created at')); ?>"><?php echo e(date('d.m.Y', strtotime($article->created_at))); ?></div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sklads/resources/views/news/show.blade.php ENDPATH**/ ?>