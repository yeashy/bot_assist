@if(!empty($assignment))
    @include('components.block-title', ['text' => 'Ближайшая запись', 'href' => ' '])
    <div
        class="rounded-2xl p-2 block-company shadow-company-sm w-full h-24 flex"
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
                        {{ $assignment->period->employee->person->short_name }}
                    </div>
                    <div>
                        {{ $assignment->period->datetime }}
                    </div>
                </div>
                <div class="text-xl">
                    <span class="font-bold">{{ $assignment->service->price }}</span> ₽
                </div>
            </div>
            <div class="flex items-end">
                {{ $assignment->service->name }}
            </div>
        </div>
    </div>
@endif
