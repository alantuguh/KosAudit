@props([
'status' => null,
'tone' => null,
'icon' => null,
'dot' => false,
])

@php
if ($tone === null) {
$n = strtolower(trim((string) $status));

$tone = match (true) {
str_contains($n, 'terisi')
|| str_contains($n, 'disetujui')
|| str_contains($n, 'selesai')
|| str_contains($n, 'baik') => 'success',

str_contains($n, 'kosong')
|| str_contains($n, 'siap')
|| str_contains($n, 'menunggu')
|| str_contains($n, 'lecet') => 'warning',

str_contains($n, 'check-out')
|| str_contains($n, 'keberatan')
|| str_contains($n, 'rusak') => 'danger',

str_contains($n, 'dikembalikan') => 'info',

default => 'neutral',
};
}
@endphp

<span {{ $attributes->class(['ui-badge', 'ui-tone-' . $tone]) }}>
    @if ($icon)
    <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
    @elseif ($dot)
    <span class="ui-badge-dot" aria-hidden="true"></span>
    @endif

    {{ $slot->isEmpty() ? $status : $slot }}
</span>