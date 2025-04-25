@props([
    'properties' => [],
])

@php
  $props = $attributes->merge([
      'class' => 'overflow-hidden embla',
  ]);
@endphp

<section {{ $props }} id="slides">
  <div class="flex embla__container">
    @foreach ($properties as $property)
      <div class="flex-none mr-4 embla__slide basis-11/12">
        <div class="relative w-full overflow-hidden aspect-thumbnail rounded-2xl content">
          <img src="{{ $property->image }}" alt="{{ $property->name }}" class="absolute object-cover size-full" />
          <div class="absolute inset-0 over4ay bg-gradient-to-t from-zinc-950 to-transparent"></div>

          <div class="absolute top-0 w-full p-6 text-white">
            <div class="flex items-center justify-between">
              <div class="flex items-center gap-2 text-yellow-400">
                <i data-lucide="star" class="fill-current size-5"></i>
                <span>{{ $property->rating }}</span>
              </div>
            </div>
          </div>

          <div class="relative flex flex-col justify-end h-full p-6 text-white">
            <span>Rp {{ number_format($property->min_price) }}</span>
            <h4 class="text-2xl font-medium truncate">{{ $property->name }}</h4>
            <p class="text-sm truncate opacity-50">{{ $property->address }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</section>
