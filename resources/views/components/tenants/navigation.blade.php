@php
  use App\Enums\RoleType;

  $props = $attributes->merge([
      'class' => 'w-full',
  ]);

  $navigations = array_to_object([
      [
          'href' => route('dashboard'),
          'active' => request()->routeIs('*.dashboard'),
          'label' => 'Home',
          'icon' => asset('icons/home.svg'),
          'color' => asset('icons/active/home.svg'),
          'show' => true,
      ],
      [
          'href' => route('tenants.area'),
          'active' => request()->routeIs('tenants.area'),
          'label' => 'Map',
          'icon' => asset('icons/map.svg'),
          'color' => asset('icons/active/map.svg'),
          'show' => Auth::user()->role == RoleType::TENANT,
      ],
      [
          'href' => route('tenants.properties.index'),
          'active' => request()->routeIs('tenants.properties.index'),
          'label' => 'Search',
          'icon' => asset('icons/search.svg'),
          'color' => asset('icons/active/search.svg'),
          'show' => Auth::user()->role == RoleType::TENANT,
      ],
      [
          'href' => route('landlords.properties.create'),
          'active' => request()->routeIs('landlords.properties.create'),
          'label' => 'Post',
          'icon' => asset('icons/post.svg'),
          'color' => asset('icons/active/post.svg'),
          'show' => Auth::user()->role == RoleType::LANDLORD,
      ],
      [
          'href' => route('landlords.properties.index'),
          'active' => request()->routeIs('landlords.properties.index'),
          'label' => 'Manage',
          'icon' => asset('icons/manage.svg'),
          'color' => asset('icons/active/manage.svg'),
          'show' => Auth::user()->role == RoleType::LANDLORD,
      ],
      [
          'href' => route('activity'),
          'active' => request()->routeIs('activity'),
          'label' => 'Activity',
          'icon' => asset('icons/activity.svg'),
          'color' => asset('icons/active/activity.svg'),
          'show' => true,
      ],
      [
          'href' => route('config'),
          'active' => request()->routeIs('config') || request()->routeIs('profile.*'),
          'label' => 'Profile',
          'icon' => asset('icons/profile.svg'),
          'color' => asset('icons/active/profile.svg'),
          'show' => true,
      ],
  ]);
@endphp

<nav {{ $props }}>
  <ul class="grid grid-cols-5 border-t border-zinc-200 bg-zinc-50">
    @foreach ($navigations as $item)
      @continue (!$item->show)

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
