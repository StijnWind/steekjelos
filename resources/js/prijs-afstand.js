export async function fetchDrivingDistance(postcode, distanceUrl) {
    const params = new URLSearchParams({ postcode: String(postcode).trim() });
    const response = await fetch(`${distanceUrl}?${params.toString()}`, {
        headers: { Accept: 'application/json' },
    });

    const payload = await response.json().catch(() => ({}));

    if (!response.ok) {
        throw new Error(payload.message || 'Afstand kon niet worden berekend.');
    }

    return {
        kilometers: payload.kilometers,
        label: payload.label,
    };
}
