@props([
'label',
'value',
'unit' => '',
'icon' => null,
'subtitle' => '',
'tone' => 'brand',
])

{{-- icon opsional: tanpa ikon, tone ditandai titik kecil di label (lebih ringkas) --}}
<x-glass-card level="subtle" {{ $attributes->class(['ui-stat', 'ui-tone-' . $tone]) }}>
    <div class="min-w-0 space-y-1">
        <p class="ui-eyebrow">
            @unless ($icon)
            <span class="ui-stat-dot" aria-hidden="true"></span>
            @endunless
            {{ $label }}
        </p>

        <p class="ui-stat-value">
            {{ $value }}
            @if ($unit)
            <span class="ui-stat-unit">{{ $unit }}</span>
            @endif
        </p>

        @if ($subtitle)
        <p class="ui-caption">{{ $subtitle }}</p>
        @endif
    </div>

    @if ($icon)
    <span class="ui-icon-tile">
        <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
    </span>
    @endif
</x-glass-card>
