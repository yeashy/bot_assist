{{--@include('components.page-title', ['text' => 'Данные клиента тут'])--}}

<div class="flex p-2 block-company box-shadow-basic rounded-2xl w-full">
    <div class="h-16 w-16 rounded-full overflow-hidden">
        <img
            id="user-avatar"
            src="{{ Storage::disk('images')->url('default/user-default-avatar.png') }}"
            alt=""
            class="w-full h-full"
        >
    </div>
    <div class="ml-2 flex flex-col justify-center">
        <div id="user-name" class="font-bold">
            Михаил
        </div>
        <div class="additional-text-company">
            <a href="{{ Request::url() }}/edit">Настройки <i class="las la-angle-right la-xs"></i></a>
        </div>
    </div>
</div>

