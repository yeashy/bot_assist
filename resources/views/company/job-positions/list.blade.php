@extends('layouts.default')

@section('title')
    Специальности | "{{ $company->name }}"
@endsection

@section('content')
    <div class="h-full">
        @include('components.page-title', ['text' => 'Выберите специальность'])

        <div>
            @forelse($positions as $position)
                @include('company.job-positions.components.item', ['position' => $position])
            @empty
            @endforelse
        </div>
    </div>
@endsection
