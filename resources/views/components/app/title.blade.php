@props([
    'section' => 'Section',
    'heading' => 'Heading',
])

<div class="flex items-center justify-between gap-4">
  <section class="flex flex-col">
    <span class="text-sm opacity-50">{{ $section }}</span>
    <h1 class="text-lg font-semibold line-clamp-1">
      {{ $heading }}
    </h1>
  </section>

  @isset($actions)
    <div class="flex items-center flex-none gap-2">
      {{ $actions }}
    </div>
  @endisset
</div>
