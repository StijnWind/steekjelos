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

function formatEuro(amount) {
    return new Intl.NumberFormat('nl-NL', {
        style: 'currency',
        currency: 'EUR',
    }).format(amount);
}

export function buildPriceBreakdown(pricing, menuItems) {
    const iceLines = [];

    if (pricing.tier1Units > 0) {
        iceLines.push({
            label: `${pricing.tier1Units} × ${formatEuro(TIER1_UNIT_PRICE)}`,
            amount: pricing.tier1Subtotal,
        });
    }

    if (pricing.tier2Units > 0) {
        iceLines.push({
            label: `${pricing.tier2Units} × ${formatEuro(TIER2_UNIT_PRICE)}`,
            amount: pricing.tier2Subtotal,
        });
    }

    if (pricing.tier3Units > 0) {
        iceLines.push({
            label: `${pricing.tier3Units} × ${formatEuro(TIER3_UNIT_PRICE)}`,
            amount: pricing.tier3Subtotal,
        });
    }

    const dipLines = menuItems
        .filter((item) => item.kind === 'dip')
        .map((item) => ({
            label: item.name,
            amount: DIP_UNIT_PRICE,
        }));

    const sections = [];

    if (iceLines.length > 0) {
        sections.push({
            title: 'IJsjes',
            lines: iceLines,
            subtotal: pricing.iceCreamSubtotal,
        });
    }

    if (dipLines.length > 0) {
        sections.push({
            title: 'Dips',
            lines: dipLines,
            subtotal: pricing.dipSubtotal,
        });
    }

    return { sections };
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
        breakdown: buildPriceBreakdown(pricing, menuItems),
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

export function normalizePostcode(value) {
    const compact = String(value).trim().replace(/\s+/g, '').toUpperCase();

    if (/^[1-9][0-9]{3}[A-Z]{2}$/.test(compact)) {
        return `${compact.slice(0, 4)} ${compact.slice(4)}`;
    }

    return String(value).trim().replace(/\s+/g, ' ').toUpperCase();
}

export function isValidDutchPostcode(value) {
    return /^[1-9][0-9]{3} [A-Z]{2}$/.test(normalizePostcode(value));
}
