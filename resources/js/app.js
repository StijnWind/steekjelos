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
    const resultMessage = document.getElementById('prijs-result-message');

    if (!form || !resultBox || !resultMessage) {
        return;
    }

    form.addEventListener('submit', (event) => {
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

        resultMessage.textContent = result.message;
        resultBox.classList.remove('hidden');
        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
}
