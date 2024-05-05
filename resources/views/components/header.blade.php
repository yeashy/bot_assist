<header
    class="text-center text-3xl bg-slate-500 font-bold text-white flex p-2"
    style="background-color: {{ $company->primary_color }}"
>
    <div
        class="items-center flex justify-center w-full"
        style="color: {{ $company->font_color }}"
    >
        {{ $company->name }}
    </div>
</header>
