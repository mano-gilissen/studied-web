<!doctype html>



<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="_token" content="{{ csrf_token() }}">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/translate.js') }}"></script>
    <script src="{{ asset('js/autocomplete_210525.js') }}"></script>
    <script src="{{ asset('js/events_110625_8.js') }}"></script>



    <script>

        if (typeof navigator.serviceWorker !== 'undefined') {

            navigator.serviceWorker.register('/sw.js', { scope: '/' });

        }

        let lang = '{{ \App\Http\Middleware\Locale::getActive() }}';

    </script>



    @yield('scripts')



    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;1,300&display=swap" rel="stylesheet">



    <link href="{{ asset('css/app_110625_4.css') }}" rel="stylesheet">



    @yield('css')



    <title>Studied</title>

</head>



<body>

    <div id="loader-global"></div>

    <div id="tooltip"></div>

    <div id="app">

        @yield('content')

    </div>

</body>



</html>
