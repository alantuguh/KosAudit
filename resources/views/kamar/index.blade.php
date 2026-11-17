@extends('layouts.glass')

@section('title', 'Data Kamar')

@section('content')
@php
/*
 * Bentuk data dari WorkspaceController::rooms() (array berindeks):
 * 0 nomor, 1 lantai, 2 deskripsi, 3 label tipe, 4 kapasitas,
 * 5 harga, 6 fasilitas (implode), 7 penghuni, 8 kontrak, 9 label status.
 * Dipetakan ke key bernama agar markup di bawah mudah dibaca.
 */
$slug = fn (string $text) => \Illuminate\Support\Str::slug($text);

$statusKey = fn (string $label) => match (true) {
    str_starts_with($label, 'Terisi') => 'terisi',
    str_starts_with($label, 'Kosong') => 'kosong',
    default => 'perbaikan',
};

$rows = collect($rooms)->map(function ($k) use ($statusKey, $slug) {
    $items = $k[6] === 'Belum ada item terdaftar' ? [] : explode(', ', $k[6]);
    $penghuni = str_starts_with($k[7], '-') ? null : $k[7];
    $status = $statusKey($k[9]);

    return [
        'nomor' => $k[0],
        'lantai' => $k[1],
        'deskripsi' => $k[2],
        'tipe' => $k[3],
        'harga' => $k[5],
        'items' => $items,
        'penghuni' => $penghuni,
        'kontrak' => $k[8],
        'status' => $k[9],
        'tags' => implode(' ', ['status-' . $status, 'lantai-' . $k[1], 'tipe-' . $slug($k[3])]),
    ];
});

$lantaiOptions = $rows->pluck('lantai')->unique()->sort()->mapWithKeys(fn ($l) => ['lantai-' . $l => 'Lantai ' . $l])->all();
$tipeOptions = $rows->pluck('tipe')->unique()->sort()->mapWithKeys(fn ($t) => ['tipe-' . $slug($t) => $t])->all();

$okupansi = $roomSummary['total'] > 0
    ? round($roomSummary['occupied'] / $roomSummary['total'] * 100)
    : 0;

// Buka kembali modal bila form tambah kamar gagal validasi.
$formFields = ['room_number', 'type', 'monthly_price', 'status', 'description', 'items', 'items.*'];
$reopenModal = $errors->hasAny($formFields);
$itemsError = $errors->first('items') ?: $errors->first('items.*');
@endphp

<x-glass-page-header
    eyebrow="Manajemen Properti"
    title="Data Kamar"
    description="Kelola unit, harga sewa, dan item kondisi yang menjadi acuan inspeksi check-in & check-out.">
    <x-slot:actions>
        <x-glass-button type="button" variant="primary" :block="false" data-modal-open="modal-tambah-kamar">
            <span class="material-symbols-outlined" aria-hidden="true">add</span>
            Tambah Kamar
        </x-glass-button>
    </x-slot:actions>
</x-glass-page-header>

{{-- Ringkasan --}}
<section aria-label="Ringkasan kamar" class="grid grid-cols-2 gap-4 xl:grid-cols-4 xl:gap-6">
    <x-glass-stat-card label="Total Kamar" :value="$roomSummary['total']" unit="Unit" tone="brand" subtitle="Terdaftar di sistem" />
    <x-glass-stat-card label="Terisi" :value="$roomSummary['occupied']" unit="Kamar" tone="success" :subtitle="'Okupansi ' . $okupansi . '%'" />
    <x-glass-stat-card label="Kosong" :value="$roomSummary['available']" unit="Unit" tone="info" subtitle="Siap disewakan" />
    <x-glass-stat-card label="Butuh Perbaikan" :value="$roomSummary['repair']" unit="Kamar" tone="warning" subtitle="Belum bisa disewakan" />
</section>

@if ($rows->isEmpty())
<x-glass-empty-state icon="meeting_room" title="Belum ada kamar terdaftar">
    Tambahkan kamar pertama beserta item kondisinya. Item ini akan menjadi daftar periksa saat inspeksi check-in dan check-out.

    <x-slot:actions>
        <x-glass-button type="button" variant="primary" :block="false" data-modal-open="modal-tambah-kamar">
            <span class="material-symbols-outlined" aria-hidden="true">add</span>
            Tambah Kamar Pertama
        </x-glass-button>
    </x-slot:actions>
