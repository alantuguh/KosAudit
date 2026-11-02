@extends('layouts.app')

@section('title', 'Dashboard Penghuni – Kamar 104')

@section('content')
<div class="flex flex-col w-full max-w-md mx-auto space-y-space-md pb-space-2xl">
<!-- Mobile Header Strip -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm flex items-center justify-between">
<div class="flex items-center gap-space-sm min-w-0">
<div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-primary text-[22px]" style="font-variation-settings: 'FILL' 1;">home_pin</span>
</div>
<div class="min-w-0 truncate">
<div class="flex items-center gap-1.5">
<span class="font-headline-sm text-headline-sm text-on-surface font-bold leading-tight truncate">Dinda Kirana</span>
<span class="inline-flex items-center px-1.5 py-0.5 rounded-full bg-surface-container font-label-sm text-label-sm text-primary font-semibold">104</span>
</div>
<p class="font-label-sm text-label-sm text-outline truncate">Griya Asri Putri • Kamar 104</p>
</div>
</div>
<div class="flex items-center gap-1 shrink-0">
<button aria-label="Notifikasi" class="relative w-9 h-9 rounded-lg bg-surface-container-low flex items-center justify-center text-on-surface-variant hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[20px]">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 rounded-full bg-error"></span>
</button>
</div>
</div>
<!-- Warm Process Greeting Banner -->
<div class="bg-surface-container-low rounded-xl p-space-md shadow-sm relative overflow-hidden">
<div class="relative z-10 flex gap-space-md items-start">
<div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shrink-0 shadow-sm">
<span class="material-symbols-outlined text-[22px]">auto_stories</span>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-center gap-space-xs">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-primary font-bold">Audit Check-Out</span>
<span class="inline-block w-1.5 h-1.5 rounded-full bg-secondary-container"></span>
<span class="font-label-sm text-label-sm text-outline">Perlu Review</span>
</div>
<h1 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface font-bold tracking-tight mt-0.5 leading-snug">
          Halo Dinda,
        </h1>
<p class="font-body-md text-body-md text-on-surface-variant mt-1 leading-relaxed">
          Proses check-out kamar kos Anda sedang berjalan. Mohon periksa rincian inspeksi fisik dan nominal pengembalian deposit di bawah.
        </p>
</div>
</div>
<!-- Visual background sparkle accent -->
<svg class="absolute -right-4 -bottom-6 w-28 h-28 text-primary-fixed-dim/20 pointer-events-none" fill="currentColor" viewbox="0 0 100 100">
<circle cx="50" cy="50" r="40"></circle>
<circle cx="85" cy="20" r="15"></circle>
</svg>
</div>
<!-- Card 1: Informasi Kamar & Sewa -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm space-y-space-md">
<div class="flex items-center justify-between pb-space-xs">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[20px]">meeting_room</span>
<h2 class="font-label-lg text-label-lg text-on-surface font-bold">Informasi Sewa Kamar</h2>
</div>
<span class="px-2 py-0.5 rounded-full bg-surface-container-high text-on-surface-variant font-label-sm text-label-sm font-semibold">Check-out</span>
</div>
<div class="grid grid-cols-2 gap-space-sm bg-surface-container-low p-space-sm rounded-lg">
<div class="space-y-0.5">
<p class="font-label-sm text-label-sm text-outline">Nomor Kamar</p>
<p class="font-body-sm text-body-sm text-on-surface font-semibold truncate">Kamar 104 (Lt. 1)</p>
<p class="font-label-sm text-label-sm text-outline-variant">Tipe AC Standar</p>
</div>
<div class="space-y-0.5">
<p class="font-label-sm text-label-sm text-outline">Durasi Sewa</p>
<p class="font-body-sm text-body-sm text-on-surface font-semibold">12 Bulan (Selesai)</p>
<p class="font-label-sm text-label-sm text-tertiary font-semibold flex items-center gap-0.5">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Lunas Penuh
        </p>
