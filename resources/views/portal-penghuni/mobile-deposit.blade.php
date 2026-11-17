@extends('layouts.glass-mobile')

@section('title', 'Rincian Deposit')

@section('content')
@php
$user = auth()->user();
$depositAwal = 500000;
$rupiah = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');

$rincian = [
    ['key' => 'ac', 'icon' => 'ac_unit', 'nama' => 'Ganti Unit Remote AC & Tutup', 'desc' => 'Layar LCD pecah & penutup baterai hilang', 'biaya' => 100000, 'bukti' => 'Nota: Mitra Elektronik (28/02)', 'foto' => 0],
    ['key' => 'cat', 'icon' => 'format_paint', 'nama' => 'Cat & Dempul Dinding (2 Titik)', 'desc' => 'Bekas paku gantungan pakaian & perekat double-tape', 'biaya' => 50000, 'bukti' => null, 'foto' => 2],
    ['key' => 'kasur', 'icon' => 'bed', 'nama' => 'Cuci Sprei & Matras Deep-Clean', 'desc' => 'Perawatan berkala rutin kos', 'biaya' => 0, 'bukti' => null, 'foto' => 0],
];

$totalPotongan = array_sum(array_column($rincian, 'biaya'));
$dikembalikan = $depositAwal - $totalPotongan;
$disanggah = array_filter($rincian, fn ($r) => $r['biaya'] > 0);
@endphp

<x-glass-page-header
    eyebrow="Kamar 104 • Dana ditahan"
    title="Rincian Deposit"
    description="Periksa rincian potongan sebelum menyetujui pencairan." />

{{-- Tahap --}}
<x-glass-card level="subtle" class="p-5">
    <ol class="ui-steps" aria-label="Tahap pengembalian deposit">
        @foreach (['Inspeksi' => 'done', 'Kalkulasi' => 'done', 'Verifikasi' => 'current', 'Cair' => 'todo'] as $label => $state)
        <li class="ui-step" data-state="{{ $state }}" @if ($state === 'current') aria-current="step" @endif>
            <span class="ui-step-dot">
                <span class="material-symbols-outlined" aria-hidden="true">{{ $state === 'done' ? 'done' : ($state === 'current' ? 'hourglass_top' : 'send_money') }}</span>
            </span>
            {{ $label }}
        </li>
        @endforeach
    </ol>
</x-glass-card>

{{-- Nominal --}}
<x-glass-card level="subtle" class="space-y-4 p-5">
    <div class="ui-highlight space-y-1">
        <p class="ui-eyebrow">Estimasi Pengembalian Bersih</p>
        <p class="ui-amount">{{ $rupiah($dikembalikan) }}</p>
    </div>

    <dl class="ui-dl ui-inset">
        <div><dt>Deposit awal</dt><dd class="ui-num">{{ $rupiah($depositAwal) }}</dd></div>
        <div><dt>Total potongan</dt><dd class="ui-num ui-text-danger">− {{ $rupiah($totalPotongan) }}</dd></div>
    </dl>
</x-glass-card>

{{-- Rincian --}}
<x-glass-card level="subtle" class="space-y-4 p-5">
    <div>
        <h2 class="ui-heading-md">Rincian Perbaikan</h2>
        <p class="ui-caption">Berdasarkan checklist check-out 28 Februari</p>
    </div>

    <ul class="flex flex-col gap-3">
        @foreach ($rincian as $r)
        <li class="ui-inset space-y-3">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <p class="text-sm font-semibold">{{ $r['nama'] }}</p>
                    <p class="ui-caption">{{ $r['desc'] }}</p>
                </div>
                <div class="shrink-0 text-right">
                    <p @class(['ui-num text-sm font-bold', 'ui-text-danger' => $r['biaya'] > 0, 'ui-text-success' => $r['biaya'] === 0])>
                        {{ $r['biaya'] > 0 ? '− ' . $rupiah($r['biaya']) : 'Rp 0' }}
                    </p>
                    @if ($r['biaya'] === 0)
                    <x-glass-badge tone="success">Ditanggung pemilik</x-glass-badge>
                    @endif
                </div>
            </div>

            @if ($r['bukti'])
            <button type="button" class="ui-btn ui-btn-secondary ui-btn-sm ui-btn-block" data-preview-action="Lampiran nota belum tersedia di backend.">
                {{ $r['bukti'] }}
            </button>
            @endif

            @if ($r['foto'])
            <div class="flex items-center gap-2">
                @for ($i = 0; $i < $r['foto']; $i++)
                <span class="ui-photo w-14" aria-hidden="true"><span class="material-symbols-outlined">image</span></span>
                @endfor
                <span class="ui-caption">{{ $r['foto'] }} foto dokumentasi</span>
            </div>
            @endif
        </li>
        @endforeach
    </ul>
