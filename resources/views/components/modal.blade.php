@props([
    'name' => 'modal',
    'show' => false,
    'width' => 'md',
])

@php
  $widths = [
      'sm' => 'max-w-sm',
      'md' => 'max-w-md',
      'lg' => 'max-w-lg',
      'xl' => 'max-w-xl',
      '2xl' => 'max-w-2xl',
  ];

  $width = $widths[$width];
@endphp

<div x-data="{
    show: @js($show),
    focusables() {
        let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
        return [...$el.querySelectorAll(selector)]
            .filter(el => !el.hasAttribute('disabled'))
    },
    firstFocusable() { return this.focusables()[0] },
    lastFocusable() { return this.focusables().slice(-1)[0] },
    nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
    prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
    nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
    prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) - 1 },
}" x-init="$watch('show', value => {
    if (value) {
        document.body.classList.add('overflow-y-hidden');
        {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
    } else {
        document.body.classList.remove('overflow-y-hidden');
    }
})"
  x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
  x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null" x-on:close.stop="show = false"
  x-on:keydown.escape.window="show = false" x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
  x-on:keydown.shift.tab.prevent="prevFocusable().focus()" x-show="show"
  class="fixed inset-0 z-50 grid items-end overflow-y-auto sm:px-0" style="display: {{ $show ? 'block' : 'none' }};">

  <div x-show="show" class="fixed inset-0 transition-all transform backdrop-blur-sm" x-on:click="show = false"
    x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
    <div class="absolute inset-0 bg-zinc-950/50"></div>
  </div>

  <div x-show="show"
    class="content rounded-t-xl overflow-hidden p-6 pb-10 transform transition-all w-full {{ $width }} mx-auto"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
    {{ $slot }}
  </div>
</div>
