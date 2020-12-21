<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="_token" content="{{ csrf_token() }}">
        <meta name="user-id" content="{{ Auth::id() }}">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->

        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/background.css') }}">

        @yield('links')
        <link href="{{ URL::asset('css/layout.css')}}" rel="stylesheet" type="text/css" media="all">
        <link href="{{ URL::asset('css/layout2.css') }}" rel="stylesheet" type="text/css" media="all">

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="{{ asset('js/ui_scripts.js') }}" defer></script>
        @yield('scripts')
    </head>
    <body class="font-sans antialiased">
        @yield('header')
        @yield('body')
        @yield('footer')
    </body>
</html>
