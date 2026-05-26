<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GoogleDistanceMatrixService
{
    private const API_URL = 'https://maps.googleapis.com/maps/api/distancematrix/json';

    public function drivingDistanceKm(string $postcode): float
    {
        $apiKey = config('services.google_maps.key');

        if (! is_string($apiKey) || $apiKey === '') {
            throw new RuntimeException('Google Maps API-sleutel is niet geconfigureerd.');
        }

        $destination = $postcode.', Netherlands';
        $origin = config('services.google_maps.distance_origin');

        try {
            $response = Http::timeout(10)
                ->withOptions([
                    'verify' => (bool) config('services.google_maps.ssl_verify', true),
                ])
                ->get(self::API_URL, [
                    'origins' => $origin,
                    'destinations' => $destination,
                    'mode' => 'driving',
                    'key' => $apiKey,
                ])
                ->throw();
        } catch (RequestException $exception) {
            throw new RuntimeException('Afstand kon niet worden opgehaald.', 0, $exception);
        }

        $payload = $response->json();

        if (! is_array($payload) || ($payload['status'] ?? '') !== 'OK') {
            $message = is_array($payload) ? ($payload['error_message'] ?? $payload['status'] ?? 'Onbekende fout') : 'Onbekende fout';

            throw new RuntimeException('Google Maps: '.$message);
        }

        $element = $payload['rows'][0]['elements'][0] ?? null;
        $elementStatus = is_array($element) ? ($element['status'] ?? '') : '';

        if ($elementStatus !== 'OK' || ! isset($element['distance']['value'])) {
            throw new RuntimeException('Geen route gevonden voor deze postcode.');
        }

        $meters = (int) $element['distance']['value'];

        return round($meters / 1000, 1);
    }
}
