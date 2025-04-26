<x-guest-layout>
  <x-ui.header>
    <x-slot:title>Log in to your account</x-slot>
  </x-ui.header>

  <x-ui.status class="mb-4" :status="session('status')" />

  <form method="POST" action="{{ route('login') }}" class="grid gap-4">
    @csrf
    <div>
      <x-ui.label for="email" value="Email" />
      <x-ui.input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
        autocomplete="username" placeholder="Enter your email" />
      @error('email')
        <x-ui.error message="{{ $message }}" />
      @enderror
    </div>

    <div>
      <x-ui.label for="password" value="Password" />
      <x-ui.input id="password" type="password" name="password" required autocomplete="current-password"
        placeholder="Enter your password" />
      @error('password')
        <x-ui.error message="{{ $message }}" />
      @enderror
    </div>

    <div class="flex items-center justify-between gap-4 text-sm">
      <a href="{{ route('password.request') }}" class="text-zinc-500">
        Forgot Password ?
      </a>

      <a href="{{ route('register') }}" class="text-primary-500">
        Create account
      </a>
    </div>

    <x-ui.button>
      <span>Log in</span>
      <i data-lucide="arrow-right"></i>
    </x-ui.button>

    <x-social-login />
  </form>
</x-guest-layout>
