<{{ $tag ?? 'a'}}
    class="bg-white bg-cover aspect-square rounded-2xl p-2 items-end flex btn-shadow-company {{ $class ?? '' }}"
    style="background-image: url({{ Storage::disk('images')->url('test.jpg') }});"
    href="{{ $href ?? "" }}"
>
    <span
        class="font-bold text-start"
    >
        {{ $text }}
    </span>
</{{ $tag ?? 'a'}}>
