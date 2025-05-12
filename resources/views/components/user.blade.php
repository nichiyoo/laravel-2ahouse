@props([
    'user' => null,
    'status' => 'Status',
])

@php
  $props = $attributes->merge([
      'class' => 'flex items-center gap-2',
  ]);
@endphp

<div {{ $props }}>
  <x-ui.avatar name="{{ $user->name }}" />

  <div class="flex flex-col text-sm">
    <span class="font-medium">{{ $user->name }}</span>
    <span class="text-zinc-500">{{ $status }}</span>
  </div>
</div>
