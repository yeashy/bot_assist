<div
    class="rounded-2xl col-span-2 row-span-2 aspect-square p-4 block-company box-shadow-basic"
>
    <div class="text-2xl">
        Ближайшая запись:
    </div>
    @include('company.components.main_block.assignment_info')
    <div class="flex justify-end">
        @include('components.button', ['text' => 'Подробнее о записи'])
    </div>
</div>
