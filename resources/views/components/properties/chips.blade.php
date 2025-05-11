@props([
    'properties' => [],
])

@php
  $props = $attributes->merge([
      'class' => 'overflow-hidden embla',
  ]);
@endphp

<section {{ $props }} id="chips">
  <div class="flex embla__container">
    @foreach (collect($properties)->chunk(2) as $chunk)
      <div class="grid flex-none gap-4 mr-4 basis-3/4 embla__slide">
        @foreach ($chunk as $property)
          <a href="{{ route('properties.show', $property) }}"
            class="grid items-center grid-cols-3 gap-4 overflow-hidden content rounded-2xl">
            <div class="aspect-square">
              <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover size-full" />
            </div>
            <div class="col-span-2 font-medium">
              <h4 class="truncate">{{ $property->name }}</h4>
              <span class="text-sm text-primary-500">Rp {{ number_format($property->min_price) }}</span>
            </div>
          </a>
        @endforeach
      </div>
    @endforeach
  </div>
</section>
