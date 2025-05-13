<x-app-layout>
  <div class="grid gap-6 p-content">
    <section>
      <x-app.title>
        <x-slot:section>Properties</x-slot>
        <x-slot:heading>Manage properties</x-slot>
      </x-app.title>
    </section>

    <section>
      <x-app.search :action="route('landlords.properties.index')" />
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
        <a href="{{ route('properties.show', $property) }}">
          <x-properties.card :property="$property" />
        </a>
      @empty
        <div class="flex flex-col justify-center gap-4 h-96">
          <div class="flex items-center justify-center gap-2 text-zinc-500">
            <span>Oops! No properties found.</span>
            <i data-lucide="search" class="size-4"></i>
          </div>

          <div class="flex justify-center">
            <a href="{{ route('properties.index') }}">
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
