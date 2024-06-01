<div
    id="buttons"
    class="w-full grid grid-cols-2 gap-4"
>
    @include('company.components.main_block.main_block')
    @include('company.components.button', ['text' => 'Записаться на прием', 'href' => $company->id . '/services'])
    @include('company.components.button', ['text' => 'Мои записи'])
    @include('company.components.button', ['text' => 'Связь с администратором'])
    @include('company.components.button', ['text' => 'Информация'])
</div>
