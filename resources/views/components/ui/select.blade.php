@props([
    'disabled' => false,
    'required' => false,
    'placeholder' => 'Select an option',
])

@php
  $props = $attributes
      ->class([
          'w-full text-sm rounded-lg shadow-sm border-zinc-300 text-zinc-900 focus:border-primary-500 focus:ring-primary-500 placeholder:text-zinc-400',
      ])
      ->merge([
          'class' => '',
          'disabled' => $disabled,
          'required' => $required,
      ]);
@endphp
<select {{ $props }}>
  <option value="">{{ $placeholder }}</option>
  {{ $slot }}
</select>
