<x-guest-layout>
  <x-ui.header>
    <x-slot:title>Confirm Password</x-slot>
    <x-slot:description> This is a secure area of the application. Please confirm your password before
      continuing.</x-slot>
  </x-ui.header>


  <form method="POST" action="{{ route('password.confirm') }}" class="grid gap-4">
    @csrf

    <div>
      <x-ui.label for="password" value="Password" />
      <x-ui.input id="password" type="password" name="password" required autocomplete="current-password" />
      <x-ui.error :messages="$errors->get('password')" />
    </div>

    <div class="flex justify-end mt-4">
      <x-ui.button>
        Confirm Change
      </x-ui.button>
    </div>
  </form>
</x-guest-layout>
