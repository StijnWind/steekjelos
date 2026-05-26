import { fetchDrivingDistance } from './prijs-afstand';
import { calculatePrice } from './prijs-calculator';
import { initMenuSelection } from './prijs-menu';

document.addEventListener('DOMContentLoaded', () => {
    initContactForm();
    initMenuSelection();
    initPrijsCalculator();
});

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

        const data = new FormData(form);
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
