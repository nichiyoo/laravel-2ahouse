@props([
    'disabled' => false,
])

<select
  {{ $attributes->merge([
      'class' => 'text-sm p-3 border-zinc-200 focus:border-primary-500 focus:ring-primary-500 rounded-xl mt-1 w-full',
  ]) }}
  @disabled($disabled)>
  {{ $slot }}
</select>
