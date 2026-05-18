@php
    $categories = config('menu.categories', []);
@endphp

<div class="card h-full" id="menu-card">
    <h2 class="font-display text-2xl tracking-wide text-steekijs-chocolate uppercase">Onze menukaart</h2>
    <p class="mt-2 text-sm text-steekijs-gray">Klik op smaken en opties — je keuze verschijnt in het formulier.</p>

    <div class="mt-6 space-y-6">
        @foreach ($categories as $category)
            <section>
                <h3 class="inline-block rounded-lg bg-steekijs-bordeaux px-3 py-1 font-display text-sm tracking-wider text-white uppercase">
                    {{ $category['name'] }}
                </h3>
                <ul class="mt-3 space-y-2" role="list">
                    @foreach ($category['items'] as $item)
                        <li>
                            <button
                                type="button"
                                class="menu-item menu-item-btn"
                                data-menu-id="{{ $item['id'] }}"
                                data-menu-name="{{ $item['name'] }}"
                                aria-pressed="false"
                            >
                                <span class="block font-semibold text-steekijs-chocolate">{{ $item['name'] }}</span>
                                <span class="mt-0.5 block text-sm text-steekijs-gray">{{ $item['description'] }}</span>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </section>
        @endforeach
    </div>

    <p id="menu-selection-count" class="mt-6 text-sm font-medium text-steekijs-chocolate">0 keuzes geselecteerd</p>
</div>
