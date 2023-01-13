<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($data['label'])): ?><?php echo e(str_replace("_", " ", $data['label'])); ?><?php endif; ?></title>
    <style>
        body, html{ font-family: DejaVu Sans, sans-serif !important; font-size: 10px}
        tbody:before, tbody:after { display: none; }
        thead:before, thead:after { display: none; }
        tbody:before, tbody:after { display: none; }
        .DigitalSign{
            width: 60%;
            padding: 10px;
            border: 6px solid #429be5;
            border-radius: 23px;
        }
        .DigitalSign p{
            color: #429be5;
            margin: 0;
            padding: 0;
        }
        .DigitalSign p:first-child{
            margin: 0;
            padding-bottom: 10px;
        }
        .watermark{
            font-size: 90px;
            position: absolute;
            top: 26%;
            border: 10px solid rgb(5, 114, 5);
            color: rgb(5, 114, 5);
            opacity: .2;
            left: 6%;
            transform: rotate(-45deg);
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div class="" style="position: relative">
    <?php if(isset($data['sklad_reg_status'])): ?>
        <?php if($data['sklad_reg_status'] == 'redeemed'): ?><span class="watermark">ПОГАШЕНО</span>
        <?php elseif($data['sklad_reg_status'] == 'accepted_and_pledget'): ?><span class="watermark">В ЗАЛОГЕ</span>
        <?php endif; ?>
    <?php endif; ?>
    <span style="font-size: 26px; margin: 0; padding: 0 20px 0 0;"><strong>Двойное складское свидетельство</strong></span>
    <div style="justify-content: space-between">
        <img style="float: right" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(80)->generate($data['url'])); ?> " alt="">
        <span>
            <p style="margin: 3px 0 0 0;">Часть 1 (складское свидетельство)</p>
            <p style="margin: 3px 0 0 0; ">СЕРИЯ И НОМЕР СКЛАДСКОГО СВИДЕТЕЛЬСТВА: <strong><?php if(isset($data['certificate_number'])): ?><?php echo e($data['certificate_number']); ?><?php endif; ?> <?php if(isset($data['blank_number'])): ?><?php echo e($data['blank_number']); ?><?php endif; ?></strong></p>
            <span>Дата выдачи свидетельства:<strong> <?php echo e(date("d-m-Y")); ?></strong></span>
        </span>
    </div>
    <div class="mt-5">
        <p>
            Настоящим складским свидетельством подтверждается, что товарный склад <strong><?php if(isset($data['store']['store_name'])): ?><?php echo e(str_replace("_", " ", $data['store']['store_name'])); ?><?php endif; ?></strong>,
            находящийся по адресу <strong><?php if(isset($data['store']['sklad_state'])): ?><?php echo e(__($data['store']['sklad_state'])); ?><?php endif; ?> <?php if(isset($data['store']['store_address'])): ?><?php echo e($data['store']['store_address']); ?><?php endif; ?>, </strong> ИНН: <strong><?php if(isset($data['store']['inn'])): ?><?php echo e($data['store']['inn']); ?><?php endif; ?>,</strong>
            дата выдачи: <strong><?php if(isset($data['registration_date'])): ?><?php echo e($data['registration_date']); ?><?php endif; ?></strong> и регистрационный №<strong><?php if(isset($data['store']['register_number'])): ?><?php echo e($data['store']['register_number']); ?><?php endif; ?></strong>, принял на хранение от
            <strong style="color: #0F74A8"><?php if(isset($data['account']['accountname'])): ?><?php echo e(str_replace("_", " ", $data['account']['accountname'])); ?><?php endif; ?></strong>, ИНН: <strong><?php if(isset($data['account']['inn'])): ?><?php echo e($data['account']['inn']); ?><?php endif; ?>, место жительства: <?php if(isset($data['account']['account_regaddress'])): ?><?php echo e($data['account']['account_regaddress']); ?><?php endif; ?></strong> следующую продукцию:
        </p>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Количество (с указанием единицы измерения)</th>
            <th scope="col">Качество (с указанием при наличии реквизитов документа, подтверждающего качество: наименование, кем выдан, дата выдачи)</th>
            <th scope="col">Вес продукции (с указанием единицы измерения)</th>
            <th scope="col">Объем продукции</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php if(isset($data['product_name'])): ?><?php echo e(str_replace("_", " ", $data['product_name'])); ?><?php endif; ?></td>
            <td><?php if(isset($data['amount'])): ?><?php echo e(str_replace("_", " ", $data['amount'])); ?><?php endif; ?> <?php if(isset($data["sklad_unit"])): ?><?php echo e(__($data["sklad_unit"])); ?><?php endif; ?></td>
            <td><?php if(isset($data['quality'])): ?><?php echo e(str_replace("_", " ", $data['quality'])); ?><?php endif; ?></td>
            <td><?php if(isset($data['weight'])): ?><?php echo e(str_replace("_", " ", $data['weight'])); ?><?php endif; ?></td>
            <td><?php if(isset($data['volume'])): ?><?php echo e(str_replace("_", " ", $data['volume'])); ?><?php endif; ?></td>
        </tr>
        </tbody>
    </table>
    <div style="margin-top: 50px">
        <p>Товарный склад обязуется хранить указанное количество продукции и возвратить держателю настоящего свидетельства <strong><?php if(isset($data['storage_period'])): ?><?php echo e($data['storage_period']); ?><?php endif; ?> дней</strong>.</p>
        <p>Стоимость хранения оплачивается: <strong><?php if(isset($data['all_storage_fee'])): ?><?php echo e($data['all_storage_fee']); ?><?php endif; ?> сом в день</strong>.</p>
        <p>Информация об участии товарного склада в системе гарантирования исполнения обязательств товарного склада перед держателями складских свидетельств или отметка о наличии или отсутствии
            страхования гражданско-правовой ответственности товарного склада перед держателем складского свидетельства
            Страховой полис №<strong><?php if(isset($data['insurance_policy'])): ?><?php echo e($data['insurance_policy']); ?><?php endif; ?></strong>.</p>
        <p class="mt-5">Настоящее складское свидетельство является частью двойного складского свидетельства.</p>
    </div>
    <p>Должность (уполномоченного лица товарного склада).</p>
    <div class=" DigitalSign ">
        <p class="text-center">Документ подписан электронной подписью</p>
        <p>Владелец: <?php if(isset($data['store_owner'])): ?><?php echo e(str_replace("_", " ", $data['store_owner'])); ?><?php endif; ?></p>
        <p>Дата подписания: <?php echo e(date("d-m-Y")); ?></p>
        <p>Срок действия: с <?php echo e(date("d-m-Y")); ?> до <?php echo e(date('d-m-Y', strtotime('+1 years'))); ?></p>
        <p>Хэш: <?php if(isset($data['hash'])): ?><?php echo e($data['hash']); ?><?php endif; ?></p>
    </div>
    <div style="margin-top: 110px">
        <p><strong> <?php if(isset($data['store_owner'])): ?><?php echo e(str_replace("_", " ", $data['store_owner'])); ?><?php endif; ?></strong></p>
        <span style="padding-right: 250px">(ФИО)</span>
        <span style="float: right"><a href="https://sklads.kg">https://sklads.kg</a></span>
    </div>
