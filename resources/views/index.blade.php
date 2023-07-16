<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" crossorigin="anonymous">
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('./libs/bootstrap/bootstrap.min.css') }}'>

    <!-- плагины -->
    @yield('plugins')

    <!-- основные стили -->
    <link rel='stylesheet' type='text/css' media='screen' href='{{ asset('./css/main.min.css') }}'>
    @livewireStyles
</head>


<body>
    <div class="main">
        @include('layouts.burger')
        @include('layouts.sidebar')
        <div class="content">
            <div class="top-line">
                @include('layouts.header')
            </div>

            @yield('content')

        </div>
    </div>
    <footer class="contact">
        @include('layouts.footer')
    </footer>
    @yield('scripts')
    @livewireScripts
</body>

</html>
