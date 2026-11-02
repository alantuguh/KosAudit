@extends('layouts.mobile')

@section('title', 'Kondisi Kamar 104')

@section('content')
<div class="flex flex-col w-full pb-10">
<div class="px-gutter-mobile pt-space-md flex flex-col gap-space-sm">
<div class="flex items-center gap-space-xs text-primary font-label-md text-label-md uppercase tracking-wider">
<span class="material-symbols-outlined text-[16px]">verified_user</span>
<span>Audit Transparan • KosAudit Protection</span>
</div>
<div class="flex flex-col gap-1">
<h1 class="font-headline-lg-mobile text-headline-lg-mobile text-on-surface">Hasil Komparasi Fisik Kamar 104</h1>
<p class="font-body-md text-body-md text-on-surface-variant">
        Audit foto check-in vs check-out oleh pengelola. Tinjau setiap temuan sebelum persetujuan deposit.
      </p>
</div>
<!-- Overview Metric Banner -->
<div class="bg-surface-container-high rounded-xl p-space-md flex items-center justify-between shadow-sm mt-space-xs">
<div class="flex items-center gap-space-sm">
<div class="w-11 h-11 rounded-full bg-secondary-container/20 flex items-center justify-center text-secondary">
<span class="material-symbols-outlined text-[24px]">balance</span>
</div>
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">8 Item Diperiksa</span>
<span class="font-body-sm text-body-sm text-secondary font-semibold flex items-center gap-1">
<span class="w-2 h-2 rounded-full bg-secondary-container inline-block"></span>
            2 item berkurang kualitasnya
          </span>
</div>
</div>
<div class="text-right">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Klaim Pengelola</span>
<span class="font-headline-sm text-headline-sm text-error">Rp 150.000</span>
</div>
</div>
<!-- Interactive Filter Pills -->
<div class="flex items-center gap-space-xs overflow-x-auto py-space-xs no-scrollbar mt-space-xs" id="categoryFilters">
<button class="filter-btn active-filter px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 bg-primary text-on-primary shadow-sm flex items-center gap-1.5 shrink-0" onclick="setFilter('all', this)">
<span class="material-symbols-outlined text-[15px]">list_alt</span>
        Semua (8)
      </button>
<button class="filter-btn px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 bg-surface-container text-on-surface-variant hover:bg-surface-container-highest shrink-0 flex items-center gap-1.5" onclick="setFilter('catatan', this)">
<span class="material-symbols-outlined text-[15px] text-error">priority_high</span>
        Ada Catatan (2)
      </button>
<button class="filter-btn px-3.5 py-1.5 rounded-full font-label-md text-label-md transition-all duration-200 bg-surface-container text-on-surface-variant hover:bg-surface-container-highest shrink-0 flex items-center gap-1.5" onclick="setFilter('baik', this)">
<span class="material-symbols-outlined text-[15px] text-tertiary">check_circle</span>
        Sesuai / Baik (6)
      </button>
</div>
</div>
<!-- Comparison Cards Feed -->
<div class="px-gutter-mobile flex flex-col gap-space-md mt-space-sm" id="itemFeed">
<!-- ITEM 1: AC Remote & Filter (Ada Catatan) -->
<div class="audit-item rounded-xl bg-surface-container-lowest p-4 shadow-sm flex flex-col gap-3" data-status="catatan">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-headline-sm text-headline-sm text-on-surface">Remote AC &amp; Filter</span>
<span class="px-2 py-0.5 rounded-full font-label-sm text-label-sm bg-error-container text-on-error-container">Lecet &amp; Kotor</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant">Elektronik • Unit Daikin 0.5 PK</span>
</div>
<div class="text-right">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Potongan Diajukan</span>
<span class="font-headline-sm text-headline-sm text-error font-mono-numeric">Rp 100.000</span>
</div>
</div>
<!-- Comparison Photographic Slider / Dual Frame -->
<div class="grid grid-cols-2 gap-2 bg-surface-container-low p-2 rounded-lg">
<!-- Check-in Frame -->
<div class="flex flex-col gap-1.5">
<div class="relative rounded-lg overflow-hidden h-36 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Close-up crisp photo of a clean Daikin air conditioner remote control and sparkling clean white air filter mesh lying on a wooden desk, brightly lit by morning sunlight in a modern minimalist rental studio, sharp macro details, authentic high-resolution inspection archival photo." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPp85cVKCKd1P0uhf7eAY3OdPWHUDKVwECFpfzYWe_ndrOAOkXNT5q1fh9x2zwYEzCjTPVySzG8TO-fNnuztjUSC4XkzvWldaOIMSs649M4Sql7qX6fILkZLICj2hQuXElsrx4YbcjyFIn-zPaU51WRuOp4lDxXqFglhqD2LVva-NuOQwhWGqmbBoQ-B49OdQ0XYOv3-TEvsUh8n9HQmSqu0rUM6NU6C4F9bRFKACZFhyrwRib38Cz"/>
<div class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-surface/90 backdrop-blur-sm text-primary font-label-sm text-label-sm font-semibold">
              Check-in (12 Jan)
            </div>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant px-0.5 leading-snug">
            Casing mulus utuh, filter dicuci bersih bebas debu.
          </p>