</div>
<div style="margin-top: 100px" style="position: relative">
    <?php if(isset($data['sklad_reg_status'])): ?>
        <?php if($data['sklad_reg_status'] == 'redeemed'): ?><span class="watermark">ПОГАШЕНО</span>
        <?php elseif($data['sklad_reg_status'] == 'accepted_and_pledget'): ?><span class="watermark">В ЗАЛОГЕ</span>
        <?php endif; ?>
    <?php endif; ?>
        <span style="font-size: 26px; margin: 0; padding: 0 20px 0 0;"><strong>Двойное складское свидетельство</strong></span>
    <div style="justify-content: space-between" class="pb-5">
        <img style="float: right" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(80)->generate($data['url'])); ?> ">
        <span>
            <p style="padding: 3px 0 0 0;">Часть 1 (складское свидетельство)</p>
            <span style="padding: 3px 0 0 0; ">СЕРИЯ И НОМЕР СКЛАДСКОГО СВИДЕТЕЛЬСТВА: <strong> <?php if(isset($data['certificate_number'])): ?><?php echo e($data['certificate_number']); ?><?php endif; ?> <?php if(isset($data['blank_number'])): ?><?php echo e($data['blank_number']); ?><?php endif; ?></strong></span>
        </span>
    </div>
    <span class="py-2"></span>
    <div class="w-100 mt-5 mb-3 p-2" style="border: 2px solid black;">
        <p class="text-center p-0 m-0">Передаточная надпись</p>
        <p class="text-center">(индоссамент)</p>
        <p>Собственник продукции <?php if(isset($data['account']['label'])): ?><?php echo e(str_replace("_", " ", $data['account']['label'])); ?><?php endif; ?> переуступает, а новый держатель <?php if(isset($data['new_account']['label'])): ?><?php echo e(str_replace("_", " ", $data['new_account']['label'])); ?><?php endif; ?> приобретает права по настоящему складскому свидетельству.</p>
        <p>Основание индоссамента </p>
        <p>Наименование/ФИО и подпись лица, переуступающего права <?php if(isset($data['account']['label'])): ?><?php echo e(str_replace("_", " ", $data['account']['label'])); ?><?php endif; ?></p>
        <p>Дата: </p>
        <p class="py-2">Наименование/ФИО и подпись лица, приобретающего права на продукцию, указанную в настоящем складском свидетельстве</p>
        <p class="py-2">Дата совершения индоссамента <?php echo e(date("d-m-Y")); ?></p>
        <p class="py-2">ЭЦП лица приобретающего права на продукцию (ФКО)</p>
    </div>
    <div>
        <p>При отделении залогового свидетельства от складского свидетельства:</p>
        <ol>
            <li>
                <p>Наименование юридического лица или полные фамилия, имя, отчество (при наличии) физического лица - кредитора/займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
            <li>
                <p>Существо денежного обязательства, его размер, в том числе проценты по нему, порядок и срок его исполнения, реквизиты договора по обеспечиваемому свидетельством обязательству, а также банковские реквизиты для перечисления денежных средств в счет обслуживания и погашения денежного обязательства /займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
            <li>
                <p>Наименование и ЭЦП уполномоченного лица юридического лица или фамилия, имя, отчество (при наличии) физического лица и ЭЦП физического лица, переступившего залоговое свидетельство и этим самым права по настоящему складскому свидетельству/займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
            <li>
                <p>Дата отделения залогового свидетельства от складского свидетельства/займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
        </ol>
        <p>(*) При указании данных собственника и нового держателя соответствующего складского свидетельства необходимо указать: полное наименование и реквизиты юридического лица или фамилию, имя и отчество (при наличии) физического лица, а также их идентификационный налоговый номер (ИНН), место нахождения или место жительства, соответственно, номер, серию, дату и наименование органа, выдавшего паспорт физическому лицу.</p>
    </div>
    <div style="margin-top: 30px">
        <span style="float: right"><a href="https://sklads.kg">https://sklads.kg</a></span>
    </div>
