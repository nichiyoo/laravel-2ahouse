<div>
  <x-ui.label for="type" value="Room Type" />
  <x-ui.input id="type" type="text" name="type" value="{{ old('type', $room->type ?? '') }}" required
    placeholder="Enter room type (e.g., Single, Double, Suite)" autofocus />
  <x-ui.error :messages="$errors->get('type')" />
</div>

<div>
  <x-ui.label for="capacity" value="Capacity" />
  <x-ui.input id="capacity" type="number" name="capacity" value="{{ old('capacity', $room->capacity ?? '') }}" required
    placeholder="Maximum occupancy" min="1" />
  <x-ui.error :messages="$errors->get('capacity')" />
</div>

<div>
  <x-ui.label for="price" value="Price per Month (Rp)" />
  <x-ui.input id="price" type="number" name="price" value="{{ old('price', $room->price ?? '') }}" required
    placeholder="Monthly rental price" min="0" step="1000" />
  <x-ui.error :messages="$errors->get('price')" />
</div>

<div>
  <x-ui.label for="images" value="Room Images" />
  @isset($room->images)
    <x-ui.multiple name="images[]" :value="old('images', $room->images ?? [])" placeholder="Add Room Image" multiple />
  @else
    <x-ui.multiple name="images[]" placeholder="Add Room Image" multiple required />
  @endisset
  <x-ui.error :messages="$errors->get('images')" />
</div>

<div>
  <x-ui.label value="Amenities" />
  <div class="grid grid-cols-2 gap-3 mt-2">
    @foreach ($amenities as $amenity)
      @php
        $actives = $room->amenities->pluck('value')->toArray() ?? [];
        $checked = in_array($amenity->value, old('amenities', $actives));
      @endphp

      <div x-data="{ checked: @js($checked) }">
        <input type="checkbox" id="amenity-{{ $amenity->value }}" name="amenities[]" value="{{ $amenity->value }}"
          class="hidden" x-bind:checked="checked">

        <button type="button" x-on:click="checked = !checked"
          x-bind:class="checked && 'border-primary-500 ring-1 ring-primary-500'"
          class="flex items-center w-full gap-2 p-3 text-sm bg-white border rounded-xl border-zinc-200">
          <i data-lucide="{{ $amenity->icon() }}" class="size-5"></i>
          <span>{{ $amenity->label() }}</span>
        </button>
      </div>
    @endforeach
  </div>
  <x-ui.error :messages="$errors->get('amenities')" />
</div>
