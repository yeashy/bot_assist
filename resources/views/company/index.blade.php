@extends('layouts.default')

@section('title')
    Компания "{{ $company->name }}"
@endsection

@section('content')
    <script>
        function getNextAssignment() {
            window.axios.get('/companies/{{ $company->id }}/assignments/next')
                .then((response) => {
                    document.querySelector('.next-assignment').innerHTML = response.data;
                });
        }

        document.addEventListener('AxiosLoaded', () => {
            getNextAssignment();
        });
    </script>

    <div>
        <div class="next-assignment">
        </div>
    </div>
@endsection
