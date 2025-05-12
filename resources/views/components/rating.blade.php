@props([
    'rating' => null,
    'expanded' => false,
])

@php
  $props = $attributes->merge([
      'class' => 'flex items-center gap-2 text-yellow-500',
  ]);
@endphp

<div {{ $props }}>
  @if ($expanded)
    <div class="flex items-center gap-0.5">
      @for ($i = 1; $i <= $rating; $i++)
        <i data-lucide="star" class="mb-1 fill-current size-4"></i>
      @endfor
    </div>
  @else
    <i data-lucide="star" class="size-4"></i>
  @endif

  <span>{{ round($rating, 1) }}</span>
</div>
