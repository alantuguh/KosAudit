@props(['status' => 'Terisi'])

@php
    $normalized = strtolower(trim($status));
    $classes = match(true) {
        str_contains($normalized, 'terisi')
            || str_contains($normalized, 'disetujui')
            || str_contains($normalized, 'selesai')
            || str_contains($normalized, 'baik')
            => 'bg-tertiary-fixed/40 text-tertiary',

        str_contains($normalized, 'kosong')
            || str_contains($normalized, 'siap')
            || str_contains($normalized, 'menunggu')
            || str_contains($normalized, 'lecet')
            => 'bg-secondary-fixed/50 text-secondary',

        str_contains($normalized, 'check-out')
            || str_contains($normalized, 'keberatan')
            || str_contains($normalized, 'rusak')
            => 'bg-error-container text-error',

        str_contains($normalized, 'dikembalikan')
            => 'bg-surface-container-high text-primary',

        default
            => 'bg-surface-container-high text-on-surface-variant',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 px-3 py-1 rounded-full font-label-sm text-label-sm font-semibold $classes"]) }}>
    {{ $slot->isEmpty() ? $status : $slot }}
</span>