/* =========================================================
   KOSAUDIT DESIGN SYSTEM
   THEME ENGINE

   Supported themes:
   - Light
   - Dark
   - System

   Storage:
   localStorage

   ========================================================= */

import { initGlassTables } from "./table.js";
import { initGlassModals } from "./modal.js";
import { initUiBehaviours } from "./ui.js";
import { initSidebar } from "./sidebar.js";

(() => {
    "use strict";

    const STORAGE_KEY = "kosaudit-theme";

    const VALID_THEMES = ["light", "dark", "system"];

    const root = document.documentElement;

    const systemTheme = window.matchMedia("(prefers-color-scheme: dark)");

    /* =====================================================
       1. GET SAVED THEME
       ===================================================== */

    function getSavedTheme() {
        try {
            const savedTheme = localStorage.getItem(STORAGE_KEY);

            if (VALID_THEMES.includes(savedTheme)) {
                return savedTheme;
            }
        } catch (error) {
            console.warn("[KosAudit] Unable to access theme storage.", error);
        }

        return "system";
    }

    /* =====================================================
       2. RESOLVE THEME
       ===================================================== */

    function resolveTheme(preference) {
        if (preference === "system") {
            return systemTheme.matches ? "dark" : "light";
        }

        return preference;
    }

    /* =====================================================
       3. APPLY THEME
       ===================================================== */

    function applyTheme(preference) {
        const resolvedTheme = resolveTheme(preference);

        root.setAttribute("data-theme", resolvedTheme);

        root.setAttribute("data-theme-preference", preference);

        root.style.colorScheme = resolvedTheme;

        document.dispatchEvent(
            new CustomEvent("kosaudit:theme-change", {
                detail: {
                    preference,
                    theme: resolvedTheme,
                },
            }),
        );
    }

    /* =====================================================
       4. SAVE THEME
       ===================================================== */

    function saveTheme(preference) {
        if (!VALID_THEMES.includes(preference)) {
            return;
        }

        try {
            localStorage.setItem(STORAGE_KEY, preference);
        } catch (error) {
            console.warn("[KosAudit] Unable to save theme.", error);
        }

        applyTheme(preference);
    }

    /* =====================================================
       5. INITIALIZE THEME
       ===================================================== */

    let currentPreference = getSavedTheme();

    applyTheme(currentPreference);

    /* =====================================================
       6. SYSTEM THEME LISTENER
       ===================================================== */

    systemTheme.addEventListener("change", () => {
        if (currentPreference === "system") {
            applyTheme("system");
        }
    });

    /* =====================================================
       7. THEME SELECTOR
       ===================================================== */

    document.addEventListener("click", (event) => {
        const target = event.target.closest("[data-theme-set]");

        if (!target) {
            return;
        }

        const selectedTheme = target.dataset.themeSet;

        if (!VALID_THEMES.includes(selectedTheme)) {
            return;
        }

        currentPreference = selectedTheme;

        saveTheme(selectedTheme);
    });

    /* =====================================================
       8. THEME TOGGLE
       ===================================================== */

    document.addEventListener("click", (event) => {
        const target = event.target.closest("[data-theme-toggle]");

        if (!target) {
            return;
        }

        const currentTheme = resolveTheme(currentPreference);

        const nextTheme = currentTheme === "dark" ? "light" : "dark";

        currentPreference = nextTheme;

        saveTheme(nextTheme);
    });

    /* =====================================================
       9. PUBLIC THEME API
       ===================================================== */

    window.KosAuditTheme = Object.freeze({
        set: (theme) => {
            if (!VALID_THEMES.includes(theme)) {
                return;
            }

            currentPreference = theme;

            saveTheme(theme);
        },

        get: () => ({
            preference: currentPreference,
            theme: resolveTheme(currentPreference),
        }),
    });

})();

/* =========================================================
   KOMPONEN
   Modul Vite bersifat deferred, DOM sudah siap saat ini.
   ========================================================= */

initGlassTables();
initGlassModals();
initUiBehaviours();
initSidebar();

/* Form ber-atribut data-submit-once: cegah submit ganda + tampilkan spinner.
   Hanya aktif bila validasi HTML5 lolos (event submit tidak terpicu jika gagal). */
document.addEventListener("submit", (event) => {
    const form = event.target;

    if (!form.matches("form[data-submit-once]")) {
        return;
    }

    if (form.dataset.submitting) {
        event.preventDefault();
        return;
    }

    form.dataset.submitting = "true";

    const button = event.submitter || form.querySelector('[type="submit"]');

    if (button) {
        button.setAttribute("aria-busy", "true");

        const spinner = document.createElement("span");
        spinner.className = "ui-btn-spinner";
        spinner.setAttribute("aria-hidden", "true");
        button.prepend(spinner);

        // Dinonaktifkan setelah event selesai agar nilai tombol tetap terkirim.
        setTimeout(() => {
            button.disabled = true;
        });
    }
});