</div>
<!-- Check-out Frame -->
<div class="flex flex-col gap-1.5">
<div class="relative rounded-lg overflow-hidden h-36 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="High quality detailed inspection photo of an AC remote control with a cracked battery slider latch showing a loose flap, placed next to a grey dusty clogged air conditioner filter grid with accumulated room dust, indoor incandescent lighting, natural apartment inspection documentation style." src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiV04FukloTwmcqCjVi1LiuS80PKLBfE1yuUEcR65faYUZ1UtIoDaUM4SushGNGZmFZjleA1gydJmruFnNm4_E1RKkLpx3wW_Cm0hFYq6XQcYdYMIBYBuVpGNePUgfwKOZmDAoMTZSrq750HV-p5ahaz3pUPXKYch5lTN-_zUGfYTWY8N5qjKzXVMaz3CDSF4dmejVGU6ZTnwyDsdSStppOnhJcA9AWDJBStHxy4DkoE_lSVxgbXPq"/>
<div class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-error-container/90 backdrop-blur-sm text-on-error-container font-label-sm text-label-sm font-semibold">
              Check-out (Hari Ini)
            </div>
</div>
<p class="font-body-sm text-body-sm text-on-surface px-0.5 leading-snug font-medium">
            Kancing penutup batere patah, kisi filter berdebu tebal.
          </p>
</div>
</div>
<!-- Owner Audit Note Box -->
<div class="bg-surface-container-low rounded-lg p-3 flex flex-col gap-1.5">
<div class="flex items-center gap-1.5 text-on-surface-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[16px] text-secondary">assignment_late</span>
          Catatan Auditor Kos
        </div>
<p class="font-body-sm text-body-sm text-on-surface">
          "Pembersihan servis filter AC (Rp 60.000) dan penggantian tutup remote compatible (Rp 40.000)."
        </p>
</div>
<!-- Tenant Action Bar -->
<div class="flex items-center justify-between pt-1">
<button class="flex items-center gap-1 text-primary hover:text-on-primary-fixed-variant font-label-md text-label-md py-1">
<span class="material-symbols-outlined text-[18px]">zoom_in</span>
          Bandingkan Fullscreen
        </button>
<button class="px-3 py-1.5 rounded-lg bg-surface-container-highest text-primary hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors flex items-center gap-1" onclick="openResponseModal('Remote AC &amp; Filter', 'Rp 100.000')">
<span class="material-symbols-outlined text-[16px]">rate_review</span>
          Beri Tanggapan
        </button>
