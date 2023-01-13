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
                'action' => 'select_certificates'
            ];

            $response = Http::asForm()->post("https://in.sklads.kg/api.php", $data)->body();
            $data = json_decode($response);
//            dd($data);
        }
        catch (Exception $exception){
            $data = [];
        }
    ?>
    <div class="container">
        <?php echo e(Breadcrumbs::render('certificates_data')); ?>

        <h2 class="section-title">Реестр свидетельств</h2>
    </div>
    <div style="margin: 0 180px">
            <table class="table table-striped" >
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?php echo e(__('Warehouse name')); ?></th>

                        <th scope="col"><?php echo e(__('Data on state registration')); ?></th>
                        <th scope="col"><?php echo e(__('Number and date of issue of the certificate of registration of the warehouse in the register of warehouses')); ?></th>
                        <th scope="col"><?php echo e(__('Current warehouse certificate number according to the warehouse register')); ?></th>
                        <th scope="col"><?php echo e(__('certificate_number')); ?></th>
                        <th scope="col"><?php echo e(__('Number and date of conclusion of the warehouse storage agreement')); ?></th>
                        <th scope="col"><?php echo e(__('Name of agricultural products of the warehouse certificate')); ?></th>
                        <th scope="col"><?php echo e(__('Date of issue of the warehouse receipt')); ?></th>


                        <th scope="col"><?php echo e(__('Warehouse receipt pledge status')); ?></th>
                        <th scope="col"><?php echo e(__('Information about the holder of the warehouse certificate')); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php if($data != null): ?>

                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th scope="row"><?php echo e($key + 1); ?></th>
                        <td><?php echo e($item->store_name); ?> <br /> <?php echo e(__($item->sklad_state)); ?> <?php if(isset($item->store_address)): ?> <?php echo e(__($item->store_address)); ?> <?php endif; ?></td>

                        <td><?php echo e(__('INN')); ?>: <?php echo e($item->inn); ?>, <?php echo e(__('OKPO')); ?>: <?php echo e($item->okpo); ?>, <?php echo e(__($item->sklad_legal_form)); ?>, <?php echo e($item->date_legal_entities); ?></td>
                        <td><?php echo e($item->store_number); ?> <br /> <?php echo e($item->store_registration_date); ?></td>
                        <td><?php echo e($item->number_waregouse_reciept); ?></td>
                        <td><?php echo e($item->certificate_number); ?><br /> <?php echo e($item->warehouse_agreementnumber); ?></td>
                        <td><?php echo e($item->warehouse_agreementnumber); ?> <br /><?php echo e($item->date_warehouse_conclusion); ?></td>
                        <td><?php echo e(__($item->warehouse_reciept_type)); ?> <br />  <?php echo e($item->product_name); ?></td>
                        <td><?php echo e($item->registration_date); ?> <br /><?php echo e($item->date_repayment_certificate); ?></td>


                        <?php if($item->sklad_pledge_status == '' || $item->sklad_pledge_status == null || $item->sklad_pledge_status == 'not_pledged' || $item->sklad_pledge_status == 'review'): ?>
                            <td><?php echo e(__('not_pledged')); ?></td>
                        <?php elseif($item->sklad_pledge_status == 'redeemed'): ?>
                            <td><?php echo e(__('redeemed')); ?></td>
                        <?php else: ?>
                            <td><?php echo e(__('pledged')); ?></td>
                        <?php endif; ?>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($user['identifier'] == $item->inn): ?>
                                <td><?php echo e($user->last_name); ?> <?php echo e($user->name); ?> <?php echo e($user->middle_name); ?> <?php echo e($user->identifier); ?></td>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if(empty(count($users->where('identifier', $item->inn)))): ?>
                            <td>----</td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <h2 >Реестр свидетельств пуст</h2>
                <?php endif; ?>
                </tbody>
            </table>

    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sklads/resources/views/vendor/certificates_data.blade.php ENDPATH**/ ?>