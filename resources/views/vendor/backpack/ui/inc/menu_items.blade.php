{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Компании" icon="la la-building" :link="backpack_url('company')" />

<x-backpack::menu-dropdown title="Справочники" icon="la la-list-ul">
    <x-backpack::menu-dropdown-item title="Шрифты" icon="la la-pen" :link="backpack_url('font')" />

    <x-backpack::menu-dropdown-item title="Типы компаний" icon="la la-list-ul" :link="backpack_url('company-type')" />

    <x-backpack::menu-dropdown-item title="Сотрудники" icon="la la-address-card" :link="backpack_url('staff-member')" />

    <x-backpack::menu-dropdown-item title="Услуги" icon="la la-handshake" :link="backpack_url('service')" />

    <x-backpack::menu-dropdown-item title="Должности" icon="la la-address-book" :link="backpack_url('job-position')" />
</x-backpack::menu-dropdown>


