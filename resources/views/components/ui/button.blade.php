@props([
    'type' => 'submit',
    'size' => 'default',
    'variant' => 'primary',
])

@php
  $props = $attributes
      ->class([
          'flex items-center gap-2',
          'transition ease-in-out duration-150',
          'px-0 py-0 size-10 aspect-square' => $size === 'icon',
          'px-6 py-3 size-10 aspect-square' => $size === 'default',
          'border-transparent bg-primary-500 text-zinc-50 both:bg-primary-600' => $variant === 'primary',
          'border-transparent bg-zinc-200 text-zinc-900 both:bg-zinc-300' => $variant === 'secondary',
          'border-transparent bg-red-500 text-zinc-50 both:bg-red-600' => $variant === 'destructive',
      ])
      ->merge([
          'type' => $type,
          'class' => 'w-full justify-center border rounded-xl text-sm font-medium focus:outline-none',
      ]);
@endphp

<button {{ $props }}>
  {{ $slot }}
</button>
