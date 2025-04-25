@props([
    'disabled' => false,
])

<input @disabled($disabled)
  {{ $attributes->merge([
      'class' =>
          'text-sm p-3 border-zinc-300 focus:border-primary-500 focus:ring-primary-500 rounded-xl mt-1 w-full placeholder:text-zinc-400',
  ]) }}>
