(function () {
    class TablePlus {
        constructor(selector, options = {}) {
            this.table = document.querySelector(selector);
            if (!this.table) {
                throw new Error(`TablePlus could not find table: ${selector}`);
            }

            this.body = this.table.tBodies[0];
            if (!this.body) {
                throw new Error(`TablePlus requires a table body: ${selector}`);
            }

            this.options = options;
            this.rows = Array.from(this.body.rows);
            this.filteredRows = this.rows.slice();
            this.filters = new Map();
            this.query = '';
            this.page = 1;
            this.perPage = Number(options.perPage) || 10;
            this.sortColumn = -1;
            this.sortDirection = 1;
            this.pagination = options.paginationContainer
                ? document.querySelector(options.paginationContainer)
                : null;

            if (options.searchInput) {
                const searchInput = document.querySelector(options.searchInput);
                if (searchInput) {
                    searchInput.addEventListener('input', () => this.search(searchInput.value));
                }
            }

            this.table.querySelectorAll('thead th').forEach((header, index) => {
                header.style.cursor = 'pointer';
                header.setAttribute('aria-sort', 'none');
                header.addEventListener('click', () => this.sort(index));
            });

            this.render();
        }

        search(value) {
            this.query = String(value || '').trim().toLocaleLowerCase();
            this.page = 1;
            this.render('filter');
        }

        setFilter(name, predicate) {
            if (predicate) {
                this.filters.set(name, predicate);
            } else {
                this.filters.delete(name);
            }

            this.page = 1;
            this.render('filter');
        }

        sort(column) {
            if (this.sortColumn === column) {
                this.sortDirection *= -1;
            } else {
                this.sortColumn = column;
                this.sortDirection = 1;
            }

            const headers = this.table.querySelectorAll('thead th');
            headers.forEach((header, index) => {
                header.setAttribute(
                    'aria-sort',
                    index === this.sortColumn
                        ? (this.sortDirection === 1 ? 'ascending' : 'descending')
                        : 'none'
                );
            });

            this.rows.sort((first, second) => {
                const firstValue = first.cells[column]?.innerText.trim() || '';
                const secondValue = second.cells[column]?.innerText.trim() || '';

                return firstValue.localeCompare(secondValue, undefined, {
                    numeric: true,
                    sensitivity: 'base'
                }) * this.sortDirection;
            });

            this.render();
        }

        render(change = null) {
            this.filteredRows = this.rows.filter((row) => {
                const matchesQuery = !this.query
                    || row.innerText.toLocaleLowerCase().includes(this.query);
                return matchesQuery && Array.from(this.filters.values()).every((filter) => filter(row));
            });

            const pageCount = Math.max(1, Math.ceil(this.filteredRows.length / this.perPage));
            this.page = Math.min(this.page, pageCount);
            const startIndex = (this.page - 1) * this.perPage;
            const visibleRows = this.filteredRows.slice(startIndex, startIndex + this.perPage);
            const visibleSet = new Set(visibleRows);

            this.rows.forEach((row) => {
                row.hidden = !visibleSet.has(row);
                this.body.appendChild(row);
            });

            if (this.pagination) {
                this.renderPagination(startIndex, visibleRows.length, pageCount);
            }

            if (change === 'filter') {
                this.options.onFilter?.();
            } else if (change === 'page') {
                this.options.onPageChange?.();
            }
        }

        renderPagination(startIndex, visibleCount, pageCount) {
            this.pagination.replaceChildren();
            this.pagination.classList.add('flex', 'flex-wrap', 'items-center', 'justify-between', 'gap-3');

            const info = document.createElement('p');
            info.className = 'text-sm text-slate-600';
            const first = visibleCount ? startIndex + 1 : 0;
            const last = startIndex + visibleCount;

            if (this.options.infoTemplate) {
                info.innerHTML = this.options.infoTemplate(
                    first,
                    last,
                    this.filteredRows.length,
                    this.rows.length
                );
            } else {
                info.textContent = `Menampilkan ${first}–${last} dari ${this.filteredRows.length} data`;
            }
            this.pagination.appendChild(info);

            const controls = document.createElement('div');
            controls.className = 'flex items-center gap-2';

            if (this.options.perPageOptions?.length) {
                const pageSize = document.createElement('select');
                pageSize.className = 'rounded border border-slate-300 bg-white px-2 py-1 text-sm';
                pageSize.setAttribute('aria-label', 'Jumlah baris per halaman');
                this.options.perPageOptions.forEach((option) => {
                    const size = Number(option);
                    if (!Number.isFinite(size) || size < 1) return;
                    const item = document.createElement('option');
                    item.value = String(size);
                    item.textContent = `${size} per halaman`;
                    item.selected = size === this.perPage;
                    pageSize.appendChild(item);
                });
                pageSize.addEventListener('change', () => {
                    this.perPage = Number(pageSize.value);
                    this.page = 1;
                    this.render('page');
                });
                controls.appendChild(pageSize);
            }

            const previous = this.createPageButton('Sebelumnya', this.page - 1, this.page === 1);
            controls.appendChild(previous);

            for (let page = 1; page <= pageCount; page += 1) {
                const button = this.createPageButton(String(page), page, false);
                button.setAttribute('aria-current', page === this.page ? 'page' : 'false');
                if (page === this.page) {
                    button.classList.add('bg-teal-700', 'text-white');
                }
                controls.appendChild(button);
            }

            controls.appendChild(this.createPageButton('Berikutnya', this.page + 1, this.page === pageCount));
            this.pagination.appendChild(controls);
        }

        createPageButton(label, page, disabled) {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = label;
            button.disabled = disabled;
            button.className = 'rounded border border-slate-300 bg-white px-2.5 py-1 text-sm disabled:cursor-not-allowed disabled:opacity-50';
            button.addEventListener('click', () => {
                this.page = page;
                this.render('page');
            });
            return button;
        }
    }

    window.TablePlus = TablePlus;
})();
