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

  @can('update', $review)
    <div class="flex items-center gap-2">
      <a href="{{ route('tenants.reviews.edit', $review) }}">
        <x-ui.button variant="secondary">
          <span>Edit</span>
        </x-ui.button>
      </a>

      <form action="{{ route('tenants.reviews.destroy', $review) }}" method="POST" class="inline">
        @csrf
        @method('DELETE')
        <x-ui.button type="submit" variant="destructive">
          <span>Delete</span>
        </x-ui.button>
      </form>
    </div>
  @endcan
</div>
