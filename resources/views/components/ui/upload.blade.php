@props([
    'value' => null,
    'name' => 'image',
    'required' => false,
    'placeholder' => 'Upload Image',
    'accept' => 'image/*',
])

@php
  $props = $attributes->merge([
      'type' => 'file',
      'class' => 'hidden',
      'id' => $name,
      'name' => $name,
      'accept' => $accept,
      'required' => $required,
  ]);
@endphp

<div x-data="upload" class="h-56 overflow-hidden bg-white border border-zinc-200 rounded-xl">
  <input {{ $props }} x-ref="input" x-on:change="change($event)" />

  <button type="button" x-on:click="$refs.input.click()" x-show="!preview" class="size-full">
    <div class="flex items-center justify-center gap-2 text-zinc-500">
      <i data-lucide="image-plus" class="size-5"></i>
      <span class="text-sm">{{ $placeholder }}</span>
    </div>
  </button>

  <div x-show="preview" class="relative h-56">
    <img x-bind:src="preview" class="object-cover size-full rounded-xl">
    <div class="absolute inset-0 transition-opacity opacity-0 hover:opacity-100 bg-zinc-900/50">
      <div class="flex items-center justify-center gap-2 size-full">
        <button type="button" x-on:click="$refs.input.click()" class="p-2 bg-white rounded-full hover:bg-zinc-100">
          <i data-lucide="pencil" class="size-5 text-zinc-700"></i>
        </button>

        <button type="button" x-on:click="clear()" class="p-2 bg-white rounded-full hover:bg-zinc-100">
          <i data-lucide="trash" class="size-5 text-zinc-700"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('upload', () => ({
      preview: null,

      init() {
        const value = @js($value);
        if (value) this.preview = value;
      },

      change(event) {
        const file = event.target.files[0];

        if (!file) {
          this.preview = null;
          return;
        }

        const reader = new FileReader();
        reader.onload = (e) => {
          this.preview = e.target.result;
        };
        reader.readAsDataURL(file);
      },

      clear() {
        this.preview = null;
        this.$refs.input.value = '';
      }
    }));
  });
</script>
