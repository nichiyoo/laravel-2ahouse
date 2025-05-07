@php
  $props = $attributes->merge([
      'class' => 'w-full',
  ]);
@endphp

<form method="GET" action="{{ route('tenants.properties.index') }}" {{ $props }}>
  <div class="flex flex-col gap-2">
    <x-ui.label for="query" value="Search property" class="sr-only" />

    <div class="relative">
      <x-ui.input id="query" name="query" type="search" placeholder="Search property"
        value="{{ request()->get('query') }}" />
      <div class="absolute top-0 right-0 m-3">
        <button type="submit">
          <i data-lucide="search"></i>
          <span class="sr-only">Search</span>
        </button>
      </div>
    </div>

    <x-ui.error :messages="$errors->get('query')" />
  </div>
</form>
