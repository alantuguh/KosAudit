@props([
    'level' => 'premium',
    'radius' => 'card',
])

<div
    {{ $attributes->class([
        'ui-glass',
        $level === 'subtle' ? 'ui-glass-subtle' : 'ui-glass-premium',
        'ui-glass-radius-control' => $radius === 'control',
    ]) }}
>
    {{ $slot }}
</div>