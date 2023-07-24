<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seleksi Ayang</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Seleksi Ayang">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">
    <link rel="shortcut icon" href="favicon.ico">

    <!-- FontAwesome JS-->
    <script defer src="{{asset('assets/plugins/fontawesome/js/all.min.js')}}"></script>

    <!-- App CSS -->
    <link id="theme-style" rel="stylesheet" href="{{asset('assets/css/portal.css')}}">
    <body class="app">
        <header class="app-header fixed-top">
            @include('layouts.partials._topnav')
            @include('layouts.partials._sidebar')

        </header>

        </div>

        <div class="app-wrapper">
            @yield('content')


            @include('layouts.partials._footer')
        </div>
        </div>

    </body>

</head>
