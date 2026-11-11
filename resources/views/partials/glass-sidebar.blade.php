@php
$user = auth()->user();
@endphp

<div class="ui-sidebar-backdrop" data-sidebar-close></div>

<aside class="ui-glass ui-glass-subtle ui-sidebar" aria-label="Navigasi utama">

    <div class="ui-sidebar-brand">
        <span class="ui-icon-tile ui-tone-brand">
            <span class="material-symbols-outlined" aria-hidden="true">verified_user</span>
        </span>

        <div>
            <p class="ui-sidebar-title">KosAudit</p>
            <p class="ui-eyebrow">Asset &amp; Audit</p>
        </div>
    </div>

    @if ($user->isOwner())
    <div class="ui-sidebar-property">
        <div class="ui-inset ui-property">
            <span class="material-symbols-outlined" aria-hidden="true">apartment</span>

            <div class="min-w-0">
                <p class="ui-user-name truncate">Griya Asri Putri</p>
                <p class="ui-caption">Data kamar tersimpan</p>
            </div>

            <span class="material-symbols-outlined" aria-hidden="true">unfold_more</span>
        </div>
    </div>
    @endif

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
            Sewa
        </x-glass-nav-item>

        <div class="ui-nav-section">
            <span class="ui-eyebrow">Audit &amp; Inspeksi</span>
        </div>

        <x-glass-nav-item :href="route('inspeksi.komparasi')" icon="inventory_2" :active="request()->routeIs('inspeksi.komparasi')">
            Item Kondisi &amp; Komparasi
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('inspeksi.create')" icon="assignment_turned_in" :active="request()->routeIs('inspeksi.create')">
            Form Inspeksi
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('deposit.perhitungan')" icon="account_balance_wallet" :active="request()->routeIs('deposit.*')">
            Perhitungan Deposit
        </x-glass-nav-item>
        @endif

        @if ($user->isTenant())
        <div class="ui-nav-section">
            <span class="ui-eyebrow">Portal Penghuni</span>
        </div>

        <x-glass-nav-item :href="route('portal.dashboard')" icon="person_pin" :active="request()->routeIs('portal.*')">
            Dashboard Penghuni
        </x-glass-nav-item>

        <x-glass-nav-item :href="route('mobile.beranda')" icon="smartphone">
            Tampilan Mobile Penghuni
        </x-glass-nav-item>
        @endif
    </nav>

    <div class="ui-sidebar-footer">
        <div class="ui-inset ui-property">
            <span class="material-symbols-outlined" aria-hidden="true">verified_user</span>

            <div class="min-w-0">
                <p class="ui-user-name">Audit Terlindungi</p>
                <p class="ui-caption">SLA Deposit 24 Jam</p>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="ml-auto">
                @csrf
                <x-glass-icon-button type="submit" icon="logout" label="Keluar / Ganti Akun" />
            </form>
        </div>
    </div>

</aside>