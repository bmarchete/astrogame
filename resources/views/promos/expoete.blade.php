<!DOCTYPE html>
<html dir="ltr" lang="{{ \Lang::getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Expoete 2016</title>

    {!! Minify::stylesheet(['/vendor/uikit/css/normalize.css', '/vendor/uikit/css/uikit.gradient.css', '/css/project/expoete.css'])->withFullUrl() !!} @yield('style')
    <link rel="icon" type="image/png" href="/img/favicon/favicon-32x32.png" sizes="32x32">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="uk-container uk-container-center">
        <video src="http://localhost/trailer.mp4" width="1080" autoplay style="position: fixed; right: 10%;padding: 6px;background: #fff;border-radius: 3px;margin: 10px" loop></video>

        <a href="http://avellan.com.br">
            <img src="{{ asset('img/avellan.png')}}" width="250" style="position: fixed;bottom: 0;right: 0;">
        </a>
    </div>
    <img src="{{ asset('img/expoete_qrcode.jpg')}}" width="130" style="position: fixed; bottom: 1%; left: 1%">
</body>
</html>
