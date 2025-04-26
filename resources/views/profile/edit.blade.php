<x-app-layout>
  <div class="grid gap-6 p-content">
    <section>
      <x-app.title>
        <x-slot:section>Profile</x-slot>
        <x-slot:heading>Update Profile</x-slot>
      </x-app.title>
    </section>

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
