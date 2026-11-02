@extends('layouts.app')

@section('title', 'Perhitungan Pengembalian Deposit')

@section('content')
<div class="mb-space-md rounded-xl border border-secondary/20 bg-secondary-fixed/50 p-space-md text-secondary font-label-md">
    Preview: backend belum menyediakan perhitungan maupun penyimpanan pengembalian deposit.
</div>
@php
$potonganList = [
    ['no'=>1,'komponen'=>'Penggantian Remote AC & Cuci','tag'=>'Barang Hilang & Berdebu','kat'=>'Elektronik • Unit AC Split','desc'=>'Remote tidak ditemukan saat checkout final. Filter pendingin penuh endapan tebal.','biaya'=>'Rp 150.000','ket'=>'Sesuai SOP vendor'],
    ['no'=>2,'komponen'=>'Pengecatan Spot Dinding','tag'=>'Lecet Cat Finishing','kat'=>'Struktur Dinding Kamar','desc'=>'4 titik plester cat terkelupas sampai dempul akibat lem double-tape foam pigura.','biaya'=>'Rp 100.000','ket'=>'Cat & upah tukang'],
    ['no'=>3,'komponen'=>'Deep Clean Noda Kasur','tag'=>'Noda Minuman Permanen','kat'=>'Furnitur • Springbed Single','desc'=>'Noda tumpahan kopi/teh pada sudut kiri matras seluas 15 cm. Memerlukan cuci vacuum.','biaya'=>'Rp 50.000','ket'=>'Jasa laundry kasur'],
    ['no'=>4,'komponen'=>'Duplikat Kunci & Silinder Pintu','tag'=>'1 Kunci Tidak Kembali','kat'=>'Akses Pintu • Silinder Utama','desc'=>'Anak kunci cadangan duplikat hilang saat pengembalian kunci kamar 104.','biaya'=>'Rp 35.000','ket'=>'Biaya duplikat'],
    ['no'=>5,'komponen'=>'Perbaikan Drat Kran Wastafel','tag'=>'Drat Kendur & Seal','kat'=>'Sanitari • Wastafel KM Dalam','desc'=>'Pemasangan kembali seal karet dan pengencangan baut drat bawah wastafel.','biaya'=>'Rp 45.000','ket'=>'Jasa tukang'],
    ['no'=>6,'komponen'=>'Pembersihan Sisa Stiker Kaca','tag'=>'Residu Perekat','kat'=>'Interior • Kaca Jendela','desc'=>'Pembersihan bekas stiker film kaca ventilasi dengan cairan scraper khusus.','biaya'=>'Rp 20.000','ket'=>'Bahan pembersih'],
];
@endphp

