@props(['name' => ''])

@php
  $props = $attributes->merge([
      'alt' => $name,
      'src' => 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=10b981&color=fff&size=64',
      'class' => 'size-10 rounded-full content flex-none',
  ]);
@endphp

<img {{ $props }} />
