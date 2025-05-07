<x-app-layout>
  <div class="grid gap-6 p-content">
    <section>
      <x-app.title>
        <x-slot:section>Bookmark</x-slot>
        <x-slot:heading>Saved Properties</x-slot>
      </x-app.title>
    </section>

    <section class="grid gap-4">
      @forelse ($properties as $property)
        <x-properties.card :property="$property" />
      @empty
        <div class="flex flex-col justify-center gap-4 h-96">
          <div class="flex items-center justify-center gap-2 text-zinc-500">
            <span>Oops! No properties found.</span>
            <i data-lucide="search" class="size-4"></i>
          </div>
        </div>
      @endforelse
    </section>
  </div>
</x-app-layout>
