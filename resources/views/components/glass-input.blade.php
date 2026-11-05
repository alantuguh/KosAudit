@props([
    'label' => null,
    'icon' => null,
    'disabled' => false,
    'error' => null,
])

@php
    $name = $attributes->get('name');
    $id = $attributes->get('id', $name);
    $message = $error ?? ($name ? $errors->first($name) : null);
@endphp

<div class="ui-field">
    @if ($label)
        <label for="{{ $id }}" class="ui-label">{{ $label }}</label>
    @endif

    <div class="ui-glass-input-field">
        @if ($icon)
            <span class="material-symbols-outlined ui-glass-input-icon" aria-hidden="true">
                {{ $icon }}
            </span>
        @endif

        <input
            @disabled($disabled)
            @if ($message) aria-invalid="true" @endif
            {{ $attributes->class([
                'ui-glass-input',
                'ui-glass-input-has-icon' => $icon,
                'ui-glass-input-error' => $message,
            ])->merge(['id' => $id, 'type' => 'text']) }}
        >
    </div>

    @if ($message)
        <p class="ui-field-error">{{ $message }}</p>
    @endif
</div>