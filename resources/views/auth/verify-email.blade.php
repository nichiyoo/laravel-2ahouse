<x-guest-layout>
  <x-ui.header>
    <x-slot name="title">Thanks for signing up!</x-slot>
    <x-slot name="description">
      Before getting started, could you verify your email address by clicking on the link we
      just emailed to you? If you didn&apos;t receive the email, we will gladly send you another.
    </x-slot>
  </x-ui.header>

  @if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
      A new verification link has been sent to the email address you provided during registration.
    </div>
  @endif

  <div class="mt-4 flex items-center justify-between">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf
      <div>
        <x-ui.button>
          Resend Email
          <i data-lucide="arrow-right"></i>
        </x-ui.button>
      </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <x-ui.button variant="secondary" type="submit"
        class="underline text-sm text-zinc-600 hover:text-zinc-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
        Log Out
      </x-ui.button>
    </form>
  </div>
</x-guest-layout>
