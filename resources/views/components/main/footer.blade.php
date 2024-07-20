<div
    class="flex justify-between py-1 border-t border-company bg-company w-full"
>
    @include('components.main.footer.footer-tab', ['text' => 'Дубликация футера для отступа', 'icon' => 'angle-double-up', 'path' => '', 'name' => 'index'])
</div>

<footer
    class="flex justify-between py-1 fixed bottom-0 border-t border-company bg-company w-full z-[100] box-shadow-basic"
>
    @include('components.main.footer.footer-tab', ['text' => 'Главная', 'icon' => 'home', 'path' => '', 'name' => 'index'])
    @include('components.main.footer.footer-tab', ['text' => 'Записаться', 'icon' => 'pen', 'path' => 'positions', 'name' => 'positions'])
    @include('components.main.footer.footer-tab', ['text' => 'Моя карточка', 'icon' => 'user', 'path' => 'profile', 'name' => 'profile'])
</footer>
