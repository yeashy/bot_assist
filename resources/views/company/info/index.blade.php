@extends('layouts.default')

@section('title')
    Информация о компании "{{ $company->name }}"
@endsection

@section('content')
    <div>
        @include('company.info.contacts')
    </div>
    <div>
        @include('company.info.map')
    </div>
    <div>
        @include('company.info.affiliates')
    </div>
@endsection
