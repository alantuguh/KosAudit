@extends('layouts.glass')

@section('title', 'Dashboard Pemilik')

@section('content')
@php
$aktivitas = collect([
['Dinda Kirana', '0812-4421-9901', '104', 'AC Standar', 'Check-out', '24 Mei 2025', 'Menunggu Verifikasi Deposit', 'Periksa Hasil'],
['Budi Wicaksono', '0857-1190-2384', '202', 'Deluxe', 'Check-in', '22 Mei 2025', 'Disetujui Penghuni', 'Lihat Detail'],
['Nabila Salma', '0821-3990-1288', '108', 'Standar', 'Check-out', '20 Mei 2025', 'Deposit Dikembalikan (Rp 420.000)', 'Kuitansi'],
['Kevin Sanjaya', '0813-9022-8311', '301', 'VIP', 'Check-in', '18 Mei 2025', 'Selesai Inspeksi', 'Lihat Detail'],
['Melisa Putri', '0819-0122-3841', '205', 'Standar', 'Check-out', '15 Mei 2025', 'Ada Keberatan', 'Review Keberatan'],
['Farhan Alamsyah', '0812-9988-1022', '105', 'VIP', 'Check-in', '12 Mei 2025', 'Selesai Inspeksi', 'Lihat Detail'],
['Siti Rahmawati', '0856-7812-4433', '101', 'Standar', 'Check-out', '10 Mei 2025', 'Deposit Dikembalikan (Rp 500.000)', 'Kuitansi'],
['Rian Pratama', '0877-2234-9910', '102', 'Standar', 'Check-in', '8 Mei 2025', 'Disetujui Penghuni', 'Lihat Detail'],
['Riko Prasetyo', '0813-8877-0019', '112', 'Standar', 'Check-out', '6 Mei 2025', 'Ada Keberatan', 'Review Keberatan'],
['Anisa Rahmawati', '0819-3321-7788', '106', 'Standar', 'Check-in', '5 Mei 2025', 'Selesai Inspeksi', 'Lihat Detail'],
['Ahmad Fauzi', '0812-7788-3344', '203', 'Standar', 'Check-out', '3 Mei 2025', 'Menunggu Verifikasi Deposit', 'Periksa Hasil'],
['Dewi Lestari', '0822-1144-8899', '204', 'Deluxe', 'Check-in', '2 Mei 2025', 'Disetujui Penghuni', 'Lihat Detail'],
['Bayu Pratama', '0852-6677-2211', '207', 'Standar', 'Check-out', '29 Apr 2025', 'Deposit Dikembalikan (Rp 450.000)', 'Kuitansi'],
['Citra Kirana', '0811-9988-4455', '206', 'VIP', 'Check-in', '26 Apr 2025', 'Disetujui Penghuni', 'Lihat Detail'],
['Eko Prasetyo', '0878-5544-1122', '302', 'Standar', 'Check-out', '23 Apr 2025', 'Selesai Inspeksi', 'Lihat Detail'],
['Fani Rahmawati', '0813-2211-9900', '303', 'Standar', 'Check-in', '20 Apr 2025', 'Disetujui Penghuni', 'Lihat Detail'],
['Gilang Ramadhan', '0819-4455-6677', '304', 'Deluxe', 'Check-out', '16 Apr 2025', 'Deposit Dikembalikan (Rp 300.000)', 'Kuitansi'],
['Hani Wijaya', '0857-1122-3344', '306', 'VIP', 'Check-in', '12 Apr 2025', 'Selesai Inspeksi', 'Lihat Detail'],
])->map(function ($r) {
[$nama, $hp, $kamar, $tipe, $jenis, $tgl, $status, $aksi] = $r;

$s = strtolower($status);
$keberatan = str_contains($s, 'keberatan');
$menunggu = str_contains($s, 'menunggu');

return compact('nama', 'hp', 'kamar', 'tipe', 'jenis', 'tgl', 'status', 'aksi', 'keberatan') + [
'tone' => $keberatan ? 'danger' : ($menunggu ? 'warning' : (str_contains($s, 'dikembalikan') ? 'neutral' : 'brand')),
'variant' => $keberatan ? 'danger' : ($menunggu ? 'primary' : 'secondary'),
'tags' => trim(($jenis === 'Check-out' ? 'checkout ' : '') . (($keberatan || $menunggu) ? 'action' : '')),
];
});
@endphp