<div class="flex flex-col w-full space-y-space-xl">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-space-md">
        <div>
            <h1 class="font-headline-lg text-on-surface">Perhitungan Pengembalian Security Deposit</h1>
            <p class="font-body-sm text-outline mt-1">Kamar 104 • Penyewa: <strong class="text-on-surface">Dinda Kirana</strong> • Rekening Tujuan: BCA 0123456789</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-xl items-start">
        {{-- Left Column: Deductions Table (TablePlus) --}}
        <div class="lg:col-span-7 bg-surface-container-lowest rounded-xl p-space-lg shadow-sm space-y-space-md">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="font-headline-sm text-on-surface font-semibold">Daftar Pemotongan Deposit</h2>
                    <p class="font-body-sm text-outline">Potongan otomatis ditarik dari item dengan status Rusak / Penurunan Kondisi.</p>
                </div>
                <span id="deposit-count-badge" class="px-2.5 py-1 bg-surface-container rounded-full text-on-surface-variant font-label-sm">6 Item Teridentifikasi</span>
            </div>

            <div class="flex items-center justify-between gap-space-sm bg-surface-container-low/70 p-space-sm rounded-xl">
                <div class="relative w-full sm:w-80">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                    <input id="search-deposit" class="w-full h-9 pl-9 pr-space-md rounded-lg bg-surface-container-lowest text-body-sm focus:outline-none focus:ring-1 focus:ring-primary" placeholder="Cari potongan atau bukti temuan..." type="text"/>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table id="deposit-table" class="w-full text-left font-body-md">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant font-label-md">
                            <th class="py-3 px-3 rounded-l-lg w-10 text-center">No</th>
                            <th class="py-3 px-3">Komponen Kerusakan</th>
                            <th class="py-3 px-3">Deskripsi &amp; Bukti Temuan</th>
                            <th class="py-3 px-3 text-right">Estimasi Biaya</th>
                            <th class="py-3 px-3 rounded-r-lg text-center w-20">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container-low">
                        @foreach ($potonganList as $p)
                        <tr class="hover:bg-surface-container-low/60 transition-colors">
                            <td class="py-4 px-3 text-center font-label-md text-outline">{{ $p['no'] }}</td>
                            <td class="py-4 px-3">
                                <span class="font-label-lg text-on-surface font-semibold block">{{ $p['komponen'] }}</span>
                                <span class="text-[11px] text-error font-medium block">{{ $p['tag'] }}</span>
                                <span class="font-body-sm text-outline">{{ $p['kat'] }}</span>
                            </td>
                            <td class="py-4 px-3 max-w-xs font-body-sm text-on-surface-variant">{{ $p['desc'] }}</td>
                            <td class="py-4 px-3 text-right">
                                <span class="font-mono-numeric text-error font-semibold block">{{ $p['biaya'] }}</span>
                                <span class="font-label-sm text-outline">{{ $p['ket'] }}</span>
                            </td>
                            <td class="py-4 px-3 text-center">
                                <button type="button" class="p-1.5 rounded-lg text-on-surface-variant hover:text-error"><span class="material-symbols-outlined text-[18px]">delete</span></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="pagination-deposit" class="p-space-sm bg-surface-container-low rounded-xl"></div>
        </div>

        {{-- Right Column: Financial Summary Card --}}
        <div class="lg:col-span-5 bg-surface-container-lowest rounded-xl p-space-xl shadow-md space-y-space-md sticky top-20">
            <h2 class="font-headline-sm text-on-surface font-semibold">Ringkasan Finansial Deposit</h2>
            <div class="space-y-2 text-body-md">
                <div class="flex justify-between">
                    <span class="text-on-surface font-medium">Deposit Awal Diterima</span>
                    <span class="font-mono-numeric font-semibold">Rp 500.000</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-error font-medium">Total Biaya Pemotongan</span>
                    <span class="font-mono-numeric font-semibold text-error">- Rp 150.000</span>
                </div>
            </div>
            <div class="bg-primary/5 rounded-xl p-space-lg">
                <span class="font-label-sm uppercase text-primary font-bold">TOTAL DEPOSIT DIKEMBALIKAN</span>
                <p class="font-display text-display text-primary font-extrabold mt-1">Rp 350.000</p>
                <p class="font-body-sm text-on-surface-variant mt-1">Akan ditransfer setelah persetujuan penyewa diterima via Portal Penghuni.</p>
            </div>
            <a href="{{ route('portal.dashboard') }}" class="w-full h-12 bg-primary hover:bg-primary-container text-on-primary font-label-lg font-bold rounded-lg shadow-md flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[20px]">send</span>
                <span>Kirim Rincian ke Penghuni &amp; Buka Portal Penghuni</span>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const depTable = new TablePlus('#deposit-table', {
        perPage: 3,
        perPageOptions: [3, 6, 10],
        searchInput: '#search-deposit',
        paginationContainer: '#pagination-deposit',
        onFilter: updateBadge,
        onPageChange: updateBadge
    });
    function updateBadge() {
        const b = document.getElementById('deposit-count-badge');
        if (b && depTable) b.textContent = depTable.filteredRows.length + ' Item Teridentifikasi';
    }
});
</script>
@endpush