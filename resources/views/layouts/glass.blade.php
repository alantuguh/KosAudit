<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') – KosAudit</title>

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

<body class="min-h-screen overflow-x-hidden antialiased">

    <div
        class="ui-app-background"
        style="--app-background-image: url('{{ asset('images/bg_sudut.jpg') }}');">
        @include('partials.glass-sidebar')

        <div class="ui-shell-main">
            @include('partials.glass-header')

            <main class="ui-shell-content">
                <x-glass-alert />

                @if (request()->routeIs('portal.dashboard'))
                <x-glass-alert type="warning">
                    Tenant API saat ini menyediakan profil akun saja. Informasi kamar, inspeksi, dan deposit pada halaman ini adalah contoh.
                </x-glass-alert>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (() => {
            const root = document.documentElement;

            document.addEventListener("click", (event) => {
                if (event.target.closest("[data-sidebar-toggle]")) {
                    root.toggleAttribute("data-sidebar-open");
                } else if (event.target.closest("[data-sidebar-close]")) {
                    root.removeAttribute("data-sidebar-open");
                }
            });

            document.addEventListener("keydown", (event) => {
                if (event.key === "Escape") {
                    root.removeAttribute("data-sidebar-open");
                }
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>