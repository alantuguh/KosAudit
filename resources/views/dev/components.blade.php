@php
$groups = \App\Support\DevTokenRegistry::componentGroups();

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
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <title>Component Preview | KosAudit</title>

                <link rel="preconnect" href="https://fonts.googleapis.com">
                <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
                <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0">

                {{-- Terapkan tema lebih awal agar tidak berkedip saat pindah tab --}}
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
            </head>

            <body class="min-h-screen overflow-x-hidden antialiased">

                <div
                    id="scene"
                    class="ui-app-background"
                    style="--app-background-image: url('{{ asset('images/bg_sudut.jpg') }}');">
                    <main class="mx-auto max-w-6xl space-y-6 px-5 py-8">

                        <x-dev.nav active="components" />

                        <!-- Header -->
                        <x-glass-card level="subtle" class="p-5 sm:p-6">
                            <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                                <div class="space-y-1">
                                    <p class="ui-eyebrow">UI Playground &middot; Local only</p>
                                    <h1 class="ui-heading-lg">Component Preview</h1>
                                    <p class="ui-body-sm max-w-md">
                                        Atur token lewat panel kontrol, lihat hasilnya langsung di komponen, lalu tekan Terapkan untuk menulisnya ke tokens.css.
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

                        <!-- Panel kontrol -->
                        <x-glass-card level="subtle" class="p-5 sm:p-6">
                            <div class="space-y-1">
                                <p class="ui-label">Panel kontrol</p>
                                <p class="ui-caption">
                                    Grup Warna hanya berlaku untuk tema yang sedang aktif. Mengganti tema membuang perubahan yang belum diterapkan.
                                </p>
                            </div>

                            <div class="mt-4 grid gap-4 md:grid-cols-2">
                                @foreach ($groups as $group => $tokens)
                                <details class="space-y-3" @if ($loop->first) open @endif>
                                    <summary class="ui-label cursor-pointer">{{ $group }}</summary>

                                    <div class="mt-3 space-y-3">
                                        @foreach ($tokens as $t)
                                        @php $id = 'tok-' . $loop->parent->index . '-' . $loop->index; @endphp

                                        <div class="space-y-1.5">
                                            <div class="flex items-center justify-between gap-3">
                                                <label for="{{ $id }}" class="ui-label">{{ $t['label'] }}</label>
                                                <span class="ui-caption tabular-nums" data-readout="{{ $t['name'] }}"></span>
                                            </div>

                                            @if ($t['type'] === 'hex')
                                            <input
                                                type="color"
                                                id="{{ $id }}"
                                                class="block h-9 w-full cursor-pointer border-0 bg-transparent p-0"
                                                data-token="{{ $t['name'] }}"
                                                data-type="hex">
                                            @else
                                            <input
                                                type="range"
                                                id="{{ $id }}"
                                                class="w-full cursor-pointer accent-brand-500"
                                                min="{{ $t['min'] }}"
                                                max="{{ $t['max'] }}"
                                                step="{{ $t['step'] }}"
                                                data-token="{{ $t['name'] }}"
                                                data-type="{{ $t['type'] }}">
                                            @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </details>
                                @endforeach
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
                        <x-dev.preview title="Card" note="Level premium dan subtle, serta varian radius control." :code="$code['card']">
                            <div class="grid gap-4 md:grid-cols-3">
                                <x-glass-card level="premium" class="space-y-2 p-6">
                                    <p class="ui-eyebrow">Premium</p>
                                    <p class="ui-body-sm">Radius card, untuk surface utama.</p>
                                </x-glass-card>

                                <x-glass-card level="subtle" class="space-y-2 p-6">
                                    <p class="ui-eyebrow">Subtle</p>
                                    <p class="ui-body-sm">Radius card, untuk panel pendukung.</p>
                                </x-glass-card>

                                <div class="flex items-start">
                                    <x-glass-card level="subtle" radius="control" class="inline-flex items-center gap-3 px-4 py-3">
                                        <span class="material-symbols-outlined text-brand-300" aria-hidden="true">apartment</span>
                                        <span class="ui-eyebrow">Radius control</span>
                                    </x-glass-card>
                                </div>
                            </div>
                        </x-dev.preview>

                        <!-- Responsive check -->
                        <x-dev.preview title="Responsive Check" note="Memuat halaman asli pada lebar 375 / 768 / 1440 px dan mendeteksi overflow horizontal. Setelah Terapkan, halaman di dalam frame ikut ter-update.">
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

                        <!-- Bar Terapkan (selalu terlihat di bawah layar) -->
                        <div class="sticky bottom-4 z-20">
                            <x-glass-card level="subtle" class="flex flex-wrap items-center justify-between gap-3 px-5 py-4">
                                <p id="apply-status" class="text-xs text-content-secondary" role="status">Belum ada perubahan.</p>

                                <div class="flex flex-wrap gap-2">
                                    <x-glass-button type="button" variant="secondary" :block="false" id="btn-reset">Reset ke token</x-glass-button>
                                    <x-glass-button type="button" variant="primary" :block="false" id="btn-apply" data-apply-url="{{ route('dev.apply') }}">Terapkan ke tokens.css</x-glass-button>
                                </div>
                            </x-glass-card>
                        </div>

                    </main>
                </div>

                <script>
                    (() => {
                        "use strict";

                        const root = document.documentElement;
                        const scene = document.getElementById("scene");
                        const csrf = document.querySelector('meta[name="csrf-token"]').content;

                        function toggleActive(button, active) {
                            button.classList.toggle("ui-btn-primary", active);
                            button.classList.toggle("ui-btn-secondary", !active);
                            button.setAttribute("aria-pressed", String(active));
                        }

                        /* ---------- Tema (klik ditangani app.js lewat data-theme-set) ---------- */
                        function syncThemeButtons() {
                            const preference = root.dataset.themePreference || "system";
                            document.querySelectorAll("[data-theme-option]").forEach((button) => {
                                toggleActive(button, button.dataset.themeSet === preference);
                            });
                        }

                        /* ---------- Background uji ---------- */
                        const bgButtons = Array.from(document.querySelectorAll("[data-bg-option]"));
                        const BG_KEY = "kosaudit-dev-bg";

                        function setBackground(url) {
                            scene.style.setProperty("--app-background-image", `url('${url}')`);
                            bgButtons.forEach((b) => toggleActive(b, b.dataset.bg === url));

                            try {
                                sessionStorage.setItem(BG_KEY, url);
                            } catch (error) {}
                        }

                        function restoreBackground() {
                            let saved = null;

                            try {
                                saved = sessionStorage.getItem(BG_KEY);
                            } catch (error) {}

                            const initial = bgButtons.find((b) => b.dataset.bg === saved) || bgButtons[0];
                            setBackground(initial.dataset.bg);
                        }

                        bgButtons.forEach((button) => {
                            button.addEventListener("click", () => setBackground(button.dataset.bg));
                        });

                        /* ---------- Panel kontrol & Terapkan ---------- */
                        const controls = Array.from(document.querySelectorAll("[data-token]"));
                        const status = document.getElementById("apply-status");
                        const applyButton = document.getElementById("btn-apply");
                        const baseline = {};
                        const channels = {};

                        const formats = {
                            rem: (v) => `${v}rem`,
                            px: (v) => `${v}px`,
                            em: (v) => `${v}em`,
                            percent: (v) => `${v}%`,
                            number: (v) => `${v}`,
                            hex: (v) => v,
                        };

                        const tones = {
                            neutral: "text-content-secondary",
                            ok: "text-success",
                            error: "text-danger",
                        };

                        function setStatus(text, tone = "neutral") {
                            status.textContent = text;
                            Object.values(tones).forEach((cls) => status.classList.remove(cls));
                            status.classList.add(tones[tone]);
                        }

                        const nameOf = (control) => control.dataset.token;

                        function cssValue(control) {
                            const type = control.dataset.type;

                            if (type === "alpha") {
                                return `rgba(${channels[nameOf(control)]}, ${control.value})`;
                            }

                            return formats[type](control.value);
                        }

                        function readValue(control, raw) {
                            const type = control.dataset.type;

                            if (type === "hex") {
                                return /^#[0-9a-fA-F]{6}$/.test(raw) ? raw.toLowerCase() : "#000000";
                            }

                            if (type === "alpha") {
                                const c = raw.match(/rgba\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)/);
                                const a = raw.match(/([\d.]+)\s*\)\s*$/);
                                channels[nameOf(control)] = c ? `${c[1]}, ${c[2]}, ${c[3]}` : "255, 255, 255";

                                return a ? a[1] : "0";
                            }

                            return String(parseFloat(raw) || 0);
                        }

                        function updateReadout(control) {
                            const readout = document.querySelector(`[data-readout="${nameOf(control)}"]`);
                            const type = control.dataset.type;

                            readout.textContent =
                                type === "alpha" ? Number(control.value).toFixed(2) : formats[type](control.value);
                        }

                        function changedControls() {
                            return controls.filter((c) => c.value !== baseline[nameOf(c)]);
                        }

                        function refreshDirty() {
                            const count = changedControls().length;

                            setStatus(
                                count === 0 ?
                                "Belum ada perubahan." :
                                `${count} nilai berubah dan belum diterapkan.`
                            );
                        }

                        function syncFromTokens() {
                            controls.forEach((c) => root.style.removeProperty(nameOf(c)));

                            const styles = getComputedStyle(root);

                            controls.forEach((c) => {
                                const raw = styles.getPropertyValue(nameOf(c)).trim();
                                c.value = readValue(c, raw);
                                baseline[nameOf(c)] = c.value;
                                updateReadout(c);
                            });

                            refreshDirty();
                        }

                        controls.forEach((control) => {
                            control.addEventListener("input", () => {
                                root.style.setProperty(nameOf(control), cssValue(control));
                                updateReadout(control);
                                refreshDirty();
                            });
                        });

                        async function applyTokens() {
                            const changed = changedControls();

                            if (changed.length === 0) {
                                setStatus("Tidak ada perubahan untuk diterapkan.");
                                return;
                            }

                            const tokens = {};
                            changed.forEach((c) => {
                                tokens[nameOf(c)] = c.dataset.type === "hex" ? c.value : Number(c.value);
                            });

                            const original = applyButton.textContent.trim();
                            applyButton.disabled = true;
                            applyButton.textContent = "Menerapkan...";

                            try {
                                const response = await fetch(applyButton.dataset.applyUrl, {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "Accept": "application/json",
                                        "X-CSRF-TOKEN": csrf,
                                    },
                                    body: JSON.stringify({
                                        theme: root.dataset.theme || "light",
                                        tokens,
                                    }),
                                });

                                const result = await response.json().catch(() => ({}));

                                if (!response.ok) {
                                    throw new Error(result.message || `Gagal menerapkan (${response.status}).`);
                                }

                                changed.forEach((c) => {
                                    baseline[nameOf(c)] = c.value;
                                });

                                setStatus(result.message || "Berhasil diterapkan.", "ok");
                            } catch (error) {
                                setStatus(error.message, "error");
                            } finally {
                                applyButton.disabled = false;
                                applyButton.textContent = original;
                            }
                        }

                        document.getElementById("btn-reset").addEventListener("click", syncFromTokens);
                        applyButton.addEventListener("click", applyTokens);

                        document.addEventListener("kosaudit:theme-change", () => {
                            syncFromTokens();
                            syncThemeButtons();
                        });

                        /* ---------- Copy Code ---------- */
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

                        /* ---------- Responsive check ---------- */
                        const frame = document.getElementById("rc-frame");
                        const wrap = document.getElementById("rc-wrap");
                        const rcStatus = document.getElementById("rc-status");
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
                            if (!frame.getAttribute("src")) {
                                return;
                            }

                            try {
                                const doc = frame.contentDocument.documentElement;
                                const overflow = doc.scrollWidth > doc.clientWidth;

                                rcStatus.textContent = overflow ?
                                    `Overflow horizontal terdeteksi pada ${viewport}px (${doc.scrollWidth}px > ${doc.clientWidth}px).` :
                                    `Tidak ada overflow horizontal pada ${viewport}px.`;
                            } catch (error) {
                                rcStatus.textContent = "Tidak bisa membaca halaman di dalam frame.";
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
                            rcStatus.textContent = "Memuat...";
                            frame.src = url;
                        }

                        vpButtons.forEach((b) => b.addEventListener("click", () => setViewport(Number(b.dataset.vp))));
                        pageButtons.forEach((b) => b.addEventListener("click", () => setPage(b.dataset.page)));

                        frame.addEventListener("load", checkOverflow);
                        window.addEventListener("resize", fitFrame);

                        /* ---------- Inisialisasi ---------- */
                        restoreBackground();

                        window.addEventListener("load", () => {
                            syncThemeButtons();
                            syncFromTokens();
                            setViewport(375);
                            setPage(pageButtons[0].dataset.page);
                        });
                    })();
                </script>

            </body>

            </html>