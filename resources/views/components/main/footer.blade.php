<div
    class="py-1 border-t opacity-0"
>
    @include('components.main.footer.footer-tab', ['text' => 'Дубликация футера для отступа', 'icon' => 'angle-double-up', 'path' => '', 'name' => 'index'])
</div>

<footer
    class="flex justify-between py-1 fixed bottom-0 border-t border-company bg-company-secondary w-full z-[100] shadow-company text-company-primary"
>
    @include('components.main.footer.footer-tab', ['text' => 'Главная', 'icon' => 'home', 'path' => '', 'name' => ['main', 'info']])
    @include('components.main.footer.footer-tab', ['text' => 'Записаться', 'icon' => 'pen', 'path' => 'positions', 'name' => 'positions'])
    @include('components.main.footer.footer-tab', ['text' => 'Моя карточка', 'icon' => 'user', 'path' => 'user', 'name' => 'user'])
</footer>
