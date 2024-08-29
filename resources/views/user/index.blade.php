@extends('layouts.default')

@section('title')
    Личный кабинет
@endsection

@section('start_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            axios.get('/companies/{{ $company->id }}/user/me', {})
                .then((response) => {
                    console.log(response.data);
                    document.getElementById('user').innerText = JSON.stringify(response.data);
                })
        })
    </script>
@endsection

@section('content')
    <div id="user">

    </div>
@endsection
