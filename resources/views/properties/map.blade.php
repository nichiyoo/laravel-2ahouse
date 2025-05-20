<x-app-layout>
  <div class="relative">
    <div id="map" class="absolute inset-0 z-0 w-full h-screen"></div>

    <section class="relative flex flex-col justify-between pb-16 text-white aspect-square p-content">
      <div class="flex items-center justify-between gap-2">
        <a href="{{ route('dashboard') }}">
          <x-ui.button size="icon">
            <i data-lucide="chevron-left" class="size-4"></i>
            <span class="sr-only">Back</span>
          </x-ui.button>
        </a>

        @tenant
          <form method="POST" action="{{ route('tenants.properties.bookmark', $property) }}">
            @csrf
            <x-ui.button size="icon">
              <i data-lucide="bookmark" class="size-4 @if ($property->bookmarked) fill-current @endif"></i>
              <span class="sr-only">Bookmark</span>
            </x-ui.button>
          </form>
        @endtenant
      </div>
  </div>

  <x-slot:action>
    <nav class="fixed bottom-0 w-full max-w-md">
      <div class="grid grid-cols-2 gap-4 p-4 border-t border-zinc-200 bg-zinc-50">
        <a href="{{ route('properties.show', $property) }}">
          <x-ui.button variant="secondary">
            <i data-lucide="arrow-left" class="size-5"></i>
            <span>Back</span>
          </x-ui.button>
        </a>

        <a href="{{ route('tenants.properties.rent', $property) }}">
          <x-ui.button>
            <i data-lucide="shopping-cart" class="size-5"></i>
            <span>Rent</span>
          </x-ui.button>
        </a>
      </div>
    </nav>
  </x-slot>

  @push('scripts')
    @vite(['resources/js/leaflet.js'])

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const property = @json($property);
        const price = Number({{ $property->min_price }});

        const location = [property.latitude, property.longitude];
        const map = L.map('map', {
          maxZoom: 15,
          minZoom: 10,
          zoomControl: false
        }).setView(location, 12);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors',
        }).addTo(map);

        const formatCurrency = (value, currency) => {
          return value.toLocaleString('id-ID', {
            style: 'currency',
            currency: currency,
          });
        };

        L.marker(location, {
            riseOnHover: true
          })
          .addTo(map)
          .bindPopup(`<strong>${property.name}</strong><br>${formatCurrency(price, 'IDR')}`)
          .openPopup();
      });
    </script>
  @endpush
</x-app-layout>
