@extends('layouts.app')

@section('title', 'Prijzen — ' . config('steekijs.name'))
@section('meta_description', 'Bereken de prijs voor het huren van de Steekijs ijskar en stel je menu samen.')

@section('content')
    <section class="section-padding border-b border-steekijs-vanilla bg-white">
        <div class="site-container max-w-2xl">
            <p class="font-chalk text-2xl text-steekijs-bordeaux">Boek de ijskar</p>
            <h1 class="mt-2 font-display text-4xl tracking-wide text-steekijs-chocolate uppercase md:text-5xl">
                Eenvoudig een offerte aanvragen
            </h1>
            <p class="accent-line ml-0"></p>
            <p class="mt-6 text-lg leading-relaxed text-steekijs-gray">
                Stel je menu samen, vul de gegevens van je evenement in en ontvang een indicatie.
                Onze ambachtelijke steekijs en knapperige wafels maken elk feest compleet.
            </p>
        </div>
    </section>

    <section class="section-padding bg-steekijs-vanilla/40">
        <div class="site-container grid gap-8 lg:grid-cols-2 lg:items-start lg:gap-10">
            <x-menu-card />

            <article class="card">
                <h2 class="font-display text-2xl tracking-wide text-steekijs-chocolate uppercase">Bereken je prijs</h2>

                <form
                    id="prijs-calculator-form"
                    class="mt-6 space-y-5"
                    data-distance-url="{{ route('prijzen.afstand') }}"
                >
                    <input type="hidden" id="menu-items-input" name="menu_items" value="">

                    <div>
                        <label for="event-date" class="label">Welke datum?</label>
                        <input type="date" id="event-date" name="event_date" required class="form-input">
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="start-time" class="label">Hoe laat verwacht je ons?</label>
                            <input type="time" id="start-time" name="start_time" required class="form-input">
                        </div>
                        <div>
                            <label for="end-time" class="label">Tot hoe laat verwacht je ons?</label>
                            <input type="time" id="end-time" name="end_time" required class="form-input">
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="guests" class="label">Hoeveel ijsjes?</label>
                            <input type="number" id="guests" name="guests" min="1" value="50" required class="form-input">
                        </div>
                        <div>
                            <label for="postcode" class="label">Waar verwacht je ons?</label>
                            <input
                                type="text"
                                id="postcode"
                                name="postcode"
                                required
                                inputmode="text"
                                autocomplete="postal-code"
                                placeholder="1234 AB"
                                pattern="^[1-9][0-9]{3}\s?[A-Za-z]{2}$"
                                title="Vul een geldige Nederlandse postcode in, bijvoorbeeld 1234 AB"
                                class="form-input uppercase"
                            >
                        </div>
                    </div>

                    <div>
                        <span class="label">Geselecteerde keuzes</span>
                        <span
                            id="menu-selection-summary"
                            class="mt-1 block min-h-[2.75rem] rounded-xl border border-dashed border-steekijs-caramel/50 bg-steekijs-cream px-4 py-3 text-sm text-steekijs-gray"
                        >
                            Kies smaken op de menukaart links.
                        </span>
                    </div>

                    <x-button type="submit">Bereken prijs</x-button>
                </form>

                <aside id="prijs-result" class="mt-6 hidden rounded-xl border border-steekijs-vanilla bg-steekijs-cream px-5 py-4" role="status" aria-live="polite">
                    <p class="font-semibold text-steekijs-chocolate">Indicatie</p>
                    <p id="prijs-result-total" class="mt-2 hidden font-display text-3xl tracking-wide text-steekijs-bordeaux"></p>
                    <div id="prijs-result-breakdown" class="mt-4 hidden border-t border-steekijs-vanilla pt-4"></div>
                    <p id="prijs-result-distance" class="mt-4 hidden text-sm font-medium text-steekijs-chocolate"></p>
                    <p id="prijs-result-message" class="mt-1 text-sm text-steekijs-gray"></p>
                </aside>
            </article>
        </div>
    </section>
@endsection
