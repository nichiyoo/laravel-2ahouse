<section class="space-y-6">
  <x-ui.header>
    <x-slot:title> Delete Account
    </x-slot>
    <x-slot:description>
      Once your account is deleted, all of its resources and data will be permanently deleted.
    </x-slot>
  </x-ui.header>

  <x-ui.button x-data="" variant="destructive"
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
    Delete Account
  </x-ui.button>

  <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()">
    <form method="post" action="{{ route('profile.destroy') }}">
      @csrf
      @method('delete')

      <x-ui.header>
        <x-slot:title> Delete Account
        </x-slot>
        <x-slot:description>
          Once your account is deleted, all of its resources and data will be permanently deleted.
        </x-slot>
      </x-ui.header>

      <div class="mt-6">
        <x-ui.label for="password" value="Password" />
        <x-ui.input id="password" name="password" type="password" placeholder="Enter your password" />
        <x-ui.error :messages="$errors->userDeletion->get('password')" />
      </div>

      <div class="flex justify-end gap-2 mt-6">
        <x-ui.button type="button" variant="secondary" x-on:click="$dispatch('close-modal', 'confirm-user-deletion')">
          Cancel
        </x-ui.button>
        <x-ui.button variant="destructive">
          Delete
        </x-ui.button>
      </div>
    </form>
  </x-modal>
</section>
