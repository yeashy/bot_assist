<div
        class="rounded-2xl aspect-square p-4 block-company shadow-company mb-4"
>
    <div class="text-2xl">
        Ближайшая запись:
    </div>
    @include('company.index.main-block.assignment_info')
    <div class="flex justify-end">
        @include('components.button', ['text' => 'Подробнее о записи'])
    </div>
</div>
