<select
    @if(!empty($id))id="{{ $id }}" @endif
    name="{{ $name }}"
    class="p-2 rounded-md text-lg input-company select-company {{ $class ?? '' }}"
    @foreach($dataset ?? [] as $name => $value)
        data-{{ $name }}="{{ $value }}"
    @endforeach
>
    @foreach($options as $name => $value)
        <option class="text-lg" value="{{ $value }}">
            {{ $name }}
        </option>
    @endforeach
</select>
