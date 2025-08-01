<x-app-layout>
  <div class="grid gap-6 p-content">
    <section>
      <x-app.title>
        <x-slot:section>Welcome Back</x-slot>
        <x-slot:heading>{{ Auth::user()->name }}</x-slot>
      </x-app.title>
    </section>

    <section>
      <x-app.search :action="route('landlords.properties.index')" />
    </section>

    <section class="grid gap-4">
      <h1 class="text-2xl font-semibold">
        Statistics
      </h1>

      <div class="grid grid-cols-2 gap-4">
        <div class="p-4 content rounded-xl col-span-full">
          <h2>Property count</h2>
          <span class="text-2xl font-bold text-primary-500">{{ $count }}</span>
        </div>

        <div class="p-4 content rounded-xl">
          <h2>Bookmark count</h2>
          <span class="text-2xl font-bold text-primary-500">{{ $bookmarked }}</span>
        </div>

        <div class="p-4 content rounded-xl">
          <h2>Average rating</h2>
          <span class="text-2xl font-bold text-primary-500">{{ round($rating, 1) }}</span>
        </div>
      </div>
    </section>

    <section class="grid gap-4">
      <div class="flex items-center justify-between">
        <h2 class="text-lg font-medium">
          Popular properties
        </h2>

        <a href="{{ route('landlords.properties.index') }}" class="flex items-center gap-2 text-sm text-primary-500">
          <span>Explore</span>
          <i data-lucide="arrow-up-right" class="size-4"></i>
        </a>
      </div>

      @foreach ($properties as $property)
        <x-properties.card :property="$property" />
      @endforeach
    </section>
  </div>
</x-app-layout>
