<a
    class="rounded-2xl py-2 px-4 flex flex-col justify-between mb-4 block-company shadow-company-sm"
    href="services/{{ $service->id }}"
>
    <div class="mb-2 text-lg">
        {{ $service->name }}
    </div>
    <div class="flex justify-between">
        <div class="font-bold text-xl">
            {{ $service->price }}&nbsp;₽
        </div>
        <div class="flex items-center">
            <i class="fa fa-arrow-right fa-xl"></i>
        </div>
    </div>
</a>
