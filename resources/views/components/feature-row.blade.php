@props([
    'title',
    'description',
    'image' => 'img/image.png',
    'imageAlt' => '',
    'imagePosition' => 'left',
])

@php
    $isImageLeft = $imagePosition === 'left';
@endphp

<section @class([
    'section-padding',
    $isImageLeft ? 'bg-white' : 'bg-steekijs-vanilla/50',
])>
    <div class="site-container grid items-center gap-10 md:grid-cols-2 md:gap-14">
        <div @class([
            'image-frame aspect-[4/3]',
            'md:order-1' => $isImageLeft,
            'md:order-2' => ! $isImageLeft,
        ])>
            <img
                src="{{ asset($image) }}"
                alt="{{ $imageAlt }}"
                loading="lazy"
            >
        </div>

        <div @class([
            'md:order-2' => $isImageLeft,
            'md:order-1' => ! $isImageLeft,
        ])>
            <h2 class="font-display text-3xl tracking-wide text-steekijs-chocolate uppercase md:text-4xl">
                {{ $title }}
            </h2>
            <p class="mt-4 leading-relaxed text-steekijs-gray">{{ $description }}</p>
        </div>
    </div>
</section>
