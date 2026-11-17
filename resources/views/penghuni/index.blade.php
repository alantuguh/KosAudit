@extends('layouts.glass')

@section('title', 'Data Penghuni')

@section('content')
@php
// Nomor lokal (08xx) -> format internasional untuk tautan WhatsApp.
$waLink = function (?string $phone) {
    if (! $phone || ! preg_match('/^(\+62|62|0)8[0-9]{7,12}$/', $phone)) {
        return null;
    }

    return 'https://wa.me/' . preg_replace('/^(\+62|0)/', '62', $phone);
};

$reopenModal = $errors->hasAny(['name', 'email', 'phone', 'password']);
@endphp

<x-glass-page-header
    eyebrow="Manajemen Penghuni"
    title="Data Penghuni"
    description="Kelola akun penghuni, kontak WhatsApp, dan rekening pengembalian deposit.">
    <x-slot:actions>
        <x-glass-button type="button" variant="primary" :block="false" data-modal-open="modal-tambah-penghuni">
            <span class="material-symbols-outlined" aria-hidden="true">person_add</span>
            Tambah Penghuni
        </x-glass-button>
    </x-slot:actions>
</x-glass-page-header>

@if ($penghuniList->isEmpty())
<x-glass-empty-state icon="group" title="Belum ada penghuni terdaftar">
    Buat akun penghuni agar mereka dapat meninjau hasil inspeksi dan menyetujui pengembalian deposit dari portal penghuni.

    <x-slot:actions>
        <x-glass-button type="button" variant="primary" :block="false" data-modal-open="modal-tambah-penghuni">
            <span class="material-symbols-outlined" aria-hidden="true">person_add</span>
            Tambah Penghuni Pertama
        </x-glass-button>
    </x-slot:actions>
</x-glass-empty-state>
@else
<x-glass-table
    id="penghuni-table"
    :stack="true"
    :per-page="10"
    :per-page-options="[10, 25, 50]"
    search-placeholder="Cari nama, email, atau nomor HP..."
    info-label="penghuni">
    <x-slot:head>
        <tr>
            <th scope="col">Penghuni</th>
            <th scope="col">Kamar</th>
            <th scope="col">WhatsApp</th>
            <th scope="col">Rekening</th>
            <th scope="col">Status</th>
            <th scope="col">Akun</th>
        </tr>
    </x-slot:head>

    @foreach ($penghuniList as $p)
    @php $wa = $waLink($p['telepon']); @endphp
    <tr>
        <td>
            <p class="font-semibold leading-tight">{{ $p['nama'] }}</p>
            <p class="ui-caption">{{ $p['email'] }}</p>
        </td>

        <td data-label="Kamar">
            @if ($p['kamar'])
            <a href="{{ route('kamar.show', $p['kamar']) }}" class="ui-link">Kamar {{ $p['kamar'] }}</a>
            @else
            <span class="ui-text-muted">Belum ditetapkan</span>
            @endif
        </td>

        <td data-label="WhatsApp" class="ui-num">
            @if ($wa)
            <a href="{{ $wa }}" target="_blank" rel="noopener noreferrer" class="ui-link">
                {{ $p['telepon'] }}<span class="sr-only"> (buka WhatsApp di tab baru)</span>
            </a>
            @else
            <span class="ui-text-muted">{{ $p['telepon'] }}</span>
            @endif
        </td>

        <td data-label="Rekening">
            <span @class(['ui-text-muted' => $p['rekening'] === 'Belum dicatat'])>{{ $p['rekening'] }}</span>
        </td>

        <td data-label="Status"><x-glass-badge :status="$p['status']" /></td>

        <td data-label="Akun" class="ui-caption ui-num">#{{ $p['id'] }}</td>
    </tr>
    @endforeach
</x-glass-table>
@endif

{{-- Modal: tambah penghuni --}}
<x-glass-modal
    id="modal-tambah-penghuni"
    title="Tambah Penghuni"
    description="Akun ini dipakai penghuni untuk masuk ke portal penghuni."
    :open="$reopenModal">
    <form method="POST" action="{{ route('penghuni.store') }}" class="ui-modal-form" data-submit-once>
        @csrf

        <x-glass-input
            label="Nama Lengkap"
            id="name"
            name="name"
            :value="old('name')"
            required
            maxlength="255"
            autocomplete="off"
            placeholder="Contoh: Nabila Salma" />

        <div class="ui-form-grid">
            <x-glass-input
                label="Email Akun"
                id="email"
                name="email"
                type="email"
                :value="old('email')"
                required
                maxlength="255"
                autocomplete="off"
                placeholder="nama@email.com" />

            <div class="ui-field">
                <x-glass-input
                    label="Nomor WhatsApp"
                    id="phone"
                    name="phone"
                    type="tel"
                    :value="old('phone')"
                    required
                    inputmode="tel"
                    pattern="(\+62|62|0)8[0-9]{7,12}"
                    title="Nomor HP Indonesia, contoh 081234567890"
                    placeholder="081234567890" />
                <p class="ui-hint">Diawali 08, 628, atau +628.</p>
            </div>
        </div>

        <div class="ui-form-grid">
            <div class="ui-field">
                <x-glass-input
                    label="Password Awal"
                    id="password"
                    name="password"
                    type="password"
                    required
                    minlength="8"
                    autocomplete="new-password"
                    />
                <p class="ui-hint">Minimal 8 karakter. Sampaikan ke penghuni secara langsung.</p>
            </div>

            <x-glass-input
                label="Konfirmasi Password"
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                required
                minlength="8"
                autocomplete="new-password"
                />
        </div>

        <div class="ui-modal-footer">
            <x-glass-button type="button" variant="secondary" :block="false" data-modal-close>Batal</x-glass-button>
            <x-glass-button type="submit" variant="primary" :block="false">
                <span class="material-symbols-outlined" aria-hidden="true">save</span>
                Simpan Penghuni
            </x-glass-button>
        </div>
    </form>
</x-glass-modal>
@endsection
