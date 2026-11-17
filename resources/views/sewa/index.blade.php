@extends('layouts.glass')

@section('title', 'Kontrak Sewa')

@section('content')
@php
$rows = collect($sewaList)->map(fn ($s) => $s + [
    'tags' => match ($s['status_deposit']) {
        'Menunggu Verifikasi', 'Ada Keberatan' => 'action',
        default => 'done',
    },
]);

$perluTindakan = $rows->where('tags', 'action')->count();
$reopenModal = $errors->hasAny(['penghuni', 'kamar', 'tanggal_mulai', 'nominal_deposit']);
@endphp

<x-glass-alert type="warning" title="Mode pratinjau">
    Modul kontrak sewa belum tersedia di backend. Daftar di bawah adalah contoh, dan formulir hanya divalidasi tanpa disimpan.
</x-glass-alert>

<x-glass-page-header
    eyebrow="Kontrak & Deposit"
    title="Kontrak Sewa"
    description="Catat penghuni, kamar, tanggal masuk, dan nominal deposit sebelum inspeksi check-in dilakukan.">
    <x-slot:actions>
        <x-glass-button type="button" variant="primary" :block="false" data-modal-open="modal-tambah-sewa">
            <span class="material-symbols-outlined" aria-hidden="true">add</span>
            Buat Kontrak
        </x-glass-button>
    </x-slot:actions>
</x-glass-page-header>

<x-glass-table
    id="sewa-table"
    :stack="true"
    :per-page="10"
    :per-page-options="[10, 25]"
    search-placeholder="Cari kode, penghuni, atau kamar..."
    info-label="kontrak"
    :filters="[
        'all' => 'Semua (' . $rows->count() . ')',
        'action' => 'Perlu Tindakan (' . $perluTindakan . ')',
    ]">
    <x-slot:head>
        <tr>
            <th scope="col">Penghuni</th>
            <th scope="col">Kamar</th>
            <th scope="col">Periode</th>
            <th scope="col" class="ui-cell-num">Deposit</th>
            <th scope="col">Status Deposit</th>
            <th scope="col" class="ui-cell-end"><span class="sr-only">Aksi</span></th>
        </tr>
    </x-slot:head>

    @foreach ($rows as $s)
    <tr data-tags="{{ $s['tags'] }}" @if ($s['status_deposit'] === 'Ada Keberatan') data-tone="danger" @endif>
        <td>
            <p class="font-semibold leading-tight">{{ $s['penghuni'] }}</p>
            <p class="ui-caption ui-num">{{ $s['kode'] }}</p>
        </td>
        <td data-label="Kamar"><a href="{{ route('kamar.show', $s['kamar']) }}" class="ui-link">Kamar {{ $s['kamar'] }}</a></td>
        <td data-label="Periode" class="ui-num">{{ $s['periode'] }}</td>
        <td data-label="Deposit" class="ui-cell-num font-semibold">{{ $s['deposit'] }}</td>
        <td data-label="Status"><x-glass-badge :status="$s['status_deposit']" /></td>
        <td class="ui-cell-end">
            <x-glass-button
                :href="route('inspeksi.create', ['kamar' => $s['kamar']])"
                variant="secondary"
                size="sm"
                :block="false"
                aria-label="Mulai inspeksi Kamar {{ $s['kamar'] }}">
                Inspeksi
            </x-glass-button>
        </td>
    </tr>
    @endforeach
</x-glass-table>

{{-- Modal: buat kontrak --}}
<x-glass-modal
    id="modal-tambah-sewa"
    title="Buat Kontrak Sewa"
    description="Setelah kontrak dibuat, lanjutkan dengan inspeksi check-in kamar."
    :open="$reopenModal">
    <form method="POST" action="{{ route('sewa.store') }}" class="ui-modal-form" data-submit-once>
        @csrf

        <div class="ui-form-grid">
            <x-glass-input
                label="Nama Penghuni"
                id="penghuni"
                name="penghuni"
                :value="old('penghuni')"
                required
                autocomplete="off"
                placeholder="Nama penghuni" />

            <x-glass-input
                label="Nomor Kamar"
                id="kamar"
                name="kamar"
                :value="old('kamar')"
                required
                autocomplete="off"
                placeholder="Contoh: 103" />

            <x-glass-input
                label="Tanggal Mulai Sewa"
                id="tanggal_mulai"
                name="tanggal_mulai"
                type="date"
                :value="old('tanggal_mulai')"
                required />

            <div class="ui-field">
                <x-glass-input
                    label="Nominal Deposit (Rp)"
                    id="nominal_deposit"
                    name="nominal_deposit"
                    type="number"
                    :value="old('nominal_deposit', 500000)"
                    required
                    min="0"
                    step="50000"
                    inputmode="numeric" />
                <p class="ui-hint">Angka saja, tanpa titik.</p>
            </div>
        </div>

        <div class="ui-modal-footer">
            <x-glass-button type="button" variant="secondary" :block="false" data-modal-close>Batal</x-glass-button>
            <x-glass-button type="submit" variant="primary" :block="false">
                Simpan &amp; Lanjut Check-in
                <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
            </x-glass-button>
        </div>
    </form>
</x-glass-modal>
@endsection
