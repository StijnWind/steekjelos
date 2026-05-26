function escapeHtml(text) {
    const el = document.createElement('span');
    el.textContent = text;
    return el.innerHTML;
}

function formatEuro(amount) {
    return new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
    }).format(amount);
}

export function renderPriceBreakdown(container, breakdown) {
    if (!container) {
        return;
    }

    if (!breakdown?.sections?.length) {
        container.innerHTML = '';
        container.classList.add('hidden');
        return;
    }

    const sectionsHtml = breakdown.sections
        .map((section) => {
            const linesHtml = section.lines
                .map(
                    (line) => `
                        <div class="flex justify-between gap-4 py-0.5">
                            <span class="text-steekijs-gray">${escapeHtml(line.label)}</span>
                            <span class="shrink-0 font-medium tabular-nums text-steekijs-chocolate">${formatEuro(line.amount)}</span>
                        </div>
                    `,
                )
                .join('');

            const subtotalHtml = section.lines.length > 1
                ? `
                    <div class="mt-1 flex justify-between gap-4 border-t border-steekijs-vanilla/80 pt-1.5 text-sm">
                        <span class="font-medium text-steekijs-chocolate">Subtotaal</span>
                        <span class="shrink-0 font-semibold tabular-nums text-steekijs-chocolate">${formatEuro(section.subtotal)}</span>
                    </div>
                `
                : '';

            return `
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-steekijs-caramel">${escapeHtml(section.title)}</p>
                    <div class="mt-1.5 space-y-0.5">${linesHtml}</div>
                    ${subtotalHtml}
                </div>
            `;
        })
        .join('');

    container.innerHTML = `
        <p class="text-sm font-semibold text-steekijs-chocolate">Prijsopbouw</p>
        <div class="mt-3 space-y-4 text-sm">${sectionsHtml}</div>
    `;
    container.classList.remove('hidden');
}
