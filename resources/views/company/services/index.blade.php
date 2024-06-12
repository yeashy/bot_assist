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
    <script>
        const employeeInfoForm = document.getElementById('employee_info_form');
        addEventListeners(employeeInfoForm);

        document.querySelectorAll('.hide_info').forEach((button) => {
            button.onclick = (e) => {
                hideEmployee();

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
            employeeInfoForm.classList.add('hidden');
            employeeInfoForm.action = '';
            document.getElementById('schedule').innerHTML = '';
        }

        function showEmployee(id) {
            employeeInfoForm.classList.remove('hidden');
            axios.get('/companies/{{ $company->id }}/employees/' + id + '/schedule')
                .then((response) => {
                    document.getElementById('schedule').innerHTML = response.data;
                });

            setEmployeeInfoData(id);
        }

        function setEmployeeInfoData(employeeId) {
            employeeInfoForm.action = '/companies/{{ $company->id }}/employees/' + employeeId + '/info';
        }

        function addEventListeners(form) {
            form.addEventListener('submitted', (e) => {
                document.querySelector('#employee-info-modal #modal-body').innerHTML = e.detail.data;
            });
        }
    </script>
@endsection
