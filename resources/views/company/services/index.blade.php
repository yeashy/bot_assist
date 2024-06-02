@extends('layouts.default')

@section('title')
    Запись на услугу "{{ $service->name }}" | {{ $company->name }}
@endsection

@section('content')
    <div class="h-full">
        <div class="mb-4">
            @include('company.services.components.employee-slider')
        </div>
        <div id="employee_schedule" class="hidden">

        </div>
        <div id="employee_info" class="hidden">
            @include('company.services.components.info')
        </div>
    </div>
@endsection

@section('end_scripts')
    <script>
        document.querySelectorAll('.employee_button').forEach((button) => {
            button.onclick = (e) => {
                showEmployee(button.dataset.id);
            }
        });

        function showEmployee(id) {
            document.getElementById('employee_info').classList.remove('hidden');

            setEmployeeInfoData(id);
        }

        function setEmployeeInfoData(employeeId) {
            document.getElementById('employee_info_form').action =
                '/companies/{{ $company->id }}/employees/' + employeeId + '/info';
        }
    </script>
@endsection
