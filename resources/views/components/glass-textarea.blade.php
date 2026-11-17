@props([
'label' => null,
'hint' => null,
'error' => null,
'value' => null,
])

@php
$name = $attributes->get('name');
$id = $attributes->get('id', $name);
$message = $error ?? ($name ? $errors->first($name) : null);
$describedBy = $message ? $id . '-error' : ($hint ? $id . '-hint' : null);
@endphp

<div class="ui-field">
    @if ($label)
    <label for="{{ $id }}" class="ui-label">{{ $label }}</label>
    @endif

    <textarea
        @if ($message) aria-invalid="true" @endif
        @if ($describedBy) aria-describedby="{{ $describedBy }}" @endif
        {{ $attributes->class([
            'ui-glass-input',
            'ui-glass-input-error' => $message,
        ])->merge(['id' => $id, 'rows' => 3]) }}>{{ $name ? old($name, $value) : $value }}</textarea>

    @if ($message)
    <p id="{{ $id }}-error" class="ui-field-error">{{ $message }}</p>
    @elseif ($hint)
    <p id="{{ $id }}-hint" class="ui-hint">{{ $hint }}</p>
    @endif
</div>
