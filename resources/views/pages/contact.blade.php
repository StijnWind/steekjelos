@extends('layouts.app')

@section('title', 'Contact — ' . config('steekijs.name'))
@section('meta_description', 'Neem contact op met Steekijs voor vragen of een boeking van onze ijskar.')

@section('content')
    <section class="section-padding border-b border-steekijs-vanilla bg-white">
        <div class="site-container">
            <x-section-heading
                subtitle="Neem contact op"
                title="We horen graag van je"
                align="left"
                class="!mx-0 !max-w-none !text-left"
            />
        </div>
    </section>

    <section class="section-padding bg-steekijs-vanilla/40">
        <div class="site-container grid gap-10 lg:grid-cols-5 lg:gap-12">
            <div class="card lg:col-span-3">
                <form id="contact-form" class="space-y-5" novalidate>
                    <div>
                        <label for="name" class="label">Naam</label>
                        <input type="text" id="name" name="name" required class="form-input">
                    </div>

                    <div>
                        <label for="email" class="label">E-mail</label>
                        <input type="email" id="email" name="email" required class="form-input">
                    </div>

                    <div>
                        <label for="phone" class="label">
                            Telefoon <span class="font-normal text-steekijs-gray">(optioneel)</span>
                        </label>
                        <input type="tel" id="phone" name="phone" class="form-input">
                    </div>

                    <div>
                        <label for="subject" class="label">Onderwerp</label>
                        <input type="text" id="subject" name="subject" required class="form-input">
                    </div>

                    <div>
                        <label for="message" class="label">Bericht</label>
                        <textarea id="message" name="message" rows="5" required class="form-input resize-y"></textarea>
                    </div>

                    <x-button type="submit">Verstuur bericht</x-button>
                </form>

                <p id="contact-success" class="mt-4 hidden rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800" role="status">
                    Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.
                </p>
            </div>

            <aside class="card lg:col-span-2 lg:sticky lg:top-24 lg:self-start">
                <p class="font-chalk text-xl text-steekijs-bordeaux">Met liefde gemaakt</p>
                <h2 class="mt-1 font-display text-2xl tracking-wide text-steekijs-chocolate uppercase">Contactgegevens</h2>

                <ul class="mt-6 space-y-5 text-steekijs-gray">
                    <li>
                        <span class="label !mb-1">Telefoon</span>
                        <a href="tel:{{ preg_replace('/\s+/', '', config('steekijs.phone')) }}" class="font-medium text-steekijs-bordeaux hover:underline">
                            {{ config('steekijs.phone') }}
                        </a>
                    </li>
                    <li>
                        <span class="label !mb-1">E-mail</span>
                        <a href="mailto:{{ config('steekijs.email') }}" class="font-medium text-steekijs-bordeaux hover:underline">
                            {{ config('steekijs.email') }}
                        </a>
                    </li>
                    <li>
                        <span class="label !mb-1">Adres</span>
                        <span class="font-medium text-steekijs-chocolate">{{ config('steekijs.address') }}</span>
                    </li>
                </ul>

                <div class="image-frame mt-8">
                    <img
                        src="{{ asset('images/posters/park-ijskar.png') }}"
                        alt="Steekijs ijskar in het park"
                        loading="lazy"
                    >
                </div>
            </aside>
        </div>
    </section>
@endsection
