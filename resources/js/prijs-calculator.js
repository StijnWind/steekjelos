const TIER1_UNIT_PRICE = 2;
const TIER2_UNIT_PRICE = 1.75;
const TIER3_UNIT_PRICE = 1.5;
const TIER1_MAX = 50;
const TIER2_MAX = 50;
const DIP_UNIT_PRICE = 10;

/**
 * P(x,d) = 2·min(x,50) + 1,75·min(max(x−50,0),50) + 1,5·max(x−100,0) + 10d
 */
export function calculateIceCreamPrice(iceCreamCount, dipCount = 0) {
    const x = Math.max(0, Math.floor(Number(iceCreamCount)) || 0);
    const d = Math.max(0, Math.floor(Number(dipCount)) || 0);

    const tier1Units = Math.min(x, TIER1_MAX);
    const tier2Units = Math.min(Math.max(x - TIER1_MAX, 0), TIER2_MAX);
    const tier3Units = Math.max(x - TIER1_MAX - TIER2_MAX, 0);

    const tier1Subtotal = tier1Units * TIER1_UNIT_PRICE;
    const tier2Subtotal = tier2Units * TIER2_UNIT_PRICE;
    const tier3Subtotal = tier3Units * TIER3_UNIT_PRICE;
    const dipSubtotal = d * DIP_UNIT_PRICE;

    return {
        iceCreamCount: x,
        dipCount: d,
        tier1Units,
        tier2Units,
        tier3Units,
        tier1Subtotal,
        tier2Subtotal,
        tier3Subtotal,
        iceCreamSubtotal: tier1Subtotal + tier2Subtotal + tier3Subtotal,
        dipSubtotal,
        total: tier1Subtotal + tier2Subtotal + tier3Subtotal + dipSubtotal,
    };
}

export function countDips(menuItems) {
    return menuItems.filter((item) => item.kind === 'dip').length;
}

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

    if (!Number.isFinite(guests) || guests < 1) {
        return {
            total: null,
            message: 'Vul een geldig aantal ijsjes in (minimaal 1).',
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

    const dipCount = countDips(menuItems);
    const pricing = calculateIceCreamPrice(guests, dipCount);

    return {
        total: pricing.total,
        pricing,
        message: '',
    };
}

function isEndAfterStart(startTime, endTime) {
    const [startH, startM] = startTime.split(':').map(Number);
    const [endH, endM] = endTime.split(':').map(Number);
    const startMinutes = startH * 60 + startM;
    const endMinutes = endH * 60 + endM;

    return endMinutes > startMinutes;
}

function normalizePostcode(value) {
    return String(value).trim().replace(/\s+/g, ' ').toUpperCase();
}

function isValidDutchPostcode(value) {
    return /^[1-9][0-9]{3} [A-Z]{2}$/.test(value);
}
