<x-app-layout>
  <x-slot:action>
    <x-properties.detail.action :property="$property" />
  </x-slot>

  <div class="relative grid gap-6">
    <div class="absolute top-0 w-full">
      <img src="{{ $property->image }}" alt="{{ $property->name }}" class="object-cover aspect-square size-full" />
      <div class="absolute inset-0 bg-gradient-to-t from-zinc-950 to-transparent"></div>
    </div>

    <section class="relative flex flex-col justify-between pb-16 text-white aspect-square p-content">
      <x-properties.detail.topbar :property="$property" />
      <x-properties.detail.profile :user="$property->landlord->user" />
    </section>

    <x-properties.detail :property="$property">
      <div class="grid gap-6">
        <div class="flex flex-col gap-2">
          <h4 class="text-lg font-medium">Tenant Review</h4>
          <div class="grid gap-6">
            @foreach ($property->reviews as $review)
              <div class="flex flex-col gap-4 p-6 content rounded-2xl">
                <div class="flex items-center gap-2 ">
                  <x-ui.avatar name="{{ $review->tenant->user->name }}" />
                  <div class="flex flex-col text-sm">
                    <span class="font-medium">{{ $review->tenant->user->name }}</span>
                    <span class="text-zinc-500">Tenant</span>
                  </div>
                </div>

                <p class="text-sm text-zinc-500">{{ $review->comment }}</p>

                <div class="flex items-center justify-end text-yellow-500">
                  @foreach (range(1, $review->rating) as $i)
                    <i data-lucide="star" class="fill-current size-4"></i>
                  @endforeach
                  <span class="ml-2">{{ $review->rating }}</span>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </x-properties.detail>
  </div>
</x-app-layout>
