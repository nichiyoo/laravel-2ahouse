<x-guest-layout>
  <form method="POST" action="{{ route('password.store') }}" class="grid gap-4">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div>
      <x-ui.label for="email" value="Email" />
      <x-ui.input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required
        autofocus autocomplete="username" />
      @error('email')
        <x-ui.error :messages="$errors->get('email')" />
      @enderror
    </div>

    <div class="mt-4">
      <x-ui.label for="password" value="Password" />
      <x-ui.input id="password" type="password" name="password" required autocomplete="new-password" />
      @error('password')
        <x-ui.error :messages="$errors->get('password')" />
      @enderror
    </div>

    <div class="mt-4">
      <x-ui.label for="password_confirmation" value="Confirm Password" />
      <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required
        autocomplete="new-password" />
      @error('password_confirmation')
        <x-ui.error :messages="$errors->get('password_confirmation')" />
      @enderror
    </div>

    <div class="flex items-center justify-end mt-4">
      <x-ui.button>
        Reset Password
        <i data-lucide="arrow-right"></i>
      </x-ui.button>
    </div>
  </form>
</x-guest-layout>
