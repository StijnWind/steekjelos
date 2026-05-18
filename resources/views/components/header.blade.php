<header class="sticky top-0 z-50 border-b border-steekijs-vanilla/80 bg-white/90 backdrop-blur-md">
    <div class="site-container flex items-center justify-between py-4">
        <a href="{{ route('home') }}" class="font-script text-3xl text-steekijs-bordeaux transition hover:text-steekijs-red md:text-4xl">
            {{ config('steekijs.brand') }}
        </a>

        <nav class="flex items-center gap-1" aria-label="Hoofdnavigatie">
            @foreach ([
                ['route' => 'home', 'label' => 'Home'],
                ['route' => 'prijzen', 'label' => 'Prijzen'],
                ['route' => 'contact', 'label' => 'Contact'],
            ] as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @class([
                        'nav-link',
                        'nav-link-active' => request()->routeIs($link['route']),
                    ])
                    @if (request()->routeIs($link['route'])) aria-current="page" @endif
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>
    </div>
</header>
