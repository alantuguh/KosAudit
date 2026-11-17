@extends('layouts.glass')

@section('title', 'Dashboard')

@section('content')
@php
/*
 * Ringkasan kamar ($roomSummary) berasal dari backend.
 * Aktivitas & keberatan di bawah masih data contoh (modul inspeksi belum tersedia).
 */
$aktivitas = collect([
    ['Dinda Kirana', '104', 'AC Standar', 'Check-out', '24 Mei 2025', 'Menunggu Verifikasi Deposit'],
    ['Budi Wicaksono', '202', 'Deluxe', 'Check-in', '22 Mei 2025', 'Disetujui Penghuni'],
    ['Nabila Salma', '108', 'Standar', 'Check-out', '20 Mei 2025', 'Deposit Dikembalikan (Rp 420.000)'],
    ['Kevin Sanjaya', '301', 'VIP', 'Check-in', '18 Mei 2025', 'Selesai Inspeksi'],
    ['Melisa Putri', '205', 'Standar', 'Check-out', '15 Mei 2025', 'Ada Keberatan'],
    ['Farhan Alamsyah', '105', 'VIP', 'Check-in', '12 Mei 2025', 'Selesai Inspeksi'],
    ['Siti Rahmawati', '101', 'Standar', 'Check-out', '10 Mei 2025', 'Deposit Dikembalikan (Rp 500.000)'],
    ['Rian Pratama', '102', 'Standar', 'Check-in', '8 Mei 2025', 'Disetujui Penghuni'],
    ['Riko Prasetyo', '112', 'Standar', 'Check-out', '6 Mei 2025', 'Ada Keberatan'],
    ['Anisa Rahmawati', '106', 'Standar', 'Check-in', '5 Mei 2025', 'Selesai Inspeksi'],
    ['Ahmad Fauzi', '203', 'Standar', 'Check-out', '3 Mei 2025', 'Menunggu Verifikasi Deposit'],
    ['Dewi Lestari', '204', 'Deluxe', 'Check-in', '2 Mei 2025', 'Disetujui Penghuni'],
    ['Bayu Pratama', '207', 'Standar', 'Check-out', '29 Apr 2025', 'Deposit Dikembalikan (Rp 450.000)'],
    ['Citra Kirana', '206', 'VIP', 'Check-in', '26 Apr 2025', 'Disetujui Penghuni'],
    ['Eko Prasetyo', '302', 'Standar', 'Check-out', '23 Apr 2025', 'Selesai Inspeksi'],
    ['Fani Rahmawati', '303', 'Standar', 'Check-in', '20 Apr 2025', 'Disetujui Penghuni'],
    ['Gilang Ramadhan', '304', 'Deluxe', 'Check-out', '16 Apr 2025', 'Deposit Dikembalikan (Rp 300.000)'],
    ['Hani Wijaya', '306', 'VIP', 'Check-in', '12 Apr 2025', 'Selesai Inspeksi'],
])->map(function ($r) {
    [$nama, $kamar, $tipe, $jenis, $tgl, $status] = $r;

    $keberatan = $status === 'Ada Keberatan';
    $menunggu = str_starts_with($status, 'Menunggu');

    return compact('nama', 'kamar', 'tipe', 'jenis', 'tgl', 'status', 'keberatan', 'menunggu') + [
        'tags' => $jenis === 'Check-out' ? 'checkout' : 'checkin',
    ];
});

// Keterangan tambahan untuk item yang perlu tindakan.
$catatanKeberatan = [
    'Melisa Putri' => 'Kran wastafel memang sudah longgar sejak awal masuk, bukan patah saat saya huni.',
    'Riko Prasetyo' => 'Cat terkelupas karena rembesan hujan dinding luar, mohon cek foto check-in.',
];

// Keberatan didahulukan, lalu verifikasi deposit.
$perluTindakan = $aktivitas
    ->filter(fn ($r) => $r['keberatan'] || $r['menunggu'])
    ->sortByDesc('keberatan')
    ->values();

$okupansi = $roomSummary['total'] > 0
    ? round($roomSummary['occupied'] / $roomSummary['total'] * 100)
    : 0;
@endphp

<x-glass-page-header
    :eyebrow="now()->locale('id')->translatedFormat('l, j F Y')"
    title="Dashboard"
    description="Ringkasan kamar dari database dan aktivitas audit terbaru. Data aktivitas masih contoh.">
    <x-slot:actions>
        <x-glass-button :href="route('inspeksi.create')" variant="primary" :block="false">
            <span class="material-symbols-outlined" aria-hidden="true">add</span>
            Mulai Inspeksi
        </x-glass-button>
    </x-slot:actions>