</x-glass-empty-state>
@else
<x-glass-table
    id="rooms-table"
    :stack="true"
    :per-page="10"
    :per-page-options="[10, 25, 50]"
    search-placeholder="Cari nomor, tipe, fasilitas..."
    info-label="kamar"
    :filters="[
        'all' => 'Semua (' . $roomSummary['total'] . ')',
        'status-terisi' => 'Terisi (' . $roomSummary['occupied'] . ')',
        'status-kosong' => 'Kosong (' . $roomSummary['available'] . ')',
        'status-perbaikan' => 'Perbaikan (' . $roomSummary['repair'] . ')',
    ]">
    <x-slot:controls>
        @if (count($lantaiOptions) > 1)
        <div class="ui-table-filter">
            <x-glass-select size="sm" placeholder="Semua Lantai" :options="$lantaiOptions" aria-label="Filter lantai" data-table-filter />
        </div>
        @endif

        @if (count($tipeOptions) > 1)
        <div class="ui-table-filter">
            <x-glass-select size="sm" placeholder="Semua Tipe" :options="$tipeOptions" aria-label="Filter tipe kamar" data-table-filter />
        </div>
        @endif
    </x-slot:controls>

    <x-slot:head>
        <tr>
            <th scope="col">Kamar</th>
            <th scope="col">Tipe</th>
            <th scope="col" class="ui-cell-num">Harga / Bulan</th>
            <th scope="col">Item Kondisi</th>
            <th scope="col">Penghuni</th>
            <th scope="col">Status</th>
            <th scope="col" class="ui-cell-end"><span class="sr-only">Aksi</span></th>
        </tr>
    </x-slot:head>

    @foreach ($rows as $room)
    <tr data-tags="{{ $room['tags'] }}">
        <td>
            <a href="{{ route('kamar.show', $room['nomor']) }}" class="ui-link">Kamar {{ $room['nomor'] }}</a>
            <span class="ui-caption block">Lantai {{ $room['lantai'] }} &bull; {{ $room['deskripsi'] }}</span>
        </td>

        <td data-label="Tipe" class="whitespace-nowrap">{{ $room['tipe'] }}</td>

        <td data-label="Harga / bulan" class="ui-cell-num font-semibold">{{ $room['harga'] }}</td>

        <td data-label="Item kondisi">
            @if ($room['items'])
            <div class="min-w-0">
                <span class="font-semibold">{{ count($room['items']) }} item</span>
                <span class="ui-caption ui-truncate" title="{{ implode(', ', $room['items']) }}">
                    {{ implode(', ', $room['items']) }}
                </span>
            </div>
            @else
            <span class="ui-text-muted">Belum diatur</span>
            @endif
        </td>

        <td data-label="Penghuni">
            @if ($room['penghuni'])
            <div>
                <span class="font-semibold">{{ $room['penghuni'] }}</span>
                <span class="ui-caption block">{{ $room['kontrak'] }}</span>
            </div>
            @else
            <span class="ui-text-muted">&mdash;</span>
            @endif
        </td>

        <td data-label="Status"><x-glass-badge :status="$room['status']" /></td>

        <td class="ui-cell-end">
            <x-glass-button
                :href="route('kamar.show', $room['nomor'])"
                variant="secondary"
                size="sm"
                :block="false"
                aria-label="Lihat detail Kamar {{ $room['nomor'] }}">
                Detail
            </x-glass-button>
        </td>
    </tr>
    @endforeach
</x-glass-table>
@endif