</div>
<div class="space-y-0.5 pt-space-xs">
<p class="font-label-sm text-label-sm text-outline">Tanggal Masuk</p>
<p class="font-body-sm text-body-sm text-on-surface font-medium">1 Juni 2024</p>
</div>
<div class="space-y-0.5 pt-space-xs">
<p class="font-label-sm text-label-sm text-outline">Tanggal Keluar</p>
<p class="font-body-sm text-body-sm text-on-surface font-medium">24 Mei 2025</p>
</div>
</div>
</div>
<!-- Card 2: Ringkasan Hasil Inspeksi Kamar -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm space-y-space-md">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[20px]">assignment_turned_in</span>
<h2 class="font-label-lg text-label-lg text-on-surface font-bold">Hasil Inspeksi Kondisi</h2>
</div>
<button class="font-label-sm text-label-sm text-primary hover:text-primary-container font-semibold flex items-center gap-0.5 transition-colors">
<span>8 Foto Komparasi</span>
<span class="material-symbols-outlined text-[16px]">arrow_forward</span>
</button>
</div>
<!-- Foto Thumbnail Preview Strip -->
<div class="flex gap-space-xs overflow-x-auto pb-1 scrollbar-none">
<div class="relative shrink-0 w-20 h-16 rounded-lg overflow-hidden bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Close up photograph of a damaged AC remote control placed on a wooden desk inside an Indonesian boarding house room with subtle interior lighting and high details." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCOa3gXzrb_JCxVQFRfLaz7WK0_BeohKKSeievTg5-D6fiWk-ElxUqWm6R5l3PlVs0TxFjH7hIcMwTdLjKG2YUmnDkmwaAdCOX5_RtdtMUcdITTeMyhSOnD-Go7_fkYpYeNQXZ4rOqe7Um2Eleqs49kXyJXpxf_t0MkEtTeYph2IYe51KaBbJjcI47973r6VGYULSxEHRyIgUa12Lk6oEKOHMZe27-v1ao3C50OxszoeXviaUgqzSC7"/>
<span class="absolute bottom-1 left-1 bg-on-surface/75 text-on-primary font-label-sm text-[10px] px-1 rounded">Remote</span>
</div>
<div class="relative shrink-0 w-20 h-16 rounded-lg overflow-hidden bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Macro photo showing peeled white wall paint near the headboard of a boarding house bedroom with visible plaster texture and realistic shadow." src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgDvJrSNZ0MjJGVJgFhF31ko1vweDfbzYNL0tCkKQRVbTAGQmoYXmEnDXuifQzPTyTh9ja3s8OZjpm_uv9JVWTDA5YaUz3POrNScV4_spzJSsd7aPD7gqeaJ4tN8EuZ3gfcPhImIAIy8DyPlAxcchM70CKdgimrzMuspKLXUFfW-o5Bq7FX1GtHqyH3B4hu7AgvjRcr4hgzx0dSwDMabA_MUNzcGHLiZdB1C7fINH-vEF8udMeqbxe"/>
<span class="absolute bottom-1 left-1 bg-on-surface/75 text-on-primary font-label-sm text-[10px] px-1 rounded">Dinding</span>
</div>
<div class="relative shrink-0 w-20 h-16 rounded-lg overflow-hidden bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Photo of a clean and neatly kept wooden wardrobe cabinet with open drawers showing proper condition inside a rental room." src="https://lh3.googleusercontent.com/aida-public/AB6AXuBg8XzTaU7TTBf5cHWkGoyGzn5XH6NvVbLSmvvIDClzl05MwgyUSQkKEsZqwmavGxoGeIH4hy4U8yypht5w171Ip9OSpXqXu0YcfuviJkP8n2pfj1YC6lAwnSsGEYOqCtDMq0ZXbHRkQqv3LdEb36q4bBzK8WSkPOrxdN4WoUV2BLd1kJjBC69HlTJX_EaDTG_UyUv_rMNJX0uaiMZZWBD_DLX9Eut_Zwko3MG0eB2camZ9neA8TzcD"/>
<span class="absolute bottom-1 left-1 bg-on-surface/75 text-on-primary font-label-sm text-[10px] px-1 rounded">Lemari</span>
</div>
<div class="shrink-0 w-16 h-16 rounded-lg bg-surface-container-low flex flex-col items-center justify-center text-primary cursor-pointer hover:bg-surface-container transition-colors">
<span class="material-symbols-outlined text-[20px]">photo_library</span>
<span class="font-label-sm text-label-sm font-semibold">+5 Lain</span>
</div>
</div>
<!-- Condition Breakdown Items -->
<div class="space-y-space-sm pt-space-xs">
<!-- Item 1: Remote AC Rusak -->
<div class="bg-surface-container-low rounded-lg p-space-sm flex items-start justify-between gap-space-sm">
<div class="flex items-start gap-space-sm">
<div class="w-7 h-7 rounded bg-error-container text-on-error-container flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[16px]">mode_fan</span>
</div>
<div>
<p class="font-body-sm text-body-sm font-semibold text-on-surface">AC &amp; Remote Kontrol</p>
<p class="font-label-sm text-label-sm text-outline">Tutup baterai pecah &amp; remote tidak menyala</p>
</div>
</div>
<span class="shrink-0 px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
          Rusak (Remote)
        </span>