</div>
<div style="margin-top: 60px;position: relative">
    <?php if(isset($data['sklad_reg_status'])): ?>
        <?php if($data['sklad_reg_status'] == 'redeemed'): ?><span class="watermark">ПОГАШЕНО</span>
        <?php elseif($data['sklad_reg_status'] == 'accepted_and_pledget'): ?><span class="watermark">В ЗАЛОГЕ</span>
        <?php endif; ?>
    <?php endif; ?>
        <span style="font-size: 26px; margin: 0; padding: 0 20px 0 0;"><strong>Двойное складское свидетельство</strong></span>
    <div style="justify-content: space-between">
        <img style="float: right" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(80)->generate($data['url'])); ?> ">
        <span>
            <p style="padding: 3px 0 0 0;">Часть 2 (залоговое свидетельство)</p>
            <p style="padding: 3px 0 0 0; ">СЕРИЯ И НОМЕР СКЛАДСКОГО СВИДЕТЕЛЬСТВА: <strong> <?php if(isset($data['certificate_number'])): ?><?php echo e($data['certificate_number']); ?><?php endif; ?> <?php if(isset($data['blank_number'])): ?><?php echo e($data['blank_number']); ?><?php endif; ?></strong></p>
            <span>Дата выдачи свидетельства: <strong><?php echo e(date("d-m-Y")); ?></strong></span>
        </span>
    </div>
    <div class="mt-3">
        <p>
            Настоящим складским свидетельством подтверждается, что товарный склад <strong><?php if(isset($data['store']['store_name'])): ?><?php echo e(str_replace("_", " ", $data['store']['store_name'])); ?><?php endif; ?></strong>,
            находящийся по адресу <strong><?php if(isset($data['store']['sklad_state'])): ?><?php echo e(__($data['store']['sklad_state'])); ?><?php endif; ?> <?php if(isset($data['store']['store_address'])): ?><?php echo e($data['store']['store_address']); ?><?php endif; ?>, </strong> ИНН: <strong><?php if(isset($data['store']['inn'])): ?><?php echo e($data['store']['inn']); ?><?php endif; ?>,</strong>
            дата выдачи: <strong><?php if(isset($data['registration_date'])): ?><?php echo e($data['registration_date']); ?><?php endif; ?></strong> и регистрационный №<strong><?php if(isset($data['store']['register_number'])): ?><?php echo e($data['store']['register_number']); ?><?php endif; ?></strong>, принял на хранение от
            <strong style="color: #0F74A8"> <?php if(isset($data['account']['accountname'])): ?><?php echo e(str_replace("_", " ", $data['account']['accountname'])); ?><?php endif; ?></strong>, ИНН: <strong><?php if(isset($data['account']['inn'])): ?><?php echo e($data['account']['inn']); ?><?php endif; ?>, <?php if(isset($data['account']['account_regaddress'])): ?><?php echo e($data['account']['account_regaddress']); ?><?php endif; ?></strong> следующую продукцию:
        </p>
    </div>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th scope="col">Наименование</th>
            <th scope="col">Количество (с указанием единицы измерения)</th>
            <th scope="col">Качество (с указанием при наличии реквизитов документа, подтверждающего качество: наименование, кем выдан, дата выдачи)</th>
            <th scope="col">Вес продукции (с указанием единицы измерения)</th>
            <th scope="col">Объем продукции</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php if(isset($data['product_name'])): ?><?php echo e(str_replace("_", " ", $data['product_name'])); ?><?php endif; ?></td>
            <td><?php if(isset($data['amount'])): ?><?php echo e(str_replace("_", " ", $data['amount'])); ?><?php endif; ?> <?php if(isset($data["sklad_unit"])): ?><?php echo e(__($data["sklad_unit"])); ?><?php endif; ?></td>
            <td><?php if(isset($data['quality'])): ?><?php echo e(str_replace("_", " ", $data['quality'])); ?><?php endif; ?></td>
            <td><?php if(isset($data['weight'])): ?><?php echo e(str_replace("_", " ", $data['weight'])); ?><?php endif; ?></td>
            <td><?php if(isset($data['volume'])): ?><?php echo e(str_replace("_", " ", $data['volume'])); ?><?php endif; ?></td>
        </tr>
        </tbody>
    </table>
    <div style="margin-top: 30px">
        <p>Товарный склад обязуется хранить указанное количество продукции и возвратить держателю настоящего свидетельства <strong><?php if(isset($data['storage_period'])): ?><?php echo e($data['storage_period']); ?><?php endif; ?> дней</strong>.</p>
        <p>Стоимость хранения оплачивается: <strong><?php if(isset($data['storage_fee'])): ?><?php echo e($data['storage_fee']); ?><?php endif; ?> сом в день</strong>.</p>
        <p>Информация об участии товарного склада в системе гарантирования исполнения обязательств товарного склада перед держателями складских свидетельств или отметка о наличии или отсутствии
            страхования гражданско-правовой ответственности товарного склада перед держателем складского свидетельства
            Страховой полис №<strong><?php if(isset($data['insurance_policy'])): ?><?php echo e($data['insurance_policy']); ?><?php endif; ?></strong>.</p>
        <p class="mt-5">Настоящее складское свидетельство является частью двойного складского свидетельства.</p>
        <p>Должность (уполномоченного лица товарного склада).</p>
    </div>
    <div class=" DigitalSign ">
        <p class="text-center">Документ подписан электронной подписью</p>
        <p>Владелец: <?php if(isset($data['bank_user'])): ?><?php echo e(str_replace("_", " ", $data['bank_user'])); ?><?php endif; ?></p>
        <p>Дата подписания: <?php echo e(date("d-m-Y")); ?></p>
        <p>Срок действия: с <?php echo e(date("d-m-Y")); ?> до <?php echo e(date('d-m-Y', strtotime('+1 years'))); ?></p>
        <p>Хэш: <?php if(isset($data['hash'])): ?><?php echo e($data['hash']); ?><?php endif; ?></p>
    </div>
    <div style="margin-top: 180px">
        <p><strong><?php if(isset($data['store_owner'])): ?><?php echo e(str_replace("_", " ", $data['store_owner'])); ?><?php endif; ?></strong></p>
        <span style="padding-right: 250px">(ФИО)</span>
        <span style="float: right"><a href="https://sklads.kg">https://sklads.kg</a></span>
    </div>
