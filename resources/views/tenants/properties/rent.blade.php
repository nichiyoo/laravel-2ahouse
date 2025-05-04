<x-app-layout>
  <x-slot:action>
    <nav class="fixed bottom-0 w-full max-w-md">
      <div class="grid grid-cols-2 border-t border-zinc-200 bg-zinc-50">
        <a href="{{ route('tenants.properties.show', $property) }}" class="p-4">
          <x-ui.button variant="secondary">
            <i data-lucide="arrow-left" class="size-5"></i>
            <span>Back</span>
          </x-ui.button>
        </a>

        <div class="p-4">
          <x-ui.button form="rentForm" type="submit">
            <i data-lucide="shopping-cart" class="size-5"></i>
            <span>Rent</span>
          </x-ui.button>
        </div>
      </div>
    </nav>
  </x-slot>

  <div class="grid gap-6 pb-24 p-content">
    <section class="flex flex-col">
      <span class="text-sm text-zinc-500">Rent a Room</span>
      <h1 class="text-lg font-semibold">
        {{ $property->name }}
      </h1>
    </section>

    <form id="rentForm" method="POST" action="{{ route('tenants.properties.reserve', $property) }}"
      class="grid gap-6">
      @csrf

      <div>
        <x-ui.label for="name" value="Full Name" />
        <x-ui.input id="name" type="text" name="name" value="{{ old('name', auth()->user()->name ?? '') }}"
          required autofocus placeholder="Enter your fullname" />
        @error('name')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>

      <div>
        <x-ui.label for="email" value="Email" />
        <x-ui.input id="email" type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}"
          required placeholder="Enter your email" />
        @error('email')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>

      <div>
        <x-ui.label for="phone" value="Phone Number" />
        <x-ui.input id="phone" type="tel" name="phone"
          value="{{ old('phone', auth()->user()->tenant->phone ?? '') }}" required
          placeholder="Enter your phone number" />
        @error('phone')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>

      <div>
        <x-ui.label for="room_id" value="Room Choice" />
        <x-ui.select id="room_id" name="room_id" required placeholder="Select a room">
          @foreach ($property->rooms as $room)
            @if ($room->capacity > 0)
              <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                {{ $room->type }} - ${{ number_format($room->price, 2) }}/month - {{ $room->capacity }} available
              </option>
            @endif
          @endforeach
        </x-ui.select>
        @error('room_id')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>

      <div>
        <x-ui.label for="start_date" value="Start Date" />
        <x-ui.input id="start_date" type="date" name="start_date" min="{{ date('Y-m-d') }}"
          value="{{ old('start_date', date('Y-m-d', strtotime('+1 week'))) }}" required />
        @error('start_date')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>

      <div>
        <x-ui.label for="notes" value="Additional Notes (Optional)" />
        <x-ui.textarea id="notes" name="notes"
          placeholder="Any special requests or information we should know">{{ old('notes') }}</x-ui.textarea>
        @error('notes')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>

      <div class="flex flex-col gap-4">
        <h3 class="text-lg font-semibold">Rental Terms</h3>
        <div class="text-sm text-zinc-600">
          <p>By submitting this form, you agree to the following terms:</p>
          <ul class="pl-5 list-disc list-inside">
            <li>A security deposit equivalent to one month's rent is required</li>
            <li>Rent is due on the 1st of each month</li>
            <li>Minimum rental period is 6 months</li>
            <li>Utilities are not included in the rent</li>
          </ul>
        </div>

        <div class="flex items-start gap-2 mt-4">
          <input type="checkbox" id="agree_terms" name="agree_terms"
            class="mt-1 rounded shadow-sm border-zinc-300 text-primary-500 focus:border-primary-500 focus:ring-primary-500"
            required>
          <label for="agree_terms" class="text-sm">I agree to the rental terms and conditions</label>
        </div>

        @error('agree_terms')
          <x-ui.error message="{{ $message }}" />
        @enderror
      </div>
    </form>
  </div>
</x-app-layout>
