@include('components.form', [
            'id' => 'registration-form',
            'action' => '/companies/' . $company->id . '/clients/register',
            'method' => 'POST',
            'title' => 'Зарегистрируйтесь',
            'inputs' => [
                'name' => [
                    'label' => 'Имя',
                    'type' => 'text',
                    'placeholder' => 'Иван'
                ],
                'surname' => [
                    'label' => 'Фамилия',
                    'type' => 'text',
                    'placeholder' => 'Иванов'
                ],
                'patronymic' => [
                    'label' => 'Отчество',
                    'type' => 'text',
                    'placeholder' => 'Иванович'
                ],
                'phone_number' => [
                    'label' => 'Номер телефона',
                    'type' => 'text',
                    'placeholder' => '+7 (999)-999-99-99'
                ]
            ],
            'submitBtn' => [
                'text' => 'Зарегистрироваться',
                'class' => 'mt-2 w-full'
            ]
        ])
