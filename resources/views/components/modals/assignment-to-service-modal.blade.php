@extends('layouts.modal')

@php($id = 'assignment-to-service-modal')

@section('modal-title')
    Записаться на услугу
@overwrite

@section('modal-body')
    <form action="" class="h-full flex flex-col">
        <div class="mb-2">
            <div class="text-lg font-bold">Специалист:</div>
            <div class="text-xl" id="assignment-name"></div>
        </div>

        <div class="mb-2">
            <div class="text-lg font-bold">Услуга:</div>
            <div class="text-xl" id="assignment-service"></div>
        </div>

        <div class="mb-2">
            <div class="text-lg font-bold">Дата записи:</div>
            <div class="text-xl" id="assignment-date"></div>
        </div>

        <div class="mb-2">
            <div class="text-lg font-bold">Время записи:</div>
            <div class="text-xl" id="assignment-time"></div>
        </div>

        <div class="mb-auto">
            <div class="text-lg font-bold">Адрес:</div>
            <div class="text-xl" id="assignment-address"></div>
        </div>

        @include('components.button', [
            'text' => 'Подтвердить запись',
            'class' => 'w-full',
            'type' => 'submit',

        ])
    </form>
@overwrite

@section('modal_scripts')

@overwrite
