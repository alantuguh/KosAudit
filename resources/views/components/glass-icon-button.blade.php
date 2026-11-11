@props([
'icon',
'label',
'dot' => false,
])

<button {{ $attributes->class(['ui-icon-btn'])->merge(['type' => 'button', 'aria-label' => $label, 'title' => $label]) }}>
    <span class="material-symbols-outlined" aria-hidden="true">{{ $icon }}</span>

    @if ($dot)
    <span class="ui-icon-btn-dot" aria-hidden="true"></span>
    @endif
</button>