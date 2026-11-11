@php
$levels = [
'premium' => [
'title' => 'Premium Glass',
'desc' => 'Sharp & crystal clear. Untuk login, modal penting, dan panel utama.',
],
'subtle' => [
'title' => 'Subtle Glass',
'desc' => 'Light & minimal. Untuk dashboard kompleks dan panel pendukung.',
],
];

$controls = [
'bg' => ['label' => 'Opacity background', 'min' => 0, 'max' => 0.8, 'step' => 0.01],
'border' => ['label' => 'Opacity border', 'min' => 0, 'max' => 1, 'step' => 0.01],
'highlight' => ['label' => 'Opacity highlight', 'min' => 0, 'max' => 1, 'step' => 0.01],
'blur' => ['label' => 'Blur (px)', 'min' => 0, 'max' => 24, 'step' => 1],
];
@endphp
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Glass Lab | KosAudit</title>

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

            <x-dev.nav active="glass-lab" />

            <!-- Header: tema & background -->
            <x-glass-card level="subtle" class="p-5 sm:p-6">
                <div class="flex flex-col gap-5 lg:flex-row lg:items-center lg:justify-between">

                    <div class="space-y-1">
                        <p class="ui-eyebrow">UI Playground &middot; Local only</p>
                        <h1 class="ui-heading-lg">Glass Lab</h1>
                        <p class="ui-body-sm max-w-md">
                            Atur nilai glass dengan slider, lalu tekan Terapkan untuk menulisnya ke tokens.css.
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

            <!-- Premium & Subtle berdampingan -->
            <div class="grid gap-6 lg:grid-cols-2">
                @foreach ($levels as $level => $meta)
                <section class="space-y-4">

                    <!-- Preview -->
                    <x-glass-card :level="$level" class="p-6 sm:p-8" data-preview="{{ $level }}">
                        <div class="space-y-5">
                            <div class="space-y-2">
                                <p class="ui-eyebrow">{{ $meta['title'] }}</p>
                                <h2 class="ui-heading-md">Kondisi Kamar 101</h2>
                                <p class="ui-body-sm">{{ $meta['desc'] }}</p>
                                <p class="ui-caption">Teks muted: terakhir diperbarui hari ini.</p>
                            </div>

                            <x-glass-input
                                label="Alamat Email"
                                type="email"
                                name="preview_{{ $level }}"
                                icon="mail"
                                placeholder="nama@email.com" />

                            <div class="flex gap-3">
                                <x-glass-button type="button" variant="primary">Primary</x-glass-button>
                                <x-glass-button type="button" variant="secondary">Secondary</x-glass-button>
                            </div>
                        </div>
                    </x-glass-card>

                    <!-- Kontrol -->
                    <x-glass-card level="subtle" class="space-y-4 p-5">
                        <p class="ui-label">Kontrol {{ $meta['title'] }}</p>

                        @foreach ($controls as $prop => $c)
                        <div class="space-y-1.5">
                            <div class="flex items-center justify-between">
                                <label for="{{ $level }}-{{ $prop }}" class="ui-label">{{ $c['label'] }}</label>
                                <span class="ui-caption tabular-nums" data-readout="{{ $level }}-{{ $prop }}">0</span>
                            </div>

                            <input
                                type="range"
                                id="{{ $level }}-{{ $prop }}"
                                class="w-full cursor-pointer accent-brand-500"
                                min="{{ $c['min'] }}"
                                max="{{ $c['max'] }}"
                                step="{{ $c['step'] }}"
                                data-level="{{ $level }}"
                                data-prop="{{ $prop }}">
                        </div>
                        @endforeach
                    </x-glass-card>

                </section>
                @endforeach
            </div>

            <!-- Output & terapkan -->
            <x-glass-card level="subtle" class="space-y-4 p-5 sm:p-6">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="space-y-1">
                        <p class="ui-label">Nilai untuk tokens.css</p>
                        <p id="apply-status" class="text-xs text-content-secondary" role="status">
                            Belum ada perubahan.
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-2">
                        <x-glass-button type="button" variant="secondary" :block="false" id="btn-reset">Reset ke token</x-glass-button>
                        <x-glass-button type="button" variant="secondary" :block="false" id="btn-copy">Copy nilai</x-glass-button>
                        <x-glass-button type="button" variant="primary" :block="false" id="btn-apply" data-apply-url="{{ route('dev.apply') }}">Terapkan ke tokens.css</x-glass-button>
                    </div>
                </div>

                <pre id="token-output" class="overflow-x-auto font-mono text-xs leading-6 text-content-secondary"></pre>

                <p class="ui-caption">
                    Hanya baris yang berubah di blok tema aktif yang ditulis. Shadow tidak ikut.
                    Pastikan npm run dev berjalan agar perubahan langsung terlihat.
                </p>
            </x-glass-card>

        </main>
    </div>

    <script>
        (() => {
            "use strict";

            const root = document.documentElement;
            const scene = document.getElementById("scene");
            const output = document.getElementById("token-output");
            const status = document.getElementById("apply-status");
            const applyButton = document.getElementById("btn-apply");
            const csrf = document.querySelector('meta[name="csrf-token"]').content;
            const levels = ["premium", "subtle"];
            const BG_KEY = "kosaudit-dev-bg";

            const alpha = {
                format: (v) => `rgba(255, 255, 255, ${v})`,
                parse: (s) => {
                    const m = s.match(/([\d.]+)\s*\)\s*$/);
                    return m ? parseFloat(m[1]) : 0;
                },
            };

            const props = {
                bg: alpha,
                border: alpha,
                highlight: alpha,
                blur: {
                    format: (v) => `${v}px`,
                    parse: (s) => parseFloat(s) || 0,
                },
            };

            const sliders = Array.from(document.querySelectorAll("input[data-prop]"));
            const baseline = {};

            const tokenName = (level, prop) => `--glass-${level}-${prop}`;
            const keyOf = (slider) => tokenName(slider.dataset.level, slider.dataset.prop);
            const preview = (level) => document.querySelector(`[data-preview="${level}"]`);
            const sliderFor = (level, prop) =>
                document.querySelector(`input[data-level="${level}"][data-prop="${prop}"]`);

            /* Status */
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

            function changedSliders() {
                return sliders.filter((slider) => slider.value !== baseline[keyOf(slider)]);
            }

            function refreshDirty() {
                const count = changedSliders().length;

                if (count === 0) {
                    setStatus("Belum ada perubahan.");
                } else {
                    setStatus(`${count} nilai berubah dan belum diterapkan.`);
                }
            }

            /* Slider */
            function updateReadout(slider) {
                const {
                    level,
                    prop
                } = slider.dataset;
                const readout = document.querySelector(`[data-readout="${level}-${prop}"]`);
                readout.textContent =
                    prop === "blur" ? `${slider.value}px` : Number(slider.value).toFixed(2);
            }

            function applySlider(slider) {
                const {
                    level,
                    prop
                } = slider.dataset;
                preview(level).style.setProperty(
                    tokenName(level, prop),
                    props[prop].format(slider.value),
                );
                updateReadout(slider);
            }

            function renderOutput() {
                const theme = root.dataset.theme || "light";
                const block = theme === "dark" ? '[data-theme="dark"]' : ':root, [data-theme="light"]';
                const lines = [`/* Blok ${block} di tokens.css */`];

                levels.forEach((level) => {
                    lines.push("");
                    Object.keys(props).forEach((prop) => {
                        const value = props[prop].format(sliderFor(level, prop).value);
                        lines.push(`${tokenName(level, prop)}: ${value};`);
                    });
                });

                output.textContent = lines.join("\n");
            }

            function syncFromTokens() {
                levels.forEach((level) => {
                    Object.keys(props).forEach((prop) => {
                        preview(level).style.removeProperty(tokenName(level, prop));
                    });
                });

                const styles = getComputedStyle(root);

                sliders.forEach((slider) => {
                    const {
                        level,
                        prop
                    } = slider.dataset;
                    const raw = styles.getPropertyValue(tokenName(level, prop)).trim();
                    slider.value = props[prop].parse(raw);
                    baseline[keyOf(slider)] = slider.value;
                    updateReadout(slider);
                });

                renderOutput();
                refreshDirty();
            }

            /* Terapkan ke tokens.css */
            async function applyTokens() {
                const changed = changedSliders();

                if (changed.length === 0) {
                    setStatus("Tidak ada perubahan untuk diterapkan.");
                    return;
                }

                const tokens = {};
                changed.forEach((slider) => {
                    tokens[keyOf(slider)] = Number(slider.value);
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

                    changed.forEach((slider) => {
                        baseline[keyOf(slider)] = slider.value;
                    });

                    setStatus(result.message || "Berhasil diterapkan.", "ok");
                } catch (error) {
                    setStatus(error.message, "error");
                } finally {
                    applyButton.disabled = false;
                    applyButton.textContent = original;
                }
            }

            /* Tombol aktif */
            function toggleActive(button, active) {
                button.classList.toggle("ui-btn-primary", active);
                button.classList.toggle("ui-btn-secondary", !active);
                button.setAttribute("aria-pressed", String(active));
            }

            function syncThemeButtons() {
                const preference = root.dataset.themePreference || "system";
                document.querySelectorAll("[data-theme-option]").forEach((button) => {
                    toggleActive(button, button.dataset.themeSet === preference);
                });
            }

            /* Background (tersimpan selama sesi, ikut terbawa antar tab) */
            const bgButtons = Array.from(document.querySelectorAll("[data-bg-option]"));

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

            /* Event */
            sliders.forEach((slider) => {
                slider.addEventListener("input", () => {
                    applySlider(slider);
                    renderOutput();
                    refreshDirty();
                });
            });

            bgButtons.forEach((button) => {
                button.addEventListener("click", () => setBackground(button.dataset.bg));
            });

            document.getElementById("btn-reset").addEventListener("click", syncFromTokens);
            applyButton.addEventListener("click", applyTokens);

            document.getElementById("btn-copy").addEventListener("click", async (event) => {
                const button = event.currentTarget;
                const original = button.textContent.trim();

                try {
                    await navigator.clipboard.writeText(output.textContent);
                    button.textContent = "Tersalin";
                } catch (error) {
                    button.textContent = "Gagal menyalin";
                }

                setTimeout(() => (button.textContent = original), 1500);
            });

            document.addEventListener("kosaudit:theme-change", () => {
                syncFromTokens();
                syncThemeButtons();
            });

            restoreBackground();

            window.addEventListener("load", () => {
                syncFromTokens();
                syncThemeButtons();
            });
        })();
    </script>

</body>

</html>