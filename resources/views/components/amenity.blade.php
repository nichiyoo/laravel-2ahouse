@props([
    'amenity' => null,
])

@php
  $props = $attributes->merge([
      'class' => 'flex items-center gap-2 p-3 border rounded-xl border-zinc-200 text-sm',
  ]);
@endphp

<li {{ $props }}>
  <i data-lucide="{{ $amenity->icon() }}" class="size-5"></i>
  <span>{{ $amenity->label() }}</span>
</li>
