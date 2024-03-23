@if ($crud->hasAccess('see_related_button') || $button->meta['access'])
    <a href="{{ $button->meta['url'] ?? url($crud->route . '/' . $entry->getKey() . '/' . $button->name) }}" class="btn btn-sm btn-link text-capitalize {{ $button->meta['class'] }}">
        <i class="{{ $button->meta['icon']  }}"></i>Перейти к {{ $button->meta['label'] }}
    </a>
@endif
