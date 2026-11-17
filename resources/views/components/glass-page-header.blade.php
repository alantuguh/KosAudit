@props([
'title',
'eyebrow' => null,
'description' => null,
])

{{--
    Kepala halaman standar: kartu premium glass berisi
    breadcrumb (slot opsional) / eyebrow, judul (h1), deskripsi, dan aksi di kanan.

    <x-glass-page-header title="..." eyebrow="..." description="...">
        <x-slot:breadcrumb> <a href="...">Induk</a> ... </x-slot:breadcrumb>
        <x-slot:actions> <x-glass-button ...> </x-slot:actions>
    </x-glass-page-header>
--}}
<x-glass-card as="header" level="premium" {{ $attributes->class(['ui-page-header']) }}>
    <div class="min-w-0 space-y-1">
        @isset($breadcrumb)
        <nav aria-label="Breadcrumb" class="ui-breadcrumb mb-1">
            {{ $breadcrumb }}
        </nav>
        @endisset

        @if ($eyebrow)
        <p class="ui-eyebrow">{{ $eyebrow }}</p>
        @endif

        <h1 class="ui-heading-lg">{{ $title }}</h1>

        @if ($description)
        <p class="ui-body-sm">{{ $description }}</p>
        @endif
    </div>

    @isset($actions)
    <div class="ui-page-actions">
        {{ $actions }}
    </div>
    @endisset
</x-glass-card>
