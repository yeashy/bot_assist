@extends('layouts.default')

@section('title')
    Компания "{{ $company->name }}"
@endsection

@section('content')
    <div
        class="min-h-full p-6 w-full"
        style="background-color: {{ $company->secondary_color }}"
    >
        @include('company.components.buttons')
    </div>
@endsection
