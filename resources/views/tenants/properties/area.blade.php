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
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const location = @json([$lat, $lng]);
        const properties = @json($properties);

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
              color: 'red'
            })
            .addTo(map)
            .bindPopup(`
              <strong>${property.name}</strong><br>
            `);
        });

        let current;

        const move = (lat, lng) => {
          if (current) map.removeLayer(current);

          current = L.marker([lat, lng], {
              color: 'blue'
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
