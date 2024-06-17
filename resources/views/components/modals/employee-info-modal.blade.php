@extends('layouts.modal')

@php($id = 'employee-info-modal')

@section('modal-title')
    Информация о специалисте
@endsection

@section('modal-body')
    @include('components.loading-animation')
@endsection

@section('modal_scripts')
    <script>
        const loading =
            '<div class="h-full w-full"> ' +
            '   <div class="flex items-center justify-center mt-[25vh]"> ' +
            '       <i class="fa-solid fa-heart-pulse fa-4x heartbeat text-btn-bg-company"></i> ' +
            '   </div> ' +
            '</div>';

        const modal = document.getElementById('{{ $id }}');

        modal.addEventListener('opened', (e) => {
            modal.querySelector('#modal-body').innerHTML = loading;
        });

        modal.addEventListener('closed', (e) => {
            modal.querySelector('#modal-body').innerHTML = '';
        })
    </script>
@endsection
