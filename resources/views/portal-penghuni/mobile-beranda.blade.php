@extends('layouts.mobile')

@section('title', 'Beranda Penghuni')

@section('content')
<div class="flex flex-col w-full px-margin-mobile pb-space-xl gap-space-md">
<!-- Banner Notifikasi Audit Terbit (Delight & Calm Transparency) -->
<div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-primary to-primary-container p-space-md text-on-primary shadow-md">
<div class="absolute -right-6 -bottom-6 w-28 h-28 bg-on-primary/10 rounded-full blur-xl pointer-events-none"></div>
<div class="relative z-10 flex items-start gap-space-sm">
<div class="w-10 h-10 rounded-lg bg-on-primary/15 flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-primary-fixed text-[24px]" style="font-variation-settings: 'FILL' 1;">shield_with_heart</span>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-center gap-space-xs mb-1">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed bg-on-primary/15 px-2 py-0.5 rounded-full font-bold">Audit Terbit</span>
<span class="inline-block w-1.5 h-1.5 rounded-full bg-secondary-fixed animate-pulse"></span>
</div>
<p class="font-headline-sm text-headline-sm text-on-primary font-bold">Laporan Inspeksi Selesai</p>
<p class="font-body-sm text-body-sm text-surface-container-high/90 mt-1">
          Dana deposit terlindungi aman di rekening penjamin (escrow). Verifikasi dalam 24 jam sebelum dana diteruskan.
        </p>
</div>
</div>
</div>
<!-- Profil Kamar & Penyewa Card -->
<div class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm flex flex-col gap-space-sm">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[20px]">apartment</span>
<span class="font-label-md text-label-md text-on-surface-variant font-semibold">Kost Putri Griya Asri</span>
</div>
<span class="font-label-sm text-label-sm font-semibold px-2.5 py-1 rounded-full bg-secondary-fixed text-on-secondary-fixed flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-secondary"></span>
        Proses Check-out
      </span>
</div>
<div class="flex items-center gap-space-md pt-space-xs">
<div class="relative w-14 h-14 rounded-full overflow-hidden shrink-0 shadow-sm bg-surface-container-highest">
<img class="w-full h-full object-cover" data-alt="Potret mahasiswi ceria dengan hijab rapi dan senyum ramah bernama Dinda Kirana, pencahayaan alami di dalam ruangan kos modern yang bersih dengan nuansa hijau toska teduh dan kayu cerah." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAp0NWzD4qG2mFyq0zkR45msfIXZfiS4m-tzaBO5Bz6RlJNxnwQa7_gl3tw5Bh4WJv1z_5g_nHLyRYdf5UjOnHw28bXZ08laoVdqZHP9AbjQdr0Qd5RX8GC_SEE5IcVSFk7P6QEAdPKJem-n8wuU2lfQj15ghnuB7ncRt0chS5hFpkctlu1Xl6r9lh1c2z41w-X6k5tcm6ZZLTFZlkl7PiSXd-KLYdf-vzZ9feHxJIE1hEIkCS3UvP8"/>
</div>
<div class="flex-1 min-w-0">
<h2 class="font-headline-sm text-headline-sm text-on-surface font-bold truncate">Dinda Kirana</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1 mt-0.5">
<span class="material-symbols-outlined text-[16px] text-primary">meeting_room</span>
          Kamar 104 • Lantai 1 (Tipe Deluxe)
        </p>
