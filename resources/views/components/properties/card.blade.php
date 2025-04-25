@props([
    'property' => null,
])

@php
  $props = $attributes->merge([
      'class' => 'content rounded-2xl overflow-hidden',
  ]);
@endphp

<div {{ $props }}>
  <div class="w-full">
    <div class="p-4">
      <div class="flex items-center gap-2">
        <x-ui.avatar name="{{ $property->landlord->user->name }}" />
        <div class="flex flex-col text-sm">
          <span class="font-medium">{{ $property->landlord->user->name }}</span>
          <span class="text-zinc-500">Owner</span>
        </div>
      </div>
    </div>

    <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover aspect-video size-full" />

    <div class="p-6">
      <div class="flex items-center justify-between font-medium">
        <h3 class="truncate">{{ $property->name }}</h3>
        <span class="text-primary-500">Rp {{ number_format($property->min_price) }}</span>
      </div>
      <p class="text-sm truncate text-zinc-500">{{ $property->address }}</p>
    </div>
  </div>
</div>
