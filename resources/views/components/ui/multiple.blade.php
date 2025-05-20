@props([
    'value' => null,
    'name' => 'image',
    'required' => false,
    'placeholder' => 'Change Images',
    'accept' => 'image/*',
])

@php
  $props = $attributes->merge([
      'type' => 'file',
      'class' => 'hidden',
      'id' => $name,
      'name' => $name . '[]',
      'accept' => $accept,
      'required' => $required,
      'multiple' => true,
  ]);
@endphp

<div x-data="multiple" class="grid gap-4" focusable>
  <input {{ $props }} x-ref="input" x-on:change="change($event)"
    class="bg-white border border-zinc-200 rounded-xl" />

  <div x-show="previews.length > 0" class="grid grid-cols-2 gap-4">
    <template x-for="(preview, index) in previews" :key="index">
      <div class="relative overflow-hidden rounded-lg h-36 bg-zinc-50">
        <img x-bind:src="preview" class="object-cover size-full">
      </div>
    </template>
  </div>

  <x-ui.button type="button" x-on:click="$refs.input.click()" variant="outline">
    <i data-lucide="images" class="size-5"></i>
    <span class="text-sm">{{ $placeholder }}</span>
  </x-ui.button>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('multiple', () => ({
      previews: [],

      init() {
        const value = @js($value);
        if (value) this.previews = value;
      },

      change(event) {
        const files = event.target.files;
        if (!files || files.length === 0) return;

        this.previews = [];

        Array.from(files).forEach(file => {
          const reader = new FileReader();
          reader.onload = (e) => {
            this.previews.push(e.target.result);
          };
          reader.readAsDataURL(file);
        });
      },

      remove(index) {
        this.previews.splice(index, 1);
        if (this.previews.length === 0) {
          this.$refs.input.value = '';
        }
      }
    }));
  });
</script>
