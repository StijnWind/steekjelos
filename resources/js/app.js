import { fetchDrivingDistance } from './prijs-afstand';
import { calculatePrice, normalizePostcode } from './prijs-calculator';
import { initMenuSelection } from './prijs-menu';
import { renderPriceBreakdown } from './prijs-opbouw';

document.addEventListener('DOMContentLoaded', () => {
    initContactForm();
    initMenuSelection();
    initPrijsCalculator();
    initPostcodeFormatting();
});

function initPostcodeFormatting() {
    const postcodeInput = document.getElementById('postcode');

    if (!postcodeInput) {
        return;
    }

    const formatPostcodeField = () => {
        const normalized = normalizePostcode(postcodeInput.value);

        if (/^[1-9][0-9]{3} [A-Z]{2}$/.test(normalized)) {
            postcodeInput.value = normalized;
        }
    };

    postcodeInput.addEventListener('blur', formatPostcodeField);
}

function initContactForm() {
    const form = document.getElementById('contact-form');
    const success = document.getElementById('contact-success');

    if (!form || !success) {
        return;
    }

    form.addEventListener('submit', (event) => {
        event.preventDefault();

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        success.classList.remove('hidden');
        form.reset();
    });
}

function initPrijsCalculator() {
    const form = document.getElementById('prijs-calculator-form');
    const resultBox = document.getElementById('prijs-result');
    const resultTotal = document.getElementById('prijs-result-total');
    const resultDistance = document.getElementById('prijs-result-distance');
    const resultBreakdown = document.getElementById('prijs-result-breakdown');
    const resultMessage = document.getElementById('prijs-result-message');
    const distanceUrl = form?.dataset.distanceUrl;

    if (!form || !resultBox || !resultMessage) {
        return;
    }

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const postcodeInput = document.getElementById('postcode');
        const data = new FormData(form);

        if (postcodeInput) {
            const normalizedPostcode = normalizePostcode(postcodeInput.value);
            postcodeInput.value = normalizedPostcode;
            data.set('postcode', normalizedPostcode);
        }

        let menuItems = [];

        try {
            const raw = data.get('menu_items');
            menuItems = raw ? JSON.parse(String(raw)) : [];
        } catch {
            menuItems = [];
        }

        const result = calculatePrice({
            eventDate: data.get('event_date'),
            startTime: data.get('start_time'),
            endTime: data.get('end_time'),
            guests: Number(data.get('guests')),
            postcode: data.get('postcode'),
            menuItems,
        });

        if (resultDistance) {
            resultDistance.textContent = '';
            resultDistance.classList.add('hidden');
        }

        if (resultBreakdown) {
            renderPriceBreakdown(resultBreakdown, null);
        }

        if (resultTotal) {
            if (result.total != null) {
                resultTotal.textContent = new Intl.NumberFormat('nl-NL', {
                    style: 'currency',
                    currency: 'EUR',
                }).format(result.total);
                resultTotal.classList.remove('hidden');
            } else {
                resultTotal.textContent = '';
                resultTotal.classList.add('hidden');
            }
        }

        if (result.total != null && resultBreakdown && result.breakdown) {
            renderPriceBreakdown(resultBreakdown, result.breakdown);
        }

        if (result.total != null && resultDistance && distanceUrl) {
            resultDistance.textContent = 'Afstand berekenen…';
            resultDistance.classList.remove('hidden');

            try {
                const distance = await fetchDrivingDistance(data.get('postcode'), distanceUrl);
                resultDistance.textContent = distance.label;
            } catch (error) {
                resultDistance.textContent = error instanceof Error
                    ? error.message
                    : 'Afstand kon niet worden berekend.';
            }
        }

        if (result.message) {
            resultMessage.textContent = result.message;
            resultMessage.classList.remove('hidden');
        } else {
            resultMessage.textContent = '';
            resultMessage.classList.add('hidden');
        }

        resultBox.classList.remove('hidden');
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
}
