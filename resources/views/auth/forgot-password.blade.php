<x-guest-layout>
  <x-ui.header>
    <x-slot:title>Forgot your password?</x-slot>
    <x-slot:description>
      No problem. Just let us know your email address and we will email you a password reset
      link that will allow you to choose a new one.
    </x-slot>
  </x-ui.header>


  <x-ui.status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('password.email') }}" class="grid gap-4">
    @csrf

    <div>
      <x-ui.label for="email" value="Email" />
      <x-ui.input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
        placeholder="Enter your email" />
      @error('email')
        <x-ui.error :messages="$errors->get('email')" />
      @enderror
    </div>

    <div class="flex items-center justify-end">
      <x-ui.button>
        <span>Send Link</span>
        <i data-lucide="arrow-right"></i>
      </x-ui.button>
    </div>
  </form>
</x-guest-layout>
