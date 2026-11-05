@props([
'title',
'note' => null,
'code' => null,
])

<x-glass-card level="subtle" class="p-5 sm:p-6">
    <div class="flex items-start justify-between gap-3">
        <div class="space-y-1">
            <h3 class="ui-heading-md">{{ $title }}</h3>

            @if ($note)
            <p class="ui-body-sm">{{ $note }}</p>
            @endif
        </div>

        @if ($code)
        <x-glass-button type="button" variant="secondary" :block="false" data-copy-code>
            Copy Code
        </x-glass-button>
        @endif
    </div>

    <div class="mt-5 space-y-4">
        {{ $slot }}
    </div>

    @if ($code)
    <details class="mt-5">
        <summary class="ui-label cursor-pointer">Lihat kode Blade</summary>

        <pre data-code class="mt-3 overflow-x-auto font-mono text-xs leading-6 text-content-secondary">{{ trim($code) }}</pre>
    </details>
    @endif
</x-glass-card>