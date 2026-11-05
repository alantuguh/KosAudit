@props([
'label' => null,
])

<label class="ui-checkbox-field">
    <input type="checkbox" {{ $attributes->class(['ui-checkbox']) }}>

    @if ($label)
    <span class="ui-checkbox-label">{{ $label }}</span>
    @endif
</label>