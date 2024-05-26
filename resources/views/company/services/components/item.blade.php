<a
    class="rounded-2xl p-2 flex h-24 mb-4"
>
    <div class="h-full w-1/4 overflow-hidden rounded-2xl mr-2">
        <img class="w-full h-full object-cover" src="{{ Storage::disk('images')->url('test.jpg') }}" alt="">
    </div>
    <div class="mr-auto flex flex-col justify-center">
        <div class="font-bold">
            {{ $service->name }}
        </div>
        <div>
            {{ $service->allocated_time }}
        </div>
    </div>
    <div class="flex items-center justify-center border-l border-company w-1/4">
        <span class="font-bold">{{ $service->price }}</span>&nbsp;₽
    </div>
</a>
