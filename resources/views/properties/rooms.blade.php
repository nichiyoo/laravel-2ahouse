<x-app-layout>
  <div class="relative grid gap-6">
    <div class="absolute top-0 w-full">
      <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover aspect-square size-full" />
      <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 to-transparent"></div>
    </div>

    <section class="relative flex flex-col justify-between pb-16 text-white aspect-square p-content">
      <x-properties.detail.topbar :property="$property" />
      <x-properties.detail.profile :user="$property->landlord->user" />
    </section>

    <x-properties.detail :property="$property">
      <div class="grid gap-8">
        @foreach ($property->rooms as $room)
          <div class="flex flex-col gap-4">
            <h3 class="text-lg font-medium">{{ $room->type }}</h3>

            <div class="grid grid-cols-3 gap-4">
              @foreach ($room->images as $image)
                @break($loop->iteration > 3)
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
                <dd class="flex items-center gap-2 text-yellow-500">
                  <i data-lucide="star" class="size-4"></i>
                  <span>{{ round($room->rating, 1) }}</span>
                </dd>
              </dl>

              <dl class="flex flex-col gap-2">
                <dt class="font-medium">Available Capacity</dt>
                <dd class="text-zinc-500">{{ $room->capacity }}</dd>
              </dl>

              <dl class="flex flex-col gap-2">
                <dt class="font-medium">Payment</dt>
                <dd class="text-zinc-500">{{ $room->payment->label() }}</dd>
              </dl>

              <dl class="flex flex-col gap-2 col-span-full">
                <dt class="font-medium">Amenities</dt>
                <ul class="grid grid-cols-2 gap-2 text-sm">
                  @foreach ($room->amenities as $amenity)
                    <li class="flex items-center gap-2 p-3 border rounded-xl border-zinc-200">
                      <i data-lucide="{{ $amenity->icon() }}" class="size-5"></i>
                      <span>{{ $amenity->label() }}</span>
                    </li>
                  @endforeach
                </ul>
              </dl>
            </div>
          </div>
        @endforeach

        <a role="button" href="{{ route('landlords.properties.create', $property) }}"
          class="grid h-40 border border-dashed place-content-center border-zinc-200 rounded-xl">
          <div class="flex items-center gap-2 text-zinc-500">
            <i data-lucide="plus" class="size-5"></i>
            <span class="text-sm">Add Room</span>
          </div>
        </a>
      </div>
    </x-properties.detail>
  </div>

  <x-slot:action>
    <x-properties.detail.action :property="$property" />
  </x-slot>
</x-app-layout>
