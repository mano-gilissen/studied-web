<!doctype html>



<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/autocomplete_100823.js') }}"></script>
    <script src="{{ asset('js/events_290524.js') }}"></script>



    @yield('scripts')



    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">



    <link href="{{ asset('css/app_100823.css') }}" rel="stylesheet">
    @yield('css')
    <link href="{{ asset('css/mobile_100823.css') }}" rel="stylesheet">



    <title>Studied</title>

</head>



<body>

    <div id="tooltip"></div>

    <div id="app">

        @yield('content')

    </div>

    @include('block.mobile')

</body>



</html>
