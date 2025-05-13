<x-app-layout>
  <div class="grid gap-6 pb-24 p-content">
    <section class="flex flex-col">
      <span class="text-sm text-zinc-500">Add New Property</span>
      <h1 class="text-lg font-semibold">Property Details</h1>
    </section>

    <form id="form" method="POST" action="{{ route('landlords.properties.store') }}" class="grid gap-6"
      enctype="multipart/form-data">
      @csrf
      @include('landlords.properties.form')
    </form>
  </div>

  <x-slot:action>
    <nav class="fixed bottom-0 w-full max-w-md">
      <div class="grid grid-cols-2 border-t border-zinc-200 bg-zinc-50">
        <a href="{{ route('landlords.properties.index') }}" class="p-4">
          <x-ui.button variant="secondary">
            <i data-lucide="arrow-left" class="size-5"></i>
            <span>Back</span>
          </x-ui.button>
        </a>

        <div class="p-4">
          <x-ui.button form="form" type="submit">
            <span>Create Property</span>
          </x-ui.button>
        </div>
      </div>
    </nav>
  </x-slot>
</x-app-layout>
