@extends('layouts.app')
@section('content')
<div class="container content">
    <div id="form_ink">
        <h4 class="my-3 form_header">Электронная выписка - это официальный документ, удостоверяющий права правообладателя, а также подтверждающий характеристики земельного участка, как объекта недвижимости.</h4>
        <p class="enterINK">*Для получения электронной выписки нужно ввести ИНК земельного участка.</p>
        <form action="#" class="form">
            <div class="form__block">
                <label for="#" class="input__label">Введите ИНК</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="ink" required placeholder="" autocomplete="off" aria-label="Recipient's username" aria-describedby="basic-addon2" v-model="ink">
                    <!-- value="{{ isset($ink) ? $ink : '' }}" -->
                    <div class="invalid-feedback" id="error">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary form_submit btn-lg">Проверить</button>
        </form>
    </div>
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
                            <td id="ink_code"></td>
                        </tr>
                        <tr>
                            <th scope="row">ЕНИ код</th>
                            <td id="eni_code"></td>
                        </tr>
                        <tr>
                            <th scope="row">Место расположение:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="land_address">Адрес участка</td>
                            <td id="asr_address"></td>
                        </tr>
                        <tr>
                            <td class="land_address">Долгота</td>
                            <td id="longitude"></td>
                        </tr>
                        <tr>
                            <td class="land_address">Широта</td>
                            <td id="latitude"></td>
                        </tr>
                        <tr>
                            <th scope="row">Данные о собственнике:</th>
                            <td></td>
                        </tr>
                        <tr>
                            <td class="owner_info">ФИО</td>
                            <td id="owner_info"></td>
                        </tr>
                        <tr>
                            <td class="inn_pin">ИНН</td>
                            <td id="inn_pin"></td>
                        </tr>
                        <tr>
                            <th scope="row">Форма собственности</th>
                            <td id="property_form"></td>
                        </tr>
                        <tr>
                            <th scope="row">Правоудостоверяющий документ</th>
                            <td id="doc_enttitlement"></td>
                        </tr>
                        <tr>
                            <th scope="row">Категория земли</th>
                            <td id="land_ctg"></td>
                        </tr>
                        <tr>
                            <th scope="row">Земельное угодье</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Целевое назначение</th>
                            <td id="special_purpose_asr" class="color"></td>
                        </tr>
                        <tr>
                            <th scope="row">Фактическая площадь земельного участка, кв.м</th>
                            <td id="square" class="color"></td>
                        </tr>
                        <tr>
                            <th scope="row">Вид культуры (в текущее время)</th>
                            <td id="culture"></td>
                        </tr>
                        <tr>
                            <th scope="row">Вид культуры (предшественник)</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">Урожайность (предшественник), ц</th>
                            <td id="crop_yield" class="color"></td>
                        </tr>
                        <tr>
                            <th scope="row">Предварительная стоимость урожая, сом</th>
                            <th id="cultureValue"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="map_content">
                <div id="map_document"></div>
            </div>
        </div>
        <div class="btn_wrap">
            <button id="pdf_btn" type="submit" class="btn btn-primary">
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
@endsection
@push('page-scripts')
<script>
    $(document).ready(function() {
        let recapcha = document.getElementById('recapcha');
        let form = document.getElementById('form_ink');
        let input = document.getElementById('ink');
        let error = document.getElementById('error');
        let doc = document.getElementById('document');
        let Modal = document.getElementById('Modal');
        let spinnerBlock = document.getElementById('spinnerBlock');
        var paramsString = document.location.search; // ?page=4&limit=10&sortby=desc  
        var searchParams = new URLSearchParams(paramsString);

        // if (input.value) {
        //     console.log('ok')
        //     postQql(input.value, doc, form)
        // }

        if (searchParams.get("ink") !== null) {
            postQql(searchParams.get("ink"), doc, form)
        }

        var maskOptions = {
            mask: '000-00-000-000-00-0000-0000'
        };
        var mask = IMask(input, maskOptions);

        input.addEventListener('keyup', async function(e) {
            if (input.value.length < 21) {
                error.innerText = '';
                input.classList.remove('error');
            }
            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                pressKey = e.key;
                moveKey(pressKey, input)
                return
            }
            getInk(input, input.value, doc, form)
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
            postQql(input.value, doc, form)
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

        let i = -1;

        function moveKey(pressKey, input) {
            const ul = document.querySelector('.list-group');
            let max = ul.childNodes.length - 1;
            for (let i = 0; i <= max; i++) {
                ul.childNodes[i].classList.remove('activeINK');
            }
            if (pressKey === 'ArrowDown') {
                i++;
                if (i > max) {
                    i = 0;
                }
                ul.childNodes[i].classList.add('activeINK');
                input.value = ul.childNodes[i].innerText;
            }
            if (pressKey === 'ArrowUp') {
                i--;
                if (i < 0) {
                    i = max;
                }
                ul.childNodes[i].classList.add('activeINK');
                input.value = ul.childNodes[i].innerText;
            }
        }
    });

    window.addEventListener('click', function(e) {
        const input = document.getElementById('ink');
        const oldUl = document.querySelector('.list-group')

        if (e.target.className !== 'list-group-item' && oldUl) {
            input.parentElement.removeChild(oldUl);
        }

    })

    function addText(input, text, doc, form) {
        input.value = text;
        postQql(input.value, doc, form)
    }

    function renderUl(input, arr, doc, form) {
        const oldUl = document.querySelector('.list-group')
        if (oldUl) {
            input.parentElement.removeChild(oldUl);
        }
        if (arr.length === 0 && oldUl) {
            input.parentElement.removeChild(oldUl);
            return
        }
        const ul = document.createElement('ul');
        ul.classList.add('list-group');
        arr.forEach(element => {
            const li = document.createElement('li');
            li.classList.add('list-group-item');
            li.addEventListener('click', function() {
                addText(input, this.innerHTML, doc, form)
            })
            li.append(element.ink_code);
            ul.append(li)
        });
        input.parentElement.append(ul)
    }

    async function getInk(input, text, doc, form) {
        try {
            const response = await fetch(`http://185.138.184.8:8111/search_ink_hub/?search=${text}`);

            if (response.status !== 200) {
                throw new Error('error');
            }
            const data = await response.json()
            renderUl(input, data.list_ink_code, doc, form)
        } catch (error) {}
    }

    async function postQql(ink, doc, form) {
        try {
            spinnerBlock.classList.remove('hide');
            const query = `query MyQuery {
  hub_landinfo(where: {ink_code: {_eq: "${ink}"}}) {
    id
    ink_code
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
    square
    culture
    crop_yield
    main_map
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
                onClick: function() {} // Callback after click
            }).showToast();
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

        let cultureName = ['Пшеница', 'barley', 'corn', 'rice', 'sugar_beet', 'raw_cotton',
            'tobacco', 'oil_crops', 'potato', 'vegetables', 'food_melons', 'Яблоко', 'grapes'
        ];
        let centnerPerHectare = [22, 20, 63, 35, 373, 31, 24, 11, 166, 192, 217, 49, 15];
        let price = [25, 21, 22, 130, 10, 90, 75, 45, 40, 30, 30, 150, 100];
        let output = cultureName.map((c, i) => ({
            name: c,
            centnerPerHectare: centnerPerHectare[i],
            price: price[i]
        }));
        let a = output;
        let cultureValue = '';
        for (const item of a) {
            if (item.name.includes(dataInfo.culture) == true) {
                let m = item.centnerPerHectare;
                let s = dataInfo.square;
                let p = item.price;
                cultureValue = s * m * p / 100;
            }
        }
        putData('cultureValue', Math.round(cultureValue).toLocaleString())
        let map = L.map('map_document').setView(result.reverse(), 16)
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map)

        var qrcode = new QRCode('qrcode', `http://192.168.0.170:3000/ink?ink=${String(dataInfo.ink_code)}`)
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
@endpush