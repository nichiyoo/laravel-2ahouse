@props([
    'review' => null,
])

@php
  $props = $attributes->merge([
      'class' => 'flex flex-col gap-4 p-6 content rounded-2xl',
  ]);
@endphp

<div {{ $props }}>
  <x-user :user="$review->tenant->user" status="Renter" />

  <p class="text-sm text-zinc-500 line-clamp-3">
    {{ $review->comment }}
  </p>

  <x-rating :rating="$review->rating" />
</div>
