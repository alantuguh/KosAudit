@extends('layouts.app')

@section('title', 'Perbandingan Kondisi Check-in vs Check-out')

@section('content')
<div class="mb-space-md rounded-xl border border-secondary/20 bg-secondary-fixed/50 p-space-md text-secondary font-label-md">
    Preview: hasil inspeksi dan perbandingan pada halaman ini adalah contoh, bukan data yang tersimpan di backend.
</div>
@php
$komparasiItems = [
    ['no'=>1,'icon'=>'mode_fan','nama'=>'AC Split & Remote Control','kat'=>'Elektronik Utama','awal'=>'Baik','akhir'=>'Rusak Berat','cat_in'=>'AC dingin optimal (22°C), remote original berfungsi normal lengkap baterai.','cat_out'=>'Remote AC tidak ditemukan saat serah terima unit. Flap AC berderit.','biaya'=>'Rp 150.000','urgent'=>true],
    ['no'=>2,'icon'=>'wallpaper','nama'=>'Dinding Kamar & Pengecatan','kat'=>'Struktur & Interior','awal'=>'Baik','akhir'=>'Rusak Berat','cat_in'=>'Cat dinding putih polos baru, permukaan mulus tanpa lubang paku atau perekat.','cat_out'=>'4 titik cat terkelupas dalam akibat tarikan double-tape cermin dan poster.','biaya'=>'Rp 100.000','urgent'=>true],
    ['no'=>3,'icon'=>'bed','nama'=>'Kasur Springbed & Sprei Pelindung','kat'=>'Furnitur Lembut','awal'=>'Baik','akhir'=>'Lecet Ringan','cat_in'=>'Springbed bersih higienis dengan sprei pelindung terpasang rapat, bebas noda.','cat_out'=>'Ada noda tumpahan minuman teh samar di sudut kanan atas kasur (±12cm).','biaya'=>'Rp 50.000','urgent'=>true],
    ['no'=>4,'icon'=>'door_sliding','nama'=>'Lemari Pakaian 2 Pintu Geser','kat'=>'Mebel Kayu','awal'=>'Baik','akhir'=>'Baik','cat_in'=>'Pintu geser lancar, kunci cadangan 2 pcs lengkap, rel bersih.','cat_out'=>'Kondisi sangat terawat, bersih, kedua kunci asli diserahkan utuh.','biaya'=>'Rp 0','urgent'=>false],
    ['no'=>5,'icon'=>'water_drop','nama'=>'Kran Air & Wastafel Kamar Mandi','kat'=>'Sanitari','awal'=>'Baik','akhir'=>'Baik (Wajar)','cat_in'=>'Air mengalir kencang, drat kran kencang, pipa rapat tanpa rembes.','cat_out'=>'Pemakaian wajar 1 tahun (normal wear & tear), keramik wastafel utuh.','biaya'=>'Rp 0','urgent'=>false],
    ['no'=>6,'icon'=>'grid_view','nama'=>'Lantai Keramik Granit 60x60','kat'=>'Lantai','awal'=>'Baik','akhir'=>'Baik','cat_in'=>'Nat keramik rapi bersih, tidak ada gompal atau retak.','cat_out'=>'Keramik lantai tetap mulus berkilau, bebas retak.','biaya'=>'Rp 0','urgent'=>false],
];
@endphp

<div class="flex flex-col w-full space-y-space-xl">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface">Audit Perbandingan Kondisi Kamar 104</h1>
            <p class="font-body-md text-on-surface-variant mt-0.5">Penghuni: <strong class="text-on-surface">Dinda Kirana</strong> • Periode: 1 Jun 2024 — 24 Mei 2025 (12 Bulan)</p>
        </div>
        <div class="flex items-center gap-space-sm">
            <a href="{{ route('inspeksi.create') }}" class="px-space-md py-2.5 rounded-lg bg-surface-container-low text-on-surface font-label-md flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Form Inspeksi
            </a>
            <a href="{{ route('deposit.perhitungan') }}" class="px-space-lg py-2.5 rounded-lg bg-primary-container text-on-primary font-label-md shadow-sm flex items-center gap-1.5">
                <span>Lanjut ke Perhitungan Deposit</span>
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </a>
        </div>
    </div>

    {{-- Side-by-Side Cards --}}
    <div class="space-y-space-md">
        @foreach ($komparasiItems as $item)
        <div class="rounded-2xl {{ $item['urgent'] ? 'bg-error-container/20 border border-error/20' : 'bg-surface-container-lowest' }} p-space-lg shadow-sm space-y-space-md">
            <div class="flex flex-wrap items-center justify-between gap-space-sm">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-surface-container-lowest flex items-center justify-center {{ $item['urgent'] ? 'text-error' : 'text-primary' }} shadow-xs">
                        <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                    </div>
                    <div>
                        <h3 class="font-headline-sm text-on-surface font-bold">{{ $item['no'] }}. {{ $item['nama'] }}</h3>
                        <p class="font-label-sm text-outline">{{ $item['kat'] }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <x-badge :status="$item['akhir']">{{ $item['awal'] }} ➔ {{ $item['akhir'] }}</x-badge>
                    <span class="px-3 py-1 rounded-full bg-surface-container-lowest font-mono-numeric font-bold {{ $item['urgent'] ? 'text-error' : 'text-tertiary' }}">
                        Estimasi Beban: {{ $item['biaya'] }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-space-md">
                <div class="bg-surface-container-lowest p-space-md rounded-xl space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-label-sm uppercase text-outline">Kondisi Awal (Check-in • 1 Jun 2024)</span>
                        <x-badge :status="$item['awal']" />
                    </div>
                    <p class="font-body-sm text-on-surface-variant italic">"{{ $item['cat_in'] }}"</p>
                </div>
                <div class="bg-surface-container-lowest p-space-md rounded-xl space-y-2">
                    <div class="flex items-center justify-between">
                        <span class="font-label-sm uppercase text-outline">Kondisi Akhir (Check-out • 24 Mei 2025)</span>
                        <x-badge :status="$item['akhir']" />
                    </div>
                    <p class="font-body-sm text-on-surface">"{{ $item['cat_out'] }}"</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection