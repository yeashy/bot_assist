<div class="text-center">
    <a
        class="btn-company no-loading rounded-xl flex justify-center items-center w-16 h-16"
        href="{{ $href ?? '' }}"
        @if($blank ?? false) target="_blank" @endif
    >
        <i class="fa-solid {{ $icon ?? '' }} fa-xl"></i>
    </a>

    {{ $text ?? '' }}
</div>
