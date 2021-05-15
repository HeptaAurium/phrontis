<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    @include('layouts.extras.css')
</head>

<body>
    @include('layouts.navs.sidebar')
    <div id="app" class="">
        @include('layouts.navs.top-nav')
        <main>
            @yield('content')
        </main>
        @include('layouts.extras.js')
        @yield('javascript')
    </div>
</body>

</html>
