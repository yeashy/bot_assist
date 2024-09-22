<a
    class="rounded-2xl py-2 px-4 flex h-12 mb-4 block-company shadow-company-sm"
    href="positions/{{ $position->id }}/services"
>
    <div class="mr-auto flex flex-col justify-center text-lg w-1/2 text-ellipsis overflow-hidden">
            {{ $position->name }}
    </div>
    <div class="h-full">
        <div class="text-company-primary rounded-xl flex justify-center items-center h-full">
            <i class="fa-solid fa-arrow-right fa-xl"></i>
        </div>
    </div>
</a>
