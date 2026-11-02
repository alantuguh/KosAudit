@extends('layouts.app')

@section('title', 'Detail Kamar ' . $kamar['nomor'])

@section('content')
<div class="flex flex-col w-full space-y-space-xl">
    {{-- Breadcrumb & Header --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
        <div class="space-y-1">
            <nav class="flex items-center gap-2 font-label-sm text-label-sm text-outline">
                <a href="{{ route('kamar.index') }}" class="hover:text-primary transition-colors">Data Kamar</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-primary font-semibold">Kamar {{ $kamar['nomor'] }}</span>
            </nav>
            <div class="flex items-center gap-space-sm">
                <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Detail Kamar {{ $kamar['nomor'] }} • {{ $kamar['tipe'] }}</h1>
                <x-badge :status="$kamar['status']" />
            </div>
            <p class="font-body-sm text-body-sm text-outline">
                Lantai {{ $kamar['lantai'] }} • Ukuran {{ $kamar['ukuran'] }} • Tarif Sewa <strong class="text-on-surface font-mono-numeric">{{ $kamar['harga'] }} / bulan</strong>
            </p>
        </div>
        <div class="flex items-center gap-space-sm">
            <a href="{{ route('inspeksi.create', ['kamar' => $kamar['nomor']]) }}"
               class="px-space-md py-2.5 rounded-lg bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md flex items-center gap-1.5 shadow-sm transition-all">
                <span class="material-symbols-outlined text-[18px]">assignment_add</span>
                <span>+ Buat Inspeksi Kamar {{ $kamar['nomor'] }}</span>
            </a>
            <a href="{{ route('inspeksi.komparasi') }}"
               class="px-space-md py-2.5 rounded-lg bg-surface-container-lowest hover:bg-surface-container-low text-on-surface font-label-md text-label-md flex items-center gap-1.5 shadow-sm transition-all">
                <span class="material-symbols-outlined text-[18px] text-primary">compare</span>
                <span>Lihat Komparasi Terakhir</span>
            </a>
        </div>
    </div>

    {{-- Info Grid: Penghuni Saat Ini & Daftar Inventaris Standar --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg">
        <div class="lg:col-span-5 bg-surface-container-lowest p-space-lg rounded-xl shadow-sm space-y-space-md">
            <div class="flex items-center justify-between">
                <h2 class="font-headline-sm text-headline-sm text-on-surface">Informasi Penghuni &amp; Deposit</h2>
                <span class="material-symbols-outlined text-primary">person_check</span>
            </div>
            <div class="p-space-md rounded-xl bg-surface-container-low space-y-2">
                <div class="flex justify-between text-body-sm">
                    <span class="text-outline">Nama Penghuni</span>
                    <span class="font-semibold text-on-surface">{{ $kamar['penghuni'] }}</span>
                </div>
                <div class="flex justify-between text-body-sm">
                    <span class="text-outline">Periode Kontrak</span>
                    <span class="font-mono-numeric text-on-surface">{{ $kamar['periode'] }}</span>
                </div>
                <div class="flex justify-between text-body-sm">
                    <span class="text-outline">Deposit Ditahan</span>
                    <span class="font-mono-numeric font-bold text-primary">{{ $kamar['deposit'] }}</span>
                </div>
                <div class="flex justify-between text-body-sm">
                    <span class="text-outline">Fasilitas Kamar</span>
                    <span class="text-on-surface font-medium">{{ implode(', ', $kamar['fasilitas']) }}</span>
                </div>
            </div>
            <div class="flex items-center justify-between pt-1">
                <a href="{{ route('deposit.perhitungan') }}" class="text-primary font-label-md hover:underline flex items-center gap-1">
                    <span>Buka Kalkulasi Pengembalian Deposit</span>
                    <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                </a>
            </div>
        </div>

        <div class="lg:col-span-7 bg-surface-container-lowest p-space-lg rounded-xl shadow-sm space-y-space-md">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-space-sm">
                <div>
                    <h2 class="font-headline-sm text-headline-sm text-on-surface">Riwayat Inspeksi Kamar {{ $kamar['nomor'] }}</h2>
                    <p class="font-body-sm text-body-sm text-outline">Log pemeriksaan fisik Check-in dan Check-out pada URI dinamis <code>/kamar/{{ $kamar['nomor'] }}</code></p>
                </div>
                <div class="relative w-full sm:w-56">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                    <input id="search-riwayat-kamar" type="text" placeholder="Cari riwayat..."
                           class="w-full h-9 pl-9 pr-3 rounded-lg bg-surface-container-low text-body-sm focus:outline-none focus:ring-1 focus:ring-primary"/>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="riwayat-kamar-table" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-outline font-label-sm text-label-sm uppercase tracking-wider">
                            <th class="py-3 px-space-md font-semibold">ID Audit</th>
                            <th class="py-3 px-space-md font-semibold">Tanggal</th>
                            <th class="py-3 px-space-md font-semibold">Jenis</th>
                            <th class="py-3 px-space-md font-semibold">Penghuni</th>
                            <th class="py-3 px-space-md font-semibold">Ringkasan Kondisi</th>
                            <th class="py-3 px-space-md text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container text-body-sm">
                        @foreach ($riwayatInspeksi as $log)
                        <tr class="hover:bg-surface-container-low/50 transition-colors">
                            <td class="py-3.5 px-space-md font-mono-numeric font-semibold text-primary">{{ $log['kode'] }}</td>
                            <td class="py-3.5 px-space-md font-mono-numeric text-outline">{{ $log['tanggal'] }}</td>
                            <td class="py-3.5 px-space-md">
                                <x-badge :status="$log['jenis']" />
                            </td>
                            <td class="py-3.5 px-space-md font-medium text-on-surface">{{ $log['penghuni'] }}</td>
                            <td class="py-3.5 px-space-md text-on-surface-variant">{{ $log['ringkasan'] }}</td>
                            <td class="py-3.5 px-space-md text-right">
                                <a href="{{ route('inspeksi.komparasi') }}" class="px-3 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface font-label-sm">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="pagination-riwayat-kamar" class="pt-2"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new TablePlus('#riwayat-kamar-table', {
        perPage: 5,
        perPageOptions: [5, 10],
        searchInput: '#search-riwayat-kamar',
        paginationContainer: '#pagination-riwayat-kamar'
    });
});
</script>
@endpush