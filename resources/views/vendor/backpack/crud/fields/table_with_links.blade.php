{{-- table_with_links_field field --}}
@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? ''));

    $relationName = $field['name'];
    $relatedElements = !empty($entry) ? $entry->$relationName : collect();
    $columns = $field['columns'];
@endphp

@include('crud::fields.inc.wrapper_start')
    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')

    <table class="table_with_links_field_class mt-2">
        <tr>
            @foreach($columns as $column)
                <th class="p-2">
                    {{ $column['label'] }}
                </th>
            @endforeach
        </tr>
        @forelse($relatedElements as $relatedElement)
            <tr>
                @foreach($columns as $column)
                    @php($columnName = $column['name'])
                    <td class="p-2">
                        <input
                            type="{{ $column['type'] }}"
                            value="{{ $relatedElement->$columnName }}"
                            @include('crud::fields.inc.attributes')
                            @if($column['disabled'] ?? false) disabled @endif
                            name="{{ $relationName . "[" . $relatedElement->id . "]" . "[" . $columnName . ']'}}"
                        >
                    </td>
                @endforeach
            </tr>
        @empty
            Записей не найдено
        @endforelse
    </table>
@include('crud::fields.inc.wrapper_end')

{{-- CUSTOM CSS --}}
@push('crud_fields_styles')
    {{-- How to load a CSS file? --}}
    @basset('table_with_linksFieldStyle.css')

    {{-- How to add some CSS? --}}
    @bassetBlock('backpack/crud/fields/table_with_links_field-style.css')
    <style>
        .table_with_links_field_class td, .table_with_links_field_class th {
            border: 1px solid #FFFFFF0F;
        }
    </style>
    @endBassetBlock
@endpush

{{-- CUSTOM JS --}}
@push('crud_fields_scripts')
    {{-- How to load a JS file? --}}
    @basset('table_with_linksFieldScript.js')

    {{-- How to add some JS to the field? --}}
    @bassetBlock('path/to/script.js')
    <script>
        function bpFieldInitDummyFieldElement(element) {
            // this function will be called on pageload, because it's
            // present as data-init-function in the HTML above; the
            // element parameter here will be the jQuery wrapped
            // element where init function was defined
            console.log(element.val());
        }
    </script>
    @endBassetBlock
@endpush
