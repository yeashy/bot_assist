@include('components.page-title', ['text' => 'Наши адреса', 'class' => 'mt-2'])

<div>
    <ul>
        @foreach($affiliates as $affiliate)
            <li class="mb-2">
                <strong>{{ $affiliate->name }}</strong> - {{ $affiliate->address }} <br>
                <a href="tel:{{ $affiliate->phone_number }}">
                    <i class="fa-solid fa-phone"></i> {{ $affiliate->phone_number }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