</x-glass-card>

{{-- Rekening --}}
<x-glass-card level="subtle" class="space-y-3 p-5">
    <div class="flex items-center justify-between gap-3">
        <p class="ui-eyebrow">Rekening Tujuan</p>
        <button type="button" class="ui-link text-sm" data-preview-action="Perubahan rekening belum didukung backend.">
            Ubah
        </button>
    </div>

    <div class="ui-inset flex items-center gap-3">
        <div class="min-w-0 flex-1">
            <p class="text-sm font-semibold">BCA <span class="ui-num">•••• 5678</span></p>
            <p class="ui-caption truncate">a.n. {{ $user->name }}</p>
        </div>
        <span class="material-symbols-outlined ui-text-success" aria-hidden="true">check_circle</span>
    </div>
</x-glass-card>

{{-- Sanggahan --}}
<x-glass-card level="subtle" class="p-0">
    <button type="button" class="flex w-full items-center justify-between gap-3 p-5 text-left" data-disclosure="dispute-form">
        <span>
            <span class="block text-sm font-semibold">Tidak sepakat dengan potongan?</span>
            <span class="ui-caption">Ajukan sanggahan &amp; lampirkan foto tandingan</span>
        </span>
        <span class="material-symbols-outlined" aria-hidden="true">expand_more</span>
    </button>

    <div id="dispute-form" class="space-y-4 px-5 pb-5" hidden>
        <div class="ui-callout ui-tone-warning">
            <span class="material-symbols-outlined" aria-hidden="true">info</span>
            <p>Sanggahan menahan pencairan sementara. Pengelola memiliki 1×24 jam untuk menanggapi bukti tandingan.</p>
        </div>

        <fieldset class="space-y-2">
            <legend class="ui-label mb-2">Potongan yang disanggah</legend>
            @foreach ($disanggah as $r)
            <x-glass-checkbox name="item_dispute[]" :value="$r['key']" :label="$r['nama'] . ' (' . $rupiah($r['biaya']) . ')'" />
            @endforeach
        </fieldset>

        <label class="ui-btn ui-btn-secondary ui-btn-block ui-upload">
            <span class="ui-upload-name" data-upload-name="Tambah foto tandingan">Tambah foto tandingan</span>
            <input type="file" accept="image/*" multiple aria-label="Tambah foto tandingan">
        </label>

        <x-glass-textarea
            id="dispute-notes"
            label="Pesan untuk pemilik kos"
            placeholder="Contoh: bekas double-tape di dinding sudah ada sebelum serah terima kunci..." />

        <x-glass-button
            type="button"
            variant="danger"
            data-preview-action="Sanggahan belum terkirim: backend sanggahan belum tersedia.">
            <span class="material-symbols-outlined" aria-hidden="true">send</span>
            Kirim Sanggahan
        </x-glass-button>
    </div>
</x-glass-card>

{{-- Aksi utama --}}
<div class="space-y-2">
    <x-glass-button
        type="button"
        variant="primary"
        data-preview-action="Persetujuan belum tersimpan: backend pencairan deposit belum tersedia.">
        <span class="material-symbols-outlined" aria-hidden="true">payments</span>
        Setuju &amp; Cairkan {{ $rupiah($dikembalikan) }}
    </x-glass-button>
    <p class="ui-caption text-center">Dana ditransfer ke rekening BCA Anda setelah persetujuan diproses.</p>
</div>
@endsection
