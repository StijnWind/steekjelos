<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PrijsAfstandTest extends TestCase
{
    public function test_distance_endpoint_returns_kilometers(): void
    {
        config([
            'services.google_maps.key' => 'test-key',
            'services.google_maps.distance_origin' => 'Grote Markt 27, Groningen, Netherlands',
        ]);

        Http::fake([
            'maps.googleapis.com/maps/api/distancematrix/json*' => Http::response([
                'status' => 'OK',
                'rows' => [
                    [
                        'elements' => [
                            [
                                'status' => 'OK',
                                'distance' => [
                                    'text' => '45,2 km',
                                    'value' => 45234,
                                ],
                            ],
                        ],
                    ],
                ],
            ]),
        ]);

        $response = $this->getJson('/prijzen/afstand?postcode=9426+EC');

        $response
            ->assertOk()
            ->assertJson([
                'kilometers' => 45.2,
                'label' => '45,2 km',
            ]);

        Http::assertSent(function ($request) {
            return str_contains($request->url(), 'distancematrix/json')
                && $request['origins'] === 'Grote Markt 27, Groningen, Netherlands'
                && $request['destinations'] === '9426 EC, Netherlands'
                && $request['mode'] === 'driving'
                && $request['key'] === 'test-key';
        });
    }

    public function test_distance_endpoint_validates_postcode(): void
    {
        $response = $this->getJson('/prijzen/afstand?postcode=ongeldig');

        $response->assertUnprocessable();
    }

    public function test_distance_endpoint_returns_error_without_api_key(): void
    {
        config(['services.google_maps.key' => null]);

        $response = $this->getJson('/prijzen/afstand?postcode=1234+AB');

        $response
            ->assertStatus(422)
            ->assertJsonPath('message', 'Google Maps API-sleutel is niet geconfigureerd.');
    }
}
