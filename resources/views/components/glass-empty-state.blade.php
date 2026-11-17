@props([
'title',
'icon' => 'inbox',
])

{{-- Keadaan kosong standar: ikon, judul, penjelasan (slot), aksi opsional --}}
<x-glass-card level="subtle" {{ $attributes->class(['ui-empty']) }}>
    <span class="ui-icon-tile ui-tone-brand ui-empty-icon">
        <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>
    </span>

    <h2 class="ui-heading-md">{{ $title }}</h2>

    @if ($slot->isNotEmpty())
    <p class="ui-body-sm ui-empty-text">{{ $slot }}</p>
    @endif

    @isset($actions)
    <div class="ui-empty-actions">
        {{ $actions }}
    </div>
    @endisset
</x-glass-card>
