@extends('layouts.default')

@section('title')
    Услуги компании "{{ $company->name }}"
@endsection

@section('content')
    <div class="h-full">
        <div class="text-company font-bold text-2xl text-center mb-4">
            Выберите услугу
        </div>

        <div>
            @forelse($services as $service)
                @include('company.services.components.item', ['service' => $service])
            @empty
            @endforelse
        </div>
    </div>
@endsection
