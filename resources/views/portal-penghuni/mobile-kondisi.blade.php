@extends('layouts.glass-mobile')

@section('title', 'Kondisi Kamar')

@section('content')
@php
$depositAwal = 500000;
$rupiah = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');

$items = [
    ['nama' => 'Remote AC & Filter', 'kat' => 'Elektronik • Unit AC 0.5 PK', 'status' => 'Lecet', 'label' => 'Lecet & Kotor', 'biaya' => 100000,
     'in' => 'Casing mulus utuh, filter dicuci bersih bebas debu.', 'out' => 'Kancing penutup baterai patah, kisi filter berdebu tebal.',
     'catatan' => 'Pembersihan servis filter AC (Rp 60.000) dan penggantian tutup remote compatible (Rp 40.000).'],
    ['nama' => 'Dinding Kamar (Cat)', 'kat' => 'Struktur • Dinding sisi meja belajar', 'status' => 'Rusak', 'label' => 'Noda Lem Busa', 'biaya' => 50000,
     'in' => 'Cat putih merata, bebas paku & noda perekat.', 'out' => '2 titik cat terkelupas akibat bekas foam tape cermin.',
     'catatan' => 'Biaya kompon plamir semen putih & cat spot touch-up 2 titik lem busa.'],
    ['nama' => 'Kasur Springbed & Dipan', 'kat' => 'Furnitur utama • Single 120x200', 'status' => 'Baik', 'label' => 'Lecet Wajar', 'biaya' => 0,
     'in' => 'Kondisi pegas padat, kain bersih.', 'out' => 'Penurunan kelenturan wajar 1 tahun.',
     'catatan' => null, 'wajar' => true],
    ['nama' => 'Lemari 2 Pintu & Wastafel', 'kat' => 'Furnitur & sanitasi', 'status' => 'Baik', 'label' => 'Kondisi Prima', 'biaya' => 0,
     'in' => null, 'out' => 'Engsel lemari mulus, kran lancar, wastafel tanpa retak, kunci lemari lengkap.',
     'catatan' => null],
];
$lainnya = ['Jendela', 'Saklar Lampu', 'Meja Kerja', 'Exhaust Fan'];

$adaCatatan = collect($items)->where('biaya', '>', 0);
$totalKlaim = $adaCatatan->sum('biaya');
$totalItem = count($items) + count($lainnya);
@endphp

<x-glass-page-header
    eyebrow="Audit Check-in vs Check-out"
    title="Kondisi Kamar 104"
    description="Tinjau setiap temuan pengelola sebelum menyetujui pengembalian deposit." />

{{-- Ringkasan --}}
<x-glass-card level="subtle" class="flex items-center justify-between gap-3 p-5">
    <div>
        <p class="text-sm font-semibold">{{ $totalItem }} item diperiksa</p>
        <p class="ui-caption">{{ $adaCatatan->count() }} item menurun kualitasnya</p>
    </div>
    <div class="text-right">
        <p class="ui-caption">Klaim pengelola</p>
        <p class="ui-num ui-text-danger font-bold">{{ $rupiah($totalKlaim) }}</p>
    </div>
</x-glass-card>

{{-- Filter --}}
<div class="ui-filter-group" role="group" aria-label="Filter temuan" data-feed-filters>
    <button type="button" class="ui-chip" data-feed-filter="all" aria-pressed="true">Semua ({{ count($items) + 1 }})</button>
    <button type="button" class="ui-chip" data-feed-filter="catatan" aria-pressed="false">Ada catatan ({{ $adaCatatan->count() }})</button>
    <button type="button" class="ui-chip" data-feed-filter="baik" aria-pressed="false">Sesuai ({{ count($items) - $adaCatatan->count() + 1 }})</button>
</div>

{{-- Feed --}}
<ul class="flex flex-col gap-4" data-feed>
    @foreach ($items as $item)
    @php $temuan = $item['biaya'] > 0; @endphp
    <li data-feed-item="{{ $temuan ? 'catatan' : 'baik' }}">
        <x-glass-card level="subtle" :class="\Illuminate\Support\Arr::toCssClasses(['space-y-3 p-4', 'ui-flag ui-tone-danger' => $temuan])">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0 space-y-1">
                    <h2 class="text-sm font-semibold">{{ $item['nama'] }}</h2>
                    <p class="ui-caption">{{ $item['kat'] }}</p>
                    <x-glass-badge :status="$item['status']">{{ $item['label'] }}</x-glass-badge>
                </div>
                <div class="shrink-0 text-right">
                    <p class="ui-caption">{{ $temuan ? 'Potongan diajukan' : 'Biaya' }}</p>
                    <p @class(['ui-num font-bold', 'ui-text-danger' => $temuan, 'ui-text-success' => ! $temuan])>{{ $rupiah($item['biaya']) }}</p>
                </div>
            </div>

            @if ($item['in'])
            <div class="grid grid-cols-2 gap-2">
                @foreach ([['Check-in', $item['in'], 'neutral'], ['Check-out', $item['out'], $temuan ? 'danger' : 'neutral']] as [$fase, $teks, $tone])
                <div class="space-y-1.5">
                    <div class="ui-photo">
                        <span class="material-symbols-outlined" aria-hidden="true">image</span>
                        <x-glass-badge :tone="$tone" class="ui-photo-tag">{{ $fase }}</x-glass-badge>
                    </div>
                    <p class="ui-caption leading-snug">{{ $teks }}</p>
                </div>
                @endforeach
            </div>
            @else
            <p class="ui-inset ui-body-sm">{{ $item['out'] }}</p>
            @endif

            @if ($item['catatan'])
            <div class="ui-inset space-y-1">
                <p class="ui-label">
                    Catatan auditor
                </p>
                <p class="ui-quote">“{{ $item['catatan'] }}”</p>
            </div>
            @endif

            @if (! empty($item['wajar']))
            <div class="ui-callout ui-tone-success">
                <span class="material-symbols-outlined" aria-hidden="true">verified</span>
                <p>Termasuk <strong>keausan wajar</strong>. Sesuai kontrak, Anda tidak dikenakan biaya.</p>
            </div>
            @endif

            @if ($temuan)
            <div class="flex justify-end">
                <x-glass-button
                    type="button"
                    variant="secondary"
                    size="sm"
                    :block="false"
                    data-modal-open="modal-sanggahan"
                    data-dispute-item="{{ $item['nama'] }}"
                    data-dispute-amount="{{ $rupiah($item['biaya']) }}">
                    Beri Tanggapan
                </x-glass-button>
            </div>
            @endif
        </x-glass-card>
    </li>
    @endforeach

    <li data-feed-item="baik">
        <x-glass-card level="subtle" class="p-4">
            <div class="min-w-0">
                <p class="text-sm font-semibold">{{ count($lainnya) }} item lainnya lolos audit</p>
                <p class="ui-caption">{{ implode(', ', $lainnya) }}</p>
            </div>
        </x-glass-card>
    </li>
