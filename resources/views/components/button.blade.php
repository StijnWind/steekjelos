@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $classes = match ($variant) {
        'primary' => 'inline-flex items-center justify-center rounded-xl bg-steekijs-bordeaux px-7 py-3.5 text-base font-semibold text-white shadow-[var(--shadow-button)] transition hover:bg-steekijs-red focus:outline-none focus-visible:ring-2 focus-visible:ring-steekijs-bordeaux focus-visible:ring-offset-2',
        'inverse' => 'inline-flex items-center justify-center rounded-xl bg-white px-7 py-3.5 text-base font-semibold text-steekijs-bordeaux shadow-[var(--shadow-card)] transition hover:bg-steekijs-cream focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-steekijs-bordeaux',
        default => '',
    };
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
