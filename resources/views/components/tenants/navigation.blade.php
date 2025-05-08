@php
  $props = $attributes->merge([
      'class' => 'w-full',
  ]);

  $navigations = array_to_object([
      [
          'route' => 'tenants.app',
          'label' => 'Home',
          'icon' => asset('icons/home.svg'),
          'active' => asset('icons/active/home.svg'),
      ],
      [
          'route' => 'tenants.area',
          'label' => 'Map',
          'icon' => asset('icons/map.svg'),
          'active' => asset('icons/active/map.svg'),
      ],
      [
          'route' => 'tenants.properties.index',
          'label' => 'Search',
          'icon' => asset('icons/search.svg'),
          'active' => asset('icons/active/search.svg'),
      ],
      [
          'route' => 'tenants.activity',
          'label' => 'Activity',
          'icon' => asset('icons/activity.svg'),
          'active' => asset('icons/active/activity.svg'),
      ],
      [
          'route' => 'tenants.config',
          'label' => 'Profile',
          'icon' => asset('icons/profile.svg'),
          'active' => asset('icons/active/profile.svg'),
      ],
  ]);
@endphp

<nav {{ $props }}>
  <ul class="grid grid-cols-5 border-t border-zinc-200 bg-zinc-50">
    @foreach ($navigations as $item)
      @php
        $active = request()->routeIs($item->route);
      @endphp

      <li>
        <a href="{{ route($item->route) }}" data-active="{{ $active ? 'true' : 'false' }}"
          class="p-4 relative flex flex-col items-center justify-center gap-2 text-sm group data-[active='true']:text-primary-500">
          <x-svg-icon src="{{ $active ? $item->active : $item->icon }}" alt="{{ $item->label }}" />

          <div class="absolute bottom-0 w-3/5 group-data-[active='true']:block hidden">
            <div class="w-full h-1 rounded-t-full bg-primary-500"></div>
          </div>

          <span>{{ $item->label }}</span>
        </a>
      </li>
    @endforeach
  </ul>
</nav>
