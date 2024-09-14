@extends('layouts.default')

@section('title')
    Компания "{{ $company->name }}"
@endsection

@section('content')
    <div>
        @include('company.index.main-block.main-block')
        @include('company.index.main-block-new')
    </div>
@endsection
