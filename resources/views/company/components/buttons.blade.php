<div
    id="buttons"
    class="w-full grid grid-cols-2 gap-4"
>
    @include('company.components.main_block.main_block')
    @include('components.shadow-button', [
        'text' => 'Записаться на прием',
        'attributes' => [
            'href' => $company->id . '/positions'
        ]
    ])
    @include('components.shadow-button', ['text' => 'Мои записи'])
    @include('components.shadow-button', ['text' => 'Связь с администратором'])
    @include('components.shadow-button', ['text' => 'Информация'])
</div>