</div>
<!-- Item 2: Dinding Terkelupas -->
<div class="bg-surface-container-low rounded-lg p-space-sm flex items-start justify-between gap-space-sm">
<div class="flex items-start gap-space-sm">
<div class="w-7 h-7 rounded bg-error-container text-on-error-container flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[16px]">format_paint</span>
</div>
<div>
<p class="font-body-sm text-body-sm font-semibold text-on-surface">Dinding Kamar</p>
<p class="font-label-sm text-label-sm text-outline">Bekas double tape &amp; cat terkelupas 2 titik</p>
</div>
</div>
<span class="shrink-0 px-2 py-0.5 rounded-full bg-error-container text-on-error-container font-label-sm text-label-sm font-semibold">
          Rusak (Cat)
        </span>
</div>
<!-- Item 3: Kasur & Sprei -->
<div class="bg-surface-container-low rounded-lg p-space-sm flex items-start justify-between gap-space-sm">
<div class="flex items-start gap-space-sm">
<div class="w-7 h-7 rounded bg-secondary-fixed text-on-secondary-fixed-variant flex items-center justify-center shrink-0 mt-0.5">
<span class="material-symbols-outlined text-[16px]">bed</span>
</div>
<div>
<p class="font-body-sm text-body-sm font-semibold text-on-surface">Kasur &amp; Sprei</p>
<p class="font-label-sm text-label-sm text-outline">Noda kopi ringan di tepi cover pelindung</p>
</div>
</div>
<span class="shrink-0 px-2 py-0.5 rounded-full bg-secondary-fixed text-on-secondary-fixed-variant font-label-sm text-label-sm font-semibold">
          Lecet Ringan
        </span>
</div>
<!-- Item 4: Lainnya Baik -->
<div class="bg-surface-container-low rounded-lg p-space-sm flex items-center justify-between gap-space-sm">
<div class="flex items-center gap-space-sm">
<div class="w-7 h-7 rounded bg-tertiary-container text-on-tertiary flex items-center justify-center shrink-0">
<span class="material-symbols-outlined text-[16px]">check</span>
</div>
<div>
<p class="font-body-sm text-body-sm font-semibold text-on-surface">Lemari, Kran, Meja &amp; 5 Item Lain</p>
<p class="font-label-sm text-label-sm text-tertiary font-medium">Semua berfungsi normal &amp; bersih</p>
</div>
</div>
<span class="shrink-0 px-2 py-0.5 rounded-full bg-tertiary-fixed text-on-tertiary-fixed-variant font-label-sm text-label-sm font-semibold">
          Baik (5 Item)
        </span>
