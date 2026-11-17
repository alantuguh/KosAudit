@props([
'id',
'title',
'description' => null,
'icon' => null,
'open' => false,
'size' => 'md',
])

{{--
    Modal berbasis <dialog> native: focus trap, tombol Esc, dan
    pengembalian fokus ditangani browser. Perilaku di resources/js/modal.js.

    Buka : <x-glass-button type="button" data-modal-open="{{ $id }}">
    Tutup: elemen apa pun ber-atribut data-modal-close, Esc, atau klik backdrop.
    :open="true" membuka otomatis saat halaman dimuat (mis. ada error validasi).
--}}

<dialog
    id="{{ $id }}"
    aria-labelledby="{{ $id }}-title"
    @if ($description) aria-describedby="{{ $id }}-description" @endif
    @if ($open) data-modal-autoopen @endif
    {{ $attributes->class(['ui-modal', 'ui-modal-' . $size]) }}>
    <div class="ui-modal-panel">
        <header class="ui-modal-header">
            @if ($icon)
            <span class="ui-icon-tile ui-tone-brand">
                <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
            </span>
            @endif

            <div class="min-w-0 flex-1 space-y-1">
                <h2 id="{{ $id }}-title" class="ui-heading-md">{{ $title }}</h2>

                @if ($description)
                <p id="{{ $id }}-description" class="ui-body-sm">{{ $description }}</p>
                @endif
            </div>

            <x-glass-icon-button icon="close" label="Tutup" data-modal-close />
        </header>

        <div class="ui-modal-body">
            {{ $slot }}
        </div>
    </div>
</dialog>
