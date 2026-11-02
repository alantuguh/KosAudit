<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'Portal Penghuni') – KosAudit</title>
    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-highest": "#d3e4fe",
                        "error": "#ba1a1a",
                        "on-primary-fixed": "#00201d",
                        "on-secondary-fixed-variant": "#653e00",
                        "surface-container": "#e5eeff",
                        "secondary-fixed": "#ffddb8",
                        "primary-fixed": "#9cf2e8",
                        "surface-bright": "#f8f9ff",
                        "on-secondary-fixed": "#2a1700",
                        "outline-variant": "#bdc9c6",
                        "primary-fixed-dim": "#80d5cb",
                        "surface-dim": "#cbdbf5",
                        "primary-container": "#0f766e",
                        "on-surface": "#0b1c30",
                        "surface-variant": "#d3e4fe",
                        "inverse-on-surface": "#eaf1ff",
                        "surface-tint": "#006a63",
                        "on-primary-container": "#a3faef",
                        "inverse-surface": "#213145",
                        "surface-container-high": "#dce9ff",
                        "tertiary-container": "#007952",
                        "on-secondary": "#ffffff",
                        "error-container": "#ffdad6",
                        "on-primary-fixed-variant": "#00504a",
                        "on-secondary-container": "#684000",
                        "background": "#f8f9ff",
                        "surface-container-lowest": "#ffffff",
                        "on-error-container": "#93000a",
                        "inverse-primary": "#80d5cb",
                        "on-background": "#0b1c30",
                        "on-tertiary-fixed": "#002113",
                        "on-tertiary": "#ffffff",
                        "secondary-container": "#fea619",
                        "on-error": "#ffffff",
                        "secondary-fixed-dim": "#ffb95f",
                        "on-surface-variant": "#3e4947",
                        "surface-container-low": "#eff4ff",
                        "secondary": "#855300",
                        "tertiary-fixed": "#6ffbbe",
                        "on-tertiary-fixed-variant": "#005236",
                        "on-primary": "#ffffff",
                        "tertiary-fixed-dim": "#4edea3",
                        "tertiary": "#005e3f",
                        "surface": "#f8f9ff",
                        "outline": "#6e7977",
                        "on-tertiary-container": "#99ffcd",
                        "primary": "#005c55"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "margin": "2rem",
                        "space-xs": "0.25rem",
                        "space-lg": "1.5rem",
                        "margin-mobile": "1rem",
                        "gutter-mobile": "1rem",
                        "space-xl": "2rem",
                        "space-md": "1rem",
                        "gutter": "1.5rem",
                        "space-2xl": "3rem",
                        "space-sm": "0.5rem"
                    },
                    "fontFamily": {
                        "headline-sm": ["Inter"],
                        "label-sm": ["Inter"],
                        "mono-numeric": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "display": ["Inter"],
                        "headline-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "label-lg": ["Inter"],
                        "body-lg": ["Inter"]
                    }
                }
            }
        };
    </script>
    <style>
        @layer base {
            html, body { width: 100%; margin: 0; padding: 0; }
            body { overscroll-behavior: none; }
            .pb-safe { padding-bottom: env(safe-area-inset-bottom, 0px); }
            .pt-safe { padding-top: env(safe-area-inset-top, 0px); }
        }
        ::-webkit-scrollbar { display: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-surface font-body-md text-on-surface flex flex-col min-h-screen max-w-md mx-auto shadow-xl">
    {{-- Topbar Mobile --}}
    <header class="fixed top-0 max-w-md w-full z-50 bg-surface/80 backdrop-blur-xl pt-safe shadow-[0_1px_8px_rgba(0,0,0,0.04)]">
        <div class="h-16 px-gutter-mobile flex items-center justify-between">
            <div class="flex items-center gap-space-sm">
                <div class="flex items-center gap-space-xs">
                    <span class="material-symbols-outlined text-primary text-[24px]">verified_user</span>
                    <span class="font-headline-sm text-headline-sm tracking-tight text-primary font-bold">KosAudit</span>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-label-sm font-label-sm bg-surface-container-high text-on-surface-variant font-semibold">Preview</span>
            </div>
            <div class="flex items-center gap-space-xs">
                <a href="{{ route('portal.dashboard') }}" title="Kembali ke Portal Penghuni" class="px-2.5 py-1 rounded-lg bg-surface-container text-primary text-xs font-semibold hover:bg-surface-container-high">
                    Mode Web
                </a>
                <div class="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-primary text-[18px]">person</span>
                </div>
            </div>
        </div>
    </header>

    {{-- Main Mobile Content --}}
    <main class="flex flex-col relative w-full pt-16 pb-24 bg-surface min-h-screen">
        <div class="mx-gutter-mobile mt-space-sm rounded-xl border border-secondary/20 bg-secondary-fixed/50 p-space-sm text-secondary text-xs font-semibold">
            Data kamar, inspeksi, dan deposit di tampilan ini adalah contoh; backend tenant baru menyediakan profil akun.
        </div>
        @yield('content')
    </main>

    {{-- Bottom Navigation Bar --}}
    <nav class="fixed bottom-0 max-w-md w-full z-50 pb-safe bg-surface/85 backdrop-blur-xl shadow-[0_-2px_12px_rgba(0,0,0,0.05)]">
        <div class="flex justify-around items-center h-16 px-space-xs">
            <a href="{{ route('mobile.beranda') }}"
               class="flex-1 flex flex-col items-center justify-center h-full transition-colors {{ request()->routeIs('mobile.beranda') ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[22px]">dashboard</span>
                <span class="font-label-sm text-label-sm mt-0.5">Beranda</span>
            </a>
            <a href="{{ route('mobile.kondisi') }}"
               class="flex-1 flex flex-col items-center justify-center h-full transition-colors {{ request()->routeIs('mobile.kondisi') ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[22px]">checklist_rtl</span>
                <span class="font-label-sm text-label-sm mt-0.5">Kondisi Kamar</span>
            </a>
            <a href="{{ route('mobile.deposit') }}"
               class="flex-1 flex flex-col items-center justify-center h-full transition-colors {{ request()->routeIs('mobile.deposit') ? 'text-primary font-semibold' : 'text-on-surface-variant hover:text-on-surface' }}">
                <span class="material-symbols-outlined text-[22px]">account_balance_wallet</span>
                <span class="font-label-sm text-label-sm mt-0.5">Deposit</span>
            </a>
            <a href="{{ route('portal.dashboard') }}"
               class="flex-1 flex flex-col items-center justify-center h-full text-on-surface-variant hover:text-on-surface transition-colors">
                <span class="material-symbols-outlined text-[22px]">help_outline</span>
                <span class="font-label-sm text-label-sm mt-0.5">Bantuan/Profil</span>
            </a>
        </div>
    </nav>

    @stack('scripts')
</body>
</html>