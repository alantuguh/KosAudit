@props([
'href',
'icon',
'active' => false,
])

<a href="{{ $href }}" @if ($active) aria-current="page" @endif {{ $attributes->class(['ui-nav-item']) }}>
    <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
    <span>{{ $slot }}</span>
</a>