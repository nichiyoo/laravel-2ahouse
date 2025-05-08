@props([
    'name' => 'modal',
    'show' => false,
])

@php
  $props = $attributes->class(['content rounded-t-2xl overflow-hidden w-full', 'transform transition-all'])->merge([
      'class' => ' px-content py-10  max-w-md mx-auto bg-white',
  ]);
@endphp

<div x-data="modal" x-trap.inert.noscroll="show" x-on:open-modal.window="open" x-on:close-modal.window="close"
  x-on:keydown.escape.window="show = false" x-show="show"
  class="fixed inset-0 z-50 grid items-end overflow-y-auto sm:px-0" x-cloak>

  <div x-show="show" class="fixed inset-0 transition-all transform" x-on:click="show = false"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 bg-zinc-950/50"></div>
  </div>

  <div {{ $props }} x-show="show" x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-on:click.outside="show = false">
    {{ $slot }}
  </div>
</div>

@once
  <script>
    document.addEventListener('alpine:init', () => {
      Alpine.data('modal', () => ({
        name: @js($name),
        show: @js($show),

        open(event) {
          if (event.detail === this.name) {
            this.show = true;
          }
        },

        close(event) {
          if (event.detail === this.name) {
            this.show = false;
          }
        }
      }));

      window.openModal = (name) => {
        window.dispatchEvent(
          new CustomEvent('open-modal', {
            detail: name
          })
        )
      }

      window.closeModal = (name) => {
        window.dispatchEvent(
          new CustomEvent('close-modal', {
            detail: name
          })
        )
      }
    });
  </script>
@endonce
