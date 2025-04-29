<x-app-layout>
  <div class="grid gap-6 p-content">
    <section>
      <x-app.title>
        <x-slot:section>Search</x-slot>
        <x-slot:heading>Explore properties</x-slot>
        <x-slot:actions>
          <x-ui.button x-data="{}" size="icon"
            x-on:click.prevent="$dispatch('open-modal', 'filter-properties')">
            <i data-lucide="list-filter" class="size-5"></i>
            <span class="sr-only">filter</span>
          </x-ui.button>

          <x-modal name="filter-properties">
            <form method="GET" action="{{ route('tenants.properties.index') }}" class="grid gap-4">
              <div>
                <x-ui.label for="query" value="Search property" />
                <x-ui.input id="query" name="query" type="search" placeholder="Search property"
                  value="{{ request()->get('query') }}" />
              </div>

              <div>
                <x-ui.label for="distance" value="Distance range" />
                <x-ui.progress name="distance" min="0" max="30" step="1"
                  value="{{ request()->get('distance', 10) }}" />
              </div>

              <div>
                <x-ui.label for="price" value="Price range" />
                <x-ui.range name="price" min="100000" max="5000000" step="100000"
                  start="{{ request()->get('price_min', 100000) }}" end="{{ request()->get('price_max', 5000000) }}" />
              </div>

              <div>
                <x-ui.label for="rating" value="Minimum Rating" />
                <x-ui.progress name="rating" min="0" max="5" step="1"
                  value="{{ request()->get('rating', 0) }}" />
              </div>

              <div class="mt-4">
                <x-ui.button>
                  Apply
                </x-ui.button>
              </div>
            </form>
          </x-modal>
        </x-slot:actions>
      </x-app.title>
    </section>

    <section>
      <x-app.search />
    </section>

    <section class="grid gap-4">
      <h2 class="font-medium">
        @if (request()->get('query'))
          <span>
            Result for keywords "{{ request()->get('query') }}"
          </span>
        @else
          <span>
            Available properties
          </span>
        @endif
      </h2>

      @forelse ($properties as $property)
        <x-properties.card :property="$property" />
      @empty
        <div class="flex flex-col justify-center gap-4 h-96">
          <div class="flex items-center justify-center gap-2 text-zinc-500">
            <span>Oops! No properties found.</span>
            <i data-lucide="search" class="size-4"></i>
          </div>

          <div class="flex justify-center">
            <a href="{{ route('tenants.properties.index') }}">
              <x-ui.button>
                Reset
              </x-ui.button>
            </a>
          </div>
        </div>
      @endforelse
    </section>
  </div>
</x-app-layout>
