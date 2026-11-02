@extends('layouts.mobile')

@section('title', 'Rincian Deposit Kamar 104')

@section('content')
<div class="flex flex-col w-full px-margin-mobile space-y-space-md pb-6">
<!-- Stepper Status Audit & Escrow -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex flex-col gap-space-sm">
<div class="flex items-center justify-between">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-primary text-[20px]" style="font-variation-settings: 'FILL' 1;">security</span>
<span class="font-label-md text-label-md text-on-surface">Penyelesaian Garansi Kamar</span>
</div>
<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-label-sm font-label-sm bg-primary-fixed text-on-primary-fixed font-semibold">
<span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
        Dana di Escrow
      </span>
</div>
<!-- Mini Progress Path -->
<div class="grid grid-cols-4 gap-1.5 pt-1">
<div class="h-1.5 rounded-full bg-primary"></div>
<div class="h-1.5 rounded-full bg-primary"></div>
<div class="h-1.5 rounded-full bg-primary"></div>
<div class="h-1.5 rounded-full bg-surface-container-highest"></div>
</div>
<div class="flex justify-between text-on-surface-variant font-label-sm text-label-sm">
<span class="text-primary font-semibold">1. Inspeksi</span>
<span class="text-primary font-semibold">2. Kalkulasi</span>
<span class="text-primary font-semibold font-bold">3. Verifikasi</span>
<span>4. Cair</span>
</div>
</div>
<!-- Hero Card Nominal Pengembalian Bersih -->
<div class="bg-gradient-to-br from-primary-container to-primary text-on-primary p-space-md rounded-xl shadow-md relative overflow-hidden">
<div class="absolute -right-8 -top-8 w-32 h-32 rounded-full bg-on-primary/10 pointer-events-none blur-xl"></div>
<div class="flex items-center justify-between mb-space-xs relative z-10">
<span class="font-label-md text-label-md text-on-primary-container tracking-wider uppercase">Estimasi Pengembalian Bersih</span>
<span class="material-symbols-outlined text-on-primary-container text-[20px]">account_balance_wallet</span>
</div>
<div class="flex items-baseline gap-2 mb-space-md relative z-10">
<span class="font-display text-display text-on-primary tracking-tight font-bold">Rp 350.000</span>
<span class="font-body-sm text-body-sm text-on-primary-container">/ 100% cair</span>
</div>
<!-- Breakdown Ringkas -->
<div class="bg-on-primary/10 rounded-lg p-space-sm grid grid-cols-2 gap-2 text-on-primary relative z-10 backdrop-blur-sm">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-primary-container">Deposit Awal</span>
<span class="font-mono-numeric text-mono-numeric font-semibold">Rp 500.000</span>
</div>
<div class="flex flex-col text-right">
<span class="font-label-sm text-label-sm text-on-primary-container">Total Pemotongan</span>
<span class="font-mono-numeric text-mono-numeric text-secondary-fixed font-semibold">-Rp 150.000</span>
</div>
</div>
<div class="mt-space-sm flex items-center justify-center gap-1.5 text-on-primary-container font-label-sm text-label-sm">
<span class="material-symbols-outlined text-[16px]">verified</span>
<span>Dana Aman di Escrow KosAudit hingga Anda konfirmasi</span>
</div>
</div>
<!-- Rincian Biaya & Transparansi Nota -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm space-y-space-md">
<div class="flex items-center justify-between">
<div>
<h2 class="font-headline-sm text-headline-sm text-on-surface">Rincian Perbaikan Kamar</h2>
<p class="font-body-sm text-body-sm text-on-surface-variant">Berdasarkan hasil checklist checkout tanggal 28 Feb</p>
</div>
<span class="p-2 rounded-full bg-surface-container-high text-primary">
<span class="material-symbols-outlined text-[20px]">receipt_long</span>
</span>
</div>
<!-- List Items -->
<div class="space-y-space-sm">
<!-- Item 1: Remote AC -->
<div class="bg-surface p-space-sm rounded-lg flex flex-col gap-2">
<div class="flex items-start justify-between">
<div class="flex gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">ac_unit</span>
<div>
<p class="font-label-lg text-label-lg text-on-surface">Ganti Unit Remote AC &amp; Tutup</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Layar LCD pecah &amp; penutup baterai hilang</p>
</div>
</div>
<span class="font-mono-numeric text-mono-numeric text-secondary font-bold">-Rp 100.000</span>
</div>
<!-- Lampiran Nota Bukti -->
<div class="flex items-center justify-between bg-surface-container-high px-space-sm py-1.5 rounded text-on-surface">
<div class="flex items-center gap-1.5 min-w-0">
<span class="material-symbols-outlined text-[16px] text-primary">attach_file</span>
<span class="font-label-sm text-label-sm truncate">Nota: Mitra Elektronik (28/02)</span>
</div>
<button class="font-label-sm text-label-sm text-primary font-bold hover:underline flex items-center gap-0.5">
            Lihat Bukti
            <span class="material-symbols-outlined text-[14px]">open_in_new</span>
