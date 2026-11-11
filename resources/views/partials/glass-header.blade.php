<header class="ui-glass ui-glass-subtle ui-header">
    <div class="ui-header-inner">

        <div class="flex min-w-0 flex-1 items-center gap-3">
            <x-glass-icon-button class="ui-menu-btn" icon="menu" label="Buka menu" data-sidebar-toggle />

            <div class="ui-header-search">
                <x-glass-input
                    id="global-header-search"
                    name="global_search"
                    icon="search"
                    placeholder="Cari nomor kamar, nama penghuni, atau tiket audit..."
                    autocomplete="off"
                    aria-label="Pencarian" />
            </div>
        </div>

        <div class="flex items-center gap-2 sm:gap-4">
            <div class="flex items-center gap-1">
                <x-glass-icon-button icon="notifications" label="Pemberitahuan" :dot="true" />
                <x-glass-icon-button icon="help_outline" label="Pusat Bantuan" />

                <button type="button" class="ui-icon-btn ui-theme-toggle" data-theme-toggle aria-label="Ganti tema" title="Ganti tema">
                    <span class="material-symbols-outlined ui-theme-icon-dark" aria-hidden="true">dark_mode</span>
                    <span class="material-symbols-outlined ui-theme-icon-light" aria-hidden="true">light_mode</span>
                </button>
            </div>

            <div class="flex items-center gap-3">
                <div class="hidden text-right sm:block">
                    <p class="ui-user-name">{{ auth()->user()->name }}</p>
                    <p class="ui-caption">Kost Putri Griya Asri</p>
                </div>

                <x-glass-avatar :name="auth()->user()->name" />
            </div>
        </div>

    </div>
</header>