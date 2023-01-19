
<?php $__env->startSection('content'); ?>
<div class="content">
    <form action="#" class="form" id="form_ink">
        <div class="form__block">
            <label for="#" class="input__label">Введите ИНК</label>
            <div class="input-group">
                <input type="text" class="form-control" id="ink" required placeholder="" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="ink">

                <div class="invalid-feedback" id="error">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary form_submit btn-lg">Проверить</button>
    </form>
    <div class="document hide" id="document">
        <div class="wrapper-document" id="document_wrap">
            <nav class="navbar-document">
                <img class="giprozem_logo" src="/images/document/giprozem-logo.png" alt="giprozem-logo">
                <div class="title">
                    <div>Электронная выписка</div>
                    <div>на элементарный участок</div>
                </div>
                <div class="qr_code">
                    <div id="qrcode"></div>
                    <div class="date" id="date"></div>
                </div>
            </nav>
            <div class="table_data">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <p class="table_title">Информация о земельном участке.</p>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Идентификационный номер контура (ИНК)</th>
                            <td id="ink_code">417-02-205-825-02-1020-1004</td>
                        </tr>
                        <tr>
                            <th scope="row">ЕНИ код</th>
                            <td id="eni_code">7-02-10-4444-1010-02-123</td>
                        </tr>
                        <tr>
                            <th scope="row">Место расположение:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="land_address">Адрес участка</td>
                            <td id="asr_address">Чуйская обл., Аламудунский район</td>
                        </tr>
                        <tr>
                            <td class="land_address">Долгота</td>
                            <td id="longitude">78.12157110607144</td>
                        </tr>
                        <tr>
                            <td class="land_address">Широта</td>
                            <td id="latitude">42.613751791719494</td>
                        </tr>
                        <tr>
                            <th scope="row">Данные о собственнике:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="owner_info">ФИО</td>
                            <td id="owner_info">Асанов Үсөн</td>
                        </tr>
                        <tr>
                            <td class="inn_pin">ИНН</td>
                            <td id="inn_pin">20101200200102</td>
                        </tr>
                        <tr>
                            <th scope="row">Форма собственности</th>
                            <td id="property_form">Государственная собственность</td>
                        </tr>
                        <tr>
                            <th scope="row">Правоудостоверяющий документ</th>
                            <td id="doc_enttitlement">Удостоверение на право временного пользования земельным участком или договор аренды</td>
                        </tr>
                        <tr>
                            <th scope="row">Категория земли</th>
                            <td id="land_ctg">Земли сельскохозяйственного назначения</td>
                        </tr>
                        <tr>
                            <th scope="row">Земельное угодье</th>
                            <td>Сельскохозяйственный вид угодий</td>
                        </tr>
                        <tr>
                            <th scope="row">Целевое назначение</th>
                            <td id="special_purpose_asr" class="color">Пахота</td>
                        </tr>
                        <tr>
                            <th scope="row">Фактическая площадь земельного участка, кв.м</th>
                            <td id="square" class="color">28 035.26</td>
                        </tr>
                        <tr>
                            <th scope="row">Вид культуры (в текущее время)</th>
                            <td id="culture" class="color"></td>
                        </tr>
                        <tr>
                            <th scope="row">Вид культуры (предшественник)</th>
                            <td>Пшеница</td>
                        </tr>
                        <tr>
                            <th scope="row">Урожайность (предшественник), кг</th>
                            <td id="crop_yield" class="color"></td>
                        </tr>
                        <tr>
                            <th scope="row">Предварительная стоимость урожая, сом</th>
                            <th id="yield_value">5 000 000</th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="map_content">
                <div id="map_document"></div>
            </div>
        </div>
        <div class="btn_wrap">
            <button id="pdf_btn" type="submit" class="btn btn-primary" onclick="generatePDF()">
                Скачать PDF
            </button>
        </div>
    </div>
    <div class="spinnerBlock hide" id="spinnerBlock">
        <div class="spinner-border" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page-scripts'); ?>
