@extends('layouts.glass')

@section('title', 'Portal Penghuni')

@section('content')
@php
// Contoh data (backend tenant baru menyediakan profil akun). Banner pratinjau tampil dari layout.
$depositAwal = 500000;
$potongan = [
    ['icon' => 'mode_fan', 'nama' => 'Ganti unit remote AC', 'biaya' => 100000],
    ['icon' => 'format_paint', 'nama' => 'Cat & dempul dinding', 'biaya' => 50000],
    ['icon' => 'bed', 'nama' => 'Noda kasur (digratiskan pemilik)', 'biaya' => 0],
];
$temuan = [
    ['icon' => 'mode_fan', 'nama' => 'AC & Remote', 'desc' => 'Tutup baterai pecah & remote tidak menyala', 'status' => 'Rusak'],
    ['icon' => 'format_paint', 'nama' => 'Dinding Kamar', 'desc' => 'Bekas double tape & cat terkelupas 2 titik', 'status' => 'Rusak'],
    ['icon' => 'bed', 'nama' => 'Kasur & Sprei', 'desc' => 'Noda kopi ringan di tepi cover pelindung', 'status' => 'Lecet Ringan'],
    ['icon' => 'check', 'nama' => 'Lemari, Kran, Meja & 2 item lain', 'desc' => 'Berfungsi normal & bersih', 'status' => 'Baik'],
];
$foto = ['Remote AC', 'Dinding', 'Lemari'];

$rupiah = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');
$totalPotongan = array_sum(array_column($potongan, 'biaya'));
$dikembalikan = $depositAwal - $totalPotongan;
$namaDepan = \Illuminate\Support\Str::of(auth()->user()->name)->before(' ');
@endphp

<x-glass-page-header
    eyebrow="Audit Check-out • Perlu Review"
    :title="'Halo, ' . $namaDepan"
    description="Proses check-out kamar Anda sedang berjalan. Periksa hasil inspeksi dan rincian pengembalian deposit di bawah ini." />

