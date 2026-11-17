@props([
    'level' => 'premium',
    'radius' => 'card',
    'as' => 'div',
])

{{--
    as: tag HTML semantik (div, header, aside, nav, section, article).
    Contoh: <x-glass-card as="header" level="premium" class="ui-header">
--}}

@php
$tag = in_array($as, ['div', 'header', 'aside', 'nav', 'section', 'article', 'footer'], true) ? $as : 'div';
@endphp

<{{ $tag }}
    {{ $attributes->class([
        'ui-glass',
        $level === 'subtle' ? 'ui-glass-subtle' : 'ui-glass-premium',
        'ui-glass-radius-control' => $radius === 'control',
    ]) }}
>
    {{ $slot }}
</{{ $tag }}>