</div>
</div>
<!-- ITEM 2: Dinding Kamar (Cat) (Ada Catatan) -->
<div class="audit-item rounded-xl bg-surface-container-lowest p-4 shadow-sm flex flex-col gap-3" data-status="catatan">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-headline-sm text-headline-sm text-on-surface">Dinding Kamar (Cat)</span>
<span class="px-2 py-0.5 rounded-full font-label-sm text-label-sm bg-error-container text-on-error-container">Noda Lem Busa</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant">Struktur • Dinding Sisi Meja Belajar</span>
</div>
<div class="text-right">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Potongan Diajukan</span>
<span class="font-headline-sm text-headline-sm text-error font-mono-numeric">Rp 50.000</span>
</div>
</div>
<!-- Comparison Photographic Dual Frame -->
<div class="grid grid-cols-2 gap-2 bg-surface-container-low p-2 rounded-lg">
<div class="flex flex-col gap-1.5">
<div class="relative rounded-lg overflow-hidden h-36 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Pristine white painted bedroom wall in an Indonesian modern minimalist boarding house room, smooth surface without any holes, scratches, or marks, soft morning sunlight casting gentle light across plaster texture." src="https://lh3.googleusercontent.com/aida-public/AB6AXuC00ZtoEbRzonIA-WofjgaQYOozAUrpGGjIy47_AMLgDIge3u2pZTmEw2dtG2hRNkKoBIPjlnavo-XZOfuYJHPetp84odr3YOBFdSEdi54shdAmPZkKpB44OJ7Wcx1Nf_GKB2NVhd65gY_tTpgVzrIjSzaag21kSDECtvdTcnJ6VFhJpRooo_cCq6CSd6WuGLpIMN-cSj-mON2jtYZeTy6V0RTCNWPDzdL1wOVu145GD6a7K8EGIlo3"/>
<div class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-surface/90 backdrop-blur-sm text-primary font-label-sm text-label-sm font-semibold">
              Check-in (12 Jan)
            </div>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant px-0.5 leading-snug">
            Cat putih merata, bebas paku &amp; noda perekat.
          </p>
</div>
<div class="flex flex-col gap-1.5">
<div class="relative rounded-lg overflow-hidden h-36 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Inspection photo showing 2 torn square spots on a white wall caused by peeling off heavy duty double tape adhesive foam, revealing grey plaster underneath, realistic daylight indoor shot in studio boarding room." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCPCQ6fCnApe8ANMBDfoEz9dgshGVwcohrByIOLiV-JRFLoWoBGIN-Nqz9k9ANRXU-htUXft6CI1bS8Qqes_PhuWTUGnMcYE9OGNknN-1v-KnUN2WnZYKfXZkuuPMhq4SZMwH3qPWyPhN1GlPvOQ2UuMjySazLCTdhFSF6zjlCNgBPb6B02pm1RgGEfS2tTQVdWGbOW42X5taRUYfTLbzZwboCaf2qJF38AdBHLO7MEPGXUC5KEO_LE"/>
<div class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-error-container/90 backdrop-blur-sm text-on-error-container font-label-sm text-label-sm font-semibold">
              Check-out (Hari Ini)
            </div>
</div>
<p class="font-body-sm text-body-sm text-on-surface px-0.5 leading-snug font-medium">
            2 titik cat terkelupas akibat bekas foam tape cermin.
          </p>
</div>
</div>
<!-- Owner Audit Note Box -->
<div class="bg-surface-container-low rounded-lg p-3 flex flex-col gap-1.5">
<div class="flex items-center gap-1.5 text-on-surface-variant font-label-sm text-label-sm font-semibold">
<span class="material-symbols-outlined text-[16px] text-secondary">assignment_late</span>
          Catatan Auditor Kos
        </div>
<p class="font-body-sm text-body-sm text-on-surface">
          "Biaya kompon plamir semen putih &amp; cat spot touch-up 2 titik lem busa."
        </p>
</div>
<div class="flex items-center justify-between pt-1">
<button class="flex items-center gap-1 text-primary hover:text-on-primary-fixed-variant font-label-md text-label-md py-1">
<span class="material-symbols-outlined text-[18px]">zoom_in</span>
          Bandingkan Fullscreen
        </button>
<button class="px-3 py-1.5 rounded-lg bg-surface-container-highest text-primary hover:bg-primary hover:text-on-primary font-label-md text-label-md transition-colors flex items-center gap-1" onclick="openResponseModal('Dinding Kamar (Cat)', 'Rp 50.000')">
<span class="material-symbols-outlined text-[16px]">rate_review</span>
          Beri Tanggapan
        </button>
