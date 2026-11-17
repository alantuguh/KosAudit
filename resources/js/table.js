/* =========================================================
   KOSAUDIT DESIGN SYSTEM
   GLASS TABLE: search, filter chip, pagination (client-side)
   Dipakai oleh komponen <x-glass-table>.

   Konvensi markup:
   - <tr data-tags="a b">        tag untuk filter chip & select
   - <select data-table-filter>  filter tambahan; value = tag, "" = semua.
                                 Semua filter digabung dengan AND.
   - sel .ui-cell-end / [data-search-ignore]  tidak ikut dicari
   ========================================================= */

const SEARCH_IGNORE = ".ui-cell-end, [data-search-ignore]";
const STATUS_DELAY = 400;

function icon(name) {
    const span = document.createElement("span");
    span.className = "material-symbols-outlined";
    span.setAttribute("aria-hidden", "true");
    span.textContent = name;
    return span;
}

function searchText(row) {
    return Array.from(row.cells)
        .filter((cell) => !cell.matches(SEARCH_IGNORE))
        .map((cell) => cell.textContent)
        .join(" ")
        .replace(/\s+/g, " ")
        .toLowerCase();
}

function init(card) {
    const table = card.querySelector("table");
    const tbody = table.tBodies[0];
    const rows = Array.from(tbody.rows);
    const columns = table.tHead.rows[0].cells.length;
    const search = card.querySelector("[data-table-search]");
    const filters = Array.from(card.querySelectorAll("[data-filter]"));
    const selectFilters = Array.from(card.querySelectorAll("select[data-table-filter]"));
    const perPageSelect = card.querySelector("[data-per-page-select]");
    const info = card.querySelector("[data-table-info]");
    const pager = card.querySelector("[data-table-pager]");
    const label = card.dataset.infoLabel || "data";

    const index = new Map(rows.map((row) => [row, searchText(row)]));

    const state = {
        query: "",
        filter: filters.length ? filters[0].dataset.filter : "all",
        page: 1,
        perPage:
            parseInt(perPageSelect ? perPageSelect.value : card.dataset.perPage, 10) || 10,
    };

    const emptyRow = document.createElement("tr");
    emptyRow.className = "ui-table-empty";
    emptyRow.hidden = true;
    const emptyCell = document.createElement("td");
    emptyCell.colSpan = columns;
    emptyCell.textContent = "Tidak ada data yang cocok.";
    emptyRow.appendChild(emptyCell);
    tbody.appendChild(emptyRow);

    let statusTimer;

    function setInfo(text, immediate) {
        clearTimeout(statusTimer);

        if (immediate) {
            info.textContent = text;
        } else {
            // Debounce agar pembaca layar tidak mengumumkan setiap ketikan.
            statusTimer = setTimeout(() => {
                info.textContent = text;
            }, STATUS_DELAY);
        }
    }

    function matches(row) {
        if (state.query && !index.get(row).includes(state.query)) {
            return false;
        }

        const tags = (row.dataset.tags || "").split(/\s+/);

        if (state.filter !== "all" && !tags.includes(state.filter)) {
            return false;
        }

        return selectFilters.every((select) => !select.value || tags.includes(select.value));
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
            render(true);
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
                gap.setAttribute("aria-hidden", "true");
                gap.textContent = "…";
                pager.appendChild(gap);
            }

            pager.appendChild(
                pageButton(String(p), p, {
                    active: p === state.page,
                    label: "Halaman " + p,
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

    function render(immediate = false) {
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
            setInfo("Tidak ada data yang cocok.", immediate);
        } else {
            const end = start + visible.size;
            let text = `Menampilkan ${start + 1}–${end} dari ${filtered.length} ${label}`;

            if (filtered.length !== rows.length) {
                text += ` (difilter dari ${rows.length})`;
            }

            setInfo(text, immediate);
        }

        renderPager(pages);
    }

    function setQuery(value) {
        state.query = value.trim().replace(/\s+/g, " ").toLowerCase();
        state.page = 1;
        render();
    }

    if (search) {
        search.addEventListener("input", () => setQuery(search.value));
    }

    filters.forEach((button) => {
        button.addEventListener("click", () => {
            state.filter = button.dataset.filter;
            state.page = 1;
            filters.forEach((b) => b.setAttribute("aria-pressed", String(b === button)));
            render(true);
        });
    });

    selectFilters.forEach((select) => {
        select.addEventListener("change", () => {
            state.page = 1;
            render(true);
        });
    });

    if (perPageSelect) {
        perPageSelect.addEventListener("change", () => {
            state.perPage = parseInt(perPageSelect.value, 10) || 10;
            state.page = 1;
            render(true);
        });
    }

    render(true);

    return { search, setQuery };
}

export function initGlassTables() {
    const tables = Array.from(document.querySelectorAll("[data-table]")).map(init);

    // Search di header hanya diteruskan ke tabel PERTAMA (tabel utama halaman),
    // bukan ke semua tabel sekaligus.
    const headerSearch = document.getElementById("global-header-search");
    const primary = tables[0];

    if (headerSearch && primary) {
        headerSearch.addEventListener("input", () => {
            if (primary.search) {
                primary.search.value = headerSearch.value;
            }

            primary.setQuery(headerSearch.value);
        });
    }
}
