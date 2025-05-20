<x-app-layout>
  <div class="grid gap-6 pb-24 p-content">
    <section class="flex flex-col">
      <span class="text-sm text-zinc-500">Edit Room</span>
      <h1 class="text-lg font-semibold">{{ $room->name }}</h1>
    </section>

    <form id="form" method="POST" action="{{ route('landlords.rooms.update', $room) }}" class="grid gap-6"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('landlords.rooms.form')
    </form>
  </div>

  <x-slot:action>
    <nav class="fixed bottom-0 w-full max-w-md">
      <div class="grid grid-cols-2 gap-4 p-4 border-t border-zinc-200 bg-zinc-50">
        <a href="{{ route('properties.rooms', $property) }}">
          <x-ui.button variant="secondary">
            <i data-lucide="arrow-left" class="size-5"></i>
            <span>Back</span>
          </x-ui.button>
        </a>

        <x-ui.button form="form" type="submit">
          <span>Update Room</span>
        </x-ui.button>
      </div>
    </nav>
  </x-slot>
</x-app-layout>
