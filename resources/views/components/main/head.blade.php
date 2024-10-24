<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @yield('start_includes')
    @include('components.main.func.start_includes')
    @yield('start_scripts')
    @include('components.main.func.start_scripts')
    @yield('styles')
    @include('components.main.func.styles')
    <title>@yield('title')</title>
</head>
