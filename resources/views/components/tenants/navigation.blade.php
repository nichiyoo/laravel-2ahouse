@php
  $props = $attributes->merge([
      'class' => 'w-full',
  ]);

  $navigations = array_to_object([
      [
          'href' => route('tenants.app'),
          'active' => request()->routeIs('tenants.app'),
          'label' => 'Home',
          'icon' => asset('icons/home.svg'),
          'color' => asset('icons/active/home.svg'),
      ],
      [
          'href' => route('tenants.area'),
          'active' => request()->routeIs('tenants.area'),
          'label' => 'Map',
          'icon' => asset('icons/map.svg'),
          'color' => asset('icons/active/map.svg'),
      ],
      [
          'href' => route('tenants.properties.index'),
          'active' => request()->routeIs('tenants.properties.index'),
          'label' => 'Search',
          'icon' => asset('icons/search.svg'),
          'color' => asset('icons/active/search.svg'),
      ],
      [
          'href' => route('tenants.activity'),
          'active' => request()->routeIs('tenants.activity'),
          'label' => 'Activity',
          'icon' => asset('icons/activity.svg'),
          'color' => asset('icons/active/activity.svg'),
      ],
      [
          'href' => route('config'),
          'active' => request()->routeIs('config') || request()->routeIs('profile.*'),
          'label' => 'Profile',
          'icon' => asset('icons/profile.svg'),
          'color' => asset('icons/active/profile.svg'),
      ],
  ]);
@endphp

<nav {{ $props }}>
  <ul class="grid grid-cols-5 border-t border-zinc-200 bg-zinc-50">
    @foreach ($navigations as $item)
      <li>
        <a href="{{ $item->href }}" data-active="{{ $item->active ? 'true' : 'false' }}"
          class="p-4 relative flex flex-col items-center justify-center gap-2 text-sm group data-[active='true']:text-primary-500">
          <x-svg-icon src="{{ $item->active ? $item->color : $item->icon }}" alt="{{ $item->label }}" />

          <div class="absolute bottom-0 w-3/5 group-data-[active='true']:block hidden">
            <div class="w-full h-1 rounded-t-full bg-primary-500"></div>
          </div>

          <span>{{ $item->label }}</span>
        </a>
      </li>
    @endforeach
  </ul>
</nav>
