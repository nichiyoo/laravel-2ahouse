<section>
  <x-ui.header>
    <x-slot:title>
      Update Password
    </x-slot>
    <x-slot:description>
      Ensure your account is using a long, random password to stay secure.
    </x-slot>
  </x-ui.header>

  <form method="post" action="{{ route('password.update') }}" class="grid gap-4 mt-6">
    @csrf
    @method('PUT')

    <div>
      <x-ui.label for="update_password_current_password" value="Current Password" />
      <x-ui.input id="update_password_current_password" name="current_password" type="password"
        autocomplete="current-password" placeholder="Enter your current password" />
      @if ($errors->updatePassword->has('current_password'))
        <x-ui.error message="{{ $errors->updatePassword->first('current_password') }}" />
      @endif
    </div>

    <div>
      <x-ui.label for="update_password_password" value="New Password" />
      <x-ui.input id="update_password_password" name="password" type="password" autocomplete="new-password"
        placeholder="Enter your new password" />
      @if ($errors->updatePassword->has('password'))
        <x-ui.error message="{{ $errors->updatePassword->first('password') }}" />
      @endif
    </div>

    <div>
      <x-ui.label for="update_password_password_confirmation" value="Confirm Password" />
      <x-ui.input id="update_password_password_confirmation" name="password_confirmation" type="password"
        autocomplete="new-password" placeholder="Confirm your new password" />
      @if ($errors->updatePassword->has('password_confirmation'))
        <x-ui.error message="{{ $errors->updatePassword->first('password_confirmation') }}" />
      @endif
    </div>

    <div class="flex items-center gap-4">
      <x-ui.button>Update Password</x-ui.button>
      @if (session('status') === 'password-updated')
        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-zinc-600">
          Saved.
        </p>
      @endif
    </div>
  </form>
</section>
