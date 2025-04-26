<x-app-layout>
  <div class="grid gap-6 py-content">
    <section class="px-content">
      <x-app.title>
        <x-slot:section>Your location</x-slot>
        <x-slot:heading>{{ Auth::user()->tenant->address }}</x-slot>
      </x-app.title>
    </section>

    <section class="px-content">
      <x-app.search />
    </section>

    <section class="grid gap-4">
      <h1 class="text-2xl font-semibold px-content">
        Nearest properties
      </h1>
      <x-properties.slides class="px-content" :properties="$nearest" />
    </section>

    <section class="grid gap-4">
      <h2 class="text-lg font-medium px-content">
        Latest properties
      </h2>

      <x-properties.chips class="px-content" :properties="$latest" />
    </section>

    <section class="grid gap-4 px-content">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-medium">
          Other properties
        </h2>

        <a href="{{ route('tenants.properties.index') }}" class="flex items-center gap-2 text-sm text-primary-500">
          <span>Explore</span>
          <i data-lucide="arrow-up-right" class="size-4"></i>
        </a>
      </div>
      @foreach ($others as $property)
        <x-properties.card :property="$property" />
      @endforeach
    </section>
  </div>
</x-app-layout>
