<section class="space-y-6">
  <x-ui.header>
    <x-slot name="title"> Sign Out </x-slot>
    <x-slot name="description">
      Signing out will also clear your remember me token.
    </x-slot>

  </x-ui.header>

  <form method="post" action="{{ route('logout') }}">
    @csrf
    @method('post')

    <x-ui.button type="submit">
      Sign Out
    </x-ui.button>
  </form>
</section>
