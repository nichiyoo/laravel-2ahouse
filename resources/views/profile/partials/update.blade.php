<section>
  <x-ui.header>
    <x-slot:title>
      Profile Information
    </x-slot>
    <x-slot:description>
      Update your account&apos;s profile information and email address.
    </x-slot>
  </x-ui.header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <form method="post" action="{{ route('profile.update') }}" class="grid gap-4 mt-6">
    @csrf
    @method('patch')

    <div>
      <x-ui.label for="name" value="Name" />
      <x-ui.input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
        autocomplete="name" />
      <x-ui.error :messages="$errors->get('name')" />
    </div>

    <div>
      <x-ui.label for="email" value="Name" />
      <x-ui.input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
        autocomplete="username" />
      <x-ui.error :messages="$errors->get('email')" />
    </div>

    <div class="flex items-center gap-4">
      <x-ui.button>Save Profile</x-ui.button>
      @if (session('status') === 'profile-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-zinc-600">
          Saved.</p>
      @endif
    </div>
  </form>
</section>
