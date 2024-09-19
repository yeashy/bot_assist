<a
    class="rounded-2xl p-2 flex h-20 mb-4 block-company"
    href="positions/{{ $position->id }}/services"
>
    <div class="h-full aspect-square overflow-hidden rounded-2xl mr-2">
        <img class="w-full h-full object-cover" src="{{ Storage::disk('images')->url('default/test.jpg') }}" alt="">
    </div>
    <div class="mr-auto flex flex-col justify-center text-xl w-1/2 text-ellipsis overflow-hidden">
            {{ $position->name }}
    </div>
    <div class="p-4 w-1/4 h-full">
        <div class="text-company-primary rounded-xl flex justify-center items-center h-full">
            <i class="fa-solid fa-arrow-right fa-xl"></i>
        </div>
    </div>
</a>
