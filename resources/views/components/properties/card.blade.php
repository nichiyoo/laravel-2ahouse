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

    <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover aspect-video size-full" />

    <div class="flex flex-col gap-2 p-6">
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
