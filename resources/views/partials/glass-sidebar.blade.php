@php
$user = auth()->user();
@endphp

{{--
    Sidebar hanya berisi brand + navigasi.
    Identitas akun & properti ada di satu tempat: menu akun di header.
--}}

<div class="ui-sidebar-backdrop" data-sidebar-close></div>

<x-glass-card as="aside" level="premium" id="app-sidebar" class="ui-sidebar" aria-label="Navigasi utama">

    <div class="ui-sidebar-brand">
        <span class="ui-icon-tile ui-tone-brand">
            <span class="material-symbols-outlined" aria-hidden="true">verified_user</span>
        </span>
        <span class="ui-sidebar-title ui-sidebar-label">KosAudit</span>
    </div>

    <nav class="ui-sidebar-nav">
        @if ($user->isOwner())
        <x-glass-nav-item :href="route('dashboard')" icon="space_dashboard" :active="request()->routeIs('dashboard')">
            Dashboard
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('kamar.index')" icon="meeting_room" :active="request()->routeIs('kamar.*')">
            Data Kamar
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('penghuni.index')" icon="group" :active="request()->routeIs('penghuni.*')">
            Penghuni
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('sewa.index')" icon="receipt_long" :active="request()->routeIs('sewa.*')">
            Kontrak Sewa
        </x-glass-nav-item>

        <div class="ui-nav-section">
            <span class="ui-eyebrow">Audit</span>
        </div>

        <x-glass-nav-item :href="route('inspeksi.create')" icon="assignment_turned_in" :active="request()->routeIs('inspeksi.create')">
            Form Inspeksi
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('inspeksi.komparasi')" icon="compare" :active="request()->routeIs('inspeksi.komparasi')">
            Komparasi
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('deposit.perhitungan')" icon="account_balance_wallet" :active="request()->routeIs('deposit.*')">
            Deposit
        </x-glass-nav-item>
        @endif

        @if ($user->isTenant())
        <x-glass-nav-item :href="route('portal.dashboard')" icon="space_dashboard" :active="request()->routeIs('portal.*')">
            Dashboard Penghuni
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('mobile.beranda')" icon="smartphone">
            Tampilan Mobile
        </x-glass-nav-item>
        @endif
    </nav>

</x-glass-card>
