@extends('layouts.glass')

@section('title', 'Komparasi Kondisi')

@section('content')
@php
// Contoh hasil komparasi (backend inspeksi belum tersedia). Biaya dalam rupiah.
$komparasiItems = [
    ['icon' => 'mode_fan', 'nama' => 'AC Split & Remote Control', 'kat' => 'Elektronik Utama', 'awal' => 'Baik', 'akhir' => 'Rusak Berat', 'cat_in' => 'AC dingin optimal (22°C), remote original berfungsi normal lengkap baterai.', 'cat_out' => 'Remote AC tidak ditemukan saat serah terima unit. Flap AC berderit.', 'biaya' => 150000],
    ['icon' => 'wallpaper', 'nama' => 'Dinding Kamar & Pengecatan', 'kat' => 'Struktur & Interior', 'awal' => 'Baik', 'akhir' => 'Rusak Berat', 'cat_in' => 'Cat dinding putih polos baru, permukaan mulus tanpa lubang paku atau perekat.', 'cat_out' => '4 titik cat terkelupas dalam akibat tarikan double-tape cermin dan poster.', 'biaya' => 100000],
    ['icon' => 'bed', 'nama' => 'Kasur Springbed & Sprei Pelindung', 'kat' => 'Furnitur Lembut', 'awal' => 'Baik', 'akhir' => 'Lecet Ringan', 'cat_in' => 'Springbed bersih higienis dengan sprei pelindung terpasang rapat, bebas noda.', 'cat_out' => 'Ada noda tumpahan minuman teh samar di sudut kanan atas kasur (±12cm).', 'biaya' => 50000],
    ['icon' => 'door_sliding', 'nama' => 'Lemari Pakaian 2 Pintu Geser', 'kat' => 'Mebel Kayu', 'awal' => 'Baik', 'akhir' => 'Baik', 'cat_in' => 'Pintu geser lancar, kunci cadangan 2 pcs lengkap, rel bersih.', 'cat_out' => 'Kondisi sangat terawat, bersih, kedua kunci asli diserahkan utuh.', 'biaya' => 0],
    ['icon' => 'water_drop', 'nama' => 'Kran Air & Wastafel Kamar Mandi', 'kat' => 'Sanitari', 'awal' => 'Baik', 'akhir' => 'Baik (Wajar)', 'cat_in' => 'Air mengalir kencang, drat kran kencang, pipa rapat tanpa rembes.', 'cat_out' => 'Pemakaian wajar 1 tahun (normal wear & tear), keramik wastafel utuh.', 'biaya' => 0],
    ['icon' => 'grid_view', 'nama' => 'Lantai Keramik Granit 60x60', 'kat' => 'Lantai', 'awal' => 'Baik', 'akhir' => 'Baik', 'cat_in' => 'Nat keramik rapi bersih, tidak ada gompal atau retak.', 'cat_out' => 'Keramik lantai tetap mulus berkilau, bebas retak.', 'biaya' => 0],
];

$rupiah = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');
$temuan = collect($komparasiItems)->where('biaya', '>', 0);
$totalBiaya = $temuan->sum('biaya');
@endphp

<x-glass-alert type="warning" title="Mode pratinjau">
    Hasil inspeksi dan perbandingan pada halaman ini adalah contoh, bukan data yang tersimpan di backend.
</x-glass-alert>

<x-glass-page-header
    eyebrow="Audit Check-in vs Check-out"
    title="Komparasi Kamar 104"
    description="Penghuni: Dinda Kirana • Periode 1 Jun 2024 – 24 Mei 2025 (12 bulan)">
    <x-slot:actions>
        <x-glass-button :href="route('inspeksi.create')" variant="secondary" :block="false">
            Form Inspeksi
        </x-glass-button>

        <x-glass-button :href="route('deposit.perhitungan')" variant="primary" :block="false">
            Hitung Deposit
            <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
        </x-glass-button>
    </x-slot:actions>
</x-glass-page-header>

{{-- Ringkasan --}}
<section aria-label="Ringkasan komparasi" class="grid grid-cols-2 gap-4 lg:grid-cols-3 xl:gap-6">
    <x-glass-stat-card label="Item Diperiksa" :value="count($komparasiItems)" unit="Item" tone="brand" subtitle="Check-in vs check-out" />
    <x-glass-stat-card label="Ada Temuan" :value="$temuan->count()" unit="Item" tone="danger" subtitle="Kondisi menurun" />
    <x-glass-stat-card label="Estimasi Beban" :value="$rupiah($totalBiaya)" tone="warning" subtitle="Diajukan ke deposit" class="col-span-2 lg:col-span-1" />
</section>

{{-- Kartu perbandingan --}}
<ol class="flex flex-col gap-4" aria-label="Perbandingan per item">
    @foreach ($komparasiItems as $i => $item)
    @php $adaTemuan = $item['biaya'] > 0; @endphp
    <li>
        <x-glass-card level="subtle" :class="\Illuminate\Support\Arr::toCssClasses(['space-y-4 p-5 sm:p-6', 'ui-flag ui-tone-danger' => $adaTemuan])">
            <div class="flex flex-wrap items-start justify-between gap-3">
                <div class="min-w-0">
                    <h2 class="text-sm font-semibold">{{ $i + 1 }}. {{ $item['nama'] }}</h2>
                    <p class="ui-caption">{{ $item['kat'] }}</p>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <x-glass-badge :status="$item['akhir']">{{ $item['awal'] }} → {{ $item['akhir'] }}</x-glass-badge>
                    <span @class(['ui-num text-sm font-semibold', 'ui-text-danger' => $adaTemuan, 'ui-text-muted' => ! $adaTemuan])>
                        {{ $adaTemuan ? $rupiah($item['biaya']) : 'Tanpa biaya' }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-3 lg:grid-cols-2">
                <div class="ui-inset space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <span class="ui-eyebrow">Check-in &bull; 1 Jun 2024</span>
                        <x-glass-badge :status="$item['awal']" />
                    </div>
                    <p class="ui-quote">“{{ $item['cat_in'] }}”</p>
                </div>

                <div class="ui-inset space-y-2">
                    <div class="flex items-center justify-between gap-2">
                        <span class="ui-eyebrow">Check-out &bull; 24 Mei 2025</span>
                        <x-glass-badge :status="$item['akhir']" />
                    </div>
                    <p class="ui-body-sm text-content">“{{ $item['cat_out'] }}”</p>
                </div>
            </div>
        </x-glass-card>
    </li>
    @endforeach
</ol>
@endsection
