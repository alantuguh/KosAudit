@props([
'label' => null,
'options' => [],
'value' => null,
'placeholder' => null,
'error' => null,
'size' => 'md',
])

@php
$name = $attributes->get('name');
$id = $attributes->get('id', $name);
$selected = $name ? old($name, $value) : $value;
$message = $error ?? ($name ? $errors->first($name) : null);
@endphp

<div class="ui-field">
    @if ($label)
    <label for="{{ $id }}" class="ui-label">{{ $label }}</label>
    @endif

    <div class="ui-select-wrap">
        <select
            @if ($message) aria-invalid="true" @endif
            {{ $attributes->class([
                'ui-glass-input',
                'ui-select',
                'ui-select-sm' => $size === 'sm',
                'ui-glass-input-error' => $message,
            ])->merge(['id' => $id]) }}>
            @if ($placeholder)
            <option value="">{{ $placeholder }}</option>
            @endif

            @foreach ($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" @selected((string) $selected===(string) $optionValue)>
                {{ $optionLabel }}
            </option>
            @endforeach
        </select>

        <span class="material-symbols-outlined ui-select-icon" aria-hidden="true">expand_more</span>
    </div>

    @if ($message)
    <p class="ui-field-error">{{ $message }}</p>
    @endif
</div>