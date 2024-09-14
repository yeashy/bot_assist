<div class="flex justify-between w-full mb-2">
    <div class="font-bold text-xl">
        {{ $text }}
    </div>
    <div class="flex items-center">
        @if(!empty($href))
            <a href="{{ $href }}">
                <i class="fa fa-arrow-right fa-xl"></i>
            </a>
        @endif
    </div>
</div>
