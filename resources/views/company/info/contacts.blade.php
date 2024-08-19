@include('components.page-title', ['text' => 'Наши контакты'])

<div>
    <div class="mb-2">
        <a href="tel:{{ $company->phone_number }}" class="no-loading">
            <i class="fa-solid fa-phone"></i> {{ $company->phone_number }}
        </a>
         - Наш телефон
    </div>
    <div class="mb-2">
        <a href="{{ $company->main_link }}" target="_blank" class="no-loading">
            <i class="fa-solid fa-globe"></i> <span class="underline">{{ $company->main_link }}</span>
        </a>
         - Наш сайт
    </div>
    <div class="mb-2">
        <a href="mailto:{{ $company->email }}" class="no-loading">
            <i class="fa-solid fa-envelope"></i> {{ $company->email }}
        </a>
         - Наша почта
    </div>
</div>


