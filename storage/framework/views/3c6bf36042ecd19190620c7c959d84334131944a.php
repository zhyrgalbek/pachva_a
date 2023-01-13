<!-- Portal -->
<div class="col-md-12 mt-5">
    <div class="portal" style="padding: 38px 50px 30px 50px;">
        <div class="row">
            <div class="col">
                <ul class="portal-list">
                    <h3><strong>Система складских свидетельств</strong></h3>
                    <p>
                        Система предназначена для обеспечения бездокументарного оборота складских свидетельств, согласно требований закона «О товарных складах и складских свидетельствах»
                    </p>
                    <a href="http://cbd.minjust.gov.kg/act/view/ru-ru/111772">
                        http://cbd.minjust.gov.kg/act/view/ru-ru/111772
                    </a>
                    <p>АИС «Складские свидетельства» предполагается использовать
                        для обеспечения электронного взаимодействия между участниками
                        электронного обращения складских свидетельств:</p>
                    <ul>

                        <li>Клиент (владелец товара, держатель складского свидетельства);</li>
                        <li>Товарный склад (инициирует выпуск, погашение, изменения информации о товаре,
                            владельце товара, залога и т.д.  В складском свидетельстве);</li>
                        <li>Коммерческий банк (акцептует складское свидетельство для залога).</li>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="col-md-6 d-none">
            <h2 class="portal-title">&nbsp;</h2>
            <p class="portal-text-2"><?php echo e(__('FinMarket portal statistics for 2021')); ?>:</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-4 pr-0">
                            <?php echo \File::get(public_path('images/post-add.svg')); ?>

                        </div>
                        <div class="col-8 pl-0">
                            <h2 class="portal-title mb-0">108 <?php echo e(__('million')); ?></h2>
                            <p class="portal-text"><?php echo e(__('services ordered through the FinMarket website and mobile application')); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-4 pr-0">
                            <?php echo \File::get(public_path('images/how-to-reg.svg')); ?>

                        </div>
                        <div class="col-8 pl-0">
                            <h2 class="portal-title mb-0">114 <?php echo e(__('thous')); ?></h2>
                            <p class="portal-text"><?php echo e(__('registered users')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <hr class="portal-line">
        </div>
        <div class="col-md-12 text-center">
            <a class="portal-dropdown" href="<?php echo e(route('about')); ?>"><?php echo e(__('More details')); ?> <i class="fas fa-angle-down"></i></a>
        </div>
    </div>
</div>
</div>
<?php /**PATH /var/www/html/sklads/resources/views/layouts/portal.blade.php ENDPATH**/ ?>