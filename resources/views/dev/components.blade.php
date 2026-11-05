@php
$code = [
'button' => <<<'CODE'
    <x-glass-button variant="primary">Primary</x-glass-button>
    <x-glass-button variant="secondary">Secondary</x-glass-button>
    <x-glass-button variant="danger">Danger</x-glass-button>

    <x-glass-button :loading="true">Menyimpan...</x-glass-button>
    <x-glass-button :disabled="true">Disabled</x-glass-button>

    {{-- Lebar menyesuaikan teks --}}
    <x-glass-button :block="false">Simpan</x-glass-button>
    CODE,

    'input' =>
    <<<'CODE'
        <x-glass-input label="Alamat Email" type="email" name="email" icon="mail" placeholder="nama@email.com" />

    <x-glass-input label="Nomor Kamar" name="kamar" value="101" :disabled="true" />

    <x-glass-input label="Kata Sandi" type="password" name="password" icon="lock" error="Kata sandi minimal 8 karakter." />
    CODE,

    'checkbox' =>
    <<<'CODE'
        <x-glass-checkbox name="remember" value="1" label="Ingat saya" />
    <x-glass-checkbox name="remember" value="1" label="Sudah dicentang" checked />
    <x-glass-checkbox name="remember" value="1" label="Tidak aktif" disabled />
    CODE,

    'alert' => <<<'CODE'
        <x-glass-alert type="success">Data kamar berhasil disimpan.</x-glass-alert>
        <x-glass-alert type="warning" title="Perhatian">Deposit belum diverifikasi.</x-glass-alert>
        <x-glass-alert type="danger">Gagal menyimpan data.</x-glass-alert>
        <x-glass-alert type="info">Inspeksi berikutnya dijadwalkan bulan depan.</x-glass-alert>

        {{-- Pesan flash & error validasi (tanpa props) --}}
        <x-glass-alert :except="['email', 'password']" />
        CODE,

        'card' => <<<'CODE'
            <x-glass-card level="premium" class="p-6">...</x-glass-card>
            <x-glass-card level="subtle" class="p-6">...</x-glass-card>

            {{-- Elemen kecil: radius 8px --}}
            <x-glass-card level="subtle" radius="control" class="px-4 py-3">...</x-glass-card>
            CODE,
            ];
            @endphp
            <!DOCTYPE html>
            <html lang="id">

            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <title>Component Preview | KosAudit</title>

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">

                @vite(['resources/css/app.css', 'resources/js/app.js'])
            </head>

            <body class="min-h-screen overflow-x-hidden antialiased">

                <div
                    id="scene"
                    class="ui-app-background"
                    style="--app-background-image: url('{{ asset('images/bg_sudut.jpg') }}');">
                    <main class="mx-auto max-w-6xl space-y-6 px-5 py-8">

                        <!-- Header -->
                        <x-glass-card level="subtle" class="p-5 sm:p-6">
                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="space-y-1">
                                    <p class="ui-eyebrow">
                                        UI Playground &middot; Local only &middot;
                                        <a href="{{ route('dev.ui-kit') }}" class="underline">Glass Lab</a>
                                    </p>
                                    <h1 class="ui-heading-lg">Component Preview</h1>
                                    <p class="ui-body-sm max-w-md">
                                        Hover, Focus, dan Active diuji langsung: arahkan kursor, tekan Tab, atau klik-tahan pada komponen.
                                    </p>
                                </div>

                                <div class="flex flex-wrap gap-6">
                                    <div class="space-y-2">
                                        <p class="ui-label">Tema</p>
                                        <div class="flex gap-2">
                                            <x-glass-button type="button" variant="secondary" :block="false" data-theme-set="light" data-theme-option>Light</x-glass-button>
                                            <x-glass-button type="button" variant="secondary" :block="false" data-theme-set="dark" data-theme-option>Dark</x-glass-button>
                                            <x-glass-button type="button" variant="secondary" :block="false" data-theme-set="system" data-theme-option>System</x-glass-button>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <p class="ui-label">Background uji</p>
                                        <div class="flex gap-2">
                                            <x-glass-button type="button" variant="secondary" :block="false" data-bg="{{ asset('images/bg_sudut.jpg') }}" data-bg-option>Sudut</x-glass-button>
                                            <x-glass-button type="button" variant="secondary" :block="false" data-bg="{{ asset('images/bg_nature.jpg') }}" data-bg-option>Nature</x-glass-button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </x-glass-card>

                        <div class="grid gap-6 lg:grid-cols-2">

                            <!-- Button -->
                            <x-dev.preview title="Button" note="Variant: primary, secondary, danger. State: default, loading, disabled." :code="$code['button']">
                                <div class="grid gap-3 sm:grid-cols-3">
                                    <x-glass-button type="button" variant="primary">Primary</x-glass-button>
                                    <x-glass-button type="button" variant="secondary">Secondary</x-glass-button>
                                    <x-glass-button type="button" variant="danger">Danger</x-glass-button>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-2">
                                    <x-glass-button type="button" :loading="true">Menyimpan...</x-glass-button>
                                    <x-glass-button type="button" :disabled="true">Disabled</x-glass-button>
                                </div>

                                <div>
                                    <x-glass-button type="button" :block="false">Simpan</x-glass-button>
                                </div>
                            </x-dev.preview>

                            <!-- Input -->
                            <x-dev.preview title="Input" note="State: default, icon, disabled, error. Focus: klik atau tekan Tab." :code="$code['input']">
                                <x-glass-input label="Alamat Email" type="email" name="demo_email" icon="mail" placeholder="nama@email.com" />
                                <x-glass-input label="Nomor Kamar" name="demo_kamar" value="101" :disabled="true" />
                                <x-glass-input label="Kata Sandi" type="password" name="demo_password" icon="lock" error="Kata sandi minimal 8 karakter." />
                            </x-dev.preview>

                            <!-- Checkbox -->
                            <x-dev.preview title="Checkbox" note="State: default, checked, disabled." :code="$code['checkbox']">
                                <div class="flex flex-col gap-4">
                                    <x-glass-checkbox name="demo_a" value="1" label="Ingat saya" />
                                    <x-glass-checkbox name="demo_b" value="1" label="Sudah dicentang" checked />
                                    <x-glass-checkbox name="demo_c" value="1" label="Tidak aktif" disabled />
                                </div>
                            </x-dev.preview>

                            <!-- Alert -->
                            <x-dev.preview title="Alert" note="Tipe: success, warning, danger, info." :code="$code['alert']">
                                <div>
                                    <x-glass-alert type="success">Data kamar berhasil disimpan.</x-glass-alert>
                                    <x-glass-alert type="warning" title="Perhatian">Deposit belum diverifikasi.</x-glass-alert>
                                    <x-glass-alert type="danger">Gagal menyimpan data.</x-glass-alert>
                                    <x-glass-alert type="info">Inspeksi berikutnya dijadwalkan bulan depan.</x-glass-alert>
                                </div>
                            </x-dev.preview>

                        </div>

                        <!-- Card -->
                        <x-dev.preview title="Card" note="Level premium dan subtle, serta varian radius control (8px)." :code="$code['card']">
                            <div class="grid gap-4 md:grid-cols-3">
                                <x-glass-card level="premium" class="space-y-2 p-6">
                                    <p class="ui-eyebrow">Premium</p>
                                    <p class="ui-body-sm">Radius 16px, untuk surface utama.</p>
                                </x-glass-card>

                                <x-glass-card level="subtle" class="space-y-2 p-6">
                                    <p class="ui-eyebrow">Subtle</p>
                                    <p class="ui-body-sm">Radius 16px, untuk panel pendukung.</p>
                                </x-glass-card>

                                <div class="flex items-start">
                                    <x-glass-card level="subtle" radius="control" class="inline-flex items-center gap-3 px-4 py-3">
                                        <span class="material-symbols-outlined text-brand-300" aria-hidden="true">apartment</span>
                                        <span class="ui-eyebrow">Radius 8px</span>
                                    </x-glass-card>
                                </div>
                            </div>
                        </x-dev.preview>

                        <!-- Responsive check -->
                        <x-dev.preview title="Responsive Check" note="Memuat halaman asli pada lebar 375 / 768 / 1440 px dan mendeteksi overflow horizontal.">
                            <div class="flex flex-wrap items-center gap-6">
                                <div class="flex gap-2">
                                    <x-glass-button type="button" variant="secondary" :block="false" data-vp="375" data-vp-option>375</x-glass-button>
                                    <x-glass-button type="button" variant="secondary" :block="false" data-vp="768" data-vp-option>768</x-glass-button>
                                    <x-glass-button type="button" variant="secondary" :block="false" data-vp="1440" data-vp-option>1440</x-glass-button>
                                </div>

                                <div class="flex gap-2">
                                    <x-glass-button type="button" variant="secondary" :block="false" data-page="{{ route('login') }}" data-page-option>Login</x-glass-button>
                                    <x-glass-button type="button" variant="secondary" :block="false" data-page="{{ route('dev.ui-kit') }}" data-page-option>Glass Lab</x-glass-button>
                                </div>

                                <p id="rc-status" class="ui-caption" role="status"></p>
                            </div>

                            <div id="rc-wrap" class="overflow-hidden" style="border: 1px solid var(--ui-border-strong); border-radius: var(--ui-radius-control);">
                                <iframe
                                    id="rc-frame"
                                    title="Responsive preview"
                                    class="block border-0"
                                    style="transform-origin: top left;"></iframe>
                            </div>
                        </x-dev.preview>

                    </main>
                </div>

                <script>
                    (() => {
                        "use strict";

                        const root = document.documentElement;
                        const scene = document.getElementById("scene");

                        function toggleActive(button, active) {
                            button.classList.toggle("ui-btn-primary", active);
                            button.classList.toggle("ui-btn-secondary", !active);
                            button.setAttribute("aria-pressed", String(active));
                        }

                        /* Tema (klik ditangani app.js lewat data-theme-set) */
                        function syncThemeButtons() {
                            const preference = root.dataset.themePreference || "system";
                            document.querySelectorAll("[data-theme-option]").forEach((button) => {
                                toggleActive(button, button.dataset.themeSet === preference);
                            });
                        }

                        document.addEventListener("kosaudit:theme-change", syncThemeButtons);

                        /* Background uji */
                        const bgButtons = Array.from(document.querySelectorAll("[data-bg-option]"));

                        bgButtons.forEach((button) => {
                            button.addEventListener("click", () => {
                                scene.style.setProperty("--app-background-image", `url('${button.dataset.bg}')`);
                                bgButtons.forEach((b) => toggleActive(b, b === button));
                            });
                        });

                        /* Copy Code */
                        document.addEventListener("click", async (event) => {
                            const button = event.target.closest("[data-copy-code]");

                            if (!button) {
                                return;
                            }

                            const code = button.closest(".ui-glass").querySelector("[data-code]");
                            const original = button.textContent.trim();

                            try {
                                await navigator.clipboard.writeText(code.textContent);
                                button.textContent = "Tersalin";
                            } catch (error) {
                                button.textContent = "Gagal menyalin";
                            }

                            setTimeout(() => (button.textContent = original), 1500);
                        });

                        /* Responsive check */
                        const frame = document.getElementById("rc-frame");
                        const wrap = document.getElementById("rc-wrap");
                        const status = document.getElementById("rc-status");
                        const vpButtons = Array.from(document.querySelectorAll("[data-vp-option]"));
                        const pageButtons = Array.from(document.querySelectorAll("[data-page-option]"));
                        const heights = {
                            375: 760,
                            768: 1024,
                            1440: 900
                        };

                        let viewport = 375;

                        function fitFrame() {
                            const height = heights[viewport];
                            const scale = Math.min(1, wrap.clientWidth / viewport);

                            frame.style.width = `${viewport}px`;
                            frame.style.height = `${height}px`;
                            frame.style.transform = `scale(${scale})`;
                            wrap.style.height = `${height * scale}px`;
                        }

                        function checkOverflow() {
                            try {
                                const doc = frame.contentDocument.documentElement;
                                const overflow = doc.scrollWidth > doc.clientWidth;

                                status.textContent = overflow ?
                                    `Overflow horizontal terdeteksi pada ${viewport}px (${doc.scrollWidth}px > ${doc.clientWidth}px).` :
                                    `Tidak ada overflow horizontal pada ${viewport}px.`;
                            } catch (error) {
                                status.textContent = "Tidak bisa membaca halaman di dalam frame.";
                            }
                        }

                        function setViewport(value) {
                            viewport = value;
                            vpButtons.forEach((b) => toggleActive(b, Number(b.dataset.vp) === value));
                            fitFrame();
                            checkOverflow();
                        }

                        function setPage(url) {
                            pageButtons.forEach((b) => toggleActive(b, b.dataset.page === url));
                            status.textContent = "Memuat...";
                            frame.src = url;
                        }

                        vpButtons.forEach((b) => b.addEventListener("click", () => setViewport(Number(b.dataset.vp))));
                        pageButtons.forEach((b) => b.addEventListener("click", () => setPage(b.dataset.page)));

                        frame.addEventListener("load", checkOverflow);
                        window.addEventListener("resize", fitFrame);

                        window.addEventListener("load", () => {
                            syncThemeButtons();
                            bgButtons.forEach((b, i) => toggleActive(b, i === 0));
                            setViewport(375);
                            setPage(pageButtons[0].dataset.page);
                        });
                    })();
                </script>

            </body>

            </html>