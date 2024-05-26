@extends('layouts.default')

@section('title')
    Компания "{{ $company->name }}"
@endsection

@section('content')
    <div>
        @include('company.components.buttons')
    </div>
@endsection