</div>
</div>
<!-- ITEM 3: Kasur & Ranjang (Wear & Tear - Non Potongan) -->
<div class="audit-item rounded-xl bg-surface-container-lowest p-4 shadow-sm flex flex-col gap-3" data-status="baik">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-headline-sm text-headline-sm text-on-surface">Kasur Springbed &amp; Dipan</span>
<span class="px-2 py-0.5 rounded-full font-label-sm text-label-sm bg-tertiary-fixed text-on-tertiary-fixed font-semibold">Bebas Biaya (Rp 0)</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant">Furnitur Utama • King Koil Single 120x200</span>
</div>
<div class="text-right">
<span class="font-label-sm text-label-sm text-on-surface-variant block">Status Audit</span>
<span class="font-headline-sm text-headline-sm text-tertiary font-mono-numeric">Lecet Wajar</span>
</div>
</div>
<!-- Single Comparative Preview -->
<div class="grid grid-cols-2 gap-2 bg-surface-container-low p-2 rounded-lg">
<div class="flex flex-col gap-1.5">
<div class="relative rounded-lg overflow-hidden h-32 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Neat springbed mattress with a pristine neutral fitted sheet resting on a warm oak timber wooden bedframe inside a tidy modern apartment room, warm atmospheric ambient light, interior photography." src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUGBCNvxzdkktIYs9SiP6-AOAmlLL4qaTn9AuzZTAad2VkgRQ2NpTjiiWroZ5hjyBcs7XKM5bQrcw1pnUOycQz7Z31D8Xa3mOhZPz700X4mHW1NiSc94-jLo_beMvK6ZmAuVcFvLPOOoA-bc0HUH681Rvh33QQiRhDjZc9XHGA2HM3aCcxYAcRkNXDl7232HKQh28TV7gQthyMLS0l00o1AhTYq7eppdv--WLU3Fb-zXNQ9V4oGC7L"/>
<div class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-surface/90 backdrop-blur-sm text-primary font-label-sm text-label-sm font-semibold">
              Check-in
            </div>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant px-0.5">Kondisi pegas padat, kain bersih.</p>
</div>
<div class="flex flex-col gap-1.5">
<div class="relative rounded-lg overflow-hidden h-32 bg-surface-container">
<img class="w-full h-full object-cover" data-alt="Well-maintained spring bed mattress on wooden frame showing slight natural fabric softening and minor corner scuffs on wood base consistent with 1 year of careful everyday use, bright clean room daylight." src="https://lh3.googleusercontent.com/aida-public/AB6AXuD0LCbifLTzvnDyOyUoDT22F0zyBllNqgqH5fttLYtuYj7EtElkLr9_SzzXWxsZmSCiqjhji5k3fyjbRRnDMdSatJF14zqSCKJCPgUZUcwUOR4a1QUurK_fYrOhfBMMdHogs4uEk28_hbc3U7b41gYdaohakkKHw3xCfyPbAWtXG8fYYlHtQSq3qJxEQy4AmixqQPdhT3MIykqugaIVXDSHHOgcFIwUIA1IIlNO_LME4_vadG0nxckt"/>
<div class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded bg-surface-container-high/90 backdrop-blur-sm text-on-surface font-label-sm text-label-sm font-semibold">
              Check-out
            </div>
</div>
<p class="font-body-sm text-body-sm text-on-surface px-0.5 font-medium">Penurunan kelenturan wajar 1 tahun.</p>
</div>
</div>
<div class="bg-surface-container-low rounded-lg p-2.5 flex items-center gap-2">
<span class="material-symbols-outlined text-tertiary text-[20px] shrink-0">verified</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">
          Dikategorikan sebagai <strong>Normal Wear &amp; Tear</strong> oleh sistem KosAudit. Sesuai kontrak sewa, Anda tidak dikenakan biaya penggantian pegas.
        </span>
