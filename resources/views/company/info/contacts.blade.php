@include('components.page-title', ['text' => 'Наши контакты'])

<div class="flex justify-between mb-6">
    @include('company.info.contacts.contact-btn',
        [
            'icon' => 'fa-phone',
            'href' => 'tel:' . $company->phone_number,
            'text' => 'Телефон'
        ])
    @include('company.info.contacts.contact-btn',
        [
            'icon' => 'fa-globe',
            'href' => $company->main_link, 'blank' => true,
            'text' => 'Сайт'
        ])
    @include('company.info.contacts.contact-btn',
        [
            'icon' => 'fa-envelope',
            'href' => 'mailto:' . $company->email,
            'text' => 'Почта'
        ])
</div>


