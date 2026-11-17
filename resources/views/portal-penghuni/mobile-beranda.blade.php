@extends('layouts.glass-mobile')

@section('title', 'Beranda')

@section('content')
@php
$user = auth()->user();
$depositAwal = 500000;
$totalPotongan = 150000;
$dikembalikan = $depositAwal - $totalPotongan;
$persenKembali = round($dikembalikan / $depositAwal * 100);
$rupiah = fn (int $n) => 'Rp ' . number_format($n, 0, ',', '.');

$temuan = [
    ['icon' => 'ac_unit', 'nama' => 'Unit AC & Remote', 'desc' => 'Tutup baterai remote kendur & servis cuci filter akhir sewa.', 'biaya' => 100000],
    ['icon' => 'format_paint', 'nama' => 'Cat Dinding Belakang Pintu', 'desc' => 'Sisa lem double tape gantungan baju perlu perapihan cat 1 petak.', 'biaya' => 50000],
];
$lolos = ['Lantai Keramik', 'Lemari 2 Pintu', 'Kran & Sanitari', 'Kasur & Dipan', 'Lampu Kamar', 'Kunci & Silinder'];
@endphp

{{-- Judul: menggantikan kartu profil (nama akun sudah ada di menu akun) --}}
<x-glass-page-header
    eyebrow="Kamar 104 • Proses Check-out"
    :title="'Halo, ' . \Illuminate\Support\Str::of($user->name)->before(' ')"
    description="Periode sewa 1 Jun 2024 – 24 Mei 2025 • Lantai 1 • Deluxe" />

{{-- Status audit --}}
<div class="ui-callout ui-tone-success">
    <span class="material-symbols-outlined" aria-hidden="true">shield_with_heart</span>
    <div>
        <p class="font-semibold">Laporan inspeksi selesai</p>
        <p>Dana deposit ditahan aman. Tinjau dan konfirmasi dalam 24 jam sebelum dana diteruskan.</p>
    </div>
</div>

{{-- Ringkasan pengembalian --}}
<x-glass-card level="subtle" class="space-y-4 p-5">
    <div>
        <p class="ui-eyebrow">Penyelesaian Deposit</p>
        <h2 class="ui-heading-md">Ringkasan Pengembalian</h2>
    </div>

    <div class="space-y-3">
        <div>
            <p class="ui-caption">Estimasi yang cair</p>
            <p class="ui-amount">{{ $rupiah($dikembalikan) }}</p>
        </div>

        <div class="ui-meter" role="img" aria-label="{{ $persenKembali }}% deposit dikembalikan, {{ 100 - $persenKembali }}% dipotong">
            <span @style(['width: ' . $persenKembali . '%'])></span>
            <span class="ui-tone-warning" @style(['width: ' . (100 - $persenKembali) . '%'])></span>
        </div>

        <dl class="ui-dl">
            <div><dt>Deposit awal</dt><dd class="ui-num">{{ $rupiah($depositAwal) }}</dd></div>
            <div><dt>Potongan ({{ count($temuan) }} item)</dt><dd class="ui-num ui-text-danger">− {{ $rupiah($totalPotongan) }}</dd></div>
        </dl>
    </div>

    <div class="ui-callout ui-tone-warning">
        <span class="material-symbols-outlined" aria-hidden="true">hourglass_top</span>
        <p>Batas respon <strong>23 jam 45 menit</strong> lagi sebelum pengembalian diproses otomatis.</p>
    </div>

    <div class="flex flex-col gap-2">
        <x-glass-button :href="route('mobile.deposit')" variant="primary">
            <span class="material-symbols-outlined" aria-hidden="true">verified</span>
            Lihat Detail &amp; Setujui
        </x-glass-button>
        <x-glass-button :href="route('mobile.kondisi')" variant="secondary">
            Tinjau &amp; Sanggah Bukti
        </x-glass-button>
    </div>
</x-glass-card>

