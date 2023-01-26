<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-4">
                <h4>Адрес</h4>
                <p>720027, г. Бишкек, ул. Тимура Фрунзе, 100</p>

                <?php if(Auth::guest()): ?>
                <a class="dropdown-item-footer" href="<?php echo e(route('login')); ?>">
                    <span class="fas fa-sign-in-alt"></span>
                    <span><?php echo e(__('ink')); ?></span>
                </a>
                <?php else: ?>
                <a class="nav-icon" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div data-tooltip="tooltip" data-placement="bottom" title="<?php echo e(__('Logout')); ?>">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="sign-out" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out fa-w-16 fa-9x">
                            <path fill="currentColor" d="M48 64h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-8.8 0-16 7.2-16 16v288c0 8.8 7.2 16 16 16h132c6.6 0 12 5.4 12 12v8c0 6.6-5.4 12-12 12H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48zm279 19.5l-7.1 7.1c-4.7 4.7-4.7 12.3 0 17l132 131.4H172c-6.6 0-12 5.4-12 12v10c0 6.6 5.4 12 12 12h279.9L320 404.4c-4.7 4.7-4.7 12.3 0 17l7.1 7.1c4.7 4.7 12.3 4.7 17 0l164.5-164c4.7-4.7 4.7-12.3 0-17L344 83.5c-4.7-4.7-12.3-4.7-17 0z" class=""></path>
                        </svg>
                        <span><?php echo e(__('Sign out')); ?></span>
                    </div>
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
                <?php endif; ?>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <h4>Режим работы</h4>
                <p>Пн–пт: с 09:00 до 18:00</p>
                <p>Сб, вс: выходной</p>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-4">
                <h4>Контакты</h4>
                <p><i class="fas fa-address-book"></i> +996(312)-41-27-17</p>
                <p><i class="fas fa-address-book"></i> +996(312)-41-71-09</p>
                <p><i class="fas fa-envelope"></i> info@example.com</p>
            </div>
        </div>
    </div>
</footer>

<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col">
                <span>© <?php echo e(date('Y')); ?> Copyright: </span>
            </div>
        </div>
    </div>
</section><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/layouts/footer.blade.php ENDPATH**/ ?>