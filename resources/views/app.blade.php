<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">



    @yield('css')



    <title>Studied</title>

</head>



<body>

    <div id="app">

        @yield('content')

    </div>

</body>



</html>
