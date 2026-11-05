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

    console.info("[KosAudit] Theme Engine initialized.");
})();
