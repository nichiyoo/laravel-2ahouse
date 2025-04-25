<section class="flex flex-col">
  <span class="text-sm text-zinc-500">Your location</span>
  <div class="text-lg font-semibold line-clamp-1">
    <p>{{ Auth::user()->tenant->address }}</p>
  </div>
</section>
