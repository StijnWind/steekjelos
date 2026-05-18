@extends('layouts.app')

@section('title', config('steekijs.name') . ' — Ambachtelijk, Romig, Onvergetelijk')
@section('meta_description', 'Ontdek het ambachtelijke vanille-ijs van Steekijs. Boek onze ijskar voor jouw evenement.')

@section('content')
    {{-- Hero --}}
    <section class="relative min-h-[88vh] lg:min-h-[92vh]">
        <img
            src="{{ asset('img/image.png') }}"
            alt="Steekijs ijskar met rood-witte parasol in het park"
            class="absolute inset-0 h-full w-full object-cover"
            width="1200"
            height="800"
        >
        <div class="hero-overlay absolute inset-0" aria-hidden="true"></div>

        <div class="relative flex min-h-[88vh] items-end lg:min-h-[92vh] lg:items-center">
            <div class="site-container w-full pb-12 pt-28 lg:pb-20 lg:pt-32">
                <div class="max-w-xl">
                    <p class="font-chalk text-3xl text-steekijs-vanilla md:text-4xl">
                        Romig, koud &amp; super lekker!
                    </p>
                    <h1 class="mt-3 font-display text-5xl leading-none tracking-wide text-white uppercase drop-shadow-sm md:text-7xl">
                        Ambachtelijk,<br>Romig, Onvergetelijk
                    </h1>
                    <p class="mt-5 text-lg leading-relaxed text-steekijs-cream/95">
                        Ontdek ons met liefde gemaakte vanille-ijs. Romige textuur, volle smaak — perfect voor jouw feest of event.
                    </p>
                    <div class="mt-8 flex flex-wrap gap-4">
                        <x-button href="{{ route('prijzen') }}">Boek ons nu</x-button>
                        <a
                            href="{{ route('contact') }}"
                            class="inline-flex items-center justify-center rounded-xl border-2 border-white/90 bg-white/10 px-7 py-3.5 text-base font-semibold text-white backdrop-blur-sm transition hover:bg-white hover:text-steekijs-bordeaux"
                        >
                            Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Product showcase (posterfoto) --}}
    <section class="section-padding bg-white">
        <div class="site-container">
            <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
                <div>
                    <p class="font-chalk text-2xl text-steekijs-bordeaux md:text-3xl">Steek je dag los!</p>
                    <h2 class="mt-2 font-display text-4xl tracking-wide text-steekijs-chocolate uppercase md:text-5xl">
                        Steekijs
                    </h2>
                    <p class="accent-line ml-0"></p>
                    <p class="mt-6 leading-relaxed text-steekijs-gray">
                        Ons handgemaakte ijs tussen knapperige wafels — de smaak van de markt, nu ook op jouw event.
                        Vers bereid, met liefde gemaakt.
                    </p>
                </div>
                <div class="image-frame shadow-[var(--shadow-card-hover)]">
                    <img
                        src="{{ asset('images/posters/hero-picnic.png') }}"
                        alt="Steekijs tussen wafels, romig en vers"
                        class="w-full"
                        loading="lazy"
                    >
                </div>
            </div>
        </div>
    </section>

    {{-- Intro --}}
    <section class="section-padding bg-steekijs-vanilla/60">
        <div class="site-container max-w-3xl text-center">
            <x-section-heading
                subtitle="Vakmanschap in scheppen"
                title="De kunst van ambachtelijk vanille-ijs"
            />
            <p class="mt-8 text-lg leading-relaxed text-steekijs-gray">
                Wij zijn gepassioneerd door het maken van het allerbeste vanille-ijs. Met jarenlange ervaring en een liefde voor ambacht creëren we ijs dat romig, puur en onvergetelijk smaakt.
            </p>
        </div>
    </section>

    <x-feature-row
        title="Puur Ambacht"
        description="Ons vanille-ijs wordt met de hand bereid volgens traditionele methodes. We selecteren alleen de beste ingrediënten en nemen de tijd om elke batch perfect te laten rijpen."
        image="img/Untitled.png"
        image-alt="Steekijs bereiden met traditionele ijsstamper"
        image-position="left"
    />

    <x-feature-row
        title="Rijke Smaak"
        description="De volle, authentieke vanillesmaak komt tot leven in elke hap. Geen kunstmatige toevoegingen, alleen pure smaken die je doen genieten van het moment."
        image="img/Untitled2.png"
        image-alt="Steekijs ijskar op een markt met parasol"
        image-position="right"
    />

    <x-feature-row
        title="Perfect Romig"
        description="Onze unieke receptuur zorgt voor een fluweelzachte textuur die smelt op je tong. Het perfecte ijs voor elke gelegenheid, van bruiloft tot bedrijfsfeest."
        image="img/Untitled3.png"
        image-alt="Steekijs ijskar bedient bezoekers op een evenement"
        image-position="left"
    />

    {{-- Menu preview --}}
    <section class="section-padding bg-steekijs-chocolate text-steekijs-cream">
        <div class="site-container grid items-center gap-10 lg:grid-cols-2 lg:gap-14">
            <div>
                <p class="font-chalk text-2xl text-steekijs-vanilla md:text-3xl">Ons aanbod</p>
                <h2 class="mt-2 font-display text-4xl tracking-wide uppercase md:text-5xl">
                    Smaken, toppings &amp; meer
                </h2>
                <p class="mt-6 leading-relaxed text-steekijs-vanilla/90">
                    Vanille, aardbei, loaded sauzen en knapperige toppings — stel je menu samen bij het boeken van de ijskar.
                </p>
                <div class="mt-8">
                    <x-button variant="inverse" href="{{ route('prijzen') }}">Bekijk menu &amp; prijzen</x-button>
                </div>
            </div>
            <div class="image-frame ring-2 ring-white/10">
                <img
                    src="{{ asset('images/posters/menu-board.png') }}"
                    alt="Steekjelos menukaart met smaken en prijzen"
                    loading="lazy"
                >
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="section-padding bg-white">
        <div class="site-container">
            <x-section-heading
                subtitle="Ervaringen"
                title="Wat onze liefhebbers zeggen"
                class="mb-12"
            />

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <x-testimonial-card
                    name="Mark D."
                    quote="Je proeft echt de liefde en zorg waarmee dit ijs wordt gemaakt. Het heeft precies de juiste balans van zoet en romig, en de vanillesmaak is heerlijk authentiek. Een absolute aanrader!"
                />
                <x-testimonial-card
                    name="Emma S."
                    quote="Dit is zonder twijfel het beste vanille-ijs dat ik ooit heb geproefd! De smaak is zo puur en romig, het voelt alsof ik een stukje hemel eet. Ik kom zeker terug voor meer!"
                />
                <x-testimonial-card
                    name="Tom R."
                    quote="Ik dacht dat ik wist hoe vanille-ijs smaakte, maar dit is op een heel ander niveau. De volle smaak en romige textuur zijn werkelijk uniek. Proef het zelf!"
                />
                <x-testimonial-card
                    name="Sophie V."
                    quote="Ik had nooit gedacht dat vanille-ijs zo bijzonder kon zijn. Dit is geen gewoon ijs; het is een ervaring. Elke hap bracht een glimlach op mijn gezicht."
                />
                <x-testimonial-card
                    name="Hans P."
                    quote="Mijn kinderen zijn dol op het ijs, en eerlijk gezegd, ik ook! Het is onze favoriete stop na een dagje uit. Vers, puur, en altijd perfect van smaak!"
                />
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="section-padding bg-steekijs-bordeaux text-center text-white">
        <div class="site-container max-w-2xl">
            <p class="font-chalk text-2xl text-steekijs-vanilla md:text-3xl">Ook zin in heerlijk ijs?</p>
            <h2 class="mt-2 font-display text-4xl tracking-wide uppercase md:text-5xl">
                Boek de ijskar voor jouw event
            </h2>
            <p class="mt-4 text-steekijs-cream/90">
                Bruiloft, bedrijfsfeest of festival — wij zorgen voor een onvergetelijke ijservaring.
            </p>
            <div class="mt-8">
                <x-button variant="inverse" href="{{ route('prijzen') }}">Boek ons nu</x-button>
            </div>
        </div>
    </section>
@endsection
