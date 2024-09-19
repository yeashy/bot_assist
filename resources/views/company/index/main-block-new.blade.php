@include('components.block-title', ['text' => 'Ближайшая запись', 'href' => ' '])
<div
    class="rounded-2xl p-2 block-company shadow-company w-full h-24 flex"
>
    <div
        class="h-full aspect-square rounded-2xl bg-cover mr-2"
        style="background-image: url({{ Storage::disk('images')->url('default/test.jpg') }});"
    >
    </div>
    <div class="flex-1 flex flex-col justify-between">
        <div class="flex justify-between w-full">
            <div class="flex-1">
                <div class="font-bold">
                    Иванов И. И.
                </div>
                <div>
                    22 мая, 17:00
                </div>
            </div>
            <div class="text-xl">
                <span class="font-bold">2200</span> ₽
            </div>
        </div>
        <div class="flex items-end">
            Первичный осмотр
        </div>
    </div>
</div>