</button>
</div>
</div>
<!-- Item 2: Dinding -->
<div class="bg-surface p-space-sm rounded-lg flex flex-col gap-2">
<div class="flex items-start justify-between">
<div class="flex gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[20px] mt-0.5">format_paint</span>
<div>
<p class="font-label-lg text-label-lg text-on-surface">Cat &amp; Dempul Dinding (2 Titik)</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Bekas paku gantungan pakaian &amp; perekat double-tape</p>
</div>
</div>
<span class="font-mono-numeric text-mono-numeric text-secondary font-bold">-Rp 50.000</span>
</div>
<div class="flex items-center gap-2">
<div class="w-12 h-12 rounded bg-surface-container overflow-hidden relative">
<img class="w-full h-full object-cover" data-alt="Close up photograph of a white bedroom wall inside an Indonesian boarding house showing peeling paint and two small nail holes marked during checkout inspection, soft daylight" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDxE7XDtMtdh4KpbXxhUXlHCj_dntoDNw_ypyHCrZdm_1hj-MJdkmcP3m9-k_huG2SKTD5Ngr3pLTVXmhfTnwnZmcZ8NsGXIPtl5a43JAhhqdB8DE8iheoqPEpNKecL11EF6dPTFOIf4lJ_dVuJ5okqfn64FR-xA4V8LHsxYvQlM7jf1R0DRgt72NttG8hUnVkacqTxkBaFzfmGDAA9vkzh1QoE4BVCk6R4HzfbWXCk-62p0Tl4cYuT"/>
</div>
<div class="w-12 h-12 rounded bg-surface-container overflow-hidden relative">
<img class="w-full h-full object-cover" data-alt="Close up macro shot of paint peel damage from industrial adhesive tape on room 104 drywall, bright indoor light with audit calibration tape" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB_R0vMg_zKPiUF4ckxdNPUUn-DLZQaLXvL-aCs0RhtEeUcttvkVijVDLuuf7BOdpgZvlgbK9BVcaGavaRqbvSR-A3tVEwJdnCwSzKDuQR8I7Uco0MKIPnmh1os7RfuCQ0F1nt4VAuW5owvTOk4CGi-Fwwk1LigPNEeaQAQ3NzRDZitD3t7_ilDI9AC5rjiQK8NvdRoZUDb-GCYKT12XydUocL5U8ZvaNwi0W-ZxpXRIxTTJCEVU4MP"/>
</div>
<span class="font-label-sm text-label-sm text-on-surface-variant">2 foto dokumentasi</span>
</div>
</div>
<!-- Item 3: Kasur (Rp 0 - Ditanggung) -->
<div class="bg-surface p-space-sm rounded-lg flex items-center justify-between">
<div class="flex items-start gap-space-xs">
<span class="material-symbols-outlined text-tertiary text-[20px] mt-0.5">bed</span>
<div>
<p class="font-label-lg text-label-lg text-on-surface">Cuci Sprei &amp; Matras Deep-Clean</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Perawatan berkala rutin kos</p>
</div>
</div>
<div class="text-right">
<span class="font-mono-numeric text-mono-numeric text-tertiary font-bold">Rp 0</span>
<p class="font-label-sm text-label-sm text-on-tertiary-container font-semibold bg-tertiary-fixed px-1.5 rounded">Ditanggung Owner</p>
</div>
</div>
</div>
</div>
<!-- Rekening Pencairan Pengembalian -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm">
<div class="flex items-center justify-between mb-space-sm">
<span class="font-label-md text-label-md text-on-surface-variant uppercase tracking-wider">Rekening Tujuan Pencairan</span>
<button class="font-label-sm text-label-sm text-primary font-bold hover:underline flex items-center gap-0.5">
<span class="material-symbols-outlined text-[16px]">edit</span>
        Ubah Rekening
      </button>
