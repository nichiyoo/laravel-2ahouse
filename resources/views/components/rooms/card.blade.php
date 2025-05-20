@props([
    'room' => null,
])

@php
  $props = $attributes->merge([
      'class' => 'flex flex-col gap-4',
  ]);
@endphp

<div {{ $props }}>
  <h3 class="text-lg font-medium">{{ $room->type }}</h3>

  <div class="grid grid-cols-3 gap-4">
    @foreach ($room->images as $image)
      <div class="overflow-hidden aspect-square rounded-xl">
        <img src="{{ $image }}" alt="{{ $room->type }}" class="object-cover size-full" />
      </div>
    @endforeach
  </div>

  <div class="grid grid-cols-2 gap-4 text-sm">
    <dl class="flex flex-col gap-2">
      <dt class="font-medium">Price</dt>
      <dd class="text-primary-500">Rp {{ number_format($room->price) }}</dd>
    </dl>

    <dl class="flex flex-col gap-2">
      <dt class="font-medium">Rating</dt>
      <dd>
        <x-rating :rating="$room->rating" />
      </dd>
    </dl>

    <dl class="flex flex-col gap-2">
      <dt class="font-medium">Available Capacity</dt>
      <dd>{{ $room->capacity }}</dd>
    </dl>

    @landlord
      <dl class="flex flex-col gap-2 col-span-full">
        <dt class="font-medium">Actions</dt>

        <div class="flex items-center gap-2">
          <a href="{{ route('landlords.rooms.edit', $room) }}">
            <x-ui.button variant="secondary">
              <span>Edit</span>
            </x-ui.button>
          </a>

          <x-ui.delete id="{{ $room->id }}" title="{{ $room->type }}"
            route="{{ route('landlords.rooms.destroy', $room) }}" class="inline-block">
            <x-ui.button variant="destructive">
              <span>Delete</span>
            </x-ui.button>
          </x-ui.delete>
        </div>
      </dl>
    @endlandlord

    <dl class="flex flex-col gap-2 col-span-full">
      <dt class="font-medium">Amenities</dt>

      <ul class="grid grid-cols-2 gap-2 text-sm">
        @foreach ($room->amenities as $amenity)
          <x-amenity :amenity="$amenity" />
        @endforeach
      </ul>
    </dl>
  </div>
</div>
