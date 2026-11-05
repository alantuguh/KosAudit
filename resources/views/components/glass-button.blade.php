@props([
'variant' => 'primary',
'type' => 'submit',
'block' => true,
'loading' => false,
])

@php
$variant = in_array($variant, ['primary', 'secondary', 'danger'], true) ? $variant : 'primary';
@endphp

<button
    type="{{ $type }}"
    @disabled($loading)
    @if ($loading) aria-busy="true" @endif
    {{ $attributes->class([
        'ui-btn',
        'ui-btn-' . $variant,
        'ui-btn-block' => $block,
    ]) }}>
    @if ($loading)
    <span class="ui-btn-spinner" aria-hidden="true"></span>
    @endif

    {{ $slot }}
</button>