@props([
    'disabled' => false,
])

@php
  $props = $attributes->merge([
      'class' => 'text-sm p-3 border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-xl w-full',
  ]);
@endphp

<input @disabled($disabled) {{ $props }}>
