/* =========================================================
   KOSAUDIT DESIGN SYSTEM
   SIDEBAR
   - Mobile (< 1024px): drawer off-canvas  -> html[data-sidebar-open]
   - Desktop          : rail ikon (ciut)   -> html[data-sidebar-collapsed]
     Status ciut disimpan di localStorage dan diterapkan lebih awal
     oleh skrip di <head> layout agar tidak berkedip.
   ========================================================= */

const STORAGE_KEY = "kosaudit-sidebar";
const desktop = window.matchMedia("(min-width: 1024px)");
const root = document.documentElement;

function syncToggles() {
    const expanded = desktop.matches
        ? !root.hasAttribute("data-sidebar-collapsed")
        : root.hasAttribute("data-sidebar-open");

    document.querySelectorAll("[data-sidebar-toggle]").forEach((button) => {
        button.setAttribute("aria-expanded", String(expanded));
    });
}

function toggle() {
    if (desktop.matches) {
        const collapsed = root.toggleAttribute("data-sidebar-collapsed");

        try {
            localStorage.setItem(STORAGE_KEY, collapsed ? "collapsed" : "expanded");
        } catch (error) {
            // Penyimpanan tidak tersedia: status hanya berlaku di halaman ini.
        }
    } else {
        root.toggleAttribute("data-sidebar-open");
    }

    syncToggles();
}

function closeDrawer() {
    if (root.hasAttribute("data-sidebar-open")) {
        root.removeAttribute("data-sidebar-open");
        syncToggles();
    }
}

export function initSidebar() {
    if (!document.querySelector(".ui-sidebar")) {
        return;
    }

    document.addEventListener("click", (event) => {
        if (event.target.closest("[data-sidebar-toggle]")) {
            toggle();
        } else if (event.target.closest("[data-sidebar-close]")) {
            closeDrawer();
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && !desktop.matches) {
            closeDrawer();
        }
    });

    // Pindah ke desktop: drawer mobile tidak relevan lagi.
    desktop.addEventListener("change", () => {
        root.removeAttribute("data-sidebar-open");
        syncToggles();
    });

    syncToggles();
}
