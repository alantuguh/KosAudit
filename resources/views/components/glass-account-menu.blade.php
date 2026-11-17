@props([
'id' => 'account-menu',
])

{{--
    Menu akun: satu-satunya tempat identitas (nama, peran/properti),
    pilihan tema, dan tombol keluar. Dipakai header desktop & mobile.
    Perilaku buka/tutup: data-dropdown (resources/js/ui.js).
--}}

@php
$user = auth()->user();
$peran = $user->isOwner() ? 'Pemilik • Kost Putri Griya Asri' : 'Penghuni';
@endphp

<div {{ $attributes->class(['ui-dropdown']) }}>
    <button
        type="button"
        class="ui-account-btn"
        data-dropdown="{{ $id }}"
        aria-haspopup="true"
        aria-label="Menu akun {{ $user->name }}">
        <x-glass-avatar :name="$user->name" />
        <span class="material-symbols-outlined" aria-hidden="true">expand_more</span>
    </button>

    <div id="{{ $id }}" class="ui-menu" hidden>
        <div class="ui-menu-head">
            <x-glass-avatar :name="$user->name" />
            <div class="min-w-0">
                <p class="ui-user-name truncate">{{ $user->name }}</p>
                <p class="ui-caption truncate">{{ $peran }}</p>
            </div>
        </div>

        <div class="ui-menu-section">
            <p class="ui-menu-label" id="{{ $id }}-theme">Tema</p>
            <div class="ui-menu-segment" role="group" aria-labelledby="{{ $id }}-theme">
                @foreach (['light' => ['light_mode', 'Terang'], 'dark' => ['dark_mode', 'Gelap'], 'system' => ['contrast', 'Sistem']] as $value => [$icon, $label])
                <button type="button" data-theme-set="{{ $value }}" aria-pressed="false">
                    <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
                    {{ $label }}
                </button>
                @endforeach
            </div>
        </div>

        <div class="ui-menu-section">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ui-menu-item ui-menu-item-danger">
                    <span class="material-symbols-outlined" aria-hidden="true">logout</span>
                    Keluar
                </button>
            </form>
        </div>
    </div>
</div>
