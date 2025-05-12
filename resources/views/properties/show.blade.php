<x-properties.detail :property="$property">
  <div class="grid gap-6">

    <div class="flex flex-col gap-2">
      <h4 class="text-lg font-medium">Detail</h4>

      <div class="grid grid-cols-2 gap-4 text-sm">
        @php
          $details = [
              'City' => $property->city,
              'Region' => $property->region,
              'Zipcode' => $property->zipcode,
              'Rooms' => $property->rooms->count(),
              'Latitude' => $property->latitude,
              'Longitude' => $property->longitude,
          ];
        @endphp

        @foreach ($details as $key => $value)
          <dl class="flex flex-col gap-2">
            <dt class="font-medium">{{ $key }}</dt>
            <dd class="text-zinc-500">{{ $value }}</dd>
          </dl>
        @endforeach
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
          <x-amenity :amenity="$amenity" />
        @endforeach
      </ul>
    </div>
  </div>
</x-properties.detail>