</x-glass-page-header>

{{-- Ringkasan --}}
<section aria-label="Ringkasan kamar" class="grid grid-cols-2 gap-4 xl:grid-cols-4 xl:gap-6">
    <x-glass-stat-card label="Kamar Terisi" :value="$roomSummary['occupied']" :unit="'/ ' . $roomSummary['total']" tone="success" :subtitle="'Okupansi ' . $okupansi . '%'" />
    <x-glass-stat-card label="Kamar Kosong" :value="$roomSummary['available']" unit="Unit" tone="info" subtitle="Siap disewakan" />
    <x-glass-stat-card label="Penghuni" :value="$roomSummary['tenants']" unit="Akun" tone="brand" subtitle="Terdaftar" />
    <x-glass-stat-card label="Butuh Perbaikan" :value="$roomSummary['repair']" unit="Kamar" tone="warning" subtitle="Belum bisa disewakan" />
</section>

<div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-3">

    {{-- Aktivitas --}}
    <div class="min-w-0 xl:col-span-2">
        <x-glass-table
            id="dashboard-table"
            title="Aktivitas Terbaru"
            :stack="true"
            :per-page="6"
            :per-page-options="[6]"
            search-placeholder="Cari penghuni atau kamar..."
            :filters="['all' => 'Semua', 'checkin' => 'Check-in', 'checkout' => 'Check-out']"
            info-label="aktivitas">
            <x-slot:head>
                <tr>
                    <th scope="col">Penghuni</th>
                    <th scope="col">Inspeksi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="ui-cell-end"><span class="sr-only">Aksi</span></th>
                </tr>
            </x-slot:head>

            @foreach ($aktivitas as $row)
            <tr data-tags="{{ $row['tags'] }}" @if ($row['keberatan']) data-tone="danger" @endif>
                <td>
                    <p class="font-semibold leading-tight">{{ $row['nama'] }}</p>
                    <a href="{{ route('kamar.show', $row['kamar']) }}" class="ui-caption hover:underline">
                        Kamar {{ $row['kamar'] }} &bull; {{ $row['tipe'] }}
                    </a>
                </td>
                <td data-label="Inspeksi"><x-glass-badge :status="$row['jenis']" /></td>
                <td data-label="Tanggal" class="ui-num">{{ $row['tgl'] }}</td>
                <td data-label="Status"><x-glass-badge :status="$row['status']" /></td>
                <td class="ui-cell-end">
                    <x-glass-button
                        :href="route('inspeksi.komparasi')"
                        variant="secondary"
                        size="sm"
                        :block="false"
                        aria-label="Detail inspeksi {{ $row['nama'] }}">
                        Detail
                    </x-glass-button>
                </td>
            </tr>
            @endforeach
        </x-glass-table>
    </div>

    {{-- Perlu tindakan --}}
    <x-glass-card level="subtle" class="p-0">
        <div class="flex items-center justify-between gap-3 px-6 pt-5 pb-4">
            <h2 class="ui-heading-md">Perlu Tindakan</h2>
            <x-glass-badge :tone="$perluTindakan->isEmpty() ? 'success' : 'danger'">{{ $perluTindakan->count() }}</x-glass-badge>
        </div>

        @if ($perluTindakan->isEmpty())
        <p class="ui-body-sm px-6 pb-6">Tidak ada keberatan atau verifikasi yang menunggu.</p>
        @else
        <ul class="ui-list" aria-label="Daftar perlu tindakan">
            @foreach ($perluTindakan as $item)
            <li class="space-y-2">
                <div class="flex items-start justify-between gap-3">
                    <div class="min-w-0">
                        <p class="truncate text-sm font-semibold">{{ $item['nama'] }}</p>
                        <p class="ui-caption">Kamar {{ $item['kamar'] }} &bull; {{ $item['tgl'] }}</p>
                    </div>
                    <x-glass-badge :tone="$item['keberatan'] ? 'danger' : 'warning'" class="shrink-0">
                        {{ $item['keberatan'] ? 'Keberatan' : 'Verifikasi' }}
                    </x-glass-badge>
                </div>

                @if ($item['keberatan'] && isset($catatanKeberatan[$item['nama']]))
                <p class="ui-quote line-clamp-2">“{{ $catatanKeberatan[$item['nama']] }}”</p>
                @endif

                <a href="{{ route('inspeksi.komparasi') }}" class="ui-link inline-flex items-center gap-1 text-sm">
                    {{ $item['keberatan'] ? 'Tinjau bukti' : 'Verifikasi deposit' }}
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">arrow_forward</span>
                </a>
            </li>
            @endforeach
        </ul>
        @endif
    </x-glass-card>
</div>
@endsection
