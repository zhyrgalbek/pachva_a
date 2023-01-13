<footer>
    <div class="container footer-floor">
        <?php if(!auth()->check()): ?>
            <div class="row justify-content-between align-items-center">
                <div class="col-md-5 text-justify mb-3 mb-md-0">
                    <span class="footer-text">Данный сервис был создан при поддержке Проекта «Обеспечение доступа к рынку» (ПОДР), реализующего Отделом реализации сельскохозяйственных проектов (ОРСП), финансируемый Международным фондом сельскохозяйственного развития (IFAD).</span>
                </div>
                <div class="col-md-3 text-center text-md-right mb-1 mb-md-0">
                    <img class="footer-logo" style="width: 290px" src="<?php echo e(asset('images/image-1.png')); ?>" alt="...">
                </div>
                <div class="col-auto text-center text-md-left">
                    <span class="footer-text-2"><?php echo e(__('The Official Internet Portal of Financial Services, :year', ['year'=>date('Y')])); ?></span>
                </div>
            </div>
        <?php else: ?>
            <div class="row justify-content-between align-items-center">
                <div class="text-center mb-1 mb-md-0">
                    <img class="footer-logo" style="width: 290px" src="<?php echo e(asset('images/image-1.png')); ?>" alt="...">
                </div>
                <div class="ml-md-5 ml-2">
                    <span class="footer-text-2"><?php echo e(__('The Official Internet Portal of Financial Services, :year', ['year'=>date('Y')])); ?></span>
                </div>
            </div>
        <?php endif; ?>
    </div>
</footer>
<?php /**PATH /var/www/html/soil_analysis/resources/views/layouts/footer.blade.php ENDPATH**/ ?>