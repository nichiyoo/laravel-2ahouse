<section class="relative grid -mt-16 bg-zinc-50 rounded-t-3xl">
  <div class="flex flex-col gap-2 py-6 p-content">
    <div class="flex flex-col">
      <span class="text-sm text-zinc-400">Detail</span>
      <h1 class="text-2xl font-semibold">
        {{ $property->name }}
      </h1>
      <p class="truncate text-zinc-500">
        <span> {{ $property->address }}</span>
        <span> - </span>
        <span> {{ round($property->distance, 1) }} Km</span>
      </p>
    </div>

    <div class="flex items-center text-yellow-500">
      @for ($i = 1; $i <= $property->rating; $i++)
        <i data-lucide="star" class="mb-1 fill-current size-4"></i>
      @endfor
      <span class="ml-2">{{ $property->rating }}</span>
    </div>
  </div>

  <div class="grid grid-cols-3 border-y border-zinc-200">
    <div class="flex items-center justify-center p-4 border-r border-zinc-200">
      <a href="{{ route('tenants.properties.show', $property) }}"
        class="@if (request()->routeIs('tenants.properties.show', $property)) text-primary-500 @endif">
        <span> Detail</span>
      </a>
    </div>

    <div class="flex items-center justify-center p-4 border-r border-zinc-200">
      <a href="{{ route('tenants.properties.rooms', $property) }}"
        class="@if (request()->routeIs('tenants.properties.rooms', $property)) text-primary-500 @endif">
        <span>Rooms</span>
      </a>
    </div>

    <div class="flex items-center justify-center p-4 border-r border-zinc-200">
      <a href="{{ route('tenants.properties.review', $property) }}"
        class="@if (request()->routeIs('tenants.properties.review', $property)) text-primary-500 @endif">
        <span> Review</span>
      </a>
    </div>
  </div>

  <div class="p-content">
    {{ $slot }}
  </div>
</section>
