@props([
    'variant' => 'primary',
])

@php
  $classes = [
      'primary' => 'border-primary-500 bg-primary-500 text-zinc-50 hover:bg-primary-600',
      'secondary' => 'border-zinc-200 bg-zinc-200 text-zinc-900 hover:bg-zinc-300',
      'destructive' => 'border-red-500 bg-red-500 text-zinc-50 hover:bg-red-600',
  ];

  $class = $classes[$variant] ?? $classes['primary'];
@endphp

<button
  {{ $attributes->merge([
      'type' => 'submit',
      'class' => "w-full justify-center border rounded-xl px-6 py-3 text-sm font-medium {$class} flex items-center gap-2 focus:outline-none transition ease-in-out duration-150",
  ]) }}>
  {{ $slot }}
</button>
