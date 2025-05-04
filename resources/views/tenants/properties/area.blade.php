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
          const image = property.image;

          const propertyIcon = L.divIcon({
            className: 'property-marker',
            html: `
              <div class="marker-container">
                <div class="image-wrapper">
                  <img src="${image}" alt="${property.name}" class="image">
                </div>
              </div>
            `,
            iconSize: [48, 48],
            iconAnchor: [20, 20],
            popupAnchor: [0, -20]
          });

          const marker = L.marker([lat, lng], {
              icon: propertyIcon
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

          current = L.marker([lat, lng])
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

    <style>
      .property-marker {
        background: transparent;
        border: none;
      }

      .marker-container {
        position: relative;
        width: 48px;
        height: 48px;
      }

      .image-wrapper {
        width: 40px;
        height: 40px;
        overflow: hidden;
        border-radius: 10px;
        position: absolute;
        border: 2px solid white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
      }

      .image {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
    </style>
  @endpush
</x-app-layout>
