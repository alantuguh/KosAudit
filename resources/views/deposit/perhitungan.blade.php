@extends('layouts.glass')

@section('title', 'Perhitungan Deposit')

@section('content')
@php
// Contoh data (backend perhitungan deposit belum tersedia). Biaya dalam rupiah.
$depositAwal = 500000;

$potonganList = [
    ['komponen' => 'Penggantian Remote AC & Cuci', 'tag' => 'Barang Hilang & Berdebu', 'kat' => 'Elektronik • Unit AC Split', 'desc' => 'Remote tidak ditemukan saat checkout final. Filter pendingin penuh endapan tebal.', 'biaya' => 150000, 'ket' => 'Sesuai SOP vendor'],
    ['komponen' => 'Pengecatan Spot Dinding', 'tag' => 'Lecet Cat Finishing', 'kat' => 'Struktur Dinding Kamar', 'desc' => '4 titik plester cat terkelupas sampai dempul akibat lem double-tape foam pigura.', 'biaya' => 100000, 'ket' => 'Cat & upah tukang'],
    ['komponen' => 'Deep Clean Noda Kasur', 'tag' => 'Noda Minuman Permanen', 'kat' => 'Furnitur • Springbed Single', 'desc' => 'Noda tumpahan kopi/teh pada sudut kiri matras seluas 15 cm. Memerlukan cuci vacuum.', 'biaya' => 50000, 'ket' => 'Jasa laundry kasur'],
    ['komponen' => 'Duplikat Kunci & Silinder Pintu', 'tag' => '1 Kunci Tidak Kembali', 'kat' => 'Akses Pintu • Silinder Utama', 'desc' => 'Anak kunci cadangan duplikat hilang saat pengembalian kunci kamar 104.', 'biaya' => 35000, 'ket' => 'Biaya duplikat'],
    ['komponen' => 'Perbaikan Drat Kran Wastafel', 'tag' => 'Drat Kendur & Seal', 'kat' => 'Sanitari • Wastafel KM Dalam', 'desc' => 'Pemasangan kembali seal karet dan pengencangan baut drat bawah wastafel.', 'biaya' => 45000, 'ket' => 'Jasa tukang'],
    ['komponen' => 'Pembersihan Sisa Stiker Kaca', 'tag' => 'Residu Perekat', 'kat' => 'Interior • Kaca Jendela', 'desc' => 'Pembersihan bekas stiker film kaca ventilasi dengan cairan scraper khusus.', 'biaya' => 20000, 'ket' => 'Bahan pembersih'],
];

$rupiah = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');
$totalPotongan = array_sum(array_column($potonganList, 'biaya'));
$dikembalikan = max(0, $depositAwal - $totalPotongan);
@endphp

<x-glass-alert type="warning" title="Mode pratinjau">
    Backend belum menyediakan perhitungan maupun penyimpanan pengembalian deposit. Perubahan di halaman ini hanya simulasi.
</x-glass-alert>

<x-glass-page-header
    eyebrow="Pengembalian Deposit"
    title="Perhitungan Deposit Kamar 104"
    description="Penyewa: Dinda Kirana • Rekening tujuan: BCA •••• 6789" />

