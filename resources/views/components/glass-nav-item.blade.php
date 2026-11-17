@props([
'href',
'icon',
'active' => false,
])

{{-- title = tooltip saat sidebar diciutkan (label teks disembunyikan) --}}
<a
    href="{{ $href }}"
    title="{{ html_entity_decode(trim(strip_tags($slot))) }}"
    @if ($active) aria-current="page" @endif
    {{ $attributes->class(['ui-nav-item']) }}>
    <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
    <span class="ui-sidebar-label">{{ $slot }}</span>
</a>
