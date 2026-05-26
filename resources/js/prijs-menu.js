const selectedItems = new Map();

export function initMenuSelection() {
    const menuCard = document.getElementById('menu-card');
    const hiddenInput = document.getElementById('menu-items-input');
    const summary = document.getElementById('menu-selection-summary');
    const countEl = document.getElementById('menu-selection-count');

    if (!menuCard || !hiddenInput || !summary) {
        return;
    }

    menuCard.querySelectorAll('.menu-item').forEach((button) => {
        button.addEventListener('click', () => {
            const id = button.dataset.menuId;
            const name = button.dataset.menuName;

            const kind = button.dataset.menuKind || 'flavor';

            if (selectedItems.has(id)) {
                selectedItems.delete(id);
                button.setAttribute('aria-pressed', 'false');
            } else {
                selectedItems.set(id, { name, kind });
                button.setAttribute('aria-pressed', 'true');
            }

            syncMenuSelection(hiddenInput, summary, countEl);
        });
    });
}

function syncMenuSelection(hiddenInput, summary, countEl) {
    const items = Array.from(selectedItems.entries()).map(([id, { name, kind }]) => ({
        id,
        name,
        kind,
    }));

    hiddenInput.value = JSON.stringify(items);

    if (countEl) {
        const count = items.length;
        countEl.textContent = count === 1 ? '1 keuze geselecteerd' : `${count} keuzes geselecteerd`;
    }

    if (items.length === 0) {
        summary.innerHTML = '<span class="text-steekijs-gray">Kies smaken op de menukaart links.</span>';
        return;
    }

    summary.innerHTML = items
        .map(
            ({ name }) =>
                `<span class="mr-2 mb-2 inline-flex rounded-lg bg-steekijs-bordeaux/10 px-2.5 py-1 text-sm font-medium text-steekijs-bordeaux ring-1 ring-steekijs-bordeaux/20">${escapeHtml(name)}</span>`,
        )
        .join('');
}

function escapeHtml(text) {
    const el = document.createElement('span');
    el.textContent = text;
    return el.innerHTML;
}

export function getSelectedMenuItems() {
    return Array.from(selectedItems.entries()).map(([id, { name, kind }]) => ({
        id,
        name,
        kind,
    }));
}