<div class="grid grid-cols-1 items-start gap-6 xl:grid-cols-3">

    <div class="flex flex-col gap-6 min-w-0 xl:col-span-2">

        {{-- Informasi sewa --}}
        <x-glass-card level="subtle" class="space-y-4 p-6">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <h2 class="ui-heading-md">Informasi Sewa</h2>
                </div>
                <x-glass-badge status="Check-out" />
            </div>

            <dl class="ui-dl">
                <div><dt>Kamar</dt><dd>Kamar 104 &bull; Lantai 1 &bull; AC Standar</dd></div>
                <div><dt>Durasi sewa</dt><dd>12 bulan (selesai)</dd></div>
                <div><dt>Tanggal masuk</dt><dd class="ui-num">1 Juni 2024</dd></div>
                <div><dt>Tanggal keluar</dt><dd class="ui-num">24 Mei 2025</dd></div>
                <div><dt>Pembayaran</dt><dd><x-glass-badge status="Lunas" /></dd></div>
            </dl>
        </x-glass-card>

        {{-- Hasil inspeksi --}}
        <x-glass-card level="subtle" class="space-y-4 p-6">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <h2 class="ui-heading-md">Hasil Inspeksi</h2>
                </div>
                <x-glass-button :href="route('mobile.kondisi')" variant="secondary" size="sm" :block="false">
                    Lihat komparasi foto
                </x-glass-button>
            </div>

            <ul class="grid grid-cols-3 gap-3" aria-label="Foto bukti inspeksi">
                @foreach ($foto as $label)
                <li class="ui-photo">
                    <span class="material-symbols-outlined" aria-hidden="true">image</span>
                    <x-glass-badge tone="neutral" class="ui-photo-tag">{{ $label }}</x-glass-badge>
                </li>
                @endforeach
            </ul>

            <ul class="flex flex-col gap-2">
                @foreach ($temuan as $t)
                <li class="ui-inset flex items-start justify-between gap-3">
                    <div class="flex items-start gap-3">
                        <div>
                            <p class="text-sm font-semibold">{{ $t['nama'] }}</p>
                            <p class="ui-caption">{{ $t['desc'] }}</p>
                        </div>
                    </div>
                    <x-glass-badge :status="$t['status']" class="shrink-0" />
                </li>
                @endforeach
            </ul>
        </x-glass-card>
    </div>

    <div class="flex flex-col gap-6 ui-sticky">

        {{-- Deposit --}}
        <x-glass-card level="subtle" class="space-y-5 p-6">
            <div class="flex items-center gap-2">
                <h2 class="ui-heading-md">Pengembalian Deposit</h2>
            </div>

            <ol class="ui-steps" aria-label="Tahap pengembalian deposit">
                <li class="ui-step" data-state="done">
                    <span class="ui-step-dot"><span class="material-symbols-outlined" aria-hidden="true">done</span></span>
                    Audit selesai
                </li>
                <li class="ui-step" data-state="current" aria-current="step">
                    <span class="ui-step-dot"><span class="material-symbols-outlined" aria-hidden="true">touch_app</span></span>
                    Konfirmasi Anda
                </li>
                <li class="ui-step" data-state="todo">
                    <span class="ui-step-dot"><span class="material-symbols-outlined" aria-hidden="true">send_money</span></span>
                    Pencairan
                </li>
            </ol>

            <dl class="ui-dl">
                <div><dt>Deposit awal</dt><dd class="ui-num">{{ $rupiah($depositAwal) }}</dd></div>
                @foreach ($potongan as $p)
                <div>
                    <dt>{{ $p['nama'] }}</dt>
                    <dd @class(['ui-num', 'ui-text-danger' => $p['biaya'] > 0, 'ui-text-success' => $p['biaya'] === 0])>
                        {{ $p['biaya'] > 0 ? '− ' . $rupiah($p['biaya']) : 'Rp 0' }}
                    </dd>
                </div>
                @endforeach
            </dl>

            <div class="ui-highlight space-y-1">
                <p class="ui-eyebrow">Nominal Bersih Kembali</p>
                <p class="ui-amount">{{ $rupiah($dikembalikan) }}</p>
                <p class="ui-caption">Ke rekening BCA •••• 6789 setelah Anda menyetujui.</p>
            </div>
        </x-glass-card>

        {{-- Konfirmasi --}}
        <x-glass-card level="subtle" class="space-y-4 p-6">
            <div class="space-y-1">
                <h2 class="ui-heading-md">Konfirmasi &amp; Persetujuan</h2>
                <p class="ui-body-sm">Apakah Anda menyetujui rincian kondisi kamar dan potongan deposit di atas?</p>
            </div>

            <div class="flex flex-col gap-3">
                <x-glass-button
                    type="button"
                    variant="primary"
                    data-preview-action="Persetujuan belum tersimpan: backend persetujuan deposit belum tersedia.">
                    <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
                    Setuju &amp; Cairkan {{ $rupiah($dikembalikan) }}
                </x-glass-button>

                <x-glass-button type="button" variant="secondary" data-disclosure="dispute-panel">
                    Ajukan Keberatan
                </x-glass-button>
            </div>

            <div id="dispute-panel" class="ui-inset space-y-3" hidden>
                <x-glass-textarea
                    id="dispute-reason"
                    label="Alasan keberatan"
                    placeholder="Contoh: remote AC sudah rusak sejak check-in awal..." />

                <div class="flex flex-wrap items-center justify-between gap-3">
                    <label class="ui-btn ui-btn-secondary ui-btn-sm ui-upload">
                        <span class="ui-upload-name" data-upload-name="Lampirkan foto">Lampirkan foto</span>
                        <input type="file" accept="image/*" multiple aria-label="Lampirkan foto bukti keberatan">
                    </label>

                    <x-glass-button type="button" variant="danger" size="sm" :block="false" data-dispute-submit>
                        Kirim Keberatan
                    </x-glass-button>
                </div>
            </div>

            <div class="ui-glass-divider"></div>

            <a
                class="ui-link inline-flex items-center gap-2 text-sm"
                href="https://wa.me/6281234567890?text={{ rawurlencode('Halo Pemilik Kos, saya ' . $namaDepan . ' dari Kamar 104 ingin menanyakan perihal audit deposit.') }}"
                target="_blank"
                rel="noopener noreferrer">
                Tanya pemilik via WhatsApp
                <span class="sr-only">(tab baru)</span>
            </a>
        </x-glass-card>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (() => {
        const submit = document.querySelector("[data-dispute-submit]");
        const reason = document.getElementById("dispute-reason");

        submit?.addEventListener("click", () => {
            if (!reason.value.trim()) {
                reason.setAttribute("aria-invalid", "true");
                reason.classList.add("ui-glass-input-error");
                reason.focus();
                window.KosAudit?.toast("Tuliskan alasan keberatan terlebih dahulu.", { tone: "danger" });
                return;
            }

            reason.removeAttribute("aria-invalid");
            reason.classList.remove("ui-glass-input-error");
            window.KosAudit?.toast("Keberatan belum terkirim: backend sanggahan belum tersedia.", {
                tone: "warning",
                title: "Mode pratinjau",
            });
        });
    })();
</script>
@endpush
