@props(['name', 'quote'])

<article class="card card-hover flex h-full flex-col">
    <div class="mb-3 flex gap-0.5 text-steekijs-yellow" aria-hidden="true">
        @foreach (range(1, 5) as $star)
            <span class="text-lg">★</span>
        @endforeach
    </div>
    <p class="flex-1 text-sm leading-relaxed text-steekijs-gray">{{ $quote }}</p>
    <p class="mt-4 font-semibold text-steekijs-bordeaux">{{ $name }}</p>
</article>
