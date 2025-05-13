@props([
    'id' => null,
    'title' => null,
    'route' => null,
])

<div x-data="confirmation" x-init="$el.querySelector('button').addEventListener('click', (e) => {
    e.preventDefault();
    $dispatch('trigger', {
        id: @js($id),
        title: @js($title),
        route: @js($route)
    });
})">

  {{ $slot }}

  @once
    <div x-on:trigger.window="open($event.detail.id, $event.detail.title, $event.detail.route)">
      <x-modal name="confirm-deletion" focusable>
        <form method="POST" x-bind:action="route" class="grid gap-4">
          @csrf
          @method('DELETE')

          <h5 class="text-lg font-semibold text-zinc-900">
            Are you sure you want to delete <span x-text="title"></span>?
          </h5>

          <p class="text-zinc-600 text-wrap">
            Be careful! This action cannot be undone. All of the data will be permanently removed,
            including all related data, make sure you have a backup of the data before proceeding.
          </p>

          <div class="grid grid-cols-2 gap-4">
            <x-ui.button variant="secondary" type="button" x-on:click="$dispatch('close-modal', 'confirm-deletion')">
              Cancel
            </x-ui.button>
            <x-ui.button variant="destructive" type="submit">
              Confirm Delete
            </x-ui.button>
          </div>
        </form>
      </x-modal>
    </div>

    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('confirmation', () => ({
          id: null,
          title: null,
          route: null,

          open(id, title, route) {
            this.id = id;
            this.title = title;
            this.route = route;
            this.$dispatch('open-modal', 'confirm-deletion');
          },
        }));
      });
    </script>
  @endonce
</div>