<div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-3" data-deposit-calculator data-deposit-awal="{{ $depositAwal }}">

    {{-- Daftar potongan --}}
    <div class="min-w-0 xl:col-span-2">
        <x-glass-table
            id="deposit-table"
            title="Daftar Potongan"
            description="Dari item yang rusak atau menurun kondisinya. Batalkan potongan yang tidak layak."
            :stack="true"
            :per-page="10"
            :per-page-options="[10, 25]"
            search-placeholder="Cari potongan..."
            info-label="potongan">
            <x-slot:head>
                <tr>
                    <th scope="col">Komponen</th>
                    <th scope="col">Temuan</th>
                    <th scope="col" class="ui-cell-num">Biaya</th>
                    <th scope="col" class="ui-cell-end"><span class="sr-only">Kenakan</span></th>
                </tr>
            </x-slot:head>

            @foreach ($potonganList as $p)
            <tr data-deposit-row data-amount="{{ $p['biaya'] }}">
                <td>
                    <p class="font-semibold leading-tight">{{ $p['komponen'] }}</p>
                    <p class="ui-caption">{{ $p['kat'] }}</p>
                </td>
                <td data-label="Temuan" class="max-w-xs">
                    <p class="ui-body-sm">{{ $p['desc'] }}</p>
                </td>
                <td data-label="Biaya" class="ui-cell-num">
                    <div>
                        <span class="ui-text-danger font-semibold" data-deposit-amount>{{ $rupiah($p['biaya']) }}</span>
                        <span class="ui-caption block">{{ $p['ket'] }}</span>
                    </div>
                </td>
                <td class="ui-cell-end">
                    <button
                        type="button"
                        class="ui-icon-btn"
                        aria-pressed="true"
                        data-deposit-toggle
                        aria-label="Batalkan potongan {{ $p['komponen'] }}"
                        title="Batalkan potongan">
                        <span class="material-symbols-outlined" aria-hidden="true">remove_circle</span>
                    </button>
                </td>
            </tr>
            @endforeach
        </x-glass-table>
    </div>

    {{-- Ringkasan --}}
    <div class="ui-sticky">
        <x-glass-card level="subtle" class="space-y-5 p-6">
            <div class="flex items-center justify-between gap-3">
                <h2 class="ui-heading-md">Ringkasan</h2>
                <x-glass-badge tone="danger" data-deposit-count>{{ count($potonganList) }} potongan</x-glass-badge>
            </div>

            <dl class="ui-dl">
                <div>
                    <dt>Deposit awal diterima</dt>
                    <dd class="ui-num">{{ $rupiah($depositAwal) }}</dd>
                </div>
                <div>
                    <dt>Total potongan</dt>
                    <dd class="ui-num ui-text-danger" data-deposit-total>&minus; {{ $rupiah($totalPotongan) }}</dd>
                </div>
            </dl>

            <div class="ui-highlight space-y-1">
                <p class="ui-eyebrow">Deposit Dikembalikan</p>
                <p class="ui-amount" data-deposit-net aria-live="polite">{{ $rupiah($dikembalikan) }}</p>
                <p class="ui-caption">Ditransfer setelah penghuni menyetujui rincian melalui portal penghuni.</p>
            </div>

            <x-glass-button
                type="button"
                variant="primary"
                data-preview-action="Rincian belum dikirim: backend pengiriman ke penghuni belum tersedia.">
                <span class="material-symbols-outlined" aria-hidden="true">send</span>
                Kirim Rincian ke Penghuni
            </x-glass-button>
        </x-glass-card>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        const root = document.querySelector("[data-deposit-calculator]");

        if (!root) {
            return;
        }

        const awal = Number(root.dataset.depositAwal) || 0;
        const rows = Array.from(root.querySelectorAll("[data-deposit-row]"));
        const totalEl = root.querySelector("[data-deposit-total]");
        const netEl = root.querySelector("[data-deposit-net]");
        const countEl = root.querySelector("[data-deposit-count]");
        const rupiah = (n) => "Rp " + n.toLocaleString("id-ID");

        function recalc() {
            const active = rows.filter((row) => !row.hasAttribute("data-excluded"));
            const total = active.reduce((sum, row) => sum + Number(row.dataset.amount), 0);

            totalEl.textContent = "− " + rupiah(total);
            netEl.textContent = rupiah(Math.max(0, awal - total));
            countEl.textContent = active.length + " potongan";
        }

        // Batalkan / kenakan kembali potongan (simulasi, dapat dibatalkan).
        root.addEventListener("click", (event) => {
            const toggle = event.target.closest("[data-deposit-toggle]");

            if (!toggle) {
                return;
            }

            const row = toggle.closest("[data-deposit-row]");
            const excluded = row.toggleAttribute("data-excluded");
            const name = row.querySelector("p").textContent.trim();

            toggle.setAttribute("aria-pressed", String(!excluded));
            toggle.setAttribute("aria-label", (excluded ? "Kenakan kembali potongan " : "Batalkan potongan ") + name);
            toggle.title = excluded ? "Kenakan kembali" : "Batalkan potongan";
            toggle.querySelector(".material-symbols-outlined").textContent = excluded ? "add_circle" : "remove_circle";

            recalc();
        });
    })();
</script>
@endpush
