@props([
'label',
'value',
'unit' => '',
'icon' => 'analytics',
'subtitle' => '',
'tone' => 'brand',
])

<x-glass-card level="subtle" class="ui-stat">
    <div class="space-y-1">
        <p class="ui-eyebrow">{{ $label }}</p>

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

    <span class="ui-icon-tile ui-tone-{{ $tone }}">
        <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
    </span>
</x-glass-card>