<div class="card card-news <?php echo e($article->published ? 'published' : 'not-published'); ?>">
    <img src="<?php echo e(explode(',',$article->photo)[0]); ?>" class="card-img-top" alt="...">
    <div class="card-body">
        <?php if($article->published): ?>
            <div class="text-muted"><?php echo e(date('d.m.Y', strtotime($article->published_at))); ?></div>
        <?php else: ?>
            <div class="text-muted"><?php echo e(date('d.m.Y', strtotime($article->created_at))); ?></div>
        <?php endif; ?>
        <h5 class="card-title"><?php echo e(Lang::has('news.title-'.$article->id) ? trans('news.title-'.$article->id) : $article->title); ?></h5>
        <p class="card-text"><?php echo Lang::has('news.summary-'.$article->id) ? trans('news.summary-'.$article->id) : $article->summary; ?></p>
        <?php if(auth()->guard()->check()): ?>
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                <?php if($article->published): ?>
                    <span class="text-sm text-success font-weight-bold"><?php echo e(__('Published')); ?></span>
                <?php else: ?>
                    <span class="text-sm text-danger font-weight-bold"><?php echo e(__('Not published')); ?></span>
                <?php endif; ?>
                <div class="btn-group btn-group-sm" role="group" aria-label="<?php echo e(__('Action')); ?>">
                    <a href="<?php echo e(route('news.show', $article->id)); ?>" class="btn btn-success" data-tooltip="tooltip" title="<?php echo e(__('Show')); ?>"><i class="fas fa-search-plus"></i></a>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-edit')): ?>
                        <a href="<?php echo e(route('news.edit', $article->id)); ?>" class="btn btn-primary" data-tooltip="tooltip" title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-delete')): ?>
                        <?php echo Form::button('<i class="far fa-trash-alt"></i>', ['class' => 'btn btn-dark', 'data-toggle'=> 'modal', 'data-target'=>'#confirmModal', 'data-confirm-text'=>__('Are you sure want to delete this?'), 'data-confirm'=>"$('#article-delete-".$article->id."').submit()", 'data-tooltip'=>'tooltip', 'title'=>__('Delete')]); ?>

                    <?php endif; ?>
                </div>
            </div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('news-delete')): ?>
            <?php echo Form::open(['method' => 'DELETE','route' => ['news.destroy', $article->id], 'class'=>'d-none', 'id'=>'article-delete-'.$article->id]); ?>

            <?php echo Form::close(); ?>

            <?php endif; ?>
        <?php else: ?>
            <a href="<?php echo e(route('news.detail', $article->id)); ?>" class="card-link"><?php echo e(__('read completely')); ?></a>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /var/www/html/soil_analysis/resources/views/layouts/article.blade.php ENDPATH**/ ?>