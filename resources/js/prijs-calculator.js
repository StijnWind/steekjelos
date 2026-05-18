/**
 * Stub — vervang calculatePrice zodra tarieven/logica zijn aangeleverd.
 */
export function calculatePrice(inputs) {
    const {
        eventDate,
        startTime,
        endTime,
        guests,
        postcode,
        menuItems,
    } = inputs;

    if (!eventDate || !startTime || !endTime || !guests || !postcode) {
        return {
            total: null,
            message: 'Vul alle verplichte velden in om een indicatie te krijgen.',
        };
    }

    if (!isEndAfterStart(startTime, endTime)) {
        return {
            total: null,
            message: 'De eindtijd moet na de begintijd liggen.',
        };
    }

    const normalizedPostcode = normalizePostcode(postcode);

    if (!isValidDutchPostcode(normalizedPostcode)) {
        return {
            total: null,
            message: 'Vul een geldige Nederlandse postcode in, bijvoorbeeld 1234 AB.',
        };
    }

    const flavorNames = menuItems.map((item) => item.name).join(', ');
    const flavorPart = menuItems.length > 0
        ? ` Geselecteerd: ${flavorNames}.`
        : ' Tip: selecteer smaken op de menukaart voor een compleet voorstel.';

    return {
        total: null,
        message: `Bedankt! Je aanvraag voor ${guests} personen op ${formatDateNl(eventDate)} (${startTime}–${endTime}) in ${normalizedPostcode} is ontvangen.${flavorPart} Prijs wordt berekend zodra de tarieven zijn ingesteld.`,
    };
}

function isEndAfterStart(startTime, endTime) {
    const [startH, startM] = startTime.split(':').map(Number);
    const [endH, endM] = endTime.split(':').map(Number);
    const startMinutes = startH * 60 + startM;
    const endMinutes = endH * 60 + endM;

    return endMinutes > startMinutes;
}

function formatDateNl(isoDate) {
    const [year, month, day] = isoDate.split('-');
    return `${day}-${month}-${year}`;
}

function normalizePostcode(value) {
    return String(value).trim().replace(/\s+/g, ' ').toUpperCase();
}

function isValidDutchPostcode(value) {
    return /^[1-9][0-9]{3} [A-Z]{2}$/.test(value);
}
