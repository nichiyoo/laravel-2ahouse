<x-app-layout>
  <div class="grid gap-6 p-content">
    <div id="map" class="absolute inset-0 z-0 w-full h-screen"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-zinc-900 to-30% to-transparent pointer-events-none">
    </div>

    <section class="relative text-white">
      <x-app.title>
        <x-slot:section>Location</x-slot>
        <x-slot:heading>Find properties</x-slot>
      </x-app.title>
    </section>

    <section class="relative">
      <x-app.search />
    </section>
  </div>

  @push('scripts')
    @vite(['resources/js/leaflet.js'])

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const location = @json([$lat, $lng]);
        const properties = @json($properties);

        const blue = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });

        const red = new L.Icon({
          iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
          shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34],
          shadowSize: [41, 41]
        });

        const map = L.map('map', {
          maxZoom: 20,
          minZoom: 6,
          zoomControl: false
        }).setView(location, 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        properties.forEach(property => {
          const lat = property.latitude;
          const lng = property.longitude;

          const marker = L.marker([lat, lng], {
              icon: red
            })
            .addTo(map)
            .bindPopup(`
              <strong>${property.name}</strong><br>
              <a href="properties/${property.id}" class="text-blue-500 hover:underline">View details</a>
            `);
        });

        let current;

        const move = (lat, lng) => {
          if (current) map.removeLayer(current);

          current = L.marker([lat, lng], {
              icon: blue
            })
            .addTo(map)
            .bindPopup('<strong>Your Location</strong>')
            .openPopup();

          map.flyTo([lat, lng], 15);
        };

        const url = new URL(window.location.href);
        const [lat, lng] = location;
        move(lat, lng);

        map.on('click', function(e) {
          const clickedLat = e.latlng.lat;
          const clickedLng = e.latlng.lng;
          move(clickedLat, clickedLng);

          map.once('moveend', function() {
            url.searchParams.set('lat', clickedLat);
            url.searchParams.set('lng', clickedLng);
            url.searchParams.set('radius', 10);
            window.location.href = url.toString();
          });
        });
      });
    </script>
  @endpush
</x-app-layout>
