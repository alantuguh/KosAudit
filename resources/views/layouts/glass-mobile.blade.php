<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    {{-- Tanpa maximum-scale / user-scalable=no: pengguna harus tetap bisa zoom (WCAG 1.4.4) --}}
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Portal Penghuni') – KosAudit</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">

    {{-- Terapkan tema lebih awal agar tidak berkedip --}}
    <script>
        (function() {
            try {
                var p = localStorage.getItem("kosaudit-theme");
                var t = p === "light" || p === "dark" ?
                    p :
                    (matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
                document.documentElement.setAttribute("data-theme", t);
            } catch (e) {}
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="ui-has-tabbar min-h-screen overflow-x-hidden antialiased">
    @php
    $tabs = [
        ['route' => 'mobile.beranda', 'icon' => 'home', 'label' => 'Beranda'],
        ['route' => 'mobile.kondisi', 'icon' => 'checklist', 'label' => 'Kondisi'],
        ['route' => 'mobile.deposit', 'icon' => 'account_balance_wallet', 'label' => 'Deposit'],
        ['route' => 'portal.dashboard', 'icon' => 'desktop_windows', 'label' => 'Versi Web'],
    ];
    @endphp

    <div
        class="ui-app-background"
        style="--app-background-image: url('{{ asset('images/bg_sudut.jpg') }}');">
        <div class="ui-mobile-shell">

            {{-- Header & tab bar: kartu premium glass melayang (sama dengan shell desktop) --}}
            <x-glass-card as="header" level="premium" class="ui-mobile-header">
                <div class="ui-mobile-header-inner">
                    <div class="flex min-w-0 items-center gap-2">
                        <span class="ui-icon-tile ui-tone-brand">
                            <span class="material-symbols-outlined" aria-hidden="true">verified_user</span>
                        </span>
                        <span class="ui-sidebar-title">KosAudit</span>
                    </div>

                    <x-glass-account-menu />
                </div>
            </x-glass-card>

            <main class="ui-mobile-content">
                <x-glass-alert />

                <x-glass-alert type="warning" title="Mode pratinjau">
                    Data kamar, inspeksi, dan deposit di tampilan ini adalah contoh; backend penghuni baru menyediakan profil akun.
                </x-glass-alert>

                @yield('content')
            </main>

            <x-glass-card as="nav" level="premium" class="ui-tabbar" aria-label="Navigasi portal penghuni">
                <div class="ui-tabbar-inner">
                    @foreach ($tabs as $tab)
                    <a
                        href="{{ route($tab['route']) }}"
                        class="ui-tabbar-item"
                        @if (request()->routeIs($tab['route'])) aria-current="page" @endif>
                        <span class="material-symbols-outlined" aria-hidden="true">{{ $tab['icon'] }}</span>
                        {{ $tab['label'] }}
                    </a>
                    @endforeach
                </div>
            </x-glass-card>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
