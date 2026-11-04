@extends('layouts.app')

@section('title', 'Dashboard Pemilik')

@section('content')
@php
    $aktivitasList = [
        ['init' => 'DK', 'bg' => 'bg-secondary-fixed/50 text-on-secondary-fixed', 'nama' => 'Dinda Kirana', 'hp' => '0812-4421-9901', 'kamar' => '104', 'tipe' => 'AC Standar', 'jenis' => 'Check-out', 'tgl' => '24 Mei 2025', 'status' => 'Menunggu Verifikasi Deposit', 'aksi' => 'Periksa Hasil', 'btn_cls' => 'bg-primary-container text-on-primary shadow-xs', 'row_cls' => ''],
        ['init' => 'BW', 'bg' => 'bg-primary-fixed/50 text-primary', 'nama' => 'Budi Wicaksono', 'hp' => '0857-1190-2384', 'kamar' => '202', 'tipe' => 'Deluxe', 'jenis' => 'Check-in', 'tgl' => '22 Mei 2025', 'status' => 'Disetujui Penghuni', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'NS', 'bg' => 'bg-surface-container-highest text-on-surface-variant', 'nama' => 'Nabila Salma', 'hp' => '0821-3990-1288', 'kamar' => '108', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '20 Mei 2025', 'status' => 'Deposit Dikembalikan (Rp 420.000)', 'aksi' => 'Kuitansi', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'KS', 'bg' => 'bg-primary-fixed/50 text-primary', 'nama' => 'Kevin Sanjaya', 'hp' => '0813-9022-8311', 'kamar' => '301', 'tipe' => 'VIP', 'jenis' => 'Check-in', 'tgl' => '18 Mei 2025', 'status' => 'Selesai Inspeksi', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'MP', 'bg' => 'bg-error-container text-error', 'nama' => 'Melisa Putri', 'hp' => '0819-0122-3841', 'kamar' => '205', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '15 Mei 2025', 'status' => 'Ada Keberatan', 'aksi' => 'Review Keberatan', 'btn_cls' => 'bg-error text-on-error shadow-xs', 'row_cls' => 'bg-error-container/20'],
        ['init' => 'FA', 'bg' => 'bg-primary-fixed/50 text-primary', 'nama' => 'Farhan Alamsyah', 'hp' => '0812-9988-1022', 'kamar' => '105', 'tipe' => 'VIP', 'jenis' => 'Check-in', 'tgl' => '12 Mei 2025', 'status' => 'Selesai Inspeksi', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'SR', 'bg' => 'bg-surface-container-highest text-on-surface-variant', 'nama' => 'Siti Rahmawati', 'hp' => '0856-7812-4433', 'kamar' => '101', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '10 Mei 2025', 'status' => 'Deposit Dikembalikan (Rp 500.000)', 'aksi' => 'Kuitansi', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'RP', 'bg' => 'bg-secondary-fixed/50 text-on-secondary-fixed', 'nama' => 'Rian Pratama', 'hp' => '0877-2234-9910', 'kamar' => '102', 'tipe' => 'Standar', 'jenis' => 'Check-in', 'tgl' => '8 Mei 2025', 'status' => 'Disetujui Penghuni', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'RK', 'bg' => 'bg-error-container text-error', 'nama' => 'Riko Prasetyo', 'hp' => '0813-8877-0019', 'kamar' => '112', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '6 Mei 2025', 'status' => 'Ada Keberatan', 'aksi' => 'Review Keberatan', 'btn_cls' => 'bg-error text-on-error shadow-xs', 'row_cls' => 'bg-error-container/20'],
        ['init' => 'AR', 'bg' => 'bg-primary-fixed/50 text-primary', 'nama' => 'Anisa Rahmawati', 'hp' => '0819-3321-7788', 'kamar' => '106', 'tipe' => 'Standar', 'jenis' => 'Check-in', 'tgl' => '5 Mei 2025', 'status' => 'Selesai Inspeksi', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'AF', 'bg' => 'bg-secondary-fixed/50 text-on-secondary-fixed', 'nama' => 'Ahmad Fauzi', 'hp' => '0812-7788-3344', 'kamar' => '203', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '3 Mei 2025', 'status' => 'Menunggu Verifikasi Deposit', 'aksi' => 'Periksa Hasil', 'btn_cls' => 'bg-primary-container text-on-primary shadow-xs', 'row_cls' => ''],
        ['init' => 'DL', 'bg' => 'bg-primary-fixed-dim text-on-primary-fixed', 'nama' => 'Dewi Lestari', 'hp' => '0822-1144-8899', 'kamar' => '204', 'tipe' => 'Deluxe', 'jenis' => 'Check-in', 'tgl' => '2 Mei 2025', 'status' => 'Disetujui Penghuni', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'BP', 'bg' => 'bg-surface-container-highest text-on-surface-variant', 'nama' => 'Bayu Pratama', 'hp' => '0852-6677-2211', 'kamar' => '207', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '29 Apr 2025', 'status' => 'Deposit Dikembalikan (Rp 450.000)', 'aksi' => 'Kuitansi', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'CK', 'bg' => 'bg-primary-fixed/50 text-primary', 'nama' => 'Citra Kirana', 'hp' => '0811-9988-4455', 'kamar' => '206', 'tipe' => 'VIP', 'jenis' => 'Check-in', 'tgl' => '26 Apr 2025', 'status' => 'Disetujui Penghuni', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'EP', 'bg' => 'bg-secondary-fixed/50 text-on-secondary-fixed', 'nama' => 'Eko Prasetyo', 'hp' => '0878-5544-1122', 'kamar' => '302', 'tipe' => 'Standar', 'jenis' => 'Check-out', 'tgl' => '23 Apr 2025', 'status' => 'Selesai Inspeksi', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'FR', 'bg' => 'bg-primary-fixed text-primary', 'nama' => 'Fani Rahmawati', 'hp' => '0813-2211-9900', 'kamar' => '303', 'tipe' => 'Standar', 'jenis' => 'Check-in', 'tgl' => '20 Apr 2025', 'status' => 'Disetujui Penghuni', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'GR', 'bg' => 'bg-surface-container-highest text-on-surface-variant', 'nama' => 'Gilang Ramadhan', 'hp' => '0819-4455-6677', 'kamar' => '304', 'tipe' => 'Deluxe', 'jenis' => 'Check-out', 'tgl' => '16 Apr 2025', 'status' => 'Deposit Dikembalikan (Rp 300.000)', 'aksi' => 'Kuitansi', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
        ['init' => 'HW', 'bg' => 'bg-primary-fixed/50 text-primary', 'nama' => 'Hani Wijaya', 'hp' => '0857-1122-3344', 'kamar' => '306', 'tipe' => 'VIP', 'jenis' => 'Check-in', 'tgl' => '12 Apr 2025', 'status' => 'Selesai Inspeksi', 'aksi' => 'Lihat Detail', 'btn_cls' => 'bg-surface-container-low text-on-surface', 'row_cls' => ''],
    ];
@endphp

<div class="flex flex-col w-full space-y-space-xl">
    {{-- Top Greeting & Control Strip --}}
    <div class="flex flex-col xl:flex-row xl:items-center justify-between gap-space-lg bg-surface-container-lowest p-space-lg rounded-xl shadow-sm relative overflow-hidden">
        <div class="absolute -right-16 -top-16 w-64 h-64 bg-primary-fixed/30 rounded-full blur-3xl pointer-events-none"></div>
        <div class="flex flex-col space-y-1 relative z-10">
            <div class="flex flex-wrap items-center gap-space-sm">
                <span class="font-headline-lg text-headline-lg text-on-surface">Selamat Datang, Pemilik Kos</span>
                <span class="inline-flex items-center gap-1.5 px-space-sm py-0.5 rounded-full bg-surface-container text-primary font-label-sm text-label-sm">
                    <span class="w-2 h-2 rounded-full bg-primary-container animate-pulse"></span>
                    Kost Putri Griya Asri • {{ $roomSummary['total'] }} Kamar Total
                </span>
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant flex items-center gap-1.5">
                <span class="material-symbols-outlined text-[16px] text-outline">verified</span>
                Ringkasan kamar dan akun penghuni tersambung ke backend. Data inspeksi dan deposit masih berupa pratinjau.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-space-sm relative z-10">
            <div class="flex items-center gap-space-xs bg-surface-container-low px-space-md py-2 rounded-lg text-on-surface-variant font-label-md text-label-md">
                <span class="material-symbols-outlined text-[18px] text-outline">calendar_month</span>
                <span>Bulan Ini (Mei 2025)</span>
            </div>
            <a href="{{ route('inspeksi.create') }}"
               class="px-space-md py-2 bg-primary-container hover:bg-primary text-on-primary font-label-md text-label-md rounded-lg flex items-center gap-space-xs shadow-sm transition-all">
                <span class="material-symbols-outlined text-[18px]">add_task</span>
                <span>+ Mulai Inspeksi Baru</span>
            </a>
        </div>
    </div>

    {{-- 4 Summary Metric Cards (Reusable <x-stat-card />) --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-space-lg">
        <x-stat-card label="Kamar Terisi" :value="$roomSummary['occupied']" :unit="'/ '.$roomSummary['total']" icon="bed" iconBg="bg-surface-container-low text-primary" subtitle="Status dari database" />
        <x-stat-card label="Kamar Kosong" :value="$roomSummary['available']" unit="Unit" icon="meeting_room" iconBg="bg-surface-container-low text-outline" subtitle="Tersedia untuk disewa" />
        <x-stat-card label="Tenant Terdaftar" :value="$roomSummary['tenants']" unit="Akun" icon="group" iconBg="bg-secondary-fixed/30 text-secondary" subtitle="Akun pada backend" />
        <x-stat-card label="Butuh Perbaikan" :value="$roomSummary['repair']" unit="Kamar" icon="construction" iconBg="bg-primary-fixed/40 text-primary-container" subtitle="Status dari database" />
    </div>

    {{-- Main Split Layout (Aktivitas Terbaru TablePlus & Keberatan Penghuni) --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-space-lg items-start">
        {{-- Left Column: Aktivitas Terbaru (TablePlus) --}}
        <div class="lg:col-span-8 bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden flex flex-col">
            <div class="p-space-lg flex flex-col sm:flex-row sm:items-center justify-between gap-space-md bg-surface-container-lowest">
                <div>
                    <h2 class="font-headline-sm text-headline-sm text-on-surface">Aktivitas Terbaru</h2>
                    <p class="font-body-sm text-body-sm text-outline mt-0.5">Catatan check-in, check-out, serta status penahanan dan verifikasi deposit</p>
                </div>
                <div class="flex flex-wrap items-center gap-space-sm">
                    <div class="relative w-full sm:w-60">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                        <input id="search-dashboard"
                               class="w-full h-9 pl-9 pr-space-md rounded-lg bg-surface-container-low text-on-surface font-body-sm text-body-sm placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest focus:ring-1 focus:ring-primary transition-all"
                               placeholder="Cari aktivitas..."
                               type="text"/>
                    </div>
                    <div class="flex items-center gap-space-xs" id="dashboard-filter-buttons">
                        <button data-filter="all" class="px-space-sm py-1.5 rounded-lg bg-primary-container text-on-primary font-label-sm text-label-sm shadow-xs transition-all">Semua</button>
                        <button data-filter="checkout" class="px-space-sm py-1.5 rounded-lg text-outline hover:bg-surface-container-low font-label-sm text-label-sm transition-colors">Check-out</button>
                        <button data-filter="action" class="px-space-sm py-1.5 rounded-lg text-outline hover:bg-surface-container-low font-label-sm text-label-sm transition-colors">Perlu Tindakan</button>
                    </div>
                </div>
            </div>

            <div class="w-full overflow-x-auto">
                <table id="dashboard-table" class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-surface-container-low text-outline font-label-sm text-label-sm uppercase tracking-wider">
                            <th class="py-3 px-space-lg font-semibold">Penghuni</th>
                            <th class="py-3 px-space-md font-semibold">Kamar</th>
                            <th class="py-3 px-space-md font-semibold">Inspeksi</th>
                            <th class="py-3 px-space-md font-semibold">Tanggal</th>
                            <th class="py-3 px-space-md font-semibold">Status Audit</th>
                            <th class="py-3 px-space-lg text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-surface-container text-on-surface font-body-sm text-body-sm">
                        @foreach ($aktivitasList as $row)
                            <tr class="hover:bg-surface-container-low/40 transition-colors {{ $row['row_cls'] }}">
                                <td class="py-3.5 px-space-lg">
                                    <div class="flex items-center gap-space-sm">
                                        <div class="w-8 h-8 rounded-full {{ $row['bg'] }} flex items-center justify-center font-semibold text-label-sm">
                                            {{ $row['init'] }}
                                        </div>
                                        <div>
                                            <p class="font-label-md text-label-md text-on-surface leading-tight font-semibold">{{ $row['nama'] }}</p>
                                            <p class="font-label-sm text-label-sm text-outline">{{ $row['hp'] }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-3.5 px-space-md">
                                    <a href="{{ route('kamar.show', $row['kamar']) }}" class="font-mono-numeric font-semibold text-on-surface hover:text-primary hover:underline">
                                        Kamar {{ $row['kamar'] }}
                                    </a>
                                    <span class="block text-outline text-[11px]">{{ $row['tipe'] }}</span>
                                </td>
                                <td class="py-3.5 px-space-md">
                                    <span class="inline-flex items-center gap-1 font-label-sm text-label-sm {{ $row['jenis'] === 'Check-out' ? 'text-secondary' : 'text-tertiary' }} font-medium">
                                        <span class="material-symbols-outlined text-[14px]">{{ $row['jenis'] === 'Check-out' ? 'logout' : 'login' }}</span>
                                        {{ $row['jenis'] }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-space-md text-outline font-mono-numeric whitespace-nowrap">
                                    {{ $row['tgl'] }}
                                </td>
                                <td class="py-3.5 px-space-md">
                                    <x-badge :status="$row['status']" />
                                </td>
                                <td class="py-3.5 px-space-lg text-right whitespace-nowrap">
                                    <a href="{{ route('inspeksi.komparasi') }}"
                                       class="inline-block px-space-md py-1.5 {{ $row['btn_cls'] }} font-label-sm text-label-sm rounded-lg hover:opacity-90 transition-all">
                                        {{ $row['aksi'] }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- TablePlus Pagination Container --}}
            <div id="dashboard-pagination" class="p-space-md bg-surface-container-low"></div>
        </div>

        {{-- Right Column: Keberatan dari Penghuni & Educational Banner --}}
        <div class="lg:col-span-4 flex flex-col space-y-space-lg">
            <div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col space-y-space-md">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-space-xs">
                        <span class="material-symbols-outlined text-error text-[20px]">report_problem</span>
                        <h3 class="font-headline-sm text-headline-sm text-on-surface">Keberatan Penghuni</h3>
                    </div>
                    <span class="px-2 py-0.5 rounded-full bg-error-container text-error font-label-sm text-label-sm font-semibold">2 Aktif</span>
                </div>
                <p class="font-body-sm text-body-sm text-outline">Tinjau sanggahan inventaris sebelum dana deposit dicairkan kembali.</p>

                <div class="space-y-space-md mt-1">
                    <div class="p-space-md bg-surface-container-low rounded-xl flex flex-col space-y-2">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-error"></span>
                                <span class="font-label-lg text-label-lg text-on-surface font-semibold">Melisa Putri</span>
                                <span class="font-mono-numeric font-label-sm text-label-sm text-outline">Kmr 205</span>
                            </div>
                            <span class="px-2 py-0.5 rounded bg-error-container text-error font-label-sm text-label-sm font-semibold">Perlu Ditinjau</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant italic bg-surface-container-lowest p-space-sm rounded-lg">
                            “Kran wastafel memang sudah longgar sejak awal masuk, bukan patah saat saya huni.”
                        </p>
                        <div class="flex items-center gap-2 pt-1">
                            <a href="{{ route('inspeksi.komparasi') }}"
                               class="flex-1 py-1.5 px-space-sm bg-primary-container hover:bg-primary text-on-primary font-label-sm text-label-sm rounded-lg flex items-center justify-center gap-1 transition-colors">
                                <span class="material-symbols-outlined text-[15px]">compare</span> Buka Komparasi Foto
                            </a>
                        </div>
                    </div>

                    <div class="p-space-md bg-surface-container-low rounded-xl flex flex-col space-y-2">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-secondary-container"></span>
                                <span class="font-label-lg text-label-lg text-on-surface font-semibold">Riko Prasetyo</span>
                                <span class="font-mono-numeric font-label-sm text-label-sm text-outline">Kmr 112</span>
                            </div>
                            <span class="px-2 py-0.5 rounded bg-secondary-fixed/50 text-secondary font-label-sm text-label-sm font-semibold">Dalam Diskusi</span>
                        </div>
                        <p class="font-body-sm text-body-sm text-on-surface-variant italic bg-surface-container-lowest p-space-sm rounded-lg">
                            “Cat terkelupas karena rembesan hujan dinding luar, mohon cek foto check-in.”
                        </p>
                        <div class="flex items-center gap-2 pt-1">
                            <a href="{{ route('inspeksi.komparasi') }}"
                               class="w-full py-1.5 px-space-sm bg-surface-container hover:bg-surface-container-high text-on-surface font-label-sm text-label-sm rounded-lg flex items-center justify-center gap-1 transition-colors">
                                <span class="material-symbols-outlined text-[15px]">image_search</span> Buka Bukti
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-primary-container text-on-primary p-space-lg rounded-xl shadow-sm relative overflow-hidden">
                <div class="relative z-10 flex items-start gap-space-md">
                    <div class="w-10 h-10 rounded-lg bg-surface-container-lowest/10 flex items-center justify-center text-on-primary-container shrink-0">
                        <span class="material-symbols-outlined text-[22px]">auto_awesome</span>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <h4 class="font-headline-sm text-headline-sm text-on-primary leading-tight">Audit Berbasis Foto</h4>
                        <p class="font-body-sm text-body-sm text-on-primary-container/90">
                            Transparansi audit foto komparasi sebelum dan sesudah huni mengurangi sengketa deposit kos dan mempercepat serah terima.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dt = new TablePlus('#dashboard-table', {
        perPage: 5,
        perPageOptions: [5, 10, 18],
        searchInput: '#search-dashboard',
        paginationContainer: '#dashboard-pagination',
        infoTemplate: function(start, end, filtered, total) {
            if (filtered !== total) {
                return 'Menampilkan <span class="font-semibold text-on-surface">' + start + '–' + end + '</span> dari <span class="font-semibold text-on-surface">' + filtered + '</span> riwayat <span class="text-outline/80">(difilter dari ' + total + ' total)</span>';
            }
            return 'Menampilkan <span class="font-semibold text-on-surface">' + start + '–' + end + '</span> dari <span class="font-semibold text-on-surface">' + total + '</span> riwayat inspeksi bulan ini';
        }
    });

    const headerSearch = document.getElementById('global-header-search');
    if (headerSearch) {
        headerSearch.addEventListener('input', function(e) {
            const val = e.target.value;
            const dInp = document.getElementById('search-dashboard');
            if (dInp) dInp.value = val;
            dt.search(val);
        });
    }

    const filterBtns = document.querySelectorAll('#dashboard-filter-buttons button');
    filterBtns.forEach(function(btn) {
        btn.addEventListener('click', function() {
            filterBtns.forEach(function(b) {
                b.className = 'px-space-sm py-1.5 rounded-lg text-outline hover:bg-surface-container-low font-label-sm text-label-sm transition-colors';
            });
            btn.className = 'px-space-sm py-1.5 rounded-lg bg-primary-container text-on-primary font-label-sm text-label-sm shadow-xs transition-all';

            const filterType = btn.getAttribute('data-filter');
            if (filterType === 'checkout') {
                dt.setFilter('type', function(row) {
                    return row.innerText.toLowerCase().includes('check-out');
                });
            } else if (filterType === 'action') {
                dt.setFilter('type', function(row) {
                    const t = row.innerText.toLowerCase();
                    return t.includes('menunggu verifikasi') || t.includes('ada keberatan');
                });
            } else {
                dt.setFilter('type', null);
            }
        });
    });
});
</script>
@endpush