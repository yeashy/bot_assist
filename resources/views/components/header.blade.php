<header
    class="flex p-2 items-center justify-center"
    style="background-color: {{ $company->secondary_color }}"
>
{{--    <img src="{{ $company->logo_path }}" alt="" class="h-14">--}}
    <div
        class="items-center flex justify-center w-full text-center text-3xl font-bold"
        style="color: {{ $company->font_color }}"
    >
        {{ $company->name }}
    </div>
</header>
