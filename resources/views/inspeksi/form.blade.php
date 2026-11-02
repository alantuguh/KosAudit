@extends('layouts.app')

@section('title', 'Form Inspeksi Kamar')

@section('content')
<div class="mb-space-md rounded-xl border border-secondary/20 bg-secondary-fixed/50 p-space-md text-secondary font-label-md">
    Preview: backend belum menyediakan penyimpanan inspeksi. Data formulir tidak akan disimpan.
</div>
@php
$inventarisItems = [
    ['kode'=>'INV-01','icon'=>'bed','nama'=>'Kasur & Sprei Springbed 120x200','desc'=>'Kasur busa rebonded + sprei pelindung tahan air standard kos.','kondisi'=>'Lecet','catatan'=>'Terdapat noda teh ringan di sisi tengah kasur, butuh laundry deep-clean.'],
    ['kode'=>'INV-02','icon'=>'door_sliding','nama'=>'Lemari Pakaian 2 Pintu Kayu Minimalis','desc'=>'Lemari kayu MDF laminasi putih, 1 cermin pintu kiri, 2 laci bawah.','kondisi'=>'Baik','catatan'=>'Engsel laci mulus, kunci lemari 1 pcs terpasang, cermin bersih utuh.'],
    ['kode'=>'INV-03','icon'=>'mode_fan','nama'=>'Unit AC Split 1/2 PK Daikin & Remote Original','desc'=>'Unit indoor terpasang dinding, braket remote, dan unit outdoor ventilasi balkon.','kondisi'=>'Rusak','catatan'=>'Remote asli hilang saat checkout & filter AC penuh debu tebal, butuh servis cuci AC.'],
    ['kode'=>'INV-04','icon'=>'lightbulb','nama'=>'Lampu Kamar & Kamar Mandi (LED Philips)','desc'=>'1 unit downlight 12W warm white kamar tidur & 1 unit 9W kamar mandi.','kondisi'=>'Baik','catatan'=>'Semua bohlam menyala normal, saklar Panasonic responsif tanpa kendala.'],
    ['kode'=>'INV-05','icon'=>'water_drop','nama'=>'Kran Wastafel & Saluran Pembuangan Toto','desc'=>'Kran stainless steel tipe putar, mangkuk wastafel keramik, dan sifon.','kondisi'=>'Lecet','catatan'=>'Kran sedikit longgar pada drat bawah, air mengalir deras dan tidak rembes.'],
    ['kode'=>'INV-06','icon'=>'key','nama'=>'Kunci Pintu Utama & Duplikat Cadangan','desc'=>'Handle gagang pintu solid stainless, silinder kunci komputer, dan grendel.','kondisi'=>'Baik','catatan'=>'Kunci lengkap 2 pcs (1 asli + 1 duplikat) diserahkan utuh, grendel normal.'],
    ['kode'=>'INV-07','icon'=>'format_paint','nama'=>'Dinding Kamar & Cat Tembok Dulux','desc'=>'Permukaan plesteran cat interior warna broken white, bebas paku permanen.','kondisi'=>'Rusak','catatan'=>'Bekas stiker double tape terkelupas 4 titik hingga lapisan semen terlihat.'],
    ['kode'=>'INV-08','icon'=>'grid_view','nama'=>'Lantai Keramik Granit Homogenous 60x60','desc'=>'Lantai kamar tidur dan plint dinding keliling granit motif marmer cream.','kondisi'=>'Baik','catatan'=>'Bersih tidak ada retak, nat antar ubin terawat rapi tanpa goresan.'],
];
@endphp

