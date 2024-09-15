@extends('layouts.error')

@section('title')
    Ошибка! {{ $code }}
@endsection

@section('content')
    <div class="text-company-primary bg-company-secondary flex w-full items-center flex-col">
        <div class="text-2xl font-bold w-full text-center m-4">
            {{ $code }}
        </div>
        <div class="text-lg w-full">
            {{ $text }}
        </div>
    </div>
@endsection
