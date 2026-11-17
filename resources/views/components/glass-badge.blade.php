@props([
'status' => null,
'tone' => null,
'icon' => null,
'dot' => false,
])

@php
/*
 * Satu sumber semantik status -> tone untuk seluruh aplikasi.
 * Pencocokan EXACT (bukan str_contains) agar "Tidak Baik" atau
 * "Belum Selesai" tidak salah menjadi success.
 * Keterangan dalam kurung diabaikan: "Deposit Dikembalikan (Rp 420.000)".
 */
if ($tone === null) {
    $key = strtolower(trim(preg_replace('/\s*\(.*\)\s*$/', '', (string) $status)));

    $tone = [
        // Positif / tuntas
        'terisi' => 'success',
        'baik' => 'success',
        'lunas' => 'success',
        'disetujui' => 'success',
        'check-in' => 'success',
        'disetujui penghuni' => 'success',
        'selesai inspeksi' => 'success',

        // Informasi / netral-positif
        'kosong' => 'info',
        'siap huni' => 'info',
        'deposit dikembalikan' => 'info',

        // Perlu perhatian
        'check-out' => 'warning',
        'menunggu verifikasi' => 'warning',
        'menunggu verifikasi deposit' => 'warning',
        'lecet' => 'warning',
        'lecet ringan' => 'warning',
        'perbaikan' => 'warning',
        'butuh perbaikan' => 'warning',
        'dalam diskusi' => 'warning',
        'proses check-out' => 'warning',
        'perlu review' => 'warning',

        // Masalah
        'rusak' => 'danger',
        'rusak berat' => 'danger',
        'hilang' => 'danger',
        'ada keberatan' => 'danger',
        'perlu ditinjau' => 'danger',
    ][$key] ?? 'neutral';
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
