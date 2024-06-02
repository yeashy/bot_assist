<header
    class="flex items-center justify-between main-block-company px-6 py-2"
>
    <div class="flex items-center justify-center absolute">
        <a href="/companies/{{ $company->id }}">
            <i class="fa-solid fa-house fa-xl"></i>
        </a>
    </div>

    <div
        class="items-center flex justify-center w-full text-center text-3xl font-bold"
    >
        {{ $company->name }}
    </div>
</header>
