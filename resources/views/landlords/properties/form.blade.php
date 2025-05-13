<div>
  <x-ui.label for="name" value="Property Name" />
  <x-ui.input id="name" type="text" name="name" value="{{ old('name', $property->name ?? '') }}" required
    placeholder="Enter property name" autofocus />
  <x-ui.error :messages="$errors->get('name')" />
</div>

<div>
  <x-ui.label for="image" value="Property Image" />
  @isset($property->image)
    <x-ui.upload name="image" value="{{ $property->image }}" placeholder="Add Property Image" />
  @else
    <x-ui.upload name="image" placeholder="Add Property Image" required />
  @endisset
  <x-ui.error :messages="$errors->get('image')" />
</div>

<div>
  <x-ui.label for="address" value="Address" />
  <x-ui.input id="address" type="text" name="address" value="{{ old('address', $property->address ?? '') }}"
    required placeholder="Enter property address" />
  <x-ui.error :messages="$errors->get('address')" />
</div>

<div>
  <x-ui.label for="city" value="City" />
  <x-ui.input id="city" type="text" name="city" value="{{ old('city', $property->city ?? '') }}" required
    placeholder="City" />
  <x-ui.error :messages="$errors->get('city')" />
</div>

<div>
  <x-ui.label for="region" value="Region/State" />
  <x-ui.input id="region" type="text" name="region" value="{{ old('region', $property->region ?? '') }}" required
    placeholder="Region or State" />
  <x-ui.error :messages="$errors->get('region')" />
</div>

<div>
  <x-ui.label for="zipcode" value="Zipcode" />
  <x-ui.input id="zipcode" type="text" name="zipcode" value="{{ old('zipcode', $property->zipcode ?? '') }}"
    required placeholder="Enter zipcode" />
  <x-ui.error :messages="$errors->get('zipcode')" />
</div>

<div>
  <x-ui.label for="description" value="Description" />
  <x-ui.textarea id="description" name="description" required
    placeholder="Describe your property">{{ old('description', $property->description ?? '') }}</x-ui.textarea>
  <x-ui.error :messages="$errors->get('description')" />
</div>

<div class="grid gap-4">
  <h3 class="text-lg font-semibold">Location</h3>

  <div id="map" class="z-0 w-full h-64 border rounded-lg border-zinc-200"></div>

  <div class="grid grid-cols-2 gap-4">
    <div>
      <x-ui.label for="latitude" value="Latitude" />
      <x-ui.input id="latitude" type="text" name="latitude"
        value="{{ old('latitude', $property->latitude ?? $location['latitude']) }}" required readonly />
      <x-ui.error :messages="$errors->get('latitude')" />
    </div>

    <div>
      <x-ui.label for="longitude" value="Longitude" />
      <x-ui.input id="longitude" type="text" name="longitude"
        value="{{ old('longitude', $property->longitude ?? $location['longitude']) }}" required readonly />
      <x-ui.error :messages="$errors->get('longitude')" />
    </div>
  </div>
  <p class="text-sm text-zinc-500">Click on the map to set the property location</p>
</div>

@push('scripts')
  @vite(['resources/js/leaflet.js'])

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const latitude = parseFloat(document.getElementById('latitude').value) || {{ $location['latitude'] }};
      const longitude = parseFloat(document.getElementById('longitude').value) || {{ $location['longitude'] }};

      const map = L.map('map', {
        zoomControl: true
      }).setView([latitude, longitude], 13);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
      }).addTo(map);

      let marker = L.marker([latitude, longitude], {
        draggable: true
      }).addTo(map);

      function updateMarker(lat, lng) {
        document.getElementById('latitude').value = lat.toFixed(6);
        document.getElementById('longitude').value = lng.toFixed(6);
      }

      marker.on('dragend', function(event) {
        const position = marker.getLatLng();
        updateMarker(position.lat, position.lng);
      });

      map.on('click', function(e) {
        const position = e.latlng;
        marker.setLatLng(position);
        updateMarker(position.lat, position.lng);
      });

      updateMarker(latitude, longitude);
    });
  </script>
@endpush
