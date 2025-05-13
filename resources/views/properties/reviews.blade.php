<x-properties.detail :property="$property">
  <div class="grid items-start gap-6 min-h-80">
    @forelse ($property->reviews as $review)
      <x-reviews.card :review="$review" />
    @empty
      <div class="flex flex-col justify-center h-56 gap-4 text-sm">
        <div class="flex items-center justify-center gap-2 text-zinc-500">
          <span>Oops! No reviews found.</span>
          <i data-lucide="search" class="size-4"></i>
        </div>
      </div>
    @endforelse
  </div>
</x-properties.detail>