</ul>

{{-- Edukasi --}}
<div class="ui-callout ui-tone-info">
    <span class="material-symbols-outlined" aria-hidden="true">info</span>
    <p>Kerusakan wajar akibat usia pemakaian (<em>fair wear and tear</em>) seperti pemudaran warna, karet seal mengeras, atau engsel kendur alami <strong>tidak boleh dipotong</strong> dari deposit Anda.</p>
</div>

{{-- Aksi --}}
<x-glass-card level="subtle" class="ui-action-bar">
    <div>
        <p class="ui-caption">Sisa deposit dikembalikan</p>
        <p class="ui-num font-bold">{{ $rupiah($depositAwal - $totalKlaim) }} <span class="ui-caption font-normal">/ {{ $rupiah($depositAwal) }}</span></p>
    </div>
    <div class="grid w-full grid-cols-2 gap-2">
        <x-glass-button
            type="button"
            variant="secondary"
            data-modal-open="modal-sanggahan"
            data-dispute-item="Sanggahan umum"
            data-dispute-amount="{{ $rupiah($totalKlaim) }}">
            Kirim Sanggahan
        </x-glass-button>
        <x-glass-button :href="route('mobile.deposit')" variant="primary">
            Rincian Deposit
            <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span>
        </x-glass-button>
    </div>
</x-glass-card>

{{-- Modal sanggahan --}}
<x-glass-modal id="modal-sanggahan" title="Sanggahan Bukti">
    <div class="ui-modal-form">
        <dl class="ui-dl ui-inset">
            <div><dt>Item</dt><dd data-dispute-item-label>—</dd></div>
            <div><dt>Nominal disanggah</dt><dd class="ui-num ui-text-danger" data-dispute-amount-label>—</dd></div>
        </dl>

        <label class="ui-btn ui-btn-secondary ui-upload">
            <span class="ui-upload-name" data-upload-name="Unggah foto / video tandingan">Unggah foto / video tandingan</span>
            <input type="file" accept="image/*,video/*" multiple aria-label="Unggah foto atau video tandingan">
        </label>

        <x-glass-textarea
            id="dispute-reason"
            label="Alasan & kronologi"
            hint="Sertakan tanggal kejadian agar mudah diverifikasi."
            placeholder="Contoh: tutup remote sudah longgar sejak bulan kedua dan sudah dilaporkan via WA pada 4 Maret..." />

        <div class="ui-modal-footer">
            <x-glass-button type="button" variant="secondary" :block="false" data-modal-close>Batal</x-glass-button>
            <x-glass-button type="button" variant="primary" :block="false" data-dispute-submit>
                <span class="material-symbols-outlined" aria-hidden="true">send</span>
                Ajukan
            </x-glass-button>
        </div>
    </div>
</x-glass-modal>
@endsection

@push('scripts')
<script>
    (() => {
        // Filter feed temuan
        const chips = Array.from(document.querySelectorAll("[data-feed-filter]"));
        const feedItems = Array.from(document.querySelectorAll("[data-feed-item]"));

        chips.forEach((chip) => {
            chip.addEventListener("click", () => {
                const filter = chip.dataset.feedFilter;
                chips.forEach((c) => c.setAttribute("aria-pressed", String(c === chip)));
                feedItems.forEach((item) => {
                    item.hidden = filter !== "all" && item.dataset.feedItem !== filter;
                });
            });
        });

        // Isi modal sesuai item yang ditanggapi
        const itemLabel = document.querySelector("[data-dispute-item-label]");
        const amountLabel = document.querySelector("[data-dispute-amount-label]");
        const reason = document.getElementById("dispute-reason");

        document.addEventListener("click", (event) => {
            const opener = event.target.closest("[data-dispute-item]");

            if (opener) {
                itemLabel.textContent = opener.dataset.disputeItem;
                amountLabel.textContent = opener.dataset.disputeAmount;
            }

            if (event.target.closest("[data-dispute-submit]")) {
                if (!reason.value.trim()) {
                    reason.setAttribute("aria-invalid", "true");
                    reason.classList.add("ui-glass-input-error");
                    reason.focus();
                    return;
                }

                reason.removeAttribute("aria-invalid");
                reason.classList.remove("ui-glass-input-error");
                reason.closest("dialog").close();
                window.KosAudit?.toast("Sanggahan belum terkirim: backend sanggahan belum tersedia.", {
                    tone: "warning",
                    title: "Mode pratinjau",
                });
            }
        });
    })();
</script>
@endpush