{{-- Modal: tambah kamar --}}
<x-glass-modal
    id="modal-tambah-kamar"
    title="Tambah Kamar Baru"
    description="Isi data unit dan pilih item kondisi yang akan diperiksa saat inspeksi."
    size="lg"
    :open="$reopenModal">
    <form method="POST" action="{{ route('kamar.store') }}" class="ui-modal-form" data-submit-once>
        @csrf

        <div class="ui-form-grid">
            <x-glass-input
                label="Nomor Kamar"
                id="room_number"
                name="room_number"
                :value="old('room_number')"
                required
                maxlength="10"
                autocomplete="off"
                placeholder="Contoh: 109" />

            <x-glass-select
                label="Tipe Kamar"
                id="type"
                name="type"
                required
                value="Standar"
                :options="['Standar' => 'Standar', 'AC' => 'AC', 'AC + KM Dalam' => 'Deluxe (AC + KM Dalam)']" />

            <div class="ui-field">
                <x-glass-input
                    label="Harga Sewa per Bulan (Rp)"
                    id="monthly_price"
                    name="monthly_price"
                    type="number"
                    :value="old('monthly_price', 1500000)"
                    required
                    min="0"
                    step="50000"
                    inputmode="numeric" />
                <p class="ui-hint">Angka saja, tanpa titik. Contoh: 1500000</p>
            </div>

            <x-glass-select
                label="Status Awal"
                id="status"
                name="status"
                value="kosong"
                :options="['kosong' => 'Kosong (Siap Huni)', 'butuh_perbaikan' => 'Butuh Perbaikan']" />
        </div>

        <x-glass-input
            label="Deskripsi"
            id="description"
            name="description"
            :value="old('description')"
            maxlength="1000"
            placeholder="Contoh: Lantai 1, sayap timur, jendela menghadap taman" />

        <fieldset class="ui-field">
            <legend class="ui-label flex w-full items-center justify-between gap-3">
                Item Kondisi Kamar
                <span class="ui-caption" data-picker-count aria-live="polite"></span>
            </legend>

            @if ($masterItems->isEmpty())
            <p class="ui-inset ui-body-sm">Belum ada master item. Item dapat ditambahkan setelah master item tersedia.</p>
            @else
            <div class="ui-inset ui-picker" data-picker>
                @foreach ($masterItems as $index => $item)
                @php $checked = (string) old("items.$index.master_item_id") === (string) $item->id; @endphp
                <div class="ui-picker-item">
                    <x-glass-checkbox
                        name="items[{{ $index }}][master_item_id]"
                        value="{{ $item->id }}"
                        :label="$item->name"
                        :checked="$checked"
                        data-picker-toggle />

                    <input
                        type="number"
                        name="items[{{ $index }}][quantity]"
                        value="{{ old("items.$index.quantity", 1) }}"
                        min="1"
                        max="255"
                        inputmode="numeric"
                        class="ui-glass-input ui-picker-qty"
                        aria-label="Jumlah {{ $item->name }}"
                        @disabled(! $checked)>
                </div>
                @endforeach
            </div>
            @endif

            @if ($itemsError)
            <p class="ui-field-error">{{ $itemsError }}</p>
            @else
            <p class="ui-hint">Centang item yang ada di kamar, lalu atur jumlahnya.</p>
            @endif
        </fieldset>

        <div class="ui-modal-footer">
            <x-glass-button type="button" variant="secondary" :block="false" data-modal-close>Batal</x-glass-button>
            <x-glass-button type="submit" variant="primary" :block="false">
                <span class="material-symbols-outlined" aria-hidden="true">save</span>
                Simpan Kamar
            </x-glass-button>
        </div>
    </form>
</x-glass-modal>
@endsection

@push('scripts')
<script>
    (() => {
        const picker = document.querySelector("[data-picker]");
        const counter = document.querySelector("[data-picker-count]");

        if (!picker) {
            return;
        }

        function updateCount() {
            const total = picker.querySelectorAll("[data-picker-toggle]:checked").length;
            counter.textContent = total ? total + " dipilih" : "";
        }

        // Jumlah hanya aktif (dan terkirim) bila item dicentang.
        picker.addEventListener("change", (event) => {
            const toggle = event.target.closest("[data-picker-toggle]");

            if (!toggle) {
                return;
            }

            const qty = toggle.closest(".ui-picker-item").querySelector(".ui-picker-qty");
            qty.disabled = !toggle.checked;

            updateCount();
        });

        updateCount();
    })();
</script>
@endpush
