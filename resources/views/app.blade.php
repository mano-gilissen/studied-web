<!doctype html>



<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">



<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="_token" content="{{ csrf_token() }}">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('js/translate_091025.js') }}"></script>
    <script src="{{ asset('js/autocomplete_190825.js') }}"></script>
    <script src="{{ asset('js/events_110625_9.js') }}"></script>



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
    <link rel="shortcut icon" type="image/png" href="/icons/android/android-launchericon-96-96.png">
    <link rel="apple-touch-icon" href="/icons/ios/128.png">



    <link href="{{ asset('css/app_020925.css') }}" rel="stylesheet">



    @yield('css')



    <title>Studied</title>

</head>



<body>

    <div id="loader-global">

        <div class="loader"></div>

    </div>

    <div id="tooltip"></div>

    <div id="app">

        @yield('content')

    </div>

</body>



</html>
