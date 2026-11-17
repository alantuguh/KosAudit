@extends('layouts.glass')

@section('title', 'Kamar ' . $kamar['nomor'])

@section('content')
<x-glass-page-header
    :title="'Kamar ' . $kamar['nomor']"
    :description="'Lantai ' . $kamar['lantai'] . ' • Tipe ' . $kamar['tipe'] . ' • ' . $kamar['ukuran']">
    <x-slot:breadcrumb>
        <a href="{{ route('kamar.index') }}">Data Kamar</a>
        <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
        <span aria-current="page">Kamar {{ $kamar['nomor'] }}</span>
    </x-slot:breadcrumb>

    <x-slot:actions>
        <x-glass-button :href="route('inspeksi.komparasi')" variant="secondary" :block="false">
            Komparasi Terakhir
        </x-glass-button>

        <x-glass-button :href="route('inspeksi.create', ['kamar' => $kamar['nomor']])" variant="primary" :block="false">
            <span class="material-symbols-outlined" aria-hidden="true">add</span>
            Buat Inspeksi
        </x-glass-button>
    </x-slot:actions>
</x-glass-page-header>

<div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-3">

    {{-- Ringkasan unit --}}
    <div class="flex flex-col gap-6">
        <x-glass-card level="subtle" class="space-y-5 p-6">
            <div class="flex items-start justify-between gap-3">
                <div class="space-y-1">
                    <p class="ui-eyebrow">Tarif Sewa</p>
                    <p class="ui-amount">{{ $kamar['harga'] }}<span class="ui-stat-unit">/ bulan</span></p>
                </div>

                <x-glass-badge :status="$kamar['status']" />
            </div>

            <div class="ui-glass-divider"></div>

            <div class="space-y-3">
                <h2 class="ui-heading-md">Penghuni &amp; Deposit</h2>

                <dl class="ui-dl">
                    <div>
                        <dt>Penghuni</dt>
                        <dd>{{ $kamar['penghuni'] }}</dd>
                    </div>
                    <div>
                        <dt>Periode kontrak</dt>
                        <dd class="ui-num">{{ $kamar['periode'] }}</dd>
                    </div>
                    <div>
                        <dt>Deposit ditahan</dt>
                        <dd class="ui-num">{{ $kamar['deposit'] }}</dd>
                    </div>
                </dl>
            </div>

            <a href="{{ route('deposit.perhitungan') }}" class="ui-link inline-flex items-center gap-1 text-sm">
                Buka kalkulasi deposit
                <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
            </a>
        </x-glass-card>

        <x-glass-card level="subtle" class="space-y-4 p-6">
            <div class="flex items-center justify-between gap-3">
                <h2 class="ui-heading-md">Item Kondisi</h2>
                <x-glass-badge tone="neutral">{{ count($kamar['fasilitas']) }} item</x-glass-badge>
            </div>

            @if ($kamar['fasilitas'])
            <ul class="flex flex-wrap gap-2" aria-label="Daftar item kondisi">
                @foreach ($kamar['fasilitas'] as $item)
                <li><x-glass-badge tone="brand">{{ $item }}</x-glass-badge></li>
                @endforeach
            </ul>
            <p class="ui-caption">Menjadi daftar periksa saat inspeksi check-in dan check-out.</p>
            @else
            <p class="ui-body-sm">Belum ada item kondisi. Tambahkan item agar kamar dapat diinspeksi.</p>
            @endif
        </x-glass-card>
    </div>

    {{-- Riwayat inspeksi --}}
    <div class="min-w-0 xl:col-span-2">
        @if (count($riwayatInspeksi))
        <x-glass-table
            id="riwayat-kamar-table"
            title="Riwayat Inspeksi"
            :stack="true"
            :per-page="6"
            :per-page-options="[6]"
            search-placeholder="Cari riwayat..."
            info-label="inspeksi">
            <x-slot:head>
                <tr>
                    <th scope="col">Inspeksi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Ringkasan</th>
                    <th scope="col" class="ui-cell-end"><span class="sr-only">Aksi</span></th>
                </tr>
            </x-slot:head>

            @foreach ($riwayatInspeksi as $log)
            <tr>
                <td>
                    <p class="ui-num font-semibold">{{ $log['kode'] }}</p>
                    <p class="ui-caption">{{ $log['penghuni'] }}</p>
                </td>
                <td data-label="Tanggal" class="ui-num">{{ $log['tanggal'] }}</td>
                <td data-label="Jenis"><x-glass-badge :status="$log['jenis']" /></td>
                <td data-label="Ringkasan">{{ $log['ringkasan'] }}</td>
                <td class="ui-cell-end">
                    <x-glass-button :href="route('inspeksi.komparasi')" variant="secondary" size="sm" :block="false">Detail</x-glass-button>
                </td>
            </tr>
            @endforeach
        </x-glass-table>
        @else
        <x-glass-empty-state icon="history" title="Belum ada riwayat inspeksi">
            Inspeksi check-in dan check-out untuk Kamar {{ $kamar['nomor'] }} akan tercatat di sini beserta ringkasan kondisinya.

            <x-slot:actions>
                <x-glass-button :href="route('inspeksi.create', ['kamar' => $kamar['nomor']])" variant="primary" :block="false">
                    <span class="material-symbols-outlined" aria-hidden="true">add</span>
                    Buat Inspeksi Pertama
                </x-glass-button>
            </x-slot:actions>
        </x-glass-empty-state>
        @endif
    </div>
</div>
@endsection