</div>
<div class="flex items-center gap-space-sm p-space-sm bg-surface-container-low rounded-lg">
<div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary">
<span class="material-symbols-outlined text-[20px]">account_balance</span>
</div>
<div class="flex-1 min-w-0">
<div class="flex items-center gap-2">
<span class="font-label-lg text-label-lg text-on-surface font-bold">BCA</span>
<span class="font-mono-numeric text-mono-numeric text-on-surface">••••••5678</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant truncate">a.n Dinda Kirana Maharani</p>
</div>
<span class="material-symbols-outlined text-tertiary text-[20px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
</div>
</div>
<!-- Sanggahan Panel (Expandable Toggle) -->
<div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
<button class="w-full p-space-md flex items-center justify-between text-left hover:bg-surface transition-colors" id="toggle-dispute-btn" onclick="toggleDisputeForm()">
<div class="flex items-center gap-space-xs">
<span class="material-symbols-outlined text-secondary text-[22px]">gavel</span>
<div>
<p class="font-label-lg text-label-lg text-on-surface font-bold">Tidak sepakat dengan potongan?</p>
<p class="font-body-sm text-body-sm text-on-surface-variant">Buka sanggahan resmi &amp; lampirkan foto tandingan</p>
</div>
</div>
<span class="material-symbols-outlined text-on-surface-variant text-[22px] transition-transform duration-200" id="dispute-chevron">expand_more</span>
</button>
<!-- Expanded Dispute Module Form -->
<div class="hidden p-space-md pt-0 bg-surface-container-lowest space-y-space-md" id="dispute-form-wrapper">
<div class="p-space-sm bg-secondary-fixed/30 rounded-lg flex items-start gap-space-xs text-on-secondary-container">
<span class="material-symbols-outlined text-secondary text-[18px] shrink-0 mt-0.5">info</span>
<p class="font-body-sm text-body-sm">
          Pengajuan sanggahan akan menahan transfer sementara di rekening penampung (Escrow). Pengelola memiliki 1x24 jam untuk menanggapi bukti tandingan.
        </p>
</div>
<!-- Pilih Item Sanggahan -->
<div class="space-y-space-xs">
<label class="font-label-md text-label-md text-on-surface font-semibold block">Pilih Pemotongan yang Disanggah</label>
<div class="space-y-2">
<label class="flex items-center gap-2 p-2 bg-surface rounded-lg cursor-pointer">
<input checked="" class="w-4 h-4 accent-primary rounded" name="item_dispute" type="checkbox" value="cat"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">Cat &amp; Dempul Dinding (Rp 50.000)</span>
</label>
<label class="flex items-center gap-2 p-2 bg-surface rounded-lg cursor-pointer">
<input class="w-4 h-4 accent-primary rounded" name="item_dispute" type="checkbox" value="ac"/>
<span class="font-body-sm text-body-sm text-on-surface flex-1">Ganti Unit Remote AC (Rp 100.000)</span>
</label>
</div>
</div>
<!-- Upload Foto Tandingan -->
<div class="space-y-space-xs">
<label class="font-label-md text-label-md text-on-surface font-semibold block">Unggah Bukti Tandingan (Foto Check-in Awal)</label>
<div class="grid grid-cols-3 gap-2">
<!-- Placeholder Uploaded 1 -->
<div class="relative w-full aspect-square rounded-lg bg-surface-container overflow-hidden group">
<img class="w-full h-full object-cover" data-alt="Smartphone screen capture of an initial check-in inspection photo of a boarding house wall with timestamp metadata showing preexisting adhesive tape stains, clean interior lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCc_ynBoeRcbbp8koETkYh5O3_4JbrZvO-a_dkSDomPczGIqXZHhp2MADaYOVUt8K6DO3ufDrE7OkN1IZqty2z_EX36VzhozmkP62LAPRe_1wYcfHVqAMI0ar_JWAbq90CmZYg2NQERAkVQ5NwofClJZsMFvfmev_tP52GuXt4ePY0YlNssIFbi2NsWhnekTP7iaQ1xSC5f9H7eA6qH2Osmzs3jDwkvMDhViWkghZ3QFUVOKhrR-GDP"/>
<button class="absolute top-1 right-1 w-5 h-5 rounded-full bg-error text-on-error flex items-center justify-center text-[12px]">
<span class="material-symbols-outlined text-[14px]">close</span>
</button>
</div>
<!-- Upload Trigger Area -->
<button class="w-full aspect-square rounded-lg bg-surface flex flex-col items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
<span class="material-symbols-outlined text-[24px]">add_a_photo</span>
<span class="font-label-sm text-label-sm mt-1">Tambah Foto</span>
</button>
</div>
</div>
<!-- Catatan Negosiasi -->
<div class="space-y-space-xs">
<label class="font-label-md text-label-md text-on-surface font-semibold block" for="dispute-notes">Pesan untuk Pemilik Kos</label>
<textarea class="w-full bg-surface p-space-sm rounded-lg text-on-surface font-body-sm text-body-sm focus:outline-none focus:ring-2 focus:ring-primary" id="dispute-notes" placeholder="Jelaskan alasan, misal: Bekas double-tape di dinding sudah ada sebelum serah terima kunci pada tanggal 1 Agustus..." rows="3"></textarea>
</div>
<!-- Tombol Kirim Sanggahan -->
<button class="w-full py-2.5 px-space-md bg-secondary text-on-secondary rounded-lg font-label-lg text-label-lg font-bold flex items-center justify-center gap-2 shadow-sm active:scale-[0.99] transition-transform" onclick="submitDispute()">
<span class="material-symbols-outlined text-[18px]">send</span>
        Kirim Berkas Sanggahan Resmi
      </button>
