@props([
'id',
'title' => null,
'description' => null,
'perPage' => 10,
'perPageOptions' => [10, 25, 50],
'searchable' => true,
'searchPlaceholder' => 'Cari...',
'filters' => [],
'infoLabel' => 'data',
'stack' => false,
])

{{--
    stack     : true = baris menjadi kartu di layar < 640px (sel butuh data-label).
    $meta     : slot opsional di samping judul, mis. badge "Contoh data".
    $controls : slot opsional untuk filter tambahan (select[data-table-filter]).
    Pemilih "baris per halaman" otomatis disembunyikan bila opsinya hanya satu.
--}}

<x-glass-card
    level="subtle"
    class="ui-table-card"
    data-table="{{ $id }}"
    data-per-page="{{ $perPage }}"
    data-info-label="{{ $infoLabel }}">
    <div class="ui-table-toolbar">
        @if ($title || $description)
        <div class="space-y-1">
            @if ($title)
            <div class="flex flex-wrap items-center gap-2">
                <h2 class="ui-heading-md">{{ $title }}</h2>
                {{ $meta ?? '' }}
            </div>
            @endif

            @if ($description)
            <p class="ui-body-sm">{{ $description }}</p>
            @endif
        </div>
        @endif

        @if ($searchable || $filters || isset($controls))
        <div class="ui-table-controls">
            {{-- Slot opsional: filter tambahan, mis. <x-glass-select data-table-filter> --}}
            {{ $controls ?? '' }}

            @if ($searchable)
            <div class="ui-table-search">
                <x-glass-input
                    name="table_search_{{ $id }}"
                    icon="search"
                    :placeholder="$searchPlaceholder"
                    autocomplete="off"
                    aria-label="Cari di tabel"
                    data-table-search />
            </div>
            @endif

            @if ($filters)
            <div class="ui-filter-group" role="group" aria-label="Filter">
                @foreach ($filters as $key => $filterLabel)
                <button
                    type="button"
                    class="ui-chip"
                    data-filter="{{ $key }}"
                    aria-pressed="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $filterLabel }}
                </button>
                @endforeach
            </div>
            @endif
        </div>
        @endif
    </div>

    <div class="ui-table-scroll">
        <table id="{{ $id }}" @class(['ui-table', 'ui-table-stack' => $stack])>
            <thead>
                {{ $head }}
            </thead>
            <tbody>
                {{ $slot }}
            </tbody>
        </table>
    </div>

    <div class="ui-table-footer">
        <p class="ui-caption" data-table-info role="status"></p>

        <div class="flex flex-wrap items-center gap-3">
            @if (count($perPageOptions) > 1)
            <div class="ui-table-perpage">
                <x-glass-select
                    size="sm"
                    aria-label="Baris per halaman"
                    :options="array_combine($perPageOptions, $perPageOptions)"
                    :value="$perPage"
                    data-per-page-select />
            </div>
            @endif

            <div class="ui-pager" data-table-pager></div>
        </div>
    </div>
</x-glass-card>
{{-- Logika tabel ada di resources/js/table.js (di-load via app.js) --}}
