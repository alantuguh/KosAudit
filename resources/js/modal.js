/* =========================================================
   KOSAUDIT DESIGN SYSTEM
   GLASS MODAL (<dialog> native)
   Dipakai oleh komponen <x-glass-modal>.
   ========================================================= */

function open(dialog) {
    if (dialog && !dialog.open) {
        dialog.showModal();
    }
}

function isBackdrop(target) {
    return target instanceof HTMLDialogElement && target.classList.contains("ui-modal");
}

export function initGlassModals() {
    // Catat target saat tombol ditekan, agar seleksi teks di input yang
    // dilepas di luar panel tidak ikut menutup modal (dan menghapus isian).
    let pressedOnBackdrop = false;

    document.addEventListener("pointerdown", (event) => {
        pressedOnBackdrop = isBackdrop(event.target);
    });

    document.addEventListener("click", (event) => {
        const opener = event.target.closest("[data-modal-open]");

        if (opener) {
            open(document.getElementById(opener.dataset.modalOpen));
            return;
        }

        const closer = event.target.closest("[data-modal-close]");

        if (closer) {
            closer.closest("dialog")?.close();
            return;
        }

        // Klik pada area backdrop: target adalah <dialog> itu sendiri.
        if (pressedOnBackdrop && isBackdrop(event.target)) {
            event.target.close();
        }

        pressedOnBackdrop = false;
    });

    // Buka otomatis, mis. saat form di dalamnya gagal validasi.
    document.querySelectorAll("dialog.ui-modal[data-modal-autoopen]").forEach(open);
}
