@extends('layouts.modal')

@php($id = 'employee-info-modal')

@section('modal-title')
    Информация о специалисте
@overwrite

@section('modal-body')
    @include('components.loading-animation')
@overwrite

@section('modal_scripts')
    <script>
        const loading = `@include('components.loading-animation')`

        const modal = document.getElementById('{{ $id }}');

        modal.addEventListener('opened', (e) => {
            modal.querySelector('#modal-body').innerHTML = loading;
        });

        modal.addEventListener('closed', (e) => {
            modal.querySelector('#modal-body').innerHTML = '';
        });
    </script>
@overwrite
