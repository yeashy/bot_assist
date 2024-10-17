<{{ $tag ?? 'a'}}
    class="bg-white bg-cover min-w-32 min-h-32 rounded-2xl p-2 items-end flex btn-shadow-company {{ $class ?? '' }}"
    style="background-image: url({{ Storage::disk('images')->url('default/test.jpg') }});"

    @foreach($attributes ?? [] as $attribute => $value)
        {{ $attribute }}="{{ $value }}"
    @endforeach

    @if(!empty($href))
        href="{{ $href }}"
    @endif

    @foreach($dataset ?? [] as $name => $value)
        data-{{ $name }}="{{ $value }}"
    @endforeach
>
    <span
        class="text-start"
    >
        {{ $text }}
    </span>
</{{ $tag ?? 'a'}}>
