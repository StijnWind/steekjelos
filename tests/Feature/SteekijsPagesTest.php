<?php

namespace Tests\Feature;

use Tests\TestCase;

class SteekijsPagesTest extends TestCase
{
    public function test_home_page_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Ambachtelijk, Romig, Onvergetelijk', false);
    }

    public function test_contact_page_returns_successful_response(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSee('We horen graag van je', false);
        $response->assertSee(config('steekijs.email'), false);
    }

    public function test_prijzen_page_returns_successful_response(): void
    {
        $response = $this->get('/prijzen');

        $response->assertStatus(200);
        $response->assertSee('Eenvoudig een offerte aanvragen', false);
        $response->assertSee('Bereken prijs', false);
        $response->assertSee('Bereken je prijs', false);
        $response->assertDontSee('Reserveren voor langer dan een uur', false);
        $response->assertSee('Welke datum?', false);
        $response->assertSee('Klassiek', false);
        $response->assertSee('name="start_time"', false);
        $response->assertSee('name="end_time"', false);
        $response->assertSee('data-menu-id="vanille"', false);
        $response->assertSee('menu-selection-summary', false);
        $response->assertSee('Waar verwacht je ons?', false);
        $response->assertSee('name="postcode"', false);
        $response->assertDontSee('Afleverlocatie', false);
    }
}
