<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'Dashboard') – KosAudit</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <style>
        @layer base {
            html, body { margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            main > :first-child { margin-top: 0 !important; }
            main > :last-child { margin-bottom: 0 !important; }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-surface": "#0b1c30",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#4edea3",
                        "primary-fixed": "#9cf2e8",
                        "on-tertiary-fixed-variant": "#005236",
                        "secondary-fixed-dim": "#ffb95f",
                        "surface-tint": "#006a63",
                        "on-primary-fixed": "#00201d",
                        "surface-dim": "#cbdbf5",
                        "inverse-primary": "#80d5cb",
                        "secondary-container": "#fea619",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "on-surface-variant": "#3e4947",
                        "surface-bright": "#f8f9ff",
                        "primary": "#005c55",
                        "primary-container": "#0f766e",
                        "on-tertiary": "#ffffff",
                        "surface-container-high": "#dce9ff",
                        "surface-container": "#e5eeff",
                        "outline": "#6e7977",
                        "on-primary-container": "#a3faef",
                        "secondary-fixed": "#ffddb8",
                        "on-error": "#ffffff",
                        "on-tertiary-container": "#99ffcd",
                        "surface-container-low": "#eff4ff",
                        "surface": "#f8f9ff",
                        "background": "#f8f9ff",
                        "tertiary": "#005e3f",
                        "secondary": "#855300",
                        "primary-fixed-dim": "#80d5cb",
                        "outline-variant": "#bdc9c6",
                        "tertiary-container": "#007952",
                        "inverse-surface": "#213145",
                        "on-secondary": "#ffffff",
                        "on-tertiary-fixed": "#002113",
                        "error": "#ba1a1a",
                        "surface-variant": "#d3e4fe",
                        "on-background": "#0b1c30",
                        "surface-container-highest": "#d3e4fe",
                        "on-primary-fixed-variant": "#00504a",
                        "tertiary-fixed": "#6ffbbe",
                        "on-secondary-fixed": "#2a1700",
                        "error-container": "#ffdad6",
                        "on-secondary-container": "#684000",
                        "on-secondary-fixed-variant": "#653e00"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "space-sm": "0.5rem",
                        "space-lg": "1.5rem",
                        "margin-mobile": "1rem",
                        "gutter": "1.5rem",
                        "space-xs": "0.25rem",
                        "space-xl": "2rem",
                        "margin": "2rem",
                        "space-2xl": "3rem",
                        "gutter-mobile": "1rem",
                        "space-md": "1rem"
                    },
                    "fontFamily": {
                        "body-sm": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-md": ["Inter"],
                        "display": ["Inter"],
                        "label-md": ["Inter"],
                        "body-lg": ["Inter"],
                        "label-sm": ["Inter"],
                        "headline-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "label-lg": ["Inter"],
                        "mono-numeric": ["Inter"]
                    },
                    "fontSize": {
                        "body-sm": ["13px", {"lineHeight": "18px", "fontWeight": "400"}],
                        "headline-md": ["22px", {"lineHeight": "28px", "letterSpacing": "-0.015em", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["14px", {"lineHeight": "20px", "fontWeight": "400"}],
                        "display": ["36px", {"lineHeight": "44px", "letterSpacing": "-0.025em", "fontWeight": "700"}],
                        "label-md": ["12px", {"lineHeight": "16px", "letterSpacing": "0.01em", "fontWeight": "600"}],
                        "body-lg": ["16px", {"lineHeight": "24px", "letterSpacing": "-0.005em", "fontWeight": "400"}],
                        "label-sm": ["11px", {"lineHeight": "14px", "letterSpacing": "0.02em", "fontWeight": "600"}],
                        "headline-sm": ["18px", {"lineHeight": "24px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "headline-lg": ["28px", {"lineHeight": "36px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "label-lg": ["14px", {"lineHeight": "20px", "letterSpacing": "0em", "fontWeight": "600"}],
                        "mono-numeric": ["14px", {"lineHeight": "20px", "letterSpacing": "-0.01em", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
    @stack('styles')
</head>
<body class="bg-background font-body-md text-on-surface antialiased">
    {{-- Sidebar Navigation --}}
    @include('partials.sidebar')

    <div class="pl-72">
        {{-- Topbar Header --}}
        @include('partials.header')

        {{-- Main Content Area --}}
        <main class="relative pt-16 bg-background min-h-screen px-space-xl py-space-xl">
            {{-- Flash Message / Validation Alert --}}
            <x-alert />

            @if (request()->routeIs('portal.dashboard'))
                <div class="mb-space-md rounded-xl border border-secondary/20 bg-secondary-fixed/50 p-space-md text-secondary font-label-md">
                    Tenant API saat ini menyediakan profil akun saja. Informasi kamar, inspeksi, dan deposit pada halaman ini adalah contoh.
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    {{-- TablePlus Script for Interactive Tables (Pagination, Search, Sort, Filter) --}}
    <script src="{{ asset('js/tableplus.js') }}"></script>
    @stack('scripts')
</body>
</html>