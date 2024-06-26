@extends('layouts.default')

@section('title')
    Запись на услугу "{{ $service->name }}" | {{ $company->name }}
@endsection

@section('content')
    <div class="h-full">
        <div class="mb-4">
            @include('company.services.components.employee-slider')
        </div>
        <div id="employee_data" class="h-1/2">
            @include('company.services.components.employee-data')
        </div>
    </div>
@endsection

@section('modals')
    @include('components.modals.employee-info-modal')
    @include('components.modals.assignment-to-service-modal')
@endsection

@section('end_scripts')
    <script defer>
        const employeeDataBlock = document.getElementById('employee_data');

        document.querySelectorAll('.hide_info').forEach((button) => {
            button.onclick = (e) => {
                hideData();
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
                hideData();
                showEmployee(button.dataset.id);

                button.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center',
                    inline: 'center'
                });
            };
        });

        function showEmployee(id) {
            showSchedule(id, true);
        }

        function showInfo(id) {
            const employeeInfoForm = document.getElementById('employee_info_form');
            employeeInfoForm.classList.remove('hidden');
            employeeInfoForm.action = '/companies/{{ $company->id }}/employees/' + id + '/info';

            employeeInfoForm.addEventListener('submitted', (e) => {
                document.querySelector('#employee-info-modal #modal-body').innerHTML = e.detail.data;
            });
        }

        function showSchedule(ids, withInfo = false) {
            axios.get('/companies/{{ $company->id }}/employees/schedule', {
                params: {
                    'employee_ids': ids
                }
            })
                .then((response) => {
                    initSchedule(response.data, ids, withInfo);
                });
        }

        function showData() {
            employeeDataBlock.innerHTML = `@include('company.services.components.employee-data')`;
        }

        function hideData() {
            employeeDataBlock.innerHTML = `@include('components.loading-animation')`;
        }

        function initSchedule(data, ids, withInfo = false) {
            showData();
            const idArray = ids.split(',');

            if (withInfo && idArray.length === 1) {
                showInfo(idArray[0]);
            }

            //TODO: переделать кринж
            const schedule = document.getElementById('schedule');
            schedule.innerHTML = data;

            activeDay = document.querySelector('.day.active');

            if (activeDay) {
                activeDay.scrollIntoView({
                    block: 'center',
                    inline: 'center'
                });
            }

            const employeeScheduleForms = document.querySelectorAll('#employee_schedule_form');
            const buttons = document.querySelectorAll('#employee_schedule_form button[type=submit]');
            const periods = document.querySelector('.calendar .periods');

            employeeScheduleForms.forEach((form) => {
                form.addEventListener('requested', (e) => {
                    if (form.dataset.full) {
                        hideData();
                    } else {
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
                    }
                });

                form.addEventListener('submitted', (e) => {
                    initSchedule(e.detail.data, ids, withInfo);
                });
            });
        }

        const assignToService = (button) => {
            setPeriodInfoToModal(button.dataset);
        }

        function setPeriodInfoToModal(data) {
            const name = document.getElementById('assignment-name');
            const service = document.getElementById('assignment-service');
            const address = document.getElementById('assignment-address');
            const date = document.getElementById('assignment-date');
            const time = document.getElementById('assignment-time');

            console.log(data);

            if (data.employeeIds.length > 1) {
                name.innerHTML = `@include('components.select', [
                    'name' => 'person_name',
                    'class' => 'w-full',
                    'options' => [
                        'Специалист 1' => '1',
                        'Специалист 2' => '2',
                        'Я обязательно это доделаю' => '5'
                    ]
                ])`;
                address.innerText = 'Адрес не отображаем до выбора специалиста';
            } else {
                name.innerText = data.personName;
                address.innerText = data.address;
            }

            service.innerText = '{{ $service->name }}'
            date.innerText = data.date;
            time.innerText = data.time;
        }
    </script>
@endsection