</div>
</div>
<!-- Aksi Utama Penghuni (Bottom Fixed Anchor Feel) -->
<div class="space-y-space-xs pt-space-xs">
<button class="w-full py-3.5 px-space-md bg-primary hover:bg-primary-container text-on-primary rounded-xl font-headline-sm text-headline-sm font-bold flex items-center justify-center gap-2 shadow-md active:scale-[0.99] transition-transform" onclick="approvePayout()">
<span class="material-symbols-outlined text-[22px]">payments</span>
      Setuju &amp; Cairkan Rp 350.000
    </button>
<div class="flex items-center justify-center gap-1.5 text-on-surface-variant font-label-sm text-label-sm pt-1">
<span class="material-symbols-outlined text-[16px] text-tertiary">bolt</span>
<span>Proses otomatis via BI-Fast dalam 15 menit ke rekening BCA</span>
</div>
</div>
<!-- Modal Sukses Konfirmasi Pencairan (Hidden Default) -->
<div class="hidden fixed inset-0 z-50 bg-inverse-surface/60 backdrop-blur-sm flex items-center justify-center p-gutter-mobile" id="success-modal">
<div class="bg-surface-container-lowest rounded-xl p-space-lg w-full max-w-sm flex flex-col items-center text-center shadow-xl space-y-space-md">
<div class="w-14 h-14 rounded-full bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed">
<span class="material-symbols-outlined text-[32px]">check_circle</span>
</div>
<div>
<h3 class="font-headline-sm text-headline-sm text-on-surface font-bold">Pencairan Diproses!</h3>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
          Dana sebesar <strong class="text-on-surface">Rp 350.000</strong> sedang ditransfer ke rekening BCA ••••••5678. Resi audit telah dikirimkan ke email terdaftar Anda.
        </p>
</div>
<button class="w-full py-2.5 bg-primary text-on-primary rounded-lg font-label-lg text-label-lg font-bold" onclick="closeModal()">
        Selesai &amp; Ke Beranda
      </button>
</div>
</div>
</div>
<script>
  function toggleDisputeForm() {
    const form = document.getElementById('dispute-form-wrapper');
    const chevron = document.getElementById('dispute-chevron');
    const isHidden = form.classList.contains('hidden');

    if (isHidden) {
      form.classList.remove('hidden');
      chevron.style.transform = 'rotate(180deg)';
      form.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } else {
      form.classList.add('hidden');
      chevron.style.transform = 'rotate(0deg)';
    }
  }

  function approvePayout() {
    const modal = document.getElementById('success-modal');
    modal.classList.remove('hidden');
  }

  function submitDispute() {
    alert('Sanggahan Anda berhasil direkam dalam log audit KosAudit. Notifikasi resmi dan bukti tandingan telah diteruskan ke pemilik kos.');
    const form = document.getElementById('dispute-form-wrapper');
    const chevron = document.getElementById('dispute-chevron');
    form.classList.add('hidden');
    chevron.style.transform = 'rotate(0deg)';
  }

  function closeModal() {
    const modal = document.getElementById('success-modal');
    modal.classList.add('hidden');
  }
</script>
@endsection