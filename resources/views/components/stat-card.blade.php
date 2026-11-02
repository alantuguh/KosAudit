@props([
    'label',
    'value',
    'unit' => '',
    'icon' => 'analytics',
    'iconBg' => 'bg-surface-container-low text-primary',
    'subtitle' => ''
])

<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex items-center justify-between hover:shadow-md transition-shadow">
    <div class="space-y-1">
        <p class="font-label-sm text-label-sm uppercase tracking-wider text-outline">{{ $label }}</p>
        <p class="font-display text-display text-on-surface font-mono-numeric">
            {{ $value }}
            @if($unit)
                <span class="font-body-md text-body-md text-outline font-normal">{{ $unit }}</span>
            @endif
        </p>
        @if($subtitle)
            <div class="flex items-center gap-1 text-outline font-label-sm text-label-sm">
                {{ $subtitle }}
            </div>
        @endif
    </div>
    <div class="w-12 h-12 rounded-xl {{ $iconBg }} flex items-center justify-center">
        <span class="material-symbols-outlined text-[28px]">{{ $icon }}</span>
    </div>
</div>