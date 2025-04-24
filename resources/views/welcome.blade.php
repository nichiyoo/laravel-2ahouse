<x-landing-layout>
  <div class="flex flex-col justify-center h-full gap-8 p-content">
    <h1 class="basis-1/3">
      <span class="block text-xl font-semibold">Selamat datang</span>
      <span class="block text-5xl font-bold text-primary-500">{{ config('app.name') }}.</span>
    </h1>

    <div class="flex flex-col items-center gap-6 basis-1/3">
      <img src={{ asset('images/logo.png') }} alt="Logo" class="w-full max-w-xs">
      <p class="text-center">
        Temukan Kos Pilihanmu
      </p>
    </div>

    <div class="flex flex-col justify-end gap-2 basis-1/3">
      <a href="{{ route('login') }}">
        <x-ui.button variant="secondary">Are you a user?</x-ui.button>
      </a>
      <a href="{{ route('login') }}">
        <x-ui.button variant="primary">Are you an owner?</x-ui.button>
      </a>
    </div>
  </div>
</x-landing-layout>
