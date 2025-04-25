<x-app-layout>
  <div class="grid gap-8 p-content">
    <div class="p-8 bg-white content rounded-xl">
      @include('profile.partials.update')
    </div>

    <div class="p-8 bg-white content rounded-xl">
      @include('profile.partials.password')
    </div>

    <div class="p-8 bg-white content rounded-xl col-span-full">
      @include('profile.partials.delete')
    </div>
  </div>
</x-app-layout>
