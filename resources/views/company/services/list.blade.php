@extends('layouts.default')

@section('title')
    Услуги специальности "{{ $position->name }}" | "{{ $company->name }}"
@endsection

@section('content')
    <div class="h-full">
        @include('components.page-title', ['text' => 'Выберите услугу'])

        <div>
            @forelse($services as $service)
                @include('company.services.components.item', ['service' => $service])
            @empty
            @endforelse
        </div>
    </div>
@endsection
