<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <body>
        <div id="app" class="flex flex-col h-screen">
            @include('components.header')
            <div id="content" class="grow w-screen">
                @yield('content')
            </div>
            @include('components.footer')
        </div>
        @yield('end_scripts')
        @yield('end_includes')
    </body>
</html>