</div>
</div>
</div>
<!-- Card 3: Status & Rincian Pengembalian Deposit -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm space-y-space-md">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[20px]">account_balance_wallet</span>
<h2 class="font-label-lg text-label-lg text-on-surface font-bold">Kalkulasi Pengembalian Deposit</h2>
</div>
<span class="w-2 h-2 rounded-full bg-secondary-container animate-ping"></span>
</div>
<!-- Mini Visual Timeline Stepper -->
<div class="bg-surface-container-low p-space-sm rounded-lg">
<div class="flex items-center justify-between text-center relative">
<!-- Connecting Line -->
<div class="absolute left-6 right-6 top-3 h-0.5 bg-surface-container-high -z-0"></div>
<!-- Step 1 -->
<div class="relative z-10 flex flex-col items-center">
<div class="w-6 h-6 rounded-full bg-primary-container text-on-primary flex items-center justify-center shadow-sm">
<span class="material-symbols-outlined text-[14px]">done</span>
</div>
<span class="font-label-sm text-label-sm text-on-surface font-medium mt-1">Audit Selesai</span>
</div>
<!-- Step 2 (Active) -->
<div class="relative z-10 flex flex-col items-center">
<div class="w-6 h-6 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center ring-4 ring-secondary-fixed/50 shadow-sm">
<span class="material-symbols-outlined text-[14px]">bolt</span>
</div>
<span class="font-label-sm text-label-sm text-secondary font-bold mt-1">Konfirmasi Anda</span>
</div>
<!-- Step 3 -->
<div class="relative z-10 flex flex-col items-center">
<div class="w-6 h-6 rounded-full bg-surface-container-high text-outline flex items-center justify-center">
<span class="material-symbols-outlined text-[14px]">send_money</span>
</div>
<span class="font-label-sm text-label-sm text-outline mt-1">Pencairan</span>
</div>
</div>
</div>
<!-- Financial Ledger Calculation -->
<div class="space-y-space-xs">
<div class="flex items-center justify-between py-1">
<span class="font-body-md text-body-md text-on-surface-variant">Deposit Jaminan Awal</span>
<span class="font-mono-numeric text-mono-numeric text-on-surface font-semibold">Rp 500.000</span>
</div>
<div class="space-y-1.5 pt-1">
<div class="flex items-center justify-between text-error">
<div class="flex items-center gap-1 font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px]">remove_circle_outline</span>
<span>Ganti Unit Remote AC</span>
</div>
<span class="font-mono-numeric text-mono-numeric font-semibold">- Rp 100.000</span>
</div>
<div class="flex items-center justify-between text-error">
<div class="flex items-center gap-1 font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px]">remove_circle_outline</span>
<span>Biaya Cat &amp; Dempul Dinding</span>
</div>
<span class="font-mono-numeric text-mono-numeric font-semibold">- Rp 50.000</span>
</div>
<div class="flex items-center justify-between text-tertiary">
<div class="flex items-center gap-1 font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[16px]">savings</span>
<span>Noda Kasur (Digratiskan Ibu Kos)</span>
</div>
<span class="font-mono-numeric text-mono-numeric font-semibold">Rp 0</span>
</div>
</div>
<!-- Clean Highlight Strip for Net Refund -->
<div class="mt-space-sm p-space-md rounded-xl bg-primary-fixed text-on-primary-fixed flex items-center justify-between shadow-sm">
<div>
<p class="font-label-sm text-label-sm uppercase tracking-wider font-bold text-on-primary-fixed-variant">Nominal Bersih Kembali</p>
<p class="font-label-sm text-label-sm text-primary">Akan ditransfer via Real-Time</p>
</div>
<div class="text-right">
<span class="font-headline-lg-mobile text-headline-lg-mobile font-bold text-primary tracking-tight">Rp 350.000</span>
</div>
</div>
</div>
<!-- Destination Account Details -->
<div class="flex items-center gap-space-sm p-space-sm rounded-lg bg-surface-container-low">
<div class="w-9 h-9 rounded bg-surface-container-lowest flex items-center justify-center shrink-0 shadow-xs">
<span class="material-symbols-outlined text-primary text-[20px]">account_balance</span>
</div>
<div class="flex-1 min-w-0">
<p class="font-label-sm text-label-sm text-outline">Rekening Tujuan Pencairan</p>
<p class="font-body-sm text-body-sm font-semibold text-on-surface truncate">BCA •••• 6789 a.n Dinda Kirana</p>
</div>
<button class="font-label-sm text-label-sm text-primary font-semibold hover:underline shrink-0">Ubah</button>
</div>
</div>
<!-- Card 4: Resident Action & Approval Section -->
<div class="bg-surface-container-lowest rounded-xl p-space-md shadow-sm space-y-space-md">
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold leading-tight">Konfirmasi &amp; Persetujuan</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1 leading-snug">
        Apakah Anda menyetujui rincian kondisi kamar dan potongan deposit di atas?
      </p>
