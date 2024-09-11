@include('components.form', [
            'id' => 'edit-user-form',
            'action' => '/companies/' . $company->id . '/clients/update',
            'method' => 'PUT',
            'title' => 'Мои данные',
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
                'text' => 'Обновить данные',
                'class' => 'mt-2 w-full'
            ]
        ])