<script>
    $(document).ready(function() {
        let recapcha = document.getElementById('recapcha');
        let form = document.getElementById('form_ink');
        let input = document.getElementById('ink');
        let error = document.getElementById('error');
        let doc = document.getElementById('document');
        let Modal = document.getElementById('Modal');
        let spinnerBlock = document.getElementById('spinnerBlock');
        let responseData = [];
        var paramsString = document.location.search; // ?page=4&limit=10&sortby=desc  
        var searchParams = new URLSearchParams(paramsString);

        if (searchParams.get("ink") !== null) {
            postQql(searchParams.get("ink"), responseData, doc, form)
        }

        var maskOptions = {
            mask: '000-00-000-000-00-0000-0000'
        };
        var mask = IMask(input, maskOptions);

        input.addEventListener('keyup', function() {
            if (input.value.length < 21) {
                error.innerText = '';
                input.classList.remove('error');
            }
            getInk(input.value)
        })

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (input.value.length < 21) {
                error.innerText = 'ИНК должен состоять из 21 цифры';
                input.classList.add('error');
                return
            }
            if (input.value.length >= 21) {
                error.innerText = '';
                input.classList.remove('error');
            }
            postQql(input.value, responseData, doc, form)
        })

        var button = document.getElementById("pdf_btn");
        var brakePage = document.getElementsByClassName("map_content");
        var navBar = document.getElementsByClassName("navbar");
        var btnExport = document.getElementsByClassName("btn_wrap");
        var footer = document.getElementsByTagName("footer");
        var section = document.getElementsByClassName("copyright");

        function hideElements() {
            navBar[0].classList.add('hide_nav');
            footer[0].classList.add('hide_footer');
            section[0].classList.add('hide_section');
            btnExport[0].classList.add('hide_btn');
        }

        function showElements() {
            navBar[0].classList.remove('hide_nav');
            footer[0].classList.remove('hide_footer');
            section[0].classList.remove('hide_section');
            btnExport[0].classList.remove('hide_btn');
        }

        button.addEventListener("click", async function() {
            await hideElements();
            window.print();
            showElements();
        });

    });

    async function getInk(text) {
        try {
            const response = await fetch(`http://185.138.184.8:8111/search_ink_hub/?search=${text}`);
            const data = await response.json()
            renderUl(data.list_ink_code)
        } catch (error) {
            console.log(error)
        }
    }

    async function postQql(ink, responseData, doc, form) {
        try {
            spinnerBlock.classList.remove('hide');
            const query = `query MyQuery {
            hub_landinfo(where: {ink_code: {_eq: "${ink}"}}) {
                    ink_code
                    id
                    eni_code
                    asr_address
                    longitude
                    latitude
                    owner_info
                    inn_pin
                    property_form
                    doc_enttitlement
                    special_purpose_asr
                    land_ctg
                    culture
                    crop_yield
                    main_map
                    square
                }
            }`;
            const response = await fetch('http://185.138.184.8:8087/v1/graphql', {
                method: 'POST',
                headers: {
                    "x-hasura-admin-secret": "RS0wqjDPes994GzytgYqoxeYkspM66f47FenuK6HSjpCdSGAGLxxEKmM8tB3vEra",
                },
                body: JSON.stringify({
                    query
                })
            })
            if (!response.ok) {
                throw new Error('failed to fetch')
            }
            const data = await response.json()
            if (data.data.hub_landinfo.length === 0) {
                throw new Error('404');
            }
            spinnerBlock.classList.add('hide');
            doc.classList.remove('hide');
            form.style.display = 'none';
            loadMap(data)
        } catch (error) {
            console.log(TypeError);
            spinnerBlock.classList.add('hide');
            if (TypeError == "Failed to fetch") {
                Toastify({
                    text: "Ошибка сервера!",
                    duration: 3000,
                    className: "rejected",
                    destination: "https://github.com/apvarun/toastify-js",
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    // style: {
                    //     background: "linear-gradient(to right, red, red)",
                    // },
                    onClick: function() {} // Callback after click
                }).showToast();
                return
            }

            Toastify({
                text: "Такой ИНК не существует!",
                duration: 3000,
                className: "rejected",
                destination: "https://github.com/apvarun/toastify-js",
                newWindow: true,
                close: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                // style: {
                //     background: "linear-gradient(to right, red, red)",
                // },
                onClick: function() {} // Callback after click
            }).showToast();

            console.log(error)
        }

    }

    function PolygonCenter(arr) {
        let result = [];
        let x = 0;
        let y = 0;
        for (let i = 0; i < arr.length; i++) {
            x += Number(arr[i][0]);
            y += Number(arr[i][1]);
        }
        result = [x / arr.length, y / arr.length];
        return result
    }

    function putData(elem, text) {
        document.getElementById(elem).innerHTML = text
    }

    function loadMap(data) {
        const dataInfo = data.data.hub_landinfo[0]
        const polygon = dataInfo.main_map.coordinates[0]
        const date = new Date()
        let result = PolygonCenter(polygon);

        putData('ink_code', dataInfo.ink_code)
        putData('eni_code', dataInfo.eni_code)
        putData('asr_address', dataInfo.asr_address)
        putData('longitude', dataInfo.longitude)
        putData('latitude', dataInfo.latitude)
        putData('owner_info', dataInfo.owner_info)
        putData('inn_pin', dataInfo.inn_pin)
        putData('property_form', dataInfo.property_form)
        putData('doc_enttitlement', dataInfo.doc_enttitlement)
        putData('special_purpose_asr', dataInfo.special_purpose_asr)
        putData('land_ctg', dataInfo.land_ctg)
        putData('square', dataInfo.square)
        putData('culture', dataInfo.culture)
        putData('crop_yield', dataInfo.crop_yield)
        putData('date', date.toLocaleDateString())

        let map = L.map('map_document').setView(result.reverse(), 16)
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map)


        var qrcode = new QRCode('qrcode',
            `http://192.168.0.151:3000/ink?ink=${String(dataInfo.ink_code)}`)
        var states = [{
            'type': 'Feature',
            'properties': {
                'party': 'Agro_land'
            },
            'geometry': {
                'type': 'Polygon',
                'coordinates': [
                    polygon
                ]
            }
        }]

        L.geoJSON(states, {
            style: function(feature) {
                switch (feature.properties.party) {
                    case 'Agro_land':
                        return {
                            color: '#ff0000'
                        }
                }
            }
        }).addTo(map)
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\pachva_a\resources\views/ink.blade.php ENDPATH**/ ?>