</div>
</div>
<!-- ITEM 4: Lemari Pakaian & Kran Wastafel (Baik) -->
<div class="audit-item rounded-xl bg-surface-container-lowest p-4 shadow-sm flex flex-col gap-3" data-status="baik">
<div class="flex items-start justify-between">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-headline-sm text-headline-sm text-on-surface">Lemari 2 Pintu &amp; Wastafel</span>
<span class="px-2 py-0.5 rounded-full font-label-sm text-label-sm bg-tertiary-fixed text-on-tertiary-fixed">Kondisi Prima</span>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant">Furnitur &amp; Sanitasi • Sesuai standar</span>
</div>
<div class="flex items-center gap-1 text-tertiary">
<span class="material-symbols-outlined text-[20px]">task_alt</span>
<span class="font-label-md text-label-md">Verified</span>
</div>
</div>
<div class="flex items-center gap-3 bg-surface-container-low p-3 rounded-lg">
<div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center text-primary shrink-0">
<span class="material-symbols-outlined text-[26px]">water_drop</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-on-surface">Engsel lemari mulus, kran air lancar</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Tidak ada retak wastafel, kunci gembok lemari lengkap 2 anak kunci.</span>
</div>
</div>
</div>
<!-- ITEM 5-8: Compact Collapsed Good Items Summary -->
<div class="audit-item rounded-xl bg-surface-container-low p-3.5 shadow-sm flex items-center justify-between" data-status="baik">
<div class="flex items-center gap-3">
<div class="w-9 h-9 rounded-full bg-tertiary/10 text-tertiary flex items-center justify-center">
<span class="material-symbols-outlined text-[20px]">inventory_2</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-on-surface">4 Item Lainnya Lolos Audit</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Jendela, Saklar Lampu, Meja Kerja, Exhaust Fan</span>
</div>
</div>
<span class="material-symbols-outlined text-on-surface-variant text-[20px]">chevron_right</span>
</div>
</div>
<!-- Educational Trust / Wear & Tear Transparency Clause -->
<div class="px-gutter-mobile mt-space-md">
<div class="rounded-xl bg-surface-container p-space-md flex flex-col gap-2">
<div class="flex items-center gap-space-xs text-primary font-headline-sm text-headline-sm">
<span class="material-symbols-outlined text-[22px]">info</span>
<span>Jaminan Perlindungan Deposit</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant leading-relaxed">
        Berdasarkan standar <strong>Perjanjian Sewa KosAudit</strong>, kerusakan wajar akibat usia pemakaian (<em>fair wear and tear</em>) seperti pemudaran warna perabot, karet seal mengeras, atau kelonggaran engsel alami <strong>tidak boleh dipotong</strong> dari deposit Anda.
      </p>
<div class="flex items-center gap-2 pt-1 text-primary">
<span class="material-symbols-outlined text-[18px]">verified</span>
<span class="font-label-sm text-label-sm font-semibold">Telah Diverifikasi Mediator Independen KosAudit</span>
</div>
</div>
</div>
<!-- Sticky Bottom Quick Action Dock -->
<div class="sticky bottom-16 w-full px-gutter-mobile pt-3 pb-2 bg-surface/95 backdrop-blur-md shadow-lg flex flex-col gap-2 mt-space-lg">
<div class="flex items-center justify-between px-1">
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant">Sisa Deposit Dikembalikan</span>
<span class="font-headline-sm text-headline-sm text-primary font-mono-numeric">Rp 1.350.000 <span class="font-body-sm text-body-sm text-on-surface-variant font-normal">/ Rp 1.500.000</span></span>
</div>
<span class="px-2 py-0.5 rounded font-label-sm text-label-sm bg-surface-container-highest text-on-surface-variant font-medium">1 Hari Menuju Batas Refund</span>
</div>
<div class="grid grid-cols-2 gap-2">
<button class="w-full py-2.5 px-3 rounded-lg bg-surface-container-highest hover:bg-surface-container text-on-surface font-label-lg text-label-lg transition-colors flex items-center justify-center gap-1.5 shadow-sm" onclick="openResponseModal('Sanggahan Umum', 'Rp 150.000')">
<span class="material-symbols-outlined text-[18px]">add_a_photo</span>
        Kirim Sanggahan
      </button>
