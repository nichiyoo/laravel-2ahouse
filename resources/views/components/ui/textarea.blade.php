@props([
    'disabled' => false,
    'required' => false,
    'rows' => 4,
])

@php
  $props = $attributes
      ->class([
          'w-full text-sm rounded-lg shadow-sm border-zinc-300 text-zinc-900 focus:border-primary-500 focus:ring-primary-500 placeholder:text-zinc-400',
      ])
      ->merge([
          'rows' => $rows,
          'disabled' => $disabled,
          'required' => $required,
      ]);
@endphp

<textarea {{ $props }}>{{ $slot }}</textarea>
