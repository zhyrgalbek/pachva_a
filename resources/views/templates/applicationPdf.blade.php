<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    {{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">--}}
    <title>Document</title>
    <style>
        @font-face {
            font-family: "DejaVu Sans";
            font-style: normal;
            font-weight: 400;
            src: url("/fonts/djsans/DejaVuSans.ttf");
            /* IE9 Compat Modes */
            src: local("DejaVu Sans"),
            local("DejaVu Sans"),
            url("/fonts/djsans/DejaVuSans.ttf") format("truetype");
        }

        body {
            font-family: "DejaVu Sans", serif;
            font-size: 12px;
        }
    </style>
</head>
<body>
<div style="display: flex">
    <div style="padding-top: 15px">
        <img style="padding-top: 10px" src="{{ asset('images/Finmarket_лого_200х200.jpg') }}" alt="finmarket-logo"
             height="190">
        <img style="padding-top: 10px; padding-left: 10px" src="{{ asset('images/СБК_лого_200х200.jpg') }}"
             alt="finmarket-logo"
             height="190">
        <img style="padding-left: 27%" src="{{ asset('storage/' .$path_to_qrcode ) }}" height="150">
    </div>
</div>
<div>
    <div style="padding-top: 50px;">
        <div style="display: inline-block;width: 200px; white-space: normal">
            <p>
                <b style="font-size: 18px">Отправитель:</b>
            </p>
            <p>
                <b>ФИО:</b> {{ $sender['name'] }}
            </p>
            <p>
                <b>ИНН:</b> {{ $sender['identifier'] }}
            </p>
        </div>
        <div style="padding-left: 40%; display: inline-block;width: 200px; white-space: normal">
            <p>
                <b style="font-size: 18px">
                    Получатель:
                </b>
            </p>
            <p>
                <b>Компания:</b> {{ $recipient['name'] }}
            </p>
            <p>
                <b>ИНН:</b> {{ $recipient['identifier'] }}
            </p>
        </div>
    </div>
</div>
<div>
    <p style="text-align: center; font-size: 24px"><b>{{ $serviceName }}</b></p>
</div>
<div>
    <p><b>Запрос:</b></p>
    <ul>
        @foreach($sentFields as $key=>$value)
            <li>
                {{ $key.': '.$value }}
            </li>
        @endforeach
    </ul>
</div>
<div>
    <p><b>Ответ на запрос:</b></p>
    <ul>
        @for($i=0;$i<10;$i++)
            <li>
                {{$i}}-Минимальная сумма кредита (USD):112300
            </li>
        @endfor
    </ul>
</div>
<div id="date-container" style="margin-top: 50px;">
    <p><b>Дата: </b>{{date('d-m-Y h:i')}}</p>
</div>
</body>
</html>