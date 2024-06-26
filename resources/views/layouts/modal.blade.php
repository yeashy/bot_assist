<div
    id="{{ $id }}"
    tabindex="-1"
    aria-hidden="true"
    class="hidden fixed top-0 left-0 z-1000 w-screen h-screen bg-black bg-opacity-60"
>
    <div class="flex items-center w-full relative p-4 h-full">
        <div class="flex flex-col text-company bg-company rounded-2xl w-full h-3/4 overflow-y-auto">
            <div class="flex items-center justify-between p-4 border-b border-company rounded-t">
                <h3 class="text-xl font-bold">
                    @yield('modal-title')
                </h3>
                <button type="button" class="modal-close" data-modal="{{ $id }}">
                    <i class="la la-times fa-xl"></i>
                </button>
            </div>
            <div id="modal-body" class="p-4 flex-1 overflow-y-auto overflow-x-hidden">
                @yield('modal-body')
            </div>
        </div>
    </div>
</div>

@yield('modal_scripts')