{{-- Cek fisik --}}
<x-glass-card level="subtle" class="space-y-4 p-5">
    <div class="flex items-start justify-between gap-3">
        <div>
            <h2 class="ui-heading-md">Status Cek Fisik</h2>
            <p class="ui-caption">{{ count($temuan) + count($lolos) }} titik pemeriksaan terverifikasi</p>
        </div>
        <x-glass-badge tone="success">{{ count($temuan) + count($lolos) }}/{{ count($temuan) + count($lolos) }} selesai</x-glass-badge>
    </div>

    <ul class="flex flex-col gap-2">
        @foreach ($temuan as $t)
        <li class="ui-inset space-y-2">
            <div class="flex items-center justify-between gap-2">
                <span class="text-sm font-semibold">{{ $t['nama'] }}</span>
                <span class="ui-num ui-text-danger text-sm font-semibold">{{ $rupiah($t['biaya']) }}</span>
            </div>
            <p class="ui-body-sm">{{ $t['desc'] }}</p>
        </li>
        @endforeach
    </ul>

    <div class="space-y-2">
        <p class="ui-label">{{ count($lolos) }} titik lolos audit</p>
        <ul class="grid grid-cols-2 gap-2">
            @foreach ($lolos as $nama)
            <li class="flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined ui-text-success text-[18px]" aria-hidden="true">check_circle</span>
                <span class="truncate">{{ $nama }}</span>
            </li>
            @endforeach
        </ul>
    </div>
</x-glass-card>

{{-- Foto bukti --}}
<x-glass-card level="subtle" class="space-y-4 p-5">
    <div class="flex items-center justify-between gap-3">
        <h2 class="ui-heading-md">Bukti Foto</h2>
        <a href="{{ route('mobile.kondisi') }}" class="ui-link text-sm">Lihat semua</a>
    </div>

    <ul class="grid grid-cols-2 gap-3">
        @foreach ([['Area Kasur & Lantai', 'Baik'], ['Casing Unit AC', 'Lecet']] as [$label, $status])
        <li class="space-y-2">
            <div class="ui-photo">
                <span class="material-symbols-outlined" aria-hidden="true">image</span>
            </div>
            <div class="flex items-center justify-between gap-2">
                <p class="truncate text-xs font-semibold">{{ $label }}</p>
                <x-glass-badge :status="$status" />
            </div>
        </li>
        @endforeach
    </ul>
</x-glass-card>

{{-- Dokumen & layanan --}}
<x-glass-card level="subtle" class="space-y-3 p-5">
    <h2 class="ui-heading-md">Dokumen &amp; Layanan</h2>

    <ul class="flex flex-col gap-2">
        <li>
            <button type="button" class="ui-inset flex w-full items-center gap-3 text-left" data-preview-action="Dokumen BAST belum tersedia untuk diunduh.">
                <span class="min-w-0 flex-1">
                    <span class="block text-sm font-semibold">BAST Check-in Awal</span>
                    <span class="ui-caption">Ditandatangani 1 Juni 2024</span>
                </span>
                <span class="material-symbols-outlined" aria-hidden="true">download</span>
            </button>
        </li>
        <li>
            <button type="button" class="ui-inset flex w-full items-center gap-3 text-left" data-preview-action="Buku pedoman belum tersedia.">
                <span class="min-w-0 flex-1">
                    <span class="block text-sm font-semibold">Pedoman Hak Penghuni</span>
                    <span class="ui-caption">Standar penalti wajar &amp; batas keausan normal</span>
                </span>
                <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
            </button>
        </li>
        <li>
            <a
                href="https://wa.me/6281234567890"
                target="_blank"
                rel="noopener noreferrer"
                class="ui-inset flex items-center gap-3 no-underline">
                <span class="min-w-0 flex-1">
                    <span class="block text-sm font-semibold text-content">Bu Rina (Pengelola Kos)</span>
                    <span class="ui-caption">Bantuan langsung via WhatsApp</span>
                </span>
                <span class="material-symbols-outlined text-content" aria-hidden="true">open_in_new</span>
                <span class="sr-only">(tab baru)</span>
            </a>
        </li>
    </ul>
</x-glass-card>
@endsection
