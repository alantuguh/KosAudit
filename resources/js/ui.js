/* =========================================================
   KOSAUDIT DESIGN SYSTEM
   UI BEHAVIOURS (deklaratif via atribut data-*)

   data-disclosure="id"        tombol buka/tutup elemen #id (aria-expanded)
   data-dropdown="id"          seperti disclosure, tetapi menutup sendiri saat
                               klik di luar atau tombol Esc (menu akun, dll.)
   [data-theme-set]            aria-pressed disinkronkan dengan tema aktif
   .ui-upload + [data-upload-name]   tampilkan nama file yang dipilih
   data-preview-action="pesan" aksi yang belum didukung backend:
                               tampilkan toast pratinjau, tidak mengirim apa pun
   window.KosAudit.toast(pesan, { tone, title })
   ========================================================= */

const TOAST_ICONS = {
    success: "check_circle",
    warning: "info",
    danger: "error",
    info: "info",
};

function toastRegion() {
    let region = document.querySelector(".ui-toast-region");

    if (!region) {
        region = document.createElement("div");
        region.className = "ui-toast-region";
        region.setAttribute("role", "status");
        region.setAttribute("aria-live", "polite");
        document.body.appendChild(region);
    }

    return region;
}

export function toast(message, { tone = "info", title = null, duration = 5000 } = {}) {
    const item = document.createElement("div");
    item.className = `ui-toast ui-tone-${tone}`;

    const icon = document.createElement("span");
    icon.className = "material-symbols-outlined";
    icon.setAttribute("aria-hidden", "true");
    icon.textContent = TOAST_ICONS[tone] || TOAST_ICONS.info;

    const body = document.createElement("div");

    if (title) {
        const heading = document.createElement("p");
        heading.className = "font-semibold";
        heading.textContent = title;
        body.appendChild(heading);
    }

    const text = document.createElement("p");
    text.textContent = message;
    body.appendChild(text);

    item.append(icon, body);
    toastRegion().appendChild(item);

    setTimeout(() => item.remove(), duration);
}

/* ---------- Dropdown ---------- */

function setDropdown(button, open) {
    const panel = document.getElementById(button.dataset.dropdown);

    if (!panel) {
        return;
    }

    panel.hidden = !open;
    button.setAttribute("aria-expanded", String(open));
}

function closeDropdowns(except = null) {
    document.querySelectorAll('[data-dropdown][aria-expanded="true"]').forEach((button) => {
        if (button !== except) {
            setDropdown(button, false);
        }
    });
}

/* ---------- Tema ---------- */

function syncThemeButtons(preference) {
    document.querySelectorAll("[data-theme-set]").forEach((button) => {
        button.setAttribute("aria-pressed", String(button.dataset.themeSet === preference));
    });
}

export function initUiBehaviours() {
    document.addEventListener("click", (event) => {
        const dropdown = event.target.closest("[data-dropdown]");

        if (dropdown) {
            const open = dropdown.getAttribute("aria-expanded") !== "true";
            closeDropdowns(dropdown);
            setDropdown(dropdown, open);
            return;
        }

        // Klik di luar panel dropdown yang terbuka -> tutup.
        if (!event.target.closest(".ui-menu")) {
            closeDropdowns();
        }

        const disclosure = event.target.closest("[data-disclosure]");

        if (disclosure) {
            const target = document.getElementById(disclosure.dataset.disclosure);

            if (target) {
                const open = target.hidden;
                target.hidden = !open;
                disclosure.setAttribute("aria-expanded", String(open));

                if (open) {
                    target.querySelector("textarea, input, select, button")?.focus();
                }
            }

            return;
        }

        const preview = event.target.closest("[data-preview-action]");

        if (preview) {
            event.preventDefault();
            toast(preview.dataset.previewAction, {
                tone: "warning",
                title: "Mode pratinjau",
            });
        }
    });

    document.addEventListener("change", (event) => {
        const input = event.target;

        if (!input.matches('.ui-upload input[type="file"]')) {
            return;
        }

        const label = input.closest(".ui-upload").querySelector("[data-upload-name]");

        if (label) {
            const files = Array.from(input.files || []);
            label.textContent = files.length
                ? files.length === 1
                    ? files[0].name
                    : `${files.length} file dipilih`
                : label.dataset.uploadName || "Unggah Foto";
        }
    });

    document.addEventListener("keydown", (event) => {
        if (event.key !== "Escape") {
            return;
        }

        const open = document.querySelector('[data-dropdown][aria-expanded="true"]');

        if (open) {
            setDropdown(open, false);
            open.focus();
        }
    });

    document.querySelectorAll("[data-dropdown]").forEach((button) => {
        button.setAttribute("aria-controls", button.dataset.dropdown);
        button.setAttribute("aria-expanded", "false");
    });

    document.addEventListener("kosaudit:theme-change", (event) => {
        syncThemeButtons(event.detail.preference);
    });

    syncThemeButtons(window.KosAuditTheme?.get().preference ?? "system");

    // Sinkronkan aria-expanded awal dengan status hidden target.
    document.querySelectorAll("[data-disclosure]").forEach((button) => {
        const target = document.getElementById(button.dataset.disclosure);
        button.setAttribute("aria-controls", button.dataset.disclosure);
        button.setAttribute("aria-expanded", String(Boolean(target && !target.hidden)));
    });

    window.KosAudit = Object.freeze({ ...(window.KosAudit || {}), toast });
}
