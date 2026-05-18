@props([
    'subtitle',
    'title',
    'align' => 'center',
])

@php
    $alignClass = match ($align) {
        'right' => 'text-right ml-auto',
        'left' => 'text-left',
        default => 'text-center mx-auto',
    };
@endphp

<header {{ $attributes->merge(['class' => "max-w-2xl {$alignClass}"]) }}>
    <p class="font-chalk text-2xl text-steekijs-bordeaux md:text-3xl">{{ $subtitle }}</p>
    <h2 class="mt-2 font-display text-4xl tracking-wide text-steekijs-chocolate uppercase md:text-5xl">
        {{ $title }}
    </h2>
    <div @class(['accent-line', 'mr-0' => $align === 'right', 'ml-0' => $align === 'left'])></div>
</header>
