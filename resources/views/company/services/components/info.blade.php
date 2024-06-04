<div class="w-full">
    <form id="employee_info_form" method="GET">
        @include('components.button', [
            'text' => 'Информация о специалисте',
            'class' => 'w-full modal-toggle',
            'type' => 'submit',
            'dataset' => [
                'modal' => 'employee-info-modal'
            ]
        ])
    </form>
</div>
