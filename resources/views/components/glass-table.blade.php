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
])

<x-glass-card
    level="subtle"
    class="ui-table-card"
    data-table="{{ $id }}"
    data-per-page="{{ $perPage }}"
    data-info-label="{{ $infoLabel }}">
    <div class="ui-table-toolbar">
        <div class="space-y-1">
            @if ($title)
            <h2 class="ui-heading-md">{{ $title }}</h2>
            @endif

            @if ($description)
            <p class="ui-body-sm">{{ $description }}</p>
            @endif
        </div>

        @if ($searchable || $filters)
        <div class="ui-table-controls">
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
        <table id="{{ $id }}" class="ui-table">
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
            <div class="ui-table-perpage">
                <x-glass-select
                    size="sm"
                    aria-label="Baris per halaman"
                    :options="array_combine($perPageOptions, $perPageOptions)"
                    :value="$perPage"
                    data-per-page-select />
            </div>

            <div class="ui-pager" data-table-pager></div>
        </div>
    </div>
</x-glass-card>

@once
@push('scripts')
<script>
    (() => {
        "use strict";

        function icon(name) {
            const span = document.createElement("span");
            span.className = "material-symbols-outlined";
            span.setAttribute("aria-hidden", "true");
            span.textContent = name;
            return span;
        }

        function init(card) {
            const table = card.querySelector("table");
            const tbody = table.tBodies[0];
            const rows = Array.from(tbody.rows);
            const columns = table.tHead.rows[0].cells.length;
            const search = card.querySelector("[data-table-search]");
            const filters = Array.from(card.querySelectorAll("[data-filter]"));
            const perPageSelect = card.querySelector("[data-per-page-select]");
            const info = card.querySelector("[data-table-info]");
            const pager = card.querySelector("[data-table-pager]");
            const label = card.dataset.infoLabel || "data";

            const state = {
                query: "",
                filter: filters.length ? filters[0].dataset.filter : "all",
                page: 1,
                perPage: parseInt(perPageSelect ? perPageSelect.value : card.dataset.perPage, 10) || 10,
            };

            const emptyRow = document.createElement("tr");
            emptyRow.className = "ui-table-empty";
            emptyRow.hidden = true;
            const emptyCell = document.createElement("td");
            emptyCell.colSpan = columns;
            emptyCell.textContent = "Tidak ada data yang cocok.";
            emptyRow.appendChild(emptyCell);
            tbody.appendChild(emptyRow);

            function matches(row) {
                if (state.query && !row.textContent.toLowerCase().includes(state.query)) {
                    return false;
                }

                if (state.filter !== "all") {
                    const tags = (row.dataset.tags || "").split(/\s+/);

                    if (!tags.includes(state.filter)) {
                        return false;
                    }
                }

                return true;
            }

            function pageButton(text, page, options = {}) {
                const button = document.createElement("button");
                button.type = "button";
                button.className =
                    "ui-btn ui-btn-sm " + (options.active ? "ui-btn-primary" : "ui-btn-secondary");
                button.disabled = Boolean(options.disabled);

                if (options.icon) {
                    button.appendChild(icon(options.icon));
                } else {
                    button.textContent = text;
                }

                if (options.label) {
                    button.setAttribute("aria-label", options.label);
                }

                if (options.active) {
                    button.setAttribute("aria-current", "page");
                }

                button.addEventListener("click", () => {
                    state.page = page;
                    render();
                });

                return button;
            }

            function renderPager(pages) {
                pager.replaceChildren();
                pager.hidden = pages <= 1;

                if (pages <= 1) {
                    return;
                }

                pager.appendChild(
                    pageButton("", state.page - 1, {
                        icon: "chevron_left",
                        label: "Halaman sebelumnya",
                        disabled: state.page === 1,
                    }),
                );

                const numbers = Array.from(
                        new Set([1, pages, state.page - 1, state.page, state.page + 1]),
                    )
                    .filter((p) => p >= 1 && p <= pages)
                    .sort((a, b) => a - b);

                let previous = 0;

                numbers.forEach((p) => {
                    if (p - previous > 1) {
                        const gap = document.createElement("span");
                        gap.className = "ui-pager-gap";
                        gap.textContent = "…";
                        pager.appendChild(gap);
                    }

                    pager.appendChild(
                        pageButton(String(p), p, {
                            active: p === state.page,
                            label: "Halaman " + p
                        }),
                    );

                    previous = p;
                });

                pager.appendChild(
                    pageButton("", state.page + 1, {
                        icon: "chevron_right",
                        label: "Halaman berikutnya",
                        disabled: state.page === pages,
                    }),
                );
            }

            function render() {
                const filtered = rows.filter(matches);
                const pages = Math.max(1, Math.ceil(filtered.length / state.perPage));

                state.page = Math.min(state.page, pages);

                const start = (state.page - 1) * state.perPage;
                const visible = new Set(filtered.slice(start, start + state.perPage));

                rows.forEach((row) => {
                    row.hidden = !visible.has(row);
                });

                emptyRow.hidden = filtered.length !== 0;

                if (filtered.length === 0) {
                    info.textContent = "Tidak ada data yang cocok.";
                } else {
                    const end = start + visible.size;
                    let text = `Menampilkan ${start + 1}–${end} dari ${filtered.length} ${label}`;

                    if (filtered.length !== rows.length) {
                        text += ` (difilter dari ${rows.length})`;
                    }

                    info.textContent = text;
                }

                renderPager(pages);
            }

            function setQuery(value) {
                state.query = value.trim().toLowerCase();
                state.page = 1;
                render();
            }

            if (search) {
                search.addEventListener("input", () => setQuery(search.value));
            }

            const headerSearch = document.getElementById("global-header-search");

            if (headerSearch) {
                headerSearch.addEventListener("input", () => {
                    if (search) {
                        search.value = headerSearch.value;
                    }

                    setQuery(headerSearch.value);
                });
            }

            filters.forEach((button) => {
                button.addEventListener("click", () => {
                    state.filter = button.dataset.filter;
                    state.page = 1;
                    filters.forEach((b) => b.setAttribute("aria-pressed", String(b === button)));
                    render();
                });
            });

            if (perPageSelect) {
                perPageSelect.addEventListener("change", () => {
                    state.perPage = parseInt(perPageSelect.value, 10) || 10;
                    state.page = 1;
                    render();
                });
            }

            render();
        }

        document.querySelectorAll("[data-table]").forEach(init);
    })();
</script>
@endpush
@endonce