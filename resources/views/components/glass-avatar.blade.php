@props([
'name' => null,
'tone' => 'brand',
])

@php
$initials = collect(preg_split('/\s+/', trim((string) $name)))
->filter()
->take(2)
->map(fn ($part) => mb_strtoupper(mb_substr($part, 0, 1)))
->implode('');
@endphp

<span {{ $attributes->class(['ui-avatar', 'ui-tone-' . $tone]) }} aria-hidden="true">{{ $initials }}</span>