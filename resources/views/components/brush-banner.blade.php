<div {{ $attributes->merge(['class' => 'relative inline-block']) }}>
    <span class="absolute -inset-x-3 -inset-y-1 inset-0 z-0" aria-hidden="true">
        <img
            src="{{ asset('images/decor/brush-red.svg') }}"
            alt=""
            class="h-full w-full object-fill opacity-95"
        >
    </span>
    <span class="relative z-10 px-2">
        {{ $slot }}
    </span>
</div>
