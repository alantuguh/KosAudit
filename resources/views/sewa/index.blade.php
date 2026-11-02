@extends('layouts.app')

@section('title', 'Data Kontrak Sewa & Deposit')

@section('content')
<div class="flex flex-col w-full space-y-space-xl">
    <div class="rounded-xl border border-secondary/20 bg-secondary-fixed/50 p-space-md text-secondary font-label-md">
        Preview: modul kontrak sewa dan deposit belum tersedia di backend yang terhubung. Pengiriman formulir tidak menyimpan kontrak.
    </div>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Kontrak Sewa &amp; Jaminan Deposit</h1>
            <p class="font-body-sm text-body-sm text-outline mt-0.5">Sesuai Flowchart: Buat data sewa (penghuni, kamar, tanggal masuk/keluar, nominal deposit) sebelum inspeksi Check-in.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-tambah-sewa').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-space-md h-10 rounded-lg bg-primary-container text-on-primary hover:bg-primary shadow-sm font-label-lg">
            <span class="material-symbols-outlined text-[20px]">add_card</span>
            <span>+ Buat Kontrak Sewa</span>
        </button>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
        <div class="p-space-md flex items-center justify-between">
            <div class="relative w-full sm:w-80">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input id="search-sewa" type="text" placeholder="Cari kontrak sewa, kamar, atau penghuni..."
                       class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-body-md focus:outline-none focus:ring-1 focus:ring-primary"/>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="sewa-table" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low text-outline font-label-sm uppercase tracking-wider">
                        <th class="py-3.5 px-space-lg">Kode Sewa</th>
                        <th class="py-3.5 px-space-md">Penghuni</th>
                        <th class="py-3.5 px-space-md">Kamar</th>
                        <th class="py-3.5 px-space-md">Periode Sewa</th>
                        <th class="py-3.5 px-space-md">Deposit Awal</th>
                        <th class="py-3.5 px-space-md">Status Deposit</th>
                        <th class="py-3.5 px-space-lg text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-body-md">
                    @foreach ($sewaList as $s)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="py-4 px-space-lg font-mono-numeric font-semibold text-primary">{{ $s['kode'] }}</td>
                        <td class="py-4 px-space-md font-semibold">{{ $s['penghuni'] }}</td>
                        <td class="py-4 px-space-md font-mono-numeric">Kamar {{ $s['kamar'] }}</td>
                        <td class="py-4 px-space-md text-outline">{{ $s['periode'] }}</td>
                        <td class="py-4 px-space-md font-mono-numeric font-semibold">{{ $s['deposit'] }}</td>
                        <td class="py-4 px-space-md"><x-badge :status="$s['status_deposit']" /></td>
                        <td class="py-4 px-space-lg text-right">
                            <a href="{{ route('inspeksi.create') }}" class="px-3 py-1.5 rounded-lg bg-surface-container-low hover:bg-surface-container text-label-sm">Inspeksi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="pagination-sewa" class="py-3.5 px-space-lg bg-surface-container-lowest"></div>
    </div>
</div>

<x-modal id="modal-tambah-sewa" title="Buat Kontrak Sewa Baru">
    <form method="POST" action="{{ route('sewa.store') }}" class="space-y-space-md">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
            <div>
                <label class="block font-label-md text-on-surface mb-1">Pilih Penghuni *</label>
                <input type="text" name="penghuni" required placeholder="Nama Penghuni" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
            <div>
                <label class="block font-label-md text-on-surface mb-1">Nomor Kamar *</label>
                <input type="text" name="kamar" required placeholder="103" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
            <div>
                <label class="block font-label-md text-on-surface mb-1">Tanggal Mulai Sewa *</label>
                <input type="date" name="tanggal_mulai" required class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
            <div>
                <label class="block font-label-md text-on-surface mb-1">Nominal Security Deposit (Rp) *</label>
                <input type="number" name="nominal_deposit" value="500000" required min="0" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
        </div>
        <div class="flex justify-end gap-2 pt-2">
            <button type="button" onclick="document.getElementById('modal-tambah-sewa').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-surface-container">Batal</button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-semibold">Simpan &amp; Lanjut Check-in</button>
        </div>
    </form>
</x-modal>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new TablePlus('#sewa-table', {
        perPage: 5,
        perPageOptions: [5, 10],
        searchInput: '#search-sewa',
        paginationContainer: '#pagination-sewa'
    });
});
</script>
@endpush