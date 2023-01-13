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
    <div>
        <div style="justify-content: space-between; margin-bottom: 40px">
            <span style="font-size: 26px; margin: 0; padding: 0 20px 0 0;"><strong>ЗАЯВЛЕНИЕ ТОВАРНОГО СКЛАДА О ВКЛЮЧЕНИИ В РЕЕСТР ТС</strong></span>
            <img style="float: right; margin-top: -27px" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(80)->generate($data['url'])); ?> " alt="">
        </div>
        <p>1. Наименование товарного склада как организации, организационно-правовая форма:
            <?php if(isset($data['store_name'])): ?><?php echo e(str_replace("_", " ", $data['store_name'])); ?><?php endif; ?>
        </p>
        <p>2. <strong>ИНН, ОКПО</strong> товарного склада как юридического лица
            <?php if(isset($data['inn'])): ?><?php echo e($data['inn']); ?><?php endif; ?>, <?php if(isset($data['okpo'])): ?><?php echo e($data['okpo']); ?><?php endif; ?>
        </p>
        <p>3. ФИО, специальность лиц, вошедших в состав исполнительного органа (Совет директоров):
            <?php if(isset($data['full_name'])): ?> <?php echo e(str_replace("_", " ", $data['full_name'])); ?><?php endif; ?>
        </p>
        <p>4. Место нахождения (фактический адрес) товарного склада:
            <?php if(isset($data['sklad_state'])): ?><?php echo e(__($data['sklad_state'])); ?><?php endif; ?>, <?php if(isset($data['store_address'])): ?><?php echo e($data['store_address']); ?><?php endif; ?>
        </p>
        <p>5. Класс товарного склада <?php if(isset($data['sklad_class'])): ?> <?php if($data['sklad_class'] != 'select_value'): ?><?php echo e(__($data['sklad_class'])); ?> <?php endif; ?> <?php endif; ?>, вместимость <?php if(isset($data['capacity'])): ?><?php echo e($data['capacity']); ?><?php endif; ?>, площадь <?php if(isset($data['square'])): ?><?php echo e($data['square']); ?><?php endif; ?>. </p>
        <p>6. Виды сельскохозяйственной продукции, на складском хранении которых товарный склад специализируется:
            <?php if(isset($data['product_type'])): ?> <?php echo e(str_replace("_", " ", $data['product_type'])); ?><?php endif; ?>
        </p>
        <p>7. Размер собственного капитала:
            <?php if(isset($data['own_capital'])): ?><?php echo e($data['own_capital']); ?><?php endif; ?>
        </p>
        <p>8. Вид документа, подтверждающего право собственности, владения и пользования складскими помещениями:
            <?php if(isset($data['ownership_docs'])): ?><?php echo e($data['ownership_docs']); ?><?php endif; ?>
        </p>
        <p>9. Общие сведения о квалификации и опыте работы персонала:
            <?php if(isset($data['experience'])): ?> <?php echo e(str_replace("_", " ", $data['experience'])); ?><?php endif; ?>
        </p>
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
<?php /**PATH /var/www/html/sklads/resources/views/vendor/unclusion_in_the_register_generatePDF.blade.php ENDPATH**/ ?>