
<?php $__env->startSection('content'); ?>
<!-- <document-component></document-component> -->
<div class="wrapper-document">
    <nav class="navbar-document">
        <!-- <img class="giprozem_logo" src="<?php echo e(asset('/images/document/giprozem-logo.png')); ?>" alt="giprozem-logo"> -->
        <img class="giprozem_logo" src="/images/document/giprozem-logo.png" alt="giprozem-logo">
        <div class="title">
            <div>
                <h1>Электронная выписка</h1>
                <h3>на элементарный участок</h3>
            </div>
        </div>
        <div class="qr_code">
            <div id="qrcode"></div>
        </div>
    </nav>
    <div class="date_num">
        <div class="num">№ 00123</div>
        <!-- <br> -->
        <div class="date">Дата: 01.01.2000</div>
    </div>
    <div class="table_data">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <p class="table_title">Информация о земельном участке.</p>
                </tr>
            </thead>
            <hr>
            <tbody>
                <tr>
                    <th scope="row">Идентификационный номер контура (ИНК)</th>
                    <td>417-02-205-825-02-1020-1004</td>
                </tr>
                <tr>
                    <th scope="row">ЕНИ код</th>
                    <td>7-02-10-4444-1010-02-123</td>
                </tr>
                <tr>
                    <th scope="row">Место расположение:</th>
                    <td></td>
                </tr>
                <tr>
                    <td class="land_address">Адрес участка</td>
                    <td>Чуйская обл., Аламудунский район</td>
                </tr>
                <tr>
                    <td class="land_address">Долгота</td>
                    <td>78.12157110607144</td>
                </tr>
                <tr>
                    <td class="land_address">Широта</td>
                    <td>42.613751791719494</td>
                </tr>
                <tr>
                    <th scope="row">Данные о собственнике:</th>
                    <td></td>
                </tr>
                <tr>
                    <td class="owner_info">ФИО</td>
                    <td>Асанов Үсөн</td>
                </tr>
                <tr>
                    <td class="owner_info">ИНН</td>
                    <td>20101200200102</td>
                </tr>
                <tr>
                    <th scope="row">Форма собственности</th>
                    <td>Государственная собственность</td>
                </tr>
                <tr>
                    <th scope="row">Правоудостоверяющий документ</th>
                    <td>Удостоверение на право временного пользования земельным участком или договор аренды</td>
                </tr>
                <tr>
                    <th scope="row">Категория земли</th>
                    <td>Земли сельскохозяйственного назначения</td>
                </tr>
                <tr>
                    <th scope="row">Земельное угодье</th>
                    <td>Сельскохозяйственный вид угодий</td>
                </tr>
                <tr>
                    <th scope="row">Целевое назначение</th>
                    <td>Пахота</td>
                </tr>
                <tr>
                    <th scope="row">Фактическая площадь земельного участка, кв.м</th>
                    <td>28 035.26</td>
                </tr>
                <tr>
                    <th scope="row">Кадастровая стоимость, сом</th>
                    <td>100 000</td>
                </tr>
                <tr>
                    <th scope="row">Вид культуры (в текущее время)</th>
                    <td>Пшеница</td>
                </tr>
                <tr>
                    <th scope="row">Вид культуры (предшественник)</th>
                    <td>Пшеница</td>
                </tr>
                <tr>
                    <th scope="row">Урожайность (предшественник), кг</th>
                    <td>2 000</td>
                </tr>
                <tr>
                    <th scope="row">Предварительная стоимость урожая, сом</th>
                    <th>5 000 000</th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="map_content">
        <div id="map_document"></div>
    </div>
    
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page-scripts'); ?>
<script>
    $(document).ready(function() {
        let map = L.map('map_document').setView([42.636329, 78.226459], 14)
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map)

        var qrcode = new QRCode('qrcode',
            'https://g-b.24mycrm.com')

        var states = [{
            'type': 'Feature',
            'properties': {
                'party': 'Republican'
            },
            'geometry': {
                'type': 'Polygon',
                'coordinates': [
                    [
                        [
                            78.226459,
                            42.636329
                        ],
                        [
                            78.228904,
                            42.625183
                        ],
                        [
                            78.230835,
                            42.625467

                        ],
                        [
                            78.228304,
                            42.636613
                        ],
                        [
                            78.226459,
                            42.636329
                        ]
                    ]
                ]
            }
        }]

        L.geoJSON(states, {
            style: function(feature) {
                switch (feature.properties.party) {
                    case 'Republican':
                        return {
                            color: '#ff0000'
                        }
                }
            }
        }).addTo(map)

    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/document.blade.php ENDPATH**/ ?>