<?php $__env->startSection('content'); ?>
    <?php
    use Illuminate\Support\Facades\Http;
    try {
            $data = [
                'token' => "efkr87hi77fheih9w8ehwfueifh",
                'link_name' => "Асан",
                'link_lastname' => "Асанов",
                'link_otchestvo' => "Асанович",
                'link_mob' => "996551551551",
                'link_inn' => "123456787654",
                'link_type' => "fermer",
                'link_org' => "ИП Асанов",
                'link_mail' => "123@gmail.com",
                'link_pass' => "123123",
                'role' => "fermer",
                'action' => 'select_stores'
            ];

            $response = Http::asForm()->post("https://in.sklads.kg/api.php", $data)->body();
            $data = json_decode($response);
        }
        catch (Exception $exception){
            $data = [];
        }
    ?>

<div class="container">
    <?php echo e(Breadcrumbs::render('warehouse_data')); ?>

    <h2 class="section-title">Реестр складов</h2>

</div>
<div style="margin: 0 180px">

    <?php if($data != null): ?>

        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col"><?php echo e(__('store_number')); ?></th>
                <th scope="col"><?php echo e(__('Store name')); ?></th>
                <th scope="col"><?php echo e(__('Stock legal form')); ?></th>
                <th scope="col"><?php echo e(__('Phone number, E-mail address')); ?></th>
                <th scope="col"><?php echo e(__('TIN of the warehouse')); ?></th>
                <th scope="col"><?php echo e(__('Equity capital')); ?></th>
                <th scope="col"><?php echo e(__('product_type')); ?></th>
                <th scope="col"><?php echo e(__('sklad_class')); ?></th>
                <th scope="col"><?php echo e(__('Warehouse capacity')); ?></th>
                <th scope="col"><?php echo e(__('Warehouse area')); ?></th>
                <th scope="col"><?php echo e(__('Full name of the person who is (his) member of the executive body (board of directors)')); ?></th>
                <th scope="col"><?php echo e(__('Information on the termination, suspension and resumption of warehouse activity')); ?></th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($key + 1); ?></th>
                        <td><?php echo e($item->store_number); ?></td>
                        <td><?php echo e($item->store_name); ?></td>
                        <td><?php echo e(__($item->sklad_legal_form)); ?> <br /><?php echo e($item->store_address); ?></td>
                        <td><?php echo e(__($item->phonenumber_email)); ?></td>

                        







                        <td><?php echo e($item->inn); ?> <?php echo e($item->okpo); ?></td>
                        <td><?php echo e($item->own_capital); ?></td>
                        <td><?php echo e($item->product_type); ?></td>
                        <td><?php echo e(__($item->sklad_class)); ?></td>
                    <?php if( $item->square == null ||  $item->square == ''): ?>
                            <td><?php echo e($item->capacity); ?></td>
                        <?php else: ?>
                            <td><?php echo e($item->capacity); ?><span style="font-size: 12px"></span></td>
                        <?php endif; ?>
                        <?php if( $item->square == null ||  $item->square == ''): ?>
                            <td><?php echo e($item->square); ?></td>
                        <?php else: ?>
                            <td><?php echo e($item->square); ?><span style="font-size: 12px"></span></td>
                        <?php endif; ?>
                        <td><?php echo e($item->full_name); ?></td>
                        <td><?php echo e($item->info_ontermination); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
        <h2 >Реестр складов пуст</h2>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sklads/resources/views/vendor/warehouse_data.blade.php ENDPATH**/ ?>