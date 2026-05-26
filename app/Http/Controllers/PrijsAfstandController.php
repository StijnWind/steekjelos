<?php

namespace App\Http\Controllers;

use App\Services\GoogleDistanceMatrixService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class PrijsAfstandController extends Controller
{
    public function __invoke(Request $request, GoogleDistanceMatrixService $distanceMatrix): JsonResponse
    {
        $validated = $request->validate([
            'postcode' => ['required', 'string', 'regex:/^[1-9][0-9]{3}\s?[A-Za-z]{2}$/i'],
        ]);

        $postcode = $this->normalizePostcode($validated['postcode']);

        try {
            $kilometers = $distanceMatrix->drivingDistanceKm($postcode);
        } catch (RuntimeException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 422);
        }

        return response()->json([
            'kilometers' => $kilometers,
            'label' => number_format($kilometers, 1, ',', '.').' km',
        ]);
    }

    private function normalizePostcode(string $value): string
    {
        $normalized = strtoupper(preg_replace('/\s+/', ' ', trim($value)) ?? '');

        if (preg_match('/^([1-9][0-9]{3})([A-Z]{2})$/', $normalized, $matches)) {
            return $matches[1].' '.$matches[2];
        }

        return $normalized;
    }
}
