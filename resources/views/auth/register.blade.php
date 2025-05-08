<x-guest-layout>
  <x-ui.header>
    <x-slot:title>Welcome to {{ config('app.name') }}</x-slot>
  </x-ui.header>

  <form method="POST" action="{{ route('register') }}" class="grid gap-4">
    @csrf

    <div>
      <x-ui.label for="name" value="Name" />
      <x-ui.input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
        autocomplete="name" placeholder="Enter your name" />
      <x-ui.error :messages="$errors->get('name')" />
    </div>

    <div>
      <x-ui.label for="email" value="Email" />
      <x-ui.input id="email" type="email" name="email" value="{{ old('email') }}" required
        autocomplete="username" placeholder="Enter your email" />
      <x-ui.error :messages="$errors->get('email')" />
    </div>

    <div>
      <x-ui.label for="role" value="Role" />
      <x-ui.select id="role" name="role" required autocomplete="role" placeholder="Select your role">
        @foreach ($roles as $role)
          <option value="{{ $role }}" @selected(request()->get('role') == $role->value ?? old('role') == $role->value)>
            {{ $role->label() }}
          </option>
        @endforeach
      </x-ui.select>
      <x-ui.error :messages="$errors->get('role')" />
    </div>

    <div>
      <x-ui.label for="password" value="Password" />
      <x-ui.input id="password" type="password" name="password" required autocomplete="new-password"
        placeholder="Enter your password" />
      <x-ui.error :messages="$errors->get('password')" />
    </div>

    <div>
      <x-ui.label for="password_confirmation" value="Confirm Password" />
      <x-ui.input id="password_confirmation" type="password" name="password_confirmation" required
        autocomplete="new-password" placeholder="Confirm your password" />
      <x-ui.error :messages="$errors->get('password_confirmation')" />
    </div>

    <div class="flex items-center justify-end gap-4 text-sm">
      <a href="{{ route('login') }}" class="text-primary-500">
        Already have an account?
      </a>
    </div>

    <x-ui.button>
      <span>Create Account</span>
      <i data-lucide="arrow-right"></i>
    </x-ui.button>
    <x-social-login />
  </form>
</x-guest-layout>
