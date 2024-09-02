@include('components.form', [
            'id' => 'registration-form',
            'action' => '/companies/' . $company->id . '/clients/register',
            'method' => 'POST',
            'title' => 'Зарегистрируйтесь',
            'inputs' => [
                'surname' => [
                    'label' => 'Фамилия',
                    'type' => 'text',
                    'placeholder' => 'Иванов'
                ],
                'name' => [
                    'label' => 'Имя',
                    'type' => 'text',
                    'placeholder' => 'Иван'
                ],
                'patronymic' => [
                    'label' => 'Отчество',
                    'type' => 'text',
                    'placeholder' => 'Иванович'
                ],
                'phone_number' => [
                    'label' => 'Номер телефона',
                    'type' => 'text',
                    'placeholder' => '+7 (999)-999-99-99',
                    'class' => 'phone-number'
                ]
            ],
            'submitBtn' => [
                'text' => 'Зарегистрироваться',
                'class' => 'mt-2 w-full'
            ]
        ])
