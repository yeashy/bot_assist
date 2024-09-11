@extends('layouts.default')

@section('title')
    Настройка профиля
@endsection

@section('start_scripts')
    <script>
        document.addEventListener('AxiosLoaded', () => {
            window.axios.get('/companies/{{ $company->id }}/user/me', {
                params: {
                    company_id: parseInt('{{ $company->id }}')
                }
            })
                .then((response) => {
                    const user = response.data.user;

                    const form = document.getElementById('edit-user-form');

                    function fillInput(inputName, value) {
                        form.querySelector('[name=' + inputName + ']').value = value;
                    }

                    fillInput('name', user.client.name);
                    fillInput('surname', user.client.surname);
                    fillInput('patronymic', user.client.patronymic);
                    fillInput('phone_number', user.phone_number_pretty ?? '');
                })
        });
    </script>
@endsection

@section('content')
@include('components.forms.edit-user-form')
@endsection
