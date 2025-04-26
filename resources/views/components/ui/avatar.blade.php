@props(['name' => ''])

@php
  $props = $attributes->merge([
      'alt' => $name,
      'src' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=e1e1e1&size=64&font-size=0.33',
      'class' => 'size-10 rounded-full flex-none',
  ]);
@endphp

<img {{ $props }} />
