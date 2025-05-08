<x-app-layout>
  <div class="grid gap-6 p-content">
    <section class="flex flex-col">
      <span class="text-sm text-zinc-500">Config</span>
      <h1 class="text-lg font-semibold">
        Configuration Page
      </h1>
    </section>

    <section class="grid items-center min-h-56">
      <div class="flex flex-col items-center gap-4">
        <x-ui.avatar name="{{ Auth::user()->name }}" class="size-32" />
        <div class="flex flex-col text-center">
          <span class="text-2xl font-semibold">{{ Auth::user()->name }}</span>
          <span class="text-sm text-zinc-500">{{ Auth::user()->email }}</span>
        </div>
      </div>
    </section>

    <nav class="grid gap-4">
      <ul class="flex flex-col divide-y">
        <li>
          <a href="{{ route('profile.edit') }}" class="flex items-center gap-4 py-4">
            <i data-lucide="user-round" class="size-5"></i>
            <span>Profile</span>
          </a>
        </li>
        <li>
          <a href="{{ route('tenants.bookmarks.index') }}" class="flex items-center gap-4 py-4">
            <i data-lucide="heart" class="size-5"></i>
            <span>Bookmarks</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center gap-4 py-4">
            <i data-lucide="layout" class="size-5"></i>
            <span>Applications</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center gap-4 py-4">
            <i data-lucide="life-buoy" class="size-5"></i>
            <span>Help</span>
          </a>
        </li>
        <li>
          <a href="#" class="flex items-center gap-4 py-4">
            <i data-lucide="bolt" class="size-5"></i>
            <span>Settings</span>
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button href="#" class="flex items-center gap-4 py-4 text-red-500">
              <i data-lucide="log-out" class="size-5"></i>
              <span>Logout</span>
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </div>
</x-app-layout>
