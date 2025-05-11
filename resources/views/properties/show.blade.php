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
      <div class="grid gap-6">

        <div class="flex flex-col gap-2">
          <h4 class="text-lg font-medium">Detail</h4>
          <div class="grid grid-cols-2 gap-4 text-sm">

            <dl class="flex flex-col gap-2">
              <dt class="font-medium">City</dt>
              <dd class="text-zinc-500">{{ $property->city }}</dd>
            </dl>

            <dl class="flex flex-col gap-2">
              <dt class="font-medium">Region</dt>
              <dd class="text-zinc-500">{{ $property->region }}</dd>
            </dl>

            <dl class="flex flex-col gap-2">
              <dt class="font-medium">Zipcode</dt>
              <dd class="text-zinc-500">{{ $property->zipcode }}</dd>
            </dl>

            <dl class="flex flex-col gap-2">
              <dt class="font-medium">Rooms</dt>
              <dd class="text-zinc-500">{{ $property->rooms->count() }}</dd>
            </dl>

            <dl class="flex flex-col gap-2">
              <dt class="font-medium">Latitude</dt>
              <dd class="text-zinc-500">{{ $property->latitude }}</dd>
            </dl>

            <dl class="flex flex-col gap-2">
              <dt class="font-medium">Longitude</dt>
              <dd class="text-zinc-500">{{ $property->longitude }}</dd>
            </dl>
          </div>
        </div>

        <div class="flex flex-col gap-2 text-sm">
          <h4 class="text-lg font-medium">Description</h4>
          <p class="text-zinc-500">
            {{ $property->description }}
          </p>
        </div>

        <div class="flex flex-col gap-2">
          <h4 class="text-lg font-medium">Amenities</h4>
          <ul class="grid grid-cols-2 gap-2 text-sm">
            @foreach ($property->amenities as $amenity)
              <li class="flex items-center gap-2 p-3 border rounded-xl border-zinc-200">
                <i data-lucide="{{ $amenity->icon() }}" class="size-5"></i>
                <span>{{ $amenity->label() }}</span>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </x-properties.detail>
  </div>

  <x-slot:action>
    <x-properties.detail.action :property="$property" />
  </x-slot>
</x-app-layout>
