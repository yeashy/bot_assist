@extends('layouts.default')

@section('title')
    Личный кабинет
@endsection

@section('start_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            axios.get('/companies/{{ $company->id }}/user/me', {
                params: {
                    company_id: parseInt('{{ $company->id }}')
                }
            })
                .then((response) => {
                    const user = response.data.user;
                    const registration = document.getElementById('registration');
                    const userData = document.getElementById('registered');

                    if (user.client === null) {
                        registration.classList.remove('hidden');
                        userData.remove();

                        addRegistrationFormReloadListener();
                    } else {
                        userData.classList.remove('hidden');
                        registration.remove();
                    }
                })
        });

        function addRegistrationFormReloadListener() {
            const form = document.getElementById('registration-form');

            form.addEventListener('submitted', (e) => {
                window.location.reload();
            });
        }
    </script>
@endsection

@section('content')
    <div id="registration" class="hidden">
        @include('components.forms.registration-form')
    </div>

    <div id="registered" class="flex hidden">
        @include('components.page-title', ['text' => 'Данные клиента тут'])

        <div class="rounded-full overflow-hidden">
            <img src="" alt="">
        </div>
    </div>
@endsection
