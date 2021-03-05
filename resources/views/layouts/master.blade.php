<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>


    <link href="{{ asset('css/vendor.bundle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet">

</head>

<body class="@yield('body-class')" style="background-image: url('/img/header.jpg');background-position: center;background-size: cover;">
<div id="app">
    @yield('content')
</div>
<script src="{{ asset('js/vendor.bundle.js') }}"></script>
<script src="{{ asset('js/scripts.bundle.js') }}"></script>
<script src="{{ asset('js/pdfmake.min.js') }}"></script>
@include('sweetalert::alert')
@stack('scripts')
</body>
</html>

