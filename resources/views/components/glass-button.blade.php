@props([
'variant' => 'primary',
'type' => 'submit',
'block' => true,
'loading' => false,
'size' => 'md',
'href' => null,
])

@php
$variant = in_array($variant, ['primary', 'secondary', 'danger'], true) ? $variant : 'primary';

$classes = [
'ui-btn',
'ui-btn-' . $variant,
'ui-btn-block' => $block,
'ui-btn-sm' => $size === 'sm',
];
@endphp

@if ($href)
<a href="{{ $href }}" {{ $attributes->class($classes) }}>
    {{ $slot }}
</a>
@else
<button
    type="{{ $type }}"
    @disabled($loading)
    @if ($loading) aria-busy="true" @endif
    {{ $attributes->class($classes) }}>
    @if ($loading)
    <span class="ui-btn-spinner" aria-hidden="true"></span>
    @endif

    {{ $slot }}
</button>
@endif