@include('components.form', [
    'id' => 'assign-to-service-form',
    'action' => '',
    'method' => 'POST',
    'inputs' => [
        'service_id' => [
            'type' => 'hidden'
        ]
    ],
    'submitBtn' => [
        'text' => 'Подтвердить запись',
        'class' => 'mt-2 w-full',
        'disabled' => true
    ]
])
