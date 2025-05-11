<x-app-layout>
  <div class="grid gap-6 p-content">
    <section>
      <x-app.title>
        <x-slot:section>Welcome Back</x-slot>
        <x-slot:heading>{{ Auth::user()->name }}</x-slot>
      </x-app.title>
    </section>

    <section>
      <div class="flex items-center justify-between p-6 content rounded-xl">
        <h2>Jumlah Daftar</h2>
        <span class="text-4xl font-bold text-primary-500">{{ $count }}</span>
      </div>
    </section>

    <section class="grid gap-4">
      <h1 class="text-2xl font-semibold">
        Popular properties
      </h1>

      @foreach ($properties as $property)
        <x-properties.card :property="$property" />
      @endforeach
    </section>
  </div>
</x-app-layout>
