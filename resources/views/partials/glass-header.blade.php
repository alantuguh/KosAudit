{{-- Header: kartu premium glass melayang --}}
<x-glass-card as="header" level="premium" class="ui-header">
    <div class="ui-header-inner">

        <div class="flex min-w-0 items-center gap-2">
            {{-- Mobile: buka drawer • Desktop: ciutkan / lebarkan sidebar --}}
            <button
                type="button"
                class="ui-icon-btn ui-sidebar-toggle"
                data-sidebar-toggle
                aria-controls="app-sidebar"
                aria-label="Tampilkan atau sembunyikan navigasi"
                title="Navigasi">
                <span class="material-symbols-outlined ui-toggle-mobile" aria-hidden="true">menu</span>
                <span class="material-symbols-outlined ui-toggle-desktop" aria-hidden="true">left_panel_close</span>
            </button>

            <span class="ui-header-brand">KosAudit</span>
        </div>

        <x-glass-account-menu />

    </div>
</x-glass-card>
