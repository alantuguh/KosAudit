@props([
'name',
'label',
'options' => [],
'value' => null,
'tones' => [],
'icons' => [],
'hideLabel' => false,
])

{{--
    Grup radio bergaya segmented control.
    options: [value => label]; tones/icons opsional per value.
    Contoh: <x-glass-segmented name="kondisi[A]" label="Kondisi" :options="[...]"
                               :tones="['Baik' => 'success', 'Rusak' => 'danger']" />
--}}

@php
$selected = old(str_replace(['[', ']'], ['.', ''], $name), $value);
@endphp

<fieldset {{ $attributes->class(['ui-segment']) }}>
    <legend class="{{ $hideLabel ? 'sr-only' : 'ui-label mb-2' }}">{{ $label }}</legend>

    @foreach ($options as $optionValue => $optionLabel)
    <label @class(['ui-segment-item', 'ui-tone-' . ($tones[$optionValue] ?? '') => isset($tones[$optionValue])])>
        <input type="radio" name="{{ $name }}" value="{{ $optionValue }}" @checked((string) $selected === (string) $optionValue)>
        <span class="ui-segment-option">
            @isset($icons[$optionValue])
            <span class="material-symbols-outlined" aria-hidden="true">{{ $icons[$optionValue] }}</span>
            @endisset
            {{ $optionLabel }}
        </span>
    </label>
    @endforeach
</fieldset>
