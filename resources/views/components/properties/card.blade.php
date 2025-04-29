@props([
    'property' => null,
])

@php
  $props = $attributes->merge([
      'class' => 'content rounded-2xl overflow-hidden',
  ]);
@endphp

<a href="{{ route('tenants.properties.show', $property) }}" {{ $props }}>
  <div class="w-full">
    <div class="flex items-center justify-between gap-4 p-4">
      <x-properties.detail.profile :user="$property->landlord->user" />

      <form method="POST" action="{{ route('tenants.properties.bookmark', $property) }}">
        @csrf
        <button size="icon">
          <i data-lucide="bookmark" class="size-5 @if ($property->bookmarked) fill-current @endif"></i>
          <span class="sr-only">Bookmark</span>
        </button>
      </form>
    </div>

    <div class="relative w-full aspect-video">
      <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover size-full" />

      <div class="absolute top-0 right-0 w-full p-4 text-xs font-medium">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-2 px-2 py-1 text-yellow-400 rounded-full bg-zinc-50">
            <i data-lucide="star" class="fill-current size-4"></i>
            <span>{{ $property->rating }}</span>
          </div>

          <div class="px-2 py-1 rounded-full bg-zinc-50">
            <span>{{ round($property->distance, 1) }} Km</span>
          </div>
        </div>
      </div>
    </div>

    <div class="flex flex-col gap-1 p-6">
      <h3 class="truncate">{{ $property->name }}</h3>
      <p class="text-sm truncate text-zinc-500">{{ $property->address }}</p>
      <p class="flex items-center gap-2 text-primary-500">
        <span>Rp {{ number_format($property->min_price) }}</span>
        @if ($property->max_price !== $property->min_price)
          <span>-</span>
          <span>Rp {{ number_format($property->max_price) }}</span>
        @endif
      </p>
    </div>

  </div>
</a>
