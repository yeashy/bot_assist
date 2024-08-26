{{-- address-input_field field --}}
@php
    $field['value'] = old_empty_or_null($field['name'], '') ?? ($field['value'] ?? ($field['default'] ?? ''));
@endphp

@include('crud::fields.inc.wrapper_start')
<label>{!! $field['label'] !!}</label>
@include('crud::fields.inc.translatable_icon')

<input type="text"
       name="{{ $field['name'] }}"
       data-init-function="initFunction"
       value="{{ $field['value'] }}"
       autocomplete="off"
    @include('crud::fields.inc.attributes')>

{{-- Dropdown container for suggestions --}}
<div id="address-suggestions" class="dropdown-menu" style="display: none;">
</div>

{{-- HINT --}}
@if (isset($field['hint']))
    <p class="help-block">{!! $field['hint'] !!}</p>
@endif
@include('crud::fields.inc.wrapper_end')

{{-- CUSTOM CSS --}}
@push('crud_fields_styles')
    @bassetBlock('backpack/crud/fields/address-input_field-style.css')
    <style>
        .dropdown-menu {
            max-height: 200px;
            overflow-y: auto;
        }
        .dropdown-item {
            cursor: pointer;
            padding: 8px 12px;
        }
    </style>
    @endBassetBlock
@endpush

{{-- CUSTOM JS --}}
@push('crud_fields_scripts')
    {{-- How to load a JS file? --}}
    @vite('resources/js/bootstrap.js')

    @bassetBlock('path/to/script.js')
    <script>
        let suggestionsContainer = document.getElementById('address-suggestions');
        let activeIndex = -1;

        const latitudeElement = document.querySelector('[name=latitude]');
        const longitudeElement = document.querySelector('[name=longitude]');

        function initFunction(element) {
            const input = document.querySelector('[name="{{ $field['name'] }}"]');
            let timeout = null;

            input.addEventListener('input', function () {
                clearTimeout(timeout);
                latitudeElement.value = '';
                longitudeElement.value = '';

                timeout = setTimeout(function () {
                    suggestAddress(input.value);
                }, 500);
            });

            input.addEventListener('blur', function () {
                setTimeout(function () {
                    suggestionsContainer.style.display = 'none';
                }, 200);
            });

            input.addEventListener('keydown', function (event) {
                const items = suggestionsContainer.querySelectorAll('.dropdown-item');

                switch (event.key) {
                    case 'ArrowDown':
                        event.preventDefault();
                        if (activeIndex < items.length - 1) {
                            activeIndex++;
                        }
                        updateActiveItem(items);
                        break;
                    case 'ArrowUp':
                        event.preventDefault();
                        if (activeIndex > 0) {
                            activeIndex--;
                        }
                        updateActiveItem(items);
                        break;
                    case 'Enter':
                        event.preventDefault();
                        if (activeIndex >= 0) {
                            items[activeIndex].click();
                        }
                        break;
                    case 'Tab':
                        event.preventDefault();
                        if (activeIndex < items.length - 1) {
                            activeIndex++;
                        } else {
                            activeIndex = 0;
                        }
                        updateActiveItem(items);
                        break;
                }
            });
        }

        function updateActiveItem(items) {
            items.forEach((item, index) => {
                item.classList.toggle('active', index === activeIndex);
            });
        }

        function suggestAddress(value) {
            if (value.length > 2) {
                axios.get('/api/address/suggest/' + value)
                    .then((response) => {
                        const suggestions = response.data.suggestions;
                        suggestionsContainer.innerHTML = '';
                        activeIndex = -1;

                        if (suggestions.length > 0) {
                            suggestions.forEach(suggestion => {
                                const item = document.createElement('div');
                                item.classList.add('dropdown-item');
                                item.textContent = suggestion['name'];

                                item.addEventListener('click', function () {
                                    const input = document.querySelector('[name="{{ $field['name'] }}"]');
                                    input.value = suggestion['name'];

                                    latitudeElement.value = suggestion['latitude'];
                                    longitudeElement.value = suggestion['longitude'];

                                    suggestionsContainer.style.display = 'none';
                                });

                                suggestionsContainer.appendChild(item);
                            });

                            const inputRect = document.querySelector('[name="{{ $field['name'] }}"]').getBoundingClientRect();
                            suggestionsContainer.style.width = `${inputRect.width}px`;
                            suggestionsContainer.style.display = 'block';
                        } else {
                            suggestionsContainer.style.display = 'none';
                        }
                    });
            } else {
                suggestionsContainer.style.display = 'none';
            }
        }
    </script>
    @endBassetBlock
@endpush
