<div class="flex items-center justify-between gap-2">
  <div>
    <x-ui.button size="icon" onclick="history.back(); return false;">
      <i data-lucide="chevron-left" class="size-4"></i>
      <span class="sr-only">Back</span>
    </x-ui.button>
  </div>

  <form method="POST" action="{{ route('tenants.properties.bookmark', $property) }}">
    @csrf
    <x-ui.button size="icon">
      <i data-lucide="bookmark" class="size-4 @if ($property->bookmarked) fill-current @endif"></i>
      <span class="sr-only">Bookmark</span>
    </x-ui.button>
  </form>
</div>
