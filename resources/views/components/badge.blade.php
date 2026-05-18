@props([
    'label' => 'Met liefde gemaakt',
    'variant' => 'default',
])

@php
    $classes = match ($variant) {
        'ambachtelijk' => 'border-steekijs-bordeaux text-steekijs-bordeaux',
        default => 'border-steekijs-caramel text-steekijs-wood',
    };
@endphp

<span
    {{ $attributes->merge([
        'class' => "inline-flex items-center gap-2 rounded-full border-2 bg-steekijs-cream px-4 py-1.5 font-display text-xs tracking-widest uppercase shadow-sticker sticker-tilt {$classes}",
    ]) }}
>
    <img src="{{ asset('images/decor/badge-ambachtelijk.svg') }}" alt="" class="h-6 w-6" width="24" height="24" aria-hidden="true">
    {{ $slot->isEmpty() ? $label : $slot }}
</span>
