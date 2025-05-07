@props([
    'readonly' => false,
    'disabled' => false,
])

@php
  $props = $attributes
      ->class([
          'disabled:bg-zinc-200 disabled:text-zinc-500' => $disabled,
          'bg-zinc-50 text-zinc-500 focus:ring-0 focus:border-zinc-300' => $readonly,
      ])
      ->merge([
          'disabled' => $disabled,
          'readonly' => $readonly,
          'class' => 'text-sm p-3 border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-xl w-full',
      ]);
@endphp

<input {{ $props }} />