<div class="flex w-full flex-col gap-6">

    {{-- Sapaan --}}
    <x-glass-card level="premium" class="p-6">
        <div class="flex flex-col gap-5 xl:flex-row xl:items-center xl:justify-between">
            <div class="space-y-2">
                <div class="flex flex-wrap items-center gap-3">
                    <h1 class="ui-heading-lg">Selamat Datang, {{ auth()->user()->name }}</h1>

                    <x-glass-badge tone="success" :dot="true">
                        Kost Putri Griya Asri &bull; {{ $roomSummary['total'] }} Kamar Total
                    </x-glass-badge>
                </div>

                <p class="ui-body-sm flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px]" aria-hidden="true">verified</span>
                    Ringkasan kamar dan akun penghuni tersambung ke backend. Data inspeksi dan deposit masih berupa pratinjau.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <x-glass-badge tone="neutral" icon="calendar_month">Bulan Ini (Mei 2025)</x-glass-badge>

                <x-glass-button :href="route('inspeksi.create')" variant="primary" :block="false">
                    <span class="material-symbols-outlined" aria-hidden="true">add_task</span>
                    Mulai Inspeksi Baru
                </x-glass-button>
            </div>
        </div>
    </x-glass-card>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <x-glass-stat-card label="Kamar Terisi" :value="$roomSummary['occupied']" :unit="'/ ' . $roomSummary['total']" icon="bed" tone="brand" subtitle="Status dari database" />
        <x-glass-stat-card label="Kamar Kosong" :value="$roomSummary['available']" unit="Unit" icon="meeting_room" tone="neutral" subtitle="Tersedia untuk disewa" />
        <x-glass-stat-card label="Tenant Terdaftar" :value="$roomSummary['tenants']" unit="Akun" icon="group" tone="info" subtitle="Akun pada backend" />
        <x-glass-stat-card label="Butuh Perbaikan" :value="$roomSummary['repair']" unit="Kamar" icon="construction" tone="warning" subtitle="Status dari database" />
    </div>

    {{-- Aktivitas & keberatan --}}
    <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-12">

        <div class="lg:col-span-8">
            <x-glass-table
                id="dashboard-table"
                title="Aktivitas Terbaru"
                description="Catatan check-in, check-out, serta status penahanan dan verifikasi deposit"
                :per-page="5"
                :per-page-options="[5, 10, 18]"
                search-placeholder="Cari aktivitas..."
                :filters="['all' => 'Semua', 'checkout' => 'Check-out', 'action' => 'Perlu Tindakan']"
                info-label="riwayat inspeksi bulan ini">
                <x-slot:head>
                    <tr>
                        <th>Penghuni</th>
                        <th>Kamar</th>
                        <th>Inspeksi</th>
                        <th>Tanggal</th>
                        <th>Status Audit</th>
                        <th class="ui-cell-end">Aksi</th>
                    </tr>
                </x-slot:head>

                @foreach ($aktivitas as $row)
                <tr data-tags="{{ $row['tags'] }}" @if ($row['keberatan']) data-tone="danger" @endif>
                    <td>
                        <div class="flex items-center gap-3">
                            <x-glass-avatar :name="$row['nama']" :tone="$row['tone']" />

                            <div>
                                <p class="font-semibold leading-tight">{{ $row['nama'] }}</p>
                                <p class="ui-caption">{{ $row['hp'] }}</p>
                            </div>
                        </div>
                    </td>

                    <td>
                        <a href="{{ route('kamar.show', $row['kamar']) }}" class="ui-link">Kamar {{ $row['kamar'] }}</a>
                        <span class="ui-caption block">{{ $row['tipe'] }}</span>
                    </td>

                    <td>
                        @if ($row['jenis'] === 'Check-out')
                        <x-glass-badge tone="warning" icon="logout">Check-out</x-glass-badge>
                        @else
                        <x-glass-badge tone="success" icon="login">Check-in</x-glass-badge>
                        @endif
                    </td>

                    <td class="whitespace-nowrap tabular-nums">{{ $row['tgl'] }}</td>

                    <td><x-glass-badge :status="$row['status']" /></td>

                    <td class="ui-cell-end">
                        <x-glass-button :href="route('inspeksi.komparasi')" :variant="$row['variant']" size="sm" :block="false">
                            {{ $row['aksi'] }}
                        </x-glass-button>
                    </td>
                </tr>
                @endforeach
            </x-glass-table>
        </div>

        <div class="flex flex-col gap-6 lg:col-span-4">

            <x-glass-card level="subtle" class="space-y-4 p-6">
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]" aria-hidden="true">report_problem</span>
                        <h3 class="ui-heading-md">Keberatan Penghuni</h3>
                    </div>

                    <x-glass-badge tone="danger">2 Aktif</x-glass-badge>
                </div>

                <p class="ui-body-sm">Tinjau sanggahan inventaris sebelum dana deposit dicairkan kembali.</p>

                <div class="ui-inset space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <p class="font-semibold">Melisa Putri <span class="ui-caption">Kmr 205</span></p>
                        <x-glass-badge tone="danger">Perlu Ditinjau</x-glass-badge>
                    </div>

                    <p class="ui-quote">“Kran wastafel memang sudah longgar sejak awal masuk, bukan patah saat saya huni.”</p>

                    <x-glass-button :href="route('inspeksi.komparasi')" variant="primary" size="sm">
                        <span class="material-symbols-outlined" aria-hidden="true">compare</span>
                        Buka Komparasi Foto
                    </x-glass-button>
                </div>

                <div class="ui-inset space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <p class="font-semibold">Riko Prasetyo <span class="ui-caption">Kmr 112</span></p>
                        <x-glass-badge tone="warning">Dalam Diskusi</x-glass-badge>
                    </div>

                    <p class="ui-quote">“Cat terkelupas karena rembesan hujan dinding luar, mohon cek foto check-in.”</p>

                    <x-glass-button :href="route('inspeksi.komparasi')" variant="secondary" size="sm">
                        <span class="material-symbols-outlined" aria-hidden="true">image_search</span>
                        Buka Bukti
                    </x-glass-button>
                </div>
            </x-glass-card>

            <x-glass-card level="subtle" class="p-6">
                <div class="flex items-start gap-4">
                    <span class="ui-icon-tile ui-tone-brand">
                        <span class="material-symbols-outlined" aria-hidden="true">auto_awesome</span>
                    </span>

                    <div class="space-y-1">
                        <h4 class="ui-heading-md">Audit Berbasis Foto</h4>
                        <p class="ui-body-sm">
                            Transparansi audit foto komparasi sebelum dan sesudah huni mengurangi sengketa deposit kos dan mempercepat serah terima.
                        </p>
                    </div>
                </div>
            </x-glass-card>

        </div>
    </div>

</div>
@endsection