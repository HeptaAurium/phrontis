<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>
    @include('layouts.extras.css')
</head>

<body>
    <div class="se-pre-con"></div>
    @include('layouts.navs.sidebar')
    @include('flash::message')
    <div id="app" class="mini">
        @include('layouts.navs.top-nav')
        <main>
            @yield('content')
        </main>
        @include('layouts.extras.js')
        @yield('javascript')
    </div>
    <script>
        $('div.alert').not('alert-important').delay(5000).fadeOut(350);

        $(window).on('load', function() {
            setTimeout(removeLoader, 2000); //wait for page load PLUS two seconds.
        });

        function removeLoader() {
            $(".se-pre-con").fadeOut(500, function() {
                // fadeOut complete. Remove the loading div
                $(".se-pre-con").addClass("hidden"); //makes page more lightweight 
            });
        }
    </script>
</body>

</html>
