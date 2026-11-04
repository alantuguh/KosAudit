@extends('layouts.app')

@section('title', 'Data Penghuni Kos')

@section('content')
<div class="flex flex-col w-full space-y-space-xl">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-space-md">
        <div>
            <h1 class="font-headline-lg text-headline-lg text-on-surface tracking-tight">Data Penghuni Kos</h1>
            <p class="font-body-sm text-body-sm text-outline mt-0.5">Kelola data identitas penghuni, kontak WhatsApp, dan rekening pengembalian deposit.</p>
        </div>
        <button type="button" onclick="document.getElementById('modal-tambah-penghuni').classList.remove('hidden')"
                class="inline-flex items-center gap-2 px-space-md h-10 rounded-lg bg-primary-container text-on-primary hover:bg-primary shadow-sm font-label-lg">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            <span>Tambah Penghuni</span>
        </button>
    </div>

    <div class="bg-surface-container-lowest rounded-xl shadow-sm overflow-hidden">
        <div class="p-space-md bg-surface-container-lowest flex flex-col sm:flex-row items-center justify-between gap-space-sm">
            <div class="relative w-full sm:w-80">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input id="search-penghuni" type="text" placeholder="Cari nama, NIK, nomor HP, atau kamar..."
                       class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-body-md focus:outline-none focus:ring-1 focus:ring-primary"/>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table id="penghuni-table" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low text-outline font-label-sm uppercase tracking-wider">
                        <th class="py-3.5 px-space-lg">Nama Penghuni</th>
                        <th class="py-3.5 px-space-md">Kamar</th>
                        <th class="py-3.5 px-space-md">No. WhatsApp</th>
                        <th class="py-3.5 px-space-md">Informasi Akun</th>
                        <th class="py-3.5 px-space-md">Status Akun</th>
                        <th class="py-3.5 px-space-lg text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-surface-container-low text-body-md">
                    @foreach ($penghuniList as $p)
                    <tr class="hover:bg-surface-container-low/50 transition-colors">
                        <td class="py-4 px-space-lg font-semibold text-on-surface">
                            {{ $p['nama'] }}
                            <span class="block text-xs font-normal text-outline">{{ $p['email'] }}</span>
                        </td>
                        <td class="py-4 px-space-md font-mono-numeric">
                            @if ($p['kamar'])
                                <a href="{{ route('kamar.show', $p['kamar']) }}" class="text-primary font-semibold hover:underline">Kamar {{ $p['kamar'] }}</a>
                            @else
                                            <span class="text-outline">Belum ditetapkan</span>
                            @endif
                        </td>
                        <td class="py-4 px-space-md font-mono-numeric text-outline">{{ $p['telepon'] }}</td>
                        <td class="py-4 px-space-md text-on-surface-variant">{{ $p['rekening'] }}</td>
                        <td class="py-4 px-space-md"><x-badge :status="$p['status']" /></td>
                        <td class="py-4 px-space-lg text-right text-outline text-xs">Akun #{{ $p['id'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="pagination-penghuni" class="py-3.5 px-space-lg bg-surface-container-lowest"></div>
    </div>
</div>

<x-modal id="modal-tambah-penghuni" title="Registrasi Penghuni Baru">
    <form method="POST" action="{{ route('penghuni.store') }}" class="space-y-space-md">
        @csrf
        <div>
            <label class="block font-label-md text-on-surface mb-1">Nama Lengkap *</label>
            <input type="text" name="name" required placeholder="Contoh: Nabila Salma" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
            <div>
                <label class="block font-label-md text-on-surface mb-1">Email akun *</label>
                <input type="email" name="email" required placeholder="nama@email.com" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
            <div>
                <label class="block font-label-md text-on-surface mb-1">Nomor WhatsApp *</label>
                <input type="tel" name="phone" required placeholder="081234567890" pattern="(\+62|62|0)8[0-9]{7,12}" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-space-md">
            <div>
                <label class="block font-label-md text-on-surface mb-1">Password awal *</label>
                <input type="password" name="password" required minlength="8" autocomplete="new-password" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
            <div>
                <label class="block font-label-md text-on-surface mb-1">Konfirmasi password *</label>
                <input type="password" name="password_confirmation" required minlength="8" autocomplete="new-password" class="w-full h-10 px-3 rounded-lg bg-surface-container-low"/>
            </div>
        </div>
        <div class="flex justify-end gap-2 pt-2">
            <button type="button" onclick="document.getElementById('modal-tambah-penghuni').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-surface-container">Batal</button>
            <button type="submit" class="px-4 py-2 rounded-lg bg-primary-container text-on-primary font-semibold">Simpan Penghuni</button>
        </div>
    </form>
</x-modal>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    new TablePlus('#penghuni-table', {
        perPage: 5,
        perPageOptions: [5, 10, 20],
        searchInput: '#search-penghuni',
        paginationContainer: '#pagination-penghuni'
    });
});
</script>
@endpush