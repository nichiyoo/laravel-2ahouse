@props(['name' => ''])

@php
  $url = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=10b981&color=fff&size=64';
@endphp

<img src="{{ $url }}" alt="{{ $name }}"
  {{ $attributes->merge([
      'class' => 'size-10 rounded-full content flex-none',
  ]) }} />
