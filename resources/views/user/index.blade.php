@extends('layouts.default')

@section('title')
    Личный кабинет
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
                    const registration = document.getElementById('registration');
                    const userData = document.getElementById('registered');

                    if (user.client === null) {
                        registration.classList.remove('hidden');
                        userData.remove();

                        addRegistrationFormReloadListener(user);
                    } else {
                        userData.classList.remove('hidden');
                        registration.remove();

                        fillUserData(user);
                    }
                })
        });

        function addRegistrationFormReloadListener(user) {
            const form = document.getElementById('registration-form');

            if (user.phone_number !== null) {
                const phoneNumberInput = form.querySelector('[name=phone_number]');

                phoneNumberInput.type = 'hidden';
                phoneNumberInput.value = user.phone_number_pretty;
            }

            form.addEventListener('submitted', (e) => {
                window.location.reload();
            });
        }

        function fillUserData(user) {
            const avatarElement = document.getElementById('user-avatar');
            const nameElement = document.getElementById('user-name');

            nameElement.innerText = user.client.name;

            if (user.client.info.photo_path !== null) {
                avatarElement.src = user.client.info.photo_path;
            }
        }
    </script>
@endsection

@section('content')
    <div id="registration" class="hidden">
        @include('components.forms.registration-form')
    </div>

    <div id="registered" class="hidden w-full">
        @include('user.user-data')
    </div>
@endsection