<button class="w-full py-2.5 px-3 rounded-lg bg-primary hover:bg-on-primary-fixed-variant text-on-primary font-label-lg text-label-lg transition-colors flex items-center justify-center gap-1.5 shadow-sm">
<span>Rincian Deposit</span>
<span class="material-symbols-outlined text-[18px]">arrow_forward</span>
</button>
</div>
</div>
<!-- Modal Sanggahan Tenant (Slide-up Dialog) -->
<div class="hidden fixed inset-0 z-50 bg-inverse-surface/40 backdrop-blur-sm flex items-end sm:items-center sm:justify-center p-0 sm:p-4" id="responseModal">
<div class="w-full max-w-md bg-surface-container-lowest rounded-t-2xl sm:rounded-2xl p-5 shadow-2xl flex flex-col gap-4 max-h-[751px] overflow-y-auto">
<div class="flex items-center justify-between pb-1">
<div class="flex flex-col">
<span class="font-headline-sm text-headline-sm text-on-surface">Formulir Sanggahan Bukti</span>
<span class="font-body-sm text-body-sm text-on-surface-variant" id="modalItemSubtitle">Remote AC &amp; Filter</span>
</div>
<button class="w-8 h-8 rounded-full bg-surface-container flex items-center justify-center text-on-surface-variant hover:text-on-surface" onclick="closeResponseModal()">
<span class="material-symbols-outlined text-[20px]">close</span>
</button>
</div>
<div class="p-3 bg-surface-container-low rounded-lg flex flex-col gap-1">
<span class="font-label-sm text-label-sm text-on-surface-variant">Nominal yang Diperdebatkan</span>
<span class="font-headline-sm text-headline-sm text-error" id="modalDeductionAmount">Rp 100.000</span>
</div>
<!-- Evidence Upload Area -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Unggah Foto / Video Tandingan</label>
<div class="rounded-xl p-4 bg-surface-container-low flex flex-col items-center justify-center text-center gap-2 cursor-pointer hover:bg-surface-container transition-colors">
<div class="w-10 h-10 rounded-full bg-primary/10 text-primary flex items-center justify-center">
<span class="material-symbols-outlined text-[22px]">cloud_upload</span>
</div>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-on-surface">Ambil foto tandingan atau dokumen</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Sertakan timestamp untuk validitas peninjauan</span>
</div>
</div>
</div>
<!-- Text Clarification Input -->
<div class="flex flex-col gap-1.5">
<label class="font-label-md text-label-md text-on-surface">Alasan &amp; Kronologi Penyewa</label>
<textarea class="w-full p-3 rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm focus:outline-none focus:bg-surface-container" placeholder="Contoh: Tutup remote sudah longgar sejak bulan kedua dan sudah dilaporkan via chat WA pada 4 Maret..." rows="3"></textarea>
</div>
<div class="grid grid-cols-2 gap-2 pt-2">
<button class="py-2.5 rounded-lg bg-surface-container text-on-surface font-label-lg text-label-lg" onclick="closeResponseModal()">
          Batal
        </button>
<button class="py-2.5 rounded-lg bg-primary text-on-primary font-label-lg text-label-lg shadow-sm flex items-center justify-center gap-1" onclick="submitResponse()">
<span class="material-symbols-outlined text-[18px]">send</span>
          Ajukan Banding
        </button>
</div>
</div>
</div>
</div>
<script>
  function setFilter(filterType, element) {
    const buttons = document.querySelectorAll('#categoryFilters .filter-btn');
    buttons.forEach(btn => {
      btn.classList.remove('bg-primary', 'text-on-primary', 'shadow-sm');
      btn.classList.add('bg-surface-container', 'text-on-surface-variant');
    });

    element.classList.remove('bg-surface-container', 'text-on-surface-variant');
    element.classList.add('bg-primary', 'text-on-primary', 'shadow-sm');

    const cards = document.querySelectorAll('#itemFeed .audit-item');
    cards.forEach(card => {
      const status = card.getAttribute('data-status');
      if (filterType === 'all') {
        card.style.display = 'flex';
      } else if (filterType === 'catatan') {
        card.style.display = status === 'catatan' ? 'flex' : 'none';
      } else if (filterType === 'baik') {
        card.style.display = status === 'baik' ? 'flex' : 'none';
      }
    });
  }

  function openResponseModal(itemName, amount) {
    document.getElementById('modalItemSubtitle').innerText = itemName;
    document.getElementById('modalDeductionAmount').innerText = amount;
    document.getElementById('responseModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
  }

  function closeResponseModal() {
    document.getElementById('responseModal').classList.add('hidden');
    document.body.style.overflow = '';
  }

  function submitResponse() {
    alert('Sanggahan berhasil dikirim ke pengelola dan tim mediasi KosAudit.');
    closeResponseModal();
  }
</script>
@endsection