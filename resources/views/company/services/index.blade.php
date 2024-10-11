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
            window.axios.get('/companies/{{ $company->id }}/employees/schedule', {
                params: {
                    'employee_ids': ids.split(',')
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
            const service = document.getElementById('service-name');
            const date = document.getElementById('working-period-date');
            const time = document.getElementById('working-period-time');

            createSelectElement(data);

            service.innerText = '{{ $service->name }}'
            date.innerText = data.date;
            time.innerText = data.time;
        }

        function createSelectElement(data) {
            const employeeIds = data.employeeIds.split(',');
            const employeeNames = data.employeeNames.split(',');
            const name = document.getElementById('staff-member-name');

            const selectElement = document.createElement('select');
            selectElement.name = 'employee_working_period_id';
            selectElement.classList.add(
                'w-full',
                'p-2',
                'rounded-md',
                'text-lg',
                'input-company',
                'select-company'
            );

            name.innerHTML = '';
            name.appendChild(selectElement);

            const form = document.getElementById('assign-to-service-form');
            const workingPeriodIdInput = form.querySelector('[name=employee_working_period_id]');
            const submitButton = form.querySelector('button[type=submit]');

            employeeIds.forEach(function (id, index) {
                const optionElement = document.createElement('option');
                optionElement.value = id;
                optionElement.innerText = employeeNames[index];
                optionElement.classList.add(
                    'option-company',
                );

                selectElement.appendChild(optionElement);

                if (!index) {
                    getPeriodInfo(data, selectElement, workingPeriodIdInput, submitButton);
                }
            });

            if (employeeIds.length < 2) {
                selectElement.disabled = true;
            }

            selectElement.addEventListener('change', function () {

                console.log(selectElement.value);

                getPeriodInfo(data, selectElement, workingPeriodIdInput, submitButton);
            });
        }

        function getPeriodInfo(data, selectElement, workingPeriodIdInput, submitButton) {
            const employeeId = selectElement.value;
            const addressElement = document.getElementById('company-affiliate-address');

            workingPeriodIdInput.value = '';
            submitButton.disabled = true;
            addressElement.innerText = '...';

            window.axios.get('/companies/{{ $company->id }}/employees/' + employeeId + '/working-period' , {
                params: {
                    'date': data.date,
                    'time': data.time
                }
            })
                .then((response) => {
                    addressElement.innerText = response.data.company_affiliate_address;
                    workingPeriodIdInput.value = response.data.employee_working_period_id;
                    submitButton.disabled = false;
                });
        }
    </script>
@endsection
