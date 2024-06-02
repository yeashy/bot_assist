<button
    @if(!empty($id))id="{{ $id }}" @endif
    type="{{ $type ?? 'button' }}"
    class="px-4 py-2 rounded-md font-bold btn-company {{ $class ?? '' }}"

    @foreach($dataset ?? [] as $name => $value)
        data-{{ $name }}="{{ $value }}"
    @endforeach
>
    {{ $text }}
</button>
