<header
    class="flex items-center justify-between main-block-company px-6 py-2 z-[100] box-shadow-basic relative"
>
    <div
        class="items-center flex justify-center w-full text-center text-3xl font-bold"
    >
        {{ $company->name }}
    </div>
    <div class="absolute right-6 flex items-center h-full pt-2">
        <a href="/companies/{{ $company->id }}/info">
            <i class="la la-info-circle la-lg"></i>
        </a>
    </div>
</header>
