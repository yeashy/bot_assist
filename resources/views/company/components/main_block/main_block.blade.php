<div
    class="rounded-2xl col-span-2 row-span-2 aspect-square p-4"
    style="box-shadow: 0px 0px 30px 0px rgba(0,0,0,0.3), inset 15px 15px 37px 200px rgba(255,255,255,0.5); background-color: {{ $company->primary_color }}; color: {{ $company->font_color }}"
>
    <div class="text-2xl">
        Ближайшая запись:
    </div>
    @include('company.components.main_block.assignment_info')
    <div class="flex justify-end">
        @include('components.button', ['text' => 'Подробнее о записи'])
    </div>
</div>
