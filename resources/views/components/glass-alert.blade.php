@props([
'except' => [],
'type' => null,
'title' => null,
])

@php
$icons = [
'success' => 'check_circle',
'warning' => 'warning',
'danger' => 'error',
'info' => 'info',
];

$items = [];

if ($type) {
$type = array_key_exists($type, $icons) ? $type : 'info';
$message = trim((string) $slot);

if ($message !== '' || $title) {
$items[] = [
'type' => $type,
'icon' => $icons[$type],
'title' => $title,
'messages' => $message !== '' ? [$message] : [],
];
}
} else {
$flashTypes = [
'success' => 'success',
'warning' => 'warning',
'error' => 'danger',
];

foreach ($flashTypes as $key => $alertType) {
if (session($key)) {
$items[] = [
'type' => $alertType,
'icon' => $icons[$alertType],
'title' => null,
'messages' => [session($key)],
];
}
}

$formErrors = collect($errors->getMessages())->except($except)->flatten()->all();

if ($formErrors) {
$items[] = [
'type' => 'danger',
'icon' => 'error',
'title' => count($formErrors) > 1 ? 'Terdapat kesalahan pada input formulir:' : null,
'messages' => $formErrors,
];
}
}
@endphp

@foreach ($items as $item)
<div
    class="ui-alert ui-alert-{{ $item['type'] }}"
    role="{{ $item['type'] === 'danger' ? 'alert' : 'status' }}">
    <span class="material-symbols-outlined ui-alert-icon" aria-hidden="true">
        {{ $item['icon'] }}
    </span>

    <div class="ui-alert-body">
        @if ($item['title'])
        <p class="ui-alert-title">{{ $item['title'] }}</p>
        @endif

        @foreach ($item['messages'] as $message)
        <p>{{ $message }}</p>
        @endforeach
    </div>

    <button
        type="button"
        class="ui-alert-close"
        onclick="this.closest('.ui-alert').remove()"
        aria-label="Tutup">
        <span class="material-symbols-outlined" aria-hidden="true">close</span>
    </button>
</div>
@endforeach