<form method="POST" action="{{ route('inspeksi.store') }}" enctype="multipart/form-data" class="flex flex-col w-full pb-28 space-y-space-lg">
    @csrf
    {{-- Header & Stepper --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
        <div>
            <div class="flex items-center gap-2 text-outline font-label-md">
                <span>Inspeksi</span>
                <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                <span class="text-on-surface font-semibold">Form Inspeksi Kamar</span>
            </div>
            <div class="flex items-center gap-space-md mt-1">
                <h1 class="font-headline-lg text-headline-lg text-on-surface">Audit Fisik &amp; Kelayakan Kamar {{ request('kamar', '104') }}</h1>
                <x-badge status="Proses Check-out">Inspeksi Berlangsung</x-badge>
            </div>
        </div>
        <div class="inline-flex p-1 bg-surface-container rounded-xl">
            <button type="button" class="px-4 py-2 rounded-lg font-label-md text-outline hover:text-on-surface flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">login</span> Check-in Awal
            </button>
            <button type="button" class="px-4 py-2 rounded-lg font-label-md bg-surface-container-lowest text-primary font-bold shadow-sm flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[18px]">logout</span> Check-out Akhir (Aktif)
            </button>
        </div>
    </div>

    {{-- Checklist 8 Item Inventaris --}}
    <div class="space-y-space-md">
        @foreach ($inventarisItems as $idx => $item)
        <div class="bg-surface-container-lowest rounded-xl p-space-lg shadow-sm space-y-space-md">
            <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-space-md">
                <div class="flex items-start gap-space-md">
                    <div class="w-10 h-10 rounded-lg bg-surface-container flex items-center justify-center text-primary shrink-0">
                        <span class="material-symbols-outlined text-[20px]">{{ $item['icon'] }}</span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="font-label-sm px-2 py-0.5 rounded bg-surface-container text-outline">{{ $item['kode'] }}</span>
                            <h4 class="font-label-lg text-on-surface font-semibold">{{ $item['nama'] }}</h4>
                        </div>
                        <p class="font-body-sm text-outline mt-0.5">{{ $item['desc'] }}</p>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    @foreach (['Baik', 'Lecet', 'Rusak', 'Tidak Ada'] as $opsi)
                    <label class="cursor-pointer">
                        <input type="radio" name="kondisi[{{ $item['kode'] }}]" value="{{ $opsi }}" class="peer sr-only" {{ $item['kondisi'] === $opsi ? 'checked' : '' }}/>
                        <span class="px-3.5 py-1.5 rounded-lg font-label-md bg-surface-container-low text-outline peer-checked:bg-primary-container peer-checked:text-on-primary peer-checked:font-bold transition-all inline-block">
                            {{ $opsi }}
                        </span>
                    </label>
                    @endforeach
                </div>
            </div>
            <div class="bg-surface-container-low/60 rounded-xl p-space-md flex flex-col md:flex-row items-stretch md:items-center gap-space-md">
                <input type="text" name="catatan[{{ $item['kode'] }}]" value="{{ $item['catatan'] }}"
                       class="flex-1 h-10 px-3 rounded-lg bg-surface-container-lowest text-body-sm focus:outline-none focus:ring-1 focus:ring-primary"
                       placeholder="Tambahkan rincian kondisi atau catatan kerusakan..."/>
                <label class="h-10 px-3 rounded-lg bg-surface-container-lowest text-primary hover:bg-surface-container font-label-sm flex items-center gap-1.5 shadow-sm cursor-pointer shrink-0">
                    <span class="material-symbols-outlined text-[18px]">add_a_photo</span>
                    <span>Unggah Foto Bukti</span>
                    <input type="file" name="foto[{{ $item['kode'] }}]" accept="image/*" class="hidden"/>
                </label>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Sticky Bottom Submit Bar --}}
    <div class="fixed bottom-0 left-72 right-0 p-space-md bg-surface-container-lowest/95 backdrop-blur-md shadow-[0_-4px_20px_rgba(0,0,0,0.06)] z-30 flex items-center justify-between">
        <span class="font-label-md text-on-surface font-semibold">Status: 8 dari 8 item telah dinilai (4 Baik • 2 Lecet • 2 Rusak)</span>
        <div class="flex items-center gap-space-sm">
            <button type="submit" class="h-11 px-space-lg rounded-xl bg-primary-container text-on-primary font-label-lg hover:bg-primary shadow-sm flex items-center gap-2">
                <span>Selesaikan Inspeksi &amp; Lihat Komparasi</span>
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </button>
        </div>
    </div>
</form>
@endsection