<header class="flex items-center justify-between">
  <div class="flex flex-col gap-2">
    <h2 class="text-xl font-semibold tracking-tight">
      {{ $title }}
    </h2>

    @isset($description)
      <p class="text-sm text-zinc-500">
        {{ $description }}
      </p>
    @endisset
  </div>

  @isset($actions)
    <div class="flex items-center flex-none gap-2">
      {{ $actions }}
    </div>
  @endisset
</header>
