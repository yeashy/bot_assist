<header
    class="flex items-center justify-between bg-company-secondary text-company-primary px-6 py-2 z-[100] shadow-company relative"
>
    <div
        class="items-center flex justify-center w-full text-center text-3xl font-bold"
    >
        {{ $company->name }}
    </div>
    <div class="absolute right-6 flex items-center h-full pt-1">
        <a href="/companies/{{ $company->id }}/info">
            <i class="la la-info-circle la-lg"></i>
        </a>
    </div>
</header>