</div>
<?php echo e($data['certificate_number']); ?>

<div style="margin-top: 60px; position: relative">
    <?php if(isset($data['sklad_reg_status'])): ?>
        <?php if($data['sklad_reg_status'] == 'redeemed'): ?><span class="watermark">ПОГАШЕНО</span>
        <?php elseif($data['sklad_reg_status'] == 'accepted_and_pledget'): ?><span class="watermark">В ЗАЛОГЕ</span>
        <?php endif; ?>
    <?php endif; ?>
        <span style="font-size: 26px; padding: 0; padding: 0 20px 0 0;"><strong>Двойное складское свидетельство</strong></span>
    <div style="justify-content: space-between" class="pb-5">
        <img style="float: right" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(80)->generate($data['url'])); ?> ">
        <span>
            <p style="padding: 3px 0 0 0;">Часть 2 (залоговое свидетельство)</p>
            <span style="padding: 3px 0 0 0; ">СЕРИЯ И НОМЕР СКЛАДСКОГО СВИДЕТЕЛЬСТВА: <strong> <?php if(isset($data['certificate_number'])): ?><?php echo e($data['certificate_number']); ?><?php endif; ?> <?php if(isset($data['blank_number'])): ?><?php echo e($data['blank_number']); ?><?php endif; ?></strong></span>
        </span>
    </div>
    <span class="py-2"></span>
    <div class="w-100 mt-5 mb-3 p-2" style="border: 2px solid black;">
        <p class="text-center p-0 m-0">Передаточная надпись</p>
        <p class="text-center">(индоссамент)</p>
        <p>Собственник продукции <?php if(isset($data['account']['label'])): ?><?php echo e(str_replace("_", " ", $data['account']['label'])); ?><?php endif; ?> переуступает, а новый держатель <?php if(isset($data['new_account']['label'])): ?><?php echo e(str_replace("_", " ", $data['new_account']['label'])); ?><?php endif; ?> приобретает права по настоящему складскому свидетельству.</p>
        <p>Основание индоссамента </p>
        <p>Наименование/ФИО и подпись лица, переуступающего права <?php if(isset($data['account']['label'])): ?><?php echo e(str_replace("_", " ", $data['account']['label'])); ?><?php endif; ?></p>
        <p>Дата: </p>
        <p class="py-2">Наименование/ФИО и подпись лица, приобретающего права на продукцию, указанную в настоящем складском свидетельстве</p>
        <p class="py-2">Дата совершения индоссамента <?php echo e(date("d-m-Y")); ?></p>
        <p class="py-2">ЭЦП лица приобретающего права на продукцию (ФКО)</p>
    </div>
    <div>
        <p>При отделении залогового свидетельства от складского свидетельства:</p>
        <ol>
            <li>
                <p>Наименование юридического лица или полные фамилия, имя, отчество (при наличии) физического лица - кредитора/займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
            <li>
                <p>Существо денежного обязательства, его размер, в том числе проценты по нему, порядок и срок его исполнения, реквизиты договора по обеспечиваемому свидетельством обязательству, а также банковские реквизиты для перечисления денежных средств в счет обслуживания и погашения денежного обязательства /займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
            <li>
                <p>Наименование и ЭЦП уполномоченного лица юридического лица или фамилия, имя, отчество (при наличии) физического лица и ЭЦП физического лица, переступившего залоговое свидетельство и этим самым права по настоящему складскому свидетельству/займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
            <li>
                <p>Дата отделения залогового свидетельства от складского свидетельства/займодавца к моменту совершения передаточной надписи, а также ИНН, место нахождения или место жительства</p>
            </li>
        </ol>
        <p>(*) При указании данных собственника и нового держателя соответствующего складского свидетельства необходимо указать: полное наименование и реквизиты юридического лица или фамилию, имя и отчество (при наличии) физического лица, а также их идентификационный налоговый номер (ИНН), место нахождения или место жительства, соответственно, номер, серию, дату и наименование органа, выдавшего паспорт физическому лицу.</p>
    </div>
    <div style="margin-top: 20px">
        <span style="float: right"><a href="https://sklads.kg">https://sklads.kg</a></span>
    </div>
</div>
</body>
</html>
<?php /**PATH /var/www/html/sklads/resources/views/vendor/store_certificate_generatePDF.blade.php ENDPATH**/ ?>