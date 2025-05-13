@php
  use App\Enums\RoleType;

  $tenant = Auth::user()->role == RoleType::TENANT;
  $landlord = Auth::user()->role == RoleType::LANDLORD;

  /**
   * Check if the current route matches the given route.
   *
   * @param mixed $route
   * @return bool
   */
  function location(mixed ...$route): bool
  {
      return request()->routeIs(...$route);
  }

  $menus = array_to_object([
      [
          'label' => 'Location',
          'icon' => 'map',
          'variant' => 'secondary',
          'route' => route('properties.map', $property),
          'show' => true,
      ],
      [
          'label' => 'Add review',
          'icon' => 'plus',
          'variant' => 'primary',
          'route' => route('tenants.properties.review', $property),
          'show' => $tenant && location('properties.reviews', $property),
      ],
      [
          'label' => 'Rent',
          'icon' => 'shopping-cart',
          'variant' => 'primary',
          'route' => route('tenants.properties.rent', $property),
          'show' => $tenant && !location('properties.reviews', $property),
      ],
      [
          'label' => 'Add room',
          'icon' => 'plus',
          'variant' => 'primary',
          'route' => route('landlords.properties.rooms.create', $property),
          'show' => $landlord && location('properties.rooms', $property),
      ],
      [
          'label' => 'Edit',
          'icon' => 'edit-3',
          'variant' => 'primary',
          'route' => route('landlords.properties.edit', $property),
          'show' => $landlord && !location('properties.rooms', $property),
      ],
  ]);
@endphp


<x-app-layout>
  <div class="relative grid gap-6">
    <div class="absolute top-0 w-full">
      <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover aspect-square size-full" />
      <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 to-transparent"></div>
    </div>

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

        @landlord
          <div>
            <x-ui.button size="icon" variant="destructive" x-data=""
              x-on:click.prevent="$dispatch('open-modal', 'delete-property')">
              <i data-lucide="trash" class="size-4"></i>
              <span class="sr-only">Delete</span>
            </x-ui.button>
          </div>

          <x-modal name="delete-property">
            <form method="POST" action="{{ route('landlords.properties.destroy', $property) }}" class="grid gap-4">
              @csrf
              @method('DELETE')

              <x-ui.header>
                <x-slot:title>Delete Property</x-slot:title>
                <x-slot:description>
                  Are you sure you want to delete {{ $property->name }}? This action cannot be undone,
                  and all associated rooms, reviews, and bookings will be permanently removed.
                </x-slot:description>
              </x-ui.header>

              <div class="grid grid-cols-2 gap-4">
                <x-ui.button type="button" variant="secondary" x-on:click="$dispatch('close-modal', 'delete-property')">
                  Cancel
                </x-ui.button>
                <x-ui.button type="submit" variant="destructive">
                  Delete Property
                </x-ui.button>
              </div>
            </form>
          </x-modal>
        @endlandlord
      </div>

      <x-user :user="$property->landlord->user" status="Owner" />
    </section>

    <section class="relative grid -mt-16 bg-zinc-50 rounded-t-3xl">
      <div class="flex flex-col gap-2 py-6 p-content">
        <div class="flex flex-col">
          <span class="text-sm text-zinc-400">Detail</span>
          <h1 class="text-2xl font-semibold">
            {{ $property->name }}
          </h1>

          <p class="truncate text-zinc-500">
            <span> {{ $property->address }}</span>
            @tenant
              <span> - </span>
              <span> {{ $property->landlord->user->name }}</span>
            @endtenant
          </p>
        </div>

        <x-rating :rating="$property->rating" expanded />
      </div>

      <div class="grid grid-cols-3 border-y border-zinc-200">
        <div class="flex items-center justify-center p-4 border-r border-zinc-200">
          <a href="{{ route('properties.show', $property) }}"
            class="@if (request()->routeIs('properties.show', $property)) text-primary-500 @endif">
            <span> Detail</span>
          </a>
        </div>

        <div class="flex items-center justify-center p-4 border-r border-zinc-200">
          <a href="{{ route('properties.rooms', $property) }}"
            class="@if (request()->routeIs('properties.rooms', $property)) text-primary-500 @endif">
            <span>Rooms</span>
          </a>
        </div>

        <div class="flex items-center justify-center p-4 border-r border-zinc-200">
          <a href="{{ route('properties.reviews', $property) }}"
            class="@if (request()->routeIs('properties.reviews', $property)) text-primary-500 @endif">
            <span> Review</span>
          </a>
        </div>
      </div>

      <div class="p-content">
        {{ $slot }}
      </div>
    </section>

    <x-slot:action>
      <nav class="grid w-full grid-cols-2 border-t border-zinc-200 bg-zinc-50">
        @foreach ($menus as $menu)
          @continue (!$menu->show)

          <a href="{{ $menu->route }}" class="p-4">
            <x-ui.button variant="{{ $menu->variant }}">
              <i data-lucide="{{ $menu->icon }}" class="size-5"></i>
              <span>{{ $menu->label }}</span>
            </x-ui.button>
          </a>
        @endforeach
      </nav>
    </x-slot:action>
</x-app-layout>
