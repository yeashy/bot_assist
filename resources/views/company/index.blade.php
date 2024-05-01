@extends('layouts.default')

@section('title')
    Компания "{{ $company->name }}"
@endsection

@section('content')
    <div>{{ $company->phone_number }}</div>
@endsection
