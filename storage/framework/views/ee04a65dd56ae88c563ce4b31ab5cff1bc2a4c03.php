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

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
<div style="position: relative">
    <div style="justify-content: space-between; margin-bottom: 40px">
        <span style="font-size: 26px; margin: 0; padding: 0 20px 0 0;"><strong>Запрос на регистрацию <br />переуступки прав банку</strong></span>
        <img style="float: right; margin-top: -27px" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(80)->generate($data['url'])); ?> " alt="">
    </div>
    <p>Складское свидетельство №</p>
    <h4><strong>Владелец товара: <?php if(isset($data['certificate_number'])): ?><?php echo e(str_replace("_", " ", $data['certificate_number'])); ?><?php endif; ?></strong></h4>
    <div style="margin-left: 30px; margin-bottom: 10px">
        <p>ФИО: <strong><?php if(isset($data['account']['accountname'])): ?><?php echo e(str_replace("_", " ", $data['account']['accountname'])); ?><?php endif; ?></strong></p>
        <p>ИНН: <strong><?php if(isset($data['account']['inn'])): ?><?php echo e(str_replace("_", " ", $data['account']['inn'])); ?><?php endif; ?></strong></p>
    </div>
    <h4><strong>Склад: </strong></h4>
    <div style="margin-left: 30px">
        <p>Наименование: <strong><?php if(isset($data['store']['store_name'])): ?><?php echo e(str_replace("_", " ", $data['store']['store_name'])); ?><?php endif; ?></strong></p>
        <p>ИНН: <strong><?php if(isset($data['store']['inn'])): ?><?php echo e(str_replace("_", " ", $data['store']['inn'])); ?><?php endif; ?></strong></p>
    </div>
    <div class="DigitalSign" style="margin-top: 180px">
        <p class="text-center">Документ подписан электронной подписью</p>
        <p>Владелец: <?php if(isset($data['assigned_user'])): ?><?php echo e(str_replace("_", " ", $data['assigned_user'])); ?><?php endif; ?></p>
        <p>Дата подписания: <?php echo e(date("d-m-Y")); ?></p>
        <p>Срок действия: с <?php echo e(date("d-m-Y")); ?> до <?php echo e(date('d-m-Y', strtotime('+1 years'))); ?></p>
        <p>Хэш: <?php if(isset($data['hash'])): ?><?php echo e($data['hash']); ?><?php endif; ?></p>
    </div>

    <div style="margin-top: 180px">
        <span style="float: right"><a href="https://sklads.kg">https://sklads.kg</a></span>
    </div>
</div>
</body>
</html>
<?php /**PATH /var/www/html/sklads/resources/views/vendor/request_for_registration_to_bank_generatePDF.blade.php ENDPATH**/ ?>