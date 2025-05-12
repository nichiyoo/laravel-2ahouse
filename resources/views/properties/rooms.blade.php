<x-properties.detail :property="$property">
  <div class="grid gap-6">
    @foreach ($property->rooms as $room)
      <x-rooms.card :room="$room" />
    @endforeach

    <a role="button" href="{{ route('landlords.properties.create', $property) }}"
      class="grid h-40 border border-dashed place-content-center border-zinc-200 rounded-xl">
      <div class="flex items-center gap-2 text-zinc-500">
        <i data-lucide="plus" class="size-5"></i>
        <span class="text-sm">Add Room</span>
      </div>
    </a>
  </div>
</x-properties.detail>
