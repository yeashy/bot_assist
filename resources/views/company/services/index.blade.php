@extends('layouts.default')

@section('title')
    Услуги компании "{{ $company->name }}"
@endsection

@section('content')
    <div class="h-full">
        @forelse($services as $service)
            @include('company.services.components.item', ['service' => $service])
        @empty
        @endforelse
    </div>
@endsection
