@props([
    'status' => null,
    'duration' => 3000,
    'variant' => 'success',
])

@php
  $props = $attributes
      ->merge([
          'class' => 'fixed bottom-24 left-1/2 -translate-x-1/2 z-50 w-full max-w-sm p-4 text-sm rounded-xl',
      ])
      ->class([
          'flex items-start gap-1',
          'bg-green-600 text-zinc-50' => $variant === 'success',
          'bg-yellow-600 text-zinc-50' => $variant === 'warning',
          'bg-red-600 text-zinc-50' => $variant === 'error',
          'bg-blue-600 text-zinc-50' => $variant === 'info',
      ]);
@endphp

@if ($status)
  <div x-data="{ show: true }" x-init="setTimeout(() => show = false, {{ $duration }})" x-show="show" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-5" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-5" {{ $props }}>

    @if ($variant === 'success')
      <i data-lucide="check-circle" class="mr-2 size-5"></i>
    @elseif($variant === 'warning')
      <i data-lucide="alert-triangle" class="mr-2 size-5"></i>
    @elseif($variant === 'error')
      <i data-lucide="x-circle" class="mr-2 size-5"></i>
    @elseif($variant === 'info')
      <i data-lucide="info-circle" class="mr-2 size-5"></i>
    @endif

    {{ $status }}
  </div>
@endif
