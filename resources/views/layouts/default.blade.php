<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @yield('start_includes')
    @yield('start_scripts')
    @yield('styles')
    @include('components.head')
    <body>
        @include('components.header')
        @yield('content')
        @include('components.footer')
        @yield('end_scripts')
        @yield('end_includes')
    </body>
</html>