</div>
</div>
<div class="mt-space-xs pt-space-sm bg-surface-container-low rounded-lg p-space-sm flex items-center justify-between text-on-surface-variant">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[18px]">calendar_today</span>
<span class="font-label-sm text-label-sm">Periode Sewa</span>
</div>
<span class="font-mono-numeric text-mono-numeric text-on-surface font-semibold">1 Jun 2024 – 24 Mei 2025</span>
</div>
</div>
<!-- Ringkasan Finansial Deposit (Interactive Breakdown) -->
<div class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm flex flex-col gap-space-md">
<div class="flex items-center justify-between">
<div>
<p class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Penyelesaian Jaminan</p>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Ringkasan Pengembalian</h3>
</div>
<div class="w-9 h-9 rounded-full bg-primary-fixed/40 flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
</div>
</div>
<!-- Visual Estimasi Saldo -->
<div class="bg-surface-container-low rounded-xl p-space-md flex flex-col gap-space-sm">
<div class="flex items-baseline justify-between">
<span class="font-body-sm text-body-sm text-on-surface-variant">Estimasi yang Cair</span>
<div class="text-right">
<span class="font-display text-display text-primary font-bold tracking-tight">Rp 350.000</span>
<span class="block font-label-sm text-label-sm text-tertiary font-semibold">Siap transfer ke Rekening BCA Anda</span>
</div>
</div>
<!-- Meter Visual Bar -->
<div class="w-full bg-surface-container-highest h-2.5 rounded-full overflow-hidden flex">
<div class="bg-primary h-full transition-all duration-700" style="width: 70%"></div>
<div class="bg-secondary-container h-full transition-all duration-700" style="width: 30%"></div>
</div>
<!-- Detail Pemotongan Mini -->
<div class="grid grid-cols-2 gap-space-sm pt-space-xs">
<div class="bg-surface-container-lowest p-space-xs rounded-lg">
<p class="font-label-sm text-label-sm text-on-surface-variant">Deposit Awal</p>
<p class="font-mono-numeric text-mono-numeric text-on-surface font-bold">Rp 500.000</p>
</div>
<div class="bg-surface-container-lowest p-space-xs rounded-lg">
<p class="font-label-sm text-label-sm text-error">Potongan (2 Item)</p>
<p class="font-mono-numeric text-mono-numeric text-error font-bold">- Rp 150.000</p>
</div>
</div>
</div>
<div class="flex items-center gap-space-xs p-2.5 rounded-lg bg-surface-container text-on-surface-variant">
<span class="material-symbols-outlined text-[18px] text-secondary">hourglass_top</span>
<p class="font-label-sm text-label-sm font-medium">Batas respon: <strong class="text-on-surface font-semibold">23 Jam 45 Menit lagi</strong> untuk pengembalian otomatis.</p>
</div>
<!-- CTA Buttons -->
<div class="flex flex-col gap-space-xs pt-space-xs">
<button class="w-full h-11 bg-primary text-on-primary rounded-lg font-label-lg text-label-lg flex items-center justify-center gap-space-xs hover:bg-primary-container transition-all active:scale-[0.99] shadow-sm" id="btn-approve">
<span class="material-symbols-outlined text-[18px]">verified</span>
        Lihat Detail &amp; Setujui
      </button>
<button class="w-full h-11 bg-surface-container-high text-on-surface rounded-lg font-label-lg text-label-lg flex items-center justify-center gap-space-xs hover:bg-surface-container-highest transition-all active:scale-[0.99]" id="btn-dispute">
<span class="material-symbols-outlined text-[18px] text-on-surface-variant">contact_support</span>
        Ajukan Sanggahan Bukti
      </button>
</div>
</div>
<!-- Hasil Cek Fisik Kamar (Quick Audit Overview) -->
<div class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm flex flex-col gap-space-sm">
<div class="flex items-center justify-between">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Status Cek Fisik Kamar</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant">8 titik pemeriksaan terverifikasi staf</p>
</div>
<span class="font-label-sm text-label-sm bg-surface-container px-2.5 py-1 rounded-full text-primary font-bold">8/8 Selesai</span>
</div>
<!-- Item Status Highlights -->
<div class="flex flex-col gap-space-xs mt-space-xs">
<!-- Item Perhatian 1 -->
<div class="bg-surface-container-low rounded-xl p-space-sm flex flex-col gap-space-xs">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px]">ac_unit</span>
<span class="font-label-lg text-label-lg text-on-surface font-semibold">Unit AC &amp; Remote</span>
</div>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold">Lecet / Perhatian</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant pl-7">
          Tutup baterai remote kendur &amp; servis cuci filter akhir sewa.
        </p>
<div class="flex items-center justify-between pl-7 pt-1">
<span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Beban Biaya Disepakati:</span>
<span class="font-mono-numeric text-mono-numeric text-error font-bold">Rp 80.000</span>
</div>
</div>
<!-- Item Perhatian 2 -->
<div class="bg-surface-container-low rounded-xl p-space-sm flex flex-col gap-space-xs">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px]">format_paint</span>
<span class="font-label-lg text-label-lg text-on-surface font-semibold">Cat Dinding Belakang Pintu</span>
</div>
<span class="font-label-sm text-label-sm px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed font-bold">Bercak Perekat</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant pl-7">
          Sisa lem foam double tape gantungan baju perlu perapihan cat 1 petak.
        </p>
