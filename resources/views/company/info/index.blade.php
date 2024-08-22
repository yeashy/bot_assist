@extends('layouts.default')

@section('title')
    Информация о компании "{{ $company->name }}"
@endsection

@section('content')
    <div>
        @include('company.info.contacts')
    </div>
    <div class="mb-4">
        @include('company.info.map')
    </div>
@endsection
