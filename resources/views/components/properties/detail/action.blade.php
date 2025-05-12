@props([
    'property' => null,
])

@php
  use App\Enums\RoleType;

  $props = $attributes->merge([
      'class' => 'w-full',
  ]);

  $menus = array_to_object([
      [
          'label' => 'Location',
          'icon' => 'map',
          'variant' => 'secondary',
          'route' => route('properties.map', $property),
          'show' => true,
      ],
      [
          'label' => 'Rent',
          'icon' => 'shopping-cart',
          'variant' => 'primary',
          'route' => route('tenants.properties.rent', $property),
          'show' => Auth::user()->role == RoleType::TENANT,
      ],
      [
          'label' => 'Edit',
          'icon' => 'edit-3',
          'variant' => 'primary',
          'route' => route('landlords.properties.edit', $property),
          'show' => Auth::user()->role == RoleType::LANDLORD,
      ],
  ]);
@endphp

<nav {{ $props }}>
  <div class="grid grid-cols-2 border-t border-zinc-200 bg-zinc-50">
    @foreach ($menus as $menu)
      @continue (!$menu->show)

      <a href="{{ $menu->route }}" class="p-4">
        <x-ui.button variant="{{ $menu->variant }}">
          <i data-lucide="{{ $menu->icon }}" class="size-5"></i>
          <span>{{ $menu->label }}</span>
        </x-ui.button>
      </a>
    @endforeach
  </div>
</nav>
