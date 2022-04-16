<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@hasSection ('title')@yield('title'){{ ' – Anjir' }}@else{{ 'Anjir – Магазин одежды со вкусом стиля' }}@endif</title>

    {{-- Noindex remove on production --}}
    <meta name="robots" content="none" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yandex" content="none">

    {{-----------Meta tags start--------- --}}
    {{-- Same metas for all routes --}}
    <meta name="keywords" content="Anjir, Анжир, Магазин одежды со вкусом стиля, Интернет магазин"/>
    <meta property="og:site_name" content="Anjir">
    <meta property="og:type" content="object" />
    <meta name="twitter:card" content="summary_large_image">

    @hasSection ('meta-tags')
        @yield('meta-tags')
    @else
        @php $shareText = 'Магазин одежды со вкусом стиля. Купите товары с выгодной ценой и с быстрой доставкой!'; @endphp
        <meta name="description" content="{{ $shareText }}">
        <meta property="og:description" content="{{ $shareText }}">
        <meta property="og:title" content="Anjir" />
        <meta property="og:image" content="{{ asset('img/main/logo-share.png') }}">
        <meta property="og:image:alt" content="Anjir logo">
        <meta name="twitter:title" content="Anjir">
        <meta name="twitter:image" content="{{ asset('img/main/logo-share.png') }}">
    @endif
    {{----------- Meta tags end-----------}}

    {{-- Favicons for all devices --}}
    <link rel="icon" href="{{ asset('img/main/cropped-favicon-32x32.ico') }}" sizes="32x32">
    <link rel="icon" href="{{ asset('img/main/cropped-favicon-192x192.ico') }}" sizes="192x192">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('img/main/cropped-favicon-180x180.ico') }}">
    <meta name="msapplication-TileImage" content="{{ asset('img/main/cropped-favicon-270x270.ico') }}">

    {{-- Open Sans Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    {{-- Material Icons --}}
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/owl-carousel/owl.theme.default.min.css') }}">
    {{-- LightBox --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/fullscrin-lightbox/lightboxed.css') }}">
    {{-- <link rel="stylesheet" href="{{ mix('css/minified/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    @include('layouts.header')
    @yield('main')
    @include('layouts.footer')

    @include('modals.feedback')
    @include('modals.policy')
    @include('modals.buy-on-click')
    
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{-- Owl Carousel --}}
    <script src="{{ asset('js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    {{-- LightBox --}}
    <script src="{{ asset('js/plugins/fullscrin-lightbox/lightboxed.js') }}"></script>
    {{-- Scripts --}}
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>