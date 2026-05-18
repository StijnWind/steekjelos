@props([
    'texture' => 'none',
    'overlap' => false,
    'tilt' => false,
])

@php
    $bgClass = match ($texture) {
        'wood' => 'bg-texture-wood text-steekijs-cream grain-overlay',
        'kraft' => 'bg-texture-kraft grain-overlay',
        'cream' => 'bg-steekijs-cream grain-overlay',
        default => 'bg-steekijs-cream',
    };
    $overlapClass = $overlap ? '-mt-10 relative z-10' : '';
    $tiltClass = $tilt ? 'rotate-sticker-1' : '';
@endphp

<section {{ $attributes->merge(['class' => "poster-section {$bgClass} {$overlapClass} {$tiltClass}"]) }}>
    <div class="mx-auto max-w-6xl">
        {{ $slot }}
    </div>
</section>
