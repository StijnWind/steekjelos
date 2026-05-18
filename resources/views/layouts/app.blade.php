<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('steekijs.name') . ' — Ambachtelijk vanille-ijs')</title>
    <meta name="description" content="@yield('meta_description', 'Steekijs: ambachtelijk, romig vanille-ijs van de ijskar. Boek ons voor jouw evenement.')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col">
    <x-header />

    <main class="flex-1">
        @yield('content')
    </main>

    <footer class="border-t border-steekijs-vanilla bg-steekijs-chocolate text-steekijs-cream">
        <div class="site-container flex flex-col items-center gap-2 py-10 text-center sm:flex-row sm:justify-between sm:text-left">
            <p class="text-sm">
                &copy; {{ date('Y') }} {{ config('steekijs.brand') }}
            </p>
            <p class="font-chalk text-lg text-steekijs-vanilla">
                {{ config('steekijs.name') }} · @steekijs
            </p>
        </div>
    </footer>
</body>
</html>
