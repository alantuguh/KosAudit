@extends('layouts.glass')

@section('title', 'Form Inspeksi')

@section('content')
@php
$nomorKamar = request('kamar', '104');

// Contoh daftar periksa (backend inspeksi belum tersedia).
$inventarisItems = [
    ['kode' => 'INV-01', 'icon' => 'bed', 'nama' => 'Kasur & Sprei Springbed 120x200', 'desc' => 'Kasur busa rebonded + sprei pelindung tahan air standar kos.', 'kondisi' => 'Lecet', 'catatan' => 'Terdapat noda teh ringan di sisi tengah kasur, butuh laundry deep-clean.'],
    ['kode' => 'INV-02', 'icon' => 'door_sliding', 'nama' => 'Lemari Pakaian 2 Pintu Kayu Minimalis', 'desc' => 'Lemari kayu MDF laminasi putih, 1 cermin pintu kiri, 2 laci bawah.', 'kondisi' => 'Baik', 'catatan' => 'Engsel laci mulus, kunci lemari 1 pcs terpasang, cermin bersih utuh.'],
    ['kode' => 'INV-03', 'icon' => 'mode_fan', 'nama' => 'Unit AC Split 1/2 PK & Remote Original', 'desc' => 'Unit indoor terpasang dinding, braket remote, dan unit outdoor ventilasi balkon.', 'kondisi' => 'Rusak', 'catatan' => 'Remote asli hilang saat checkout & filter AC penuh debu tebal, butuh servis cuci AC.'],
    ['kode' => 'INV-04', 'icon' => 'lightbulb', 'nama' => 'Lampu Kamar & Kamar Mandi', 'desc' => '1 unit downlight 12W warm white kamar tidur & 1 unit 9W kamar mandi.', 'kondisi' => 'Baik', 'catatan' => 'Semua bohlam menyala normal, saklar responsif tanpa kendala.'],
    ['kode' => 'INV-05', 'icon' => 'water_drop', 'nama' => 'Kran Wastafel & Saluran Pembuangan', 'desc' => 'Kran stainless steel tipe putar, mangkuk wastafel keramik, dan sifon.', 'kondisi' => 'Lecet', 'catatan' => 'Kran sedikit longgar pada drat bawah, air mengalir deras dan tidak rembes.'],
    ['kode' => 'INV-06', 'icon' => 'key', 'nama' => 'Kunci Pintu Utama & Duplikat Cadangan', 'desc' => 'Handle gagang pintu solid stainless, silinder kunci komputer, dan grendel.', 'kondisi' => 'Baik', 'catatan' => 'Kunci lengkap 2 pcs (1 asli + 1 duplikat) diserahkan utuh, grendel normal.'],
    ['kode' => 'INV-07', 'icon' => 'format_paint', 'nama' => 'Dinding Kamar & Cat Tembok', 'desc' => 'Permukaan plesteran cat interior warna broken white, bebas paku permanen.', 'kondisi' => 'Rusak', 'catatan' => 'Bekas stiker double tape terkelupas 4 titik hingga lapisan semen terlihat.'],
    ['kode' => 'INV-08', 'icon' => 'grid_view', 'nama' => 'Lantai Keramik Granit 60x60', 'desc' => 'Lantai kamar tidur dan plint dinding keliling granit motif marmer cream.', 'kondisi' => 'Baik', 'catatan' => 'Bersih tidak ada retak, nat antar ubin terawat rapi tanpa goresan.'],
];

$kondisiOptions = ['Baik' => 'Baik', 'Lecet' => 'Lecet', 'Rusak' => 'Rusak', 'Tidak Ada' => 'Tidak Ada'];
$kondisiTones = ['Baik' => 'success', 'Lecet' => 'warning', 'Rusak' => 'danger', 'Tidak Ada' => 'neutral'];
@endphp

<x-glass-alert type="warning" title="Mode pratinjau">
    Backend belum menyediakan penyimpanan inspeksi. Formulir dapat diisi untuk simulasi, tetapi datanya tidak disimpan.
</x-glass-alert>

