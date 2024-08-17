<div class="flex-1">
    <a
        href="/companies/{{ $company->id }}/{{ $path ?? '' }}"
        class="flex flex-col items-center @if(str(request()->route()->getName())->contains($name)) additional-text-company @endif">
        <i class="la la-{{ $icon }} la-2x"></i>
        <span class="text-xs">{{ $text }}</span>
    </a>
</div>
