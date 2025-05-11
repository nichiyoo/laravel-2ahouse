@props([
    'property' => null,
])

@php
  $props = $attributes->merge([
      'class' => 'w-full',
  ]);
@endphp

<nav {{ $props }}>
  <div class="grid grid-cols-2 border-t border-zinc-200 bg-zinc-50">
    <a href="{{ route('properties.map', $property) }}" class="p-4">
      <x-ui.button variant="secondary">
        <i data-lucide="map" class="size-5"></i>
        <span>View Location</span>
      </x-ui.button>
    </a>

    <a href="{{ route('tenants.properties.rent', $property) }}" class="p-4">
      <x-ui.button>
        <i data-lucide="shopping-cart" class="size-5"></i>
        <span>Rent</span>
      </x-ui.button>
    </a>
  </div>
</nav>