<form method="POST" action="{{ route('inspeksi.store') }}" enctype="multipart/form-data" class="flex flex-col gap-6" data-inspection-form data-submit-once>
    @csrf

    <x-glass-page-header
        :title="'Inspeksi Kamar ' . $nomorKamar"
        description="Nilai kondisi setiap item, tambahkan catatan, dan unggah foto bukti bila ada temuan.">
        <x-slot:breadcrumb>
            <a href="{{ route('kamar.show', $nomorKamar) }}">Kamar {{ $nomorKamar }}</a>
            <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
            <span aria-current="page">Form Inspeksi</span>
        </x-slot:breadcrumb>

        <x-slot:actions>
            <x-glass-segmented
                name="jenis"
                label="Jenis inspeksi"
                :hide-label="true"
                value="checkout"
                :options="['checkin' => 'Check-in', 'checkout' => 'Check-out']" />
        </x-slot:actions>
    </x-glass-page-header>

    {{-- Daftar periksa --}}
    <ol class="flex flex-col gap-4" aria-label="Daftar periksa item">
        @foreach ($inventarisItems as $item)
        <li>
            <x-glass-card level="subtle" class="space-y-4 p-5 sm:p-6" data-inspection-item>
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="min-w-0 space-y-1">
                        <div class="flex flex-wrap items-center gap-2">
                            <x-glass-badge tone="neutral">{{ $item['kode'] }}</x-glass-badge>
                            <h2 class="text-sm font-semibold">{{ $item['nama'] }}</h2>
                        </div>
                        <p class="ui-body-sm">{{ $item['desc'] }}</p>
                    </div>

                    <x-glass-segmented
                        :name="'kondisi[' . $item['kode'] . ']'"
                        :label="'Kondisi ' . $item['nama']"
                        :hide-label="true"
                        :value="$item['kondisi']"
                        :options="$kondisiOptions"
                        :tones="$kondisiTones"
                        class="shrink-0" />
                </div>

                <div class="ui-inset flex flex-col gap-3 md:flex-row md:items-center">
                    <div class="flex-1">
                        <x-glass-input
                            :id="'catatan-' . $item['kode']"
                            :name="'catatan[' . $item['kode'] . ']'"
                            :value="$item['catatan']"
                            :aria-label="'Catatan ' . $item['nama']"
                            placeholder="Rincian kondisi atau catatan kerusakan..." />
                    </div>

                    <label class="ui-btn ui-btn-secondary ui-upload shrink-0">
                        <span class="ui-upload-name" data-upload-name="Unggah Foto">Unggah Foto</span>
                        <input type="file" name="foto[{{ $item['kode'] }}]" accept="image/*" aria-label="Foto bukti {{ $item['nama'] }}">
                    </label>
                </div>
            </x-glass-card>
        </li>
        @endforeach
    </ol>

    {{-- Ringkasan & submit --}}
    <x-glass-card level="subtle" class="ui-action-bar">
        <div class="space-y-1">
            <p class="text-sm font-semibold" data-inspection-progress aria-live="polite">
                {{ count($inventarisItems) }} dari {{ count($inventarisItems) }} item dinilai
            </p>
            <div class="flex flex-wrap gap-2" data-inspection-summary>
                @foreach ($kondisiTones as $label => $tone)
                <x-glass-badge :tone="$tone" data-count-for="{{ $label }}">{{ $label }}: 0</x-glass-badge>
                @endforeach
            </div>
        </div>

        <x-glass-button type="submit" variant="primary" :block="false">
            Selesaikan Inspeksi
            <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
        </x-glass-button>
    </x-glass-card>
</form>
@endsection

@push('scripts')
<script>
    (() => {
        const form = document.querySelector("[data-inspection-form]");

        if (!form) {
            return;
        }

        const items = Array.from(form.querySelectorAll("[data-inspection-item]"));
        const progress = form.querySelector("[data-inspection-progress]");
        const badges = Array.from(form.querySelectorAll("[data-count-for]"));

        function refresh() {
            const counts = {};
            let rated = 0;

            items.forEach((item) => {
                const checked = item.querySelector('input[name^="kondisi"]:checked');
                const value = checked ? checked.value : null;

                // Tandai kartu dengan temuan kerusakan.
                item.classList.toggle("ui-flag", value === "Rusak" || value === "Lecet");
                item.classList.toggle("ui-tone-danger", value === "Rusak");
                item.classList.toggle("ui-tone-warning", value === "Lecet");

                if (value) {
                    rated += 1;
                    counts[value] = (counts[value] || 0) + 1;
                }
            });

            progress.textContent = `${rated} dari ${items.length} item dinilai`;

            badges.forEach((badge) => {
                const label = badge.dataset.countFor;
                badge.textContent = `${label}: ${counts[label] || 0}`;
            });
        }

        form.addEventListener("change", (event) => {
            if (event.target.matches('input[name^="kondisi"]')) {
                refresh();
            }
        });

        refresh();
    })();
</script>
@endpush
