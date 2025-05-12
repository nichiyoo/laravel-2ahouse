<x-properties.detail :property="$property">
  <div class="grid gap-6">
    @foreach ($property->reviews as $review)
      <x-reviews.card :review="$review" />
    @endforeach

    <a role="button" href="#"
      class="grid h-40 border border-dashed place-content-center border-zinc-200 rounded-xl">
      <div class="flex items-center gap-2 text-zinc-500">
        <i data-lucide="plus" class="size-5"></i>
        <span class="text-sm">Add Review</span>
      </div>
    </a>
  </div>
</x-properties.detail>
