<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.main.head')
<body>
@yield('content')
</body>