</div>
<!-- Interactive Approval Block -->
<div class="space-y-space-sm pt-space-xs">
<!-- Emerald Confirmation CTA -->
<button class="w-full h-12 bg-primary-container hover:bg-primary text-on-primary font-label-lg text-label-lg font-bold rounded-lg shadow-sm flex items-center justify-center gap-space-xs active:scale-[0.99] transition-all" id="btn-approve" onclick="handleApproval()">
<span class="material-symbols-outlined text-[20px]">check_circle</span>
<span>Setuju &amp; Cairkan Rp 350.000</span>
</button>
<!-- Dispute Toggle Button -->
<button class="w-full h-11 bg-surface-container-low hover:bg-surface-container text-error font-label-lg text-label-lg font-semibold rounded-lg flex items-center justify-center gap-space-xs transition-colors" id="btn-toggle-dispute" onclick="toggleDisputeForm()">
<span class="material-symbols-outlined text-[18px]">gavel</span>
<span>Ajukan Keberatan / Diskusi Ulang</span>
</button>
</div>
<!-- Collapsible Dispute Form -->
<div class="hidden transition-all duration-200 ease-in-out pt-space-xs space-y-space-sm" id="dispute-form-container">
<div class="p-space-sm bg-error-container/40 rounded-lg text-on-surface">
<label class="block font-label-sm text-label-sm font-semibold text-error mb-1" for="dispute-reason">
          Catatan atau Alasan Sanggahan:
        </label>
<textarea class="w-full p-2.5 rounded-lg bg-surface-container-lowest text-on-surface font-body-sm text-body-sm placeholder:text-outline focus:outline-none" id="dispute-reason" placeholder="Tuliskan alasan keberatan (misal: remote AC sudah rusak sejak check-in awal)..." rows="3"></textarea>
<div class="mt-space-sm flex items-center justify-between">
<button class="flex items-center gap-1 font-label-sm text-label-sm text-primary font-semibold py-1" type="button">
<span class="material-symbols-outlined text-[16px]">add_a_photo</span>
<span>Unggah Bukti Foto Baru</span>
</button>
<button class="px-3 py-1.5 bg-error text-on-error rounded-lg font-label-sm text-label-sm font-bold shadow-xs" onclick="submitDispute()" type="button">
            Kirimkan Sanggahan
          </button>
</div>
</div>
</div>
<!-- Direct WhatsApp Assistance Support Button -->
<div class="pt-space-xs">
<a class="w-full py-2.5 px-space-md rounded-lg bg-surface-container-low hover:bg-surface-container text-on-surface-variant flex items-center justify-center gap-space-sm font-label-sm text-label-sm font-semibold transition-colors" href="https://wa.me/6281234567890?text=Halo%20Pemilik%20Kos,%20saya%20Dinda%20dari%20Kamar%20104%20ingin%20menanyakan%20perihal%20audit%20deposit." rel="noopener noreferrer" target="_blank">
<span class="material-symbols-outlined text-tertiary text-[18px]" style="font-variation-settings: 'FILL' 1;">chat</span>
<span>Tanya Pemilik Langsung via WhatsApp</span>
</a>
</div>
<!-- Assurance Tagline -->
<div class="flex items-center justify-center gap-1 text-center pt-space-xs">
<span class="material-symbols-outlined text-[14px] text-tertiary">verified_user</span>
<p class="font-label-sm text-label-sm text-outline">Dana disimpan aman di Escrow KosAudit hingga Anda setuju</p>
</div>
</div>
<!-- Interactive JavaScript Handling -->
<script>
    function toggleDisputeForm() {
      const container = document.getElementById('dispute-form-container');
      if (container.classList.contains('hidden')) {
        container.classList.remove('hidden');
        document.getElementById('dispute-reason').focus();
      } else {
        container.classList.add('hidden');
      }
    }

    function handleApproval() {
      const btn = document.getElementById('btn-approve');
      btn.innerHTML = '<span class="material-symbols-outlined text-[20px] animate-spin">progress_activity</span><span>Memproses Pencairan...</span>';
      btn.disabled = true;
      setTimeout(() => {
        btn.classList.remove('bg-primary-container', 'hover:bg-primary');
        btn.classList.add('bg-tertiary-container');
        btn.innerHTML = '<span class="material-symbols-outlined text-[20px]">check</span><span>Disetujui! Dana Segera Dikirim</span>';
        alert('Terima kasih Dinda! Persetujuan Anda telah dicatat. Nominal Rp 350.000 akan ditransfer ke rekening BCA Anda dalam waktu maksimal 1x24 jam.');
      }, 1000);
    }

    function submitDispute() {
      const val = document.getElementById('dispute-reason').value.trim();
      if (!val) {
        alert('Silakan ketikkan detail keberatan Anda terlebih dahulu.');
        return;
      }
      alert('Sanggahan berhasil dikirim ke Pemilik Kos. Tim audit akan melakukan verifikasi ulang berkas check-in.');
      document.getElementById('dispute-form-container').classList.add('hidden');
    }
  </script>
</div>
@endsection