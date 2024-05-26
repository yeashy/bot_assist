<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('components.main.head')
<body>
<div id="app" class="flex flex-col h-screen">
    @include('components.main.header')
    <div
        id="content"
        class="grow w-screen p-6 pb-2 bg-company"
    >
        @yield('content')
    </div>
    @include('components.main.footer')
</div>
@yield('end_scripts')
@yield('end_includes')
</body>
</html>
