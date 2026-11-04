<header class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-md shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-40">
    <div class="h-16 px-space-lg flex items-center justify-between gap-space-md">
        {{-- Global Search Input (Connected to TablePlus on Active Table Pages) --}}
        <div class="flex items-center gap-space-md flex-1 max-w-xl">
            <div class="relative w-full">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input id="global-header-search"
                       class="w-full h-10 pl-10 pr-space-md rounded-lg bg-surface-container-low text-on-surface font-body-md text-body-md placeholder:text-outline focus:outline-none focus:bg-surface-container-lowest transition-all"
                       placeholder="Cari nomor kamar, nama penghuni, atau tiket audit..."
                       type="text"/>
            </div>
        </div>

        {{-- Right Action Icons & User Profile --}}
        <div class="flex items-center gap-space-lg">
            <div class="flex items-center gap-space-sm">
                <button aria-label="Pemberitahuan" class="relative p-2 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[22px]">notifications</span>
                    <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-error rounded-full ring-2 ring-surface-container-lowest"></span>
                </button>
                <button aria-label="Pusat Bantuan" class="p-2 rounded-lg text-on-surface-variant hover:bg-surface-container-low hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined text-[22px]">help_outline</span>
                </button>
            </div>

            <div class="h-8 w-px bg-outline-variant/40"></div>

            <div class="flex items-center gap-space-md pl-space-xs">
                <div class="text-right hidden sm:block">
                    <p class="font-label-lg text-label-lg text-on-surface leading-tight font-semibold">
                        {{ auth()->user()->name ?? 'Pemilik Kos' }}
                    </p>
                    <p class="font-label-sm text-label-sm text-outline leading-tight mt-0.5">
                        Kost Putri Griya Asri
                    </p>
                </div>
                <div class="relative">
                    <div class="w-9 h-9 rounded-full bg-primary-fixed text-primary font-label-md flex items-center justify-center ring-2 ring-primary-container/20 font-bold">
                        PK
                    </div>
                    <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-tertiary-container rounded-full ring-2 ring-surface-container-lowest"></span>
                </div>
            </div>
        </div>
    </div>
</header>