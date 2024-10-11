@extends('layouts.modal')

@php($id = 'assignment-to-service-modal')

@section('modal-title')
    Записаться на услугу
@overwrite

@section('modal-body')
    <div class="mb-2">
        <div class="text-lg font-bold">Специалист:</div>
        <div class="text-xl" id="staff-member-name"></div>
    </div>

    <div class="mb-2">
        <div class="text-lg font-bold">Услуга:</div>
        <div class="text-xl" id="service-name"></div>
    </div>

    <div class="mb-2">
        <div class="text-lg font-bold">Дата записи:</div>
        <div class="text-xl" id="working-period-date"></div>
    </div>

    <div class="mb-2">
        <div class="text-lg font-bold">Время записи:</div>
        <div class="text-xl" id="working-period-time"></div>
    </div>

    <div class="mb-auto">
        <div class="text-lg font-bold">Адрес:</div>
        <div class="text-xl" id="company-affiliate-address"></div>
    </div>

    @include('components.forms.assign-to-service-form')
@overwrite

@section('modal_scripts')

@overwrite