<div class="flex items-center justify-between pl-7 pt-1">
<span class="font-label-sm text-label-sm text-on-surface-variant font-medium">Beban Biaya Disepakati:</span>
<span class="font-mono-numeric text-mono-numeric text-error font-bold">Rp 70.000</span>
</div>
</div>
<!-- 6 Item Kondisi Baik (Pill Grid) -->
<div class="pt-space-xs">
<p class="font-label-sm text-label-sm text-on-surface-variant font-semibold mb-2">6 Titik Lolos Audit (Kondisi Baik &amp; Bersih):</p>
<div class="grid grid-cols-2 gap-space-xs">
<div class="flex items-center gap-2 p-2 rounded-lg bg-surface-container-lowest shadow-sm">
<span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
<span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lantai Keramik</span>
</div>
<div class="flex items-center gap-2 p-2 rounded-lg bg-surface-container-lowest shadow-sm">
<span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
<span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lemari 2 Pintu</span>
</div>
<div class="flex items-center gap-2 p-2 rounded-lg bg-surface-container-lowest shadow-sm">
<span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
<span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Kran &amp; Sanitari</span>
</div>
<div class="flex items-center gap-2 p-2 rounded-lg bg-surface-container-lowest shadow-sm">
<span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
<span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Kasur &amp; Dipan</span>
</div>
<div class="flex items-center gap-2 p-2 rounded-lg bg-surface-container-lowest shadow-sm">
<span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
<span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Lampu Kamar</span>
</div>
<div class="flex items-center gap-2 p-2 rounded-lg bg-surface-container-lowest shadow-sm">
<span class="material-symbols-outlined text-tertiary text-[18px]">check_circle</span>
<span class="font-body-sm text-body-sm text-on-surface font-medium truncate">Kunci &amp; Silinder</span>
</div>
</div>
</div>
</div>
</div>
<!-- Foto Dokumentasi Inspeksi (Visual Assurance) -->
<div class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm flex flex-col gap-space-sm">
<div class="flex items-center justify-between">
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Bukti Foto Staf Kos</h3>
<span class="font-label-sm text-label-sm text-primary font-semibold cursor-pointer">Lihat Semua (8)</span>
</div>
<div class="grid grid-cols-2 gap-space-sm">
<div class="rounded-lg overflow-hidden bg-surface-container flex flex-col">
<div class="h-28 w-full bg-cover bg-center" data-alt="Tampilan rapi dan bersih kamar kos minimalis dengan ranjang kayu rapi, seprai warna netral, serta lantai keramik mengkilap tersinari cahaya jendela siang hari yang terang benderang." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBx6V_OFlZEc1wB8SCUSUAYbORCgKyqWmvGmUX-N4r6KpO35kc03BCYP3daFAd-7aAD_DgWh9y-bXO4nC8dycPedHqK0FDB3zW98hRc3_ZCEv0IpEGal2mTaYuMtcxNc7OlEOeBx3CQ9ieiaS6vqvBZGIJ4epMlvX1wS5EAjRXrU0mdHitDYrSub0ddoPtOmF0-p_HDps1JkBkhTVBBd7AZ1r26K3j8ca_ufXPC_YwIHtaNBSo8-8tC')"></div>
<div class="p-2 bg-surface-container-lowest">
<p class="font-label-sm text-label-sm text-on-surface font-semibold truncate">Area Kasur &amp; Lantai</p>
<span class="font-label-sm text-label-sm text-tertiary font-medium">Kondisi Baik</span>
</div>
</div>
<div class="rounded-lg overflow-hidden bg-surface-container flex flex-col">
<div class="h-28 w-full bg-cover bg-center" data-alt="Detail foto jarak dekat tombol AC dan panel casing pendingin ruangan di dinding putih yang terawat rapi tanpa keretakan dengan penandaan stiker inspeksi resmi KosAudit." style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCWFsJtjxOmNz0XQUSDCYwPmKFQUnuFwyaM3reiwchoywkO0IvjLm9RAeKQTHvUWrWjsYaPsydBMnxNCxxlkHuOkR2FW2rrmaSPw7Zc33wKmoTC_BkwUCugkiNyx6nF6k65zZijAYs5vF9uEBeeUwMzTurG-37CNfdxRGoqcgGgOcdyl-CiH1iLt9Y_a7Zti0zgISp9sa22hiPMivy_07pIsERUQDStJ3zCmt2OKf6yN8NskfuUK1Cz')"></div>
<div class="p-2 bg-surface-container-lowest">
<p class="font-label-sm text-label-sm text-on-surface font-semibold truncate">Casing Unit AC</p>
<span class="font-label-sm text-label-sm text-secondary font-medium">Filter Bersih</span>
</div>
</div>
</div>
</div>
<!-- Akses Dokumen Digital & Bantuan Cepat -->
<div class="rounded-xl bg-surface-container-lowest p-space-md shadow-sm flex flex-col gap-space-sm">
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Dokumen &amp; Layanan</h3>
<div class="flex flex-col gap-space-xs">
<!-- BAST Masuk -->
<a class="flex items-center justify-between p-space-sm rounded-lg hover:bg-surface-container-low transition-colors bg-surface-container-lowest shadow-sm" href="#">
<div class="flex items-center gap-space-sm">
<div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[20px]">description</span>
</div>
<div>
<p class="font-label-lg text-label-lg text-on-surface font-semibold">BAST Check-in Awal</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Ditandatangani 1 Juni 2024</p>
</div>
</div>
<span class="material-symbols-outlined text-primary text-[20px]">download</span>
</a>
<!-- Panduan Hak Penghuni -->
<a class="flex items-center justify-between p-space-sm rounded-lg hover:bg-surface-container-low transition-colors bg-surface-container-lowest shadow-sm" href="#">
<div class="flex items-center gap-space-sm">
<div class="w-10 h-10 rounded-lg bg-surface-container-highest flex items-center justify-center text-primary">
<span class="material-symbols-outlined text-[20px]">menu_book</span>
</div>
<div>
<p class="font-label-lg text-label-lg text-on-surface font-semibold">Buku Pedoman Hak Anak Kos</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Standar penalti wajar &amp; batas keausan normal</p>
</div>
</div>
<span class="material-symbols-outlined text-on-surface-variant text-[20px]">chevron_right</span>
</a>
<!-- Kontak Pengelola Kos (WhatsApp Darurat) -->
<a class="flex items-center justify-between p-space-sm rounded-lg bg-tertiary-container text-on-tertiary shadow-sm transition-transform active:scale-[0.99]" href="https://wa.me/">
<div class="flex items-center gap-space-sm">
<div class="w-10 h-10 rounded-lg bg-on-tertiary/20 flex items-center justify-center">
<span class="material-symbols-outlined text-on-tertiary text-[22px]">chat</span>
</div>
<div>
<p class="font-label-lg text-label-lg text-on-tertiary font-bold">Bu Rina (Pengelola Kos)</p>
<p class="font-body-sm text-body-sm text-on-tertiary-container">Bantuan Langsung WhatsApp • Online</p>
</div>
</div>
<span class="material-symbols-outlined text-on-tertiary text-[20px]">arrow_forward</span>
</a>
</div>
</div>
<!-- Micro-dialog Toast Mockup for Delight Interaction -->
<div class="hidden fixed bottom-20 left-4 right-4 bg-inverse-surface text-inverse-on-surface p-space-md rounded-xl shadow-xl z-50 flex items-center justify-between" id="toast-delight">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary-fixed text-[20px]">task_alt</span>
<span class="font-body-sm text-body-sm">Persetujuan tersimpan! Escrow bersiap mentransfer dana.</span>
</div>
<button class="text-inverse-on-surface/80 hover:text-inverse-on-surface" id="close-toast">
<span class="material-symbols-outlined text-[18px]">close</span>
</button>
</div>
</div>
<script>
  (function() {
    const btnApprove = document.getElementById('btn-approve');
    const toast = document.getElementById('toast-delight');
    const closeToast = document.getElementById('close-toast');

    if (btnApprove && toast) {
      btnApprove.addEventListener('click', function() {
        toast.classList.remove('hidden');
        toast.classList.add('flex');
        setTimeout(() => {
          toast.classList.add('hidden');
          toast.classList.remove('flex');
        }, 4000);
      });
    }

    if (closeToast && toast) {
      closeToast.addEventListener('click', function() {
        toast.classList.add('hidden');
        toast.classList.remove('flex');
      });
    }
  })();
</script>
@endsection