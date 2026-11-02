<aside class="fixed left-0 top-0 h-full w-72 bg-surface-container-lowest shadow-[0_1px_8px_rgba(0,0,0,0.04)] z-50 flex flex-col justify-between">
    <div class="flex flex-col flex-1 min-h-0">
        {{-- Brand Logo --}}
        <div class="h-16 px-space-lg flex items-center gap-space-sm">
            <div class="w-9 h-9 rounded-xl bg-primary-container text-on-primary flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[22px]">verified_user</span>
            </div>
            <div class="flex flex-col">
                <span class="font-headline-sm text-headline-sm text-on-surface leading-none tracking-tight">KosAudit</span>
                <span class="font-label-sm text-label-sm text-outline mt-0.5 tracking-wider uppercase">Asset &amp; Audit</span>
            </div>
        </div>

        @if (auth()->user()->isOwner())
            {{-- Property Selector Strip --}}
            <div class="px-space-md py-space-sm">
                <div class="bg-surface-container-low px-space-md py-space-sm rounded-lg flex items-center justify-between">
                    <div class="flex items-center gap-space-sm min-w-0">
                        <span class="material-symbols-outlined text-primary text-[20px]">apartment</span>
                        <div class="truncate">
                            <p class="font-label-md text-label-md text-on-surface truncate leading-tight">Griya Asri Putri</p>
                            <p class="font-label-sm text-label-sm text-outline leading-tight">Data kamar tersimpan</p>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-outline text-[18px]">unfold_more</span>
                </div>
            </div>
        @endif

        {{-- Navigation Links with Automatic Active Route Highlighting --}}
        <nav class="flex-1 px-space-md py-space-xs space-y-1 overflow-y-auto">
            @if (auth()->user()->isOwner())
                <a href="{{ route('dashboard') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">space_dashboard</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('kamar.index') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('kamar.*') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">meeting_room</span>
                    <span>Data Kamar</span>
                </a>

                <a href="{{ route('penghuni.index') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('penghuni.*') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">group</span>
                    <span>Penghuni</span>
                </a>

                <a href="{{ route('sewa.index') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('sewa.*') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                    <span>Sewa</span>
                </a>

                <div class="pt-space-sm pb-space-xs px-space-md">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Audit &amp; Inspeksi</span>
                </div>

                <a href="{{ route('inspeksi.komparasi') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('inspeksi.komparasi') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">inventory_2</span>
                    <span>Item Kondisi &amp; Komparasi</span>
                </a>

                <a href="{{ route('inspeksi.create') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('inspeksi.create') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">assignment_turned_in</span>
                    <span>Form Inspeksi</span>
                </a>

                <a href="{{ route('deposit.perhitungan') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('deposit.*') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                    <span>Perhitungan Deposit</span>
                </a>
            @endif

            @if (auth()->user()->isTenant())
                <div class="pt-space-sm pb-space-xs px-space-md">
                    <span class="font-label-sm text-label-sm uppercase tracking-wider text-outline">Portal Penghuni</span>
                </div>

                <a href="{{ route('portal.dashboard') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg transition-all {{ request()->routeIs('portal.*') ? 'bg-primary-container text-on-primary font-label-lg shadow-sm' : 'text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface' }}">
                    <span class="material-symbols-outlined text-[20px]">person_pin</span>
                    <span>Dashboard Penghuni</span>
                </a>

                <a href="{{ route('mobile.beranda') }}"
                   class="flex items-center gap-space-md px-space-md py-2.5 rounded-lg text-on-surface-variant font-body-md text-body-md hover:bg-surface-container-low hover:text-on-surface transition-all">
                    <span class="material-symbols-outlined text-[20px]">smartphone</span>
                    <span>Tampilan Mobile Penghuni</span>
                </a>
            @endif
        </nav>
    </div>

    {{-- Bottom SLA & Logout Card --}}
    <div class="p-space-md bg-surface-container-lowest">
        <div class="bg-surface-container-low p-space-md rounded-xl flex items-center justify-between gap-space-sm">
            <div class="flex items-center gap-space-sm">
                <span class="material-symbols-outlined text-tertiary-container text-[20px]">verified_user</span>
                <div>
                    <p class="font-label-md text-label-md text-on-surface font-semibold">Audit Terlindungi</p>
                    <p class="font-label-sm text-label-sm text-outline">SLA Deposit 24 Jam</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" title="Keluar / Ganti Akun" class="text-outline hover:text-error p-1 rounded transition-colors">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>