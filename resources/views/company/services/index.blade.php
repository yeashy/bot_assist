@extends('layouts.default')

@section('title')
    Запись на услугу "{{ $service->name }}" | {{ $company->name }}
@endsection

@section('content')
    <div class="h-full">
        <div class="mb-4">
            @include('company.services.components.employee-slider')
        </div>
        <div>
            @include('company.services.components.schedule')
        </div>
        <div>
            @include('company.services.components.info')
        </div>
    </div>
@endsection

@section('modals')
    @include('components.modals.employee-info-modal')
@endsection

@section('end_scripts')
    <script defer>
        const employeeInfoForm = document.getElementById('employee_info_form');

        addEventListeners();

        document.querySelectorAll('.hide_info').forEach((button) => {
            button.onclick = (e) => {
                hideEmployee();
                showSchedule(button.dataset.id);

                button.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center',
                    inline: 'center'
                });
            };
        });

        document.querySelectorAll('.employee_button').forEach((button) => {
            button.onclick = (e) => {
                showEmployee(button.dataset.id);

                button.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center',
                    inline: 'center'
                });
            };
        });

        function hideEmployee() {
            hideInfo();
        }

        function showEmployee(id) {
            showInfo(id);
            showSchedule(id);
        }

        function showInfo(id) {
            employeeInfoForm.classList.remove('hidden');
        }

        function showSchedule(id) {
            axios.get('/companies/{{ $company->id }}/employees/schedule', {
                params: {
                    'employee_ids': id
                }
            })
                .then((response) => {
                    initSchedule(response.data);
                    document.querySelector('.day.active').scrollIntoView({
                        block: 'center',
                        inline: 'center'
                    });
                });

            setEmployeeInfoData(id);
        }

        function hideInfo() {
            employeeInfoForm.classList.add('hidden');
            employeeInfoForm.action = '';
        }

        function setEmployeeInfoData(employeeId) {
            employeeInfoForm.action = '/companies/{{ $company->id }}/employees/' + employeeId + '/info';
        }

        function addEventListeners() {
            employeeInfoForm.addEventListener('submitted', (e) => {
                document.querySelector('#employee-info-modal #modal-body').innerHTML = e.detail.data;
            });
        }

        function initSchedule(data) {
            //TODO: переделать кринж
            const schedule = document.getElementById('schedule');
            schedule.innerHTML = data;

            const employeeScheduleForms = document.querySelectorAll('#employee_schedule_form');
            const buttons = document.querySelectorAll('#employee_schedule_form button[type=submit]');
            const periods = document.querySelector('.calendar .periods');

            employeeScheduleForms.forEach((form) => {
                form.addEventListener('requested', (e) => {
                    form.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center',
                        inline: 'center'
                    });

                    buttons.forEach((button) => {
                        button.classList.remove('active');
                    });

                    form.querySelector('[type=submit]').classList.add('active');

                    periods.innerHTML = `@include('components.loading-animation')`;
                });

                form.addEventListener('submitted', (e) => {
                    initSchedule(e.detail.data);

                    document.querySelector('.day.active').scrollIntoView({
                        block: 'center',
                        inline: 'center'
                    });
                });
            });
        }
    </script>
@endsection
