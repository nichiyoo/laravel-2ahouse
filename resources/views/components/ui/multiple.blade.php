@props([
    'value' => null,
    'name' => 'image',
    'required' => false,
    'placeholder' => 'Upload Images',
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

<div x-data="multipleUpload">
  <input {{ $props }} x-ref="input"
    x-on:change="change($event)"class="bg-white border border-zinc-200 rounded-xl" />

  <button type="button" x-on:click="$refs.input.click()" x-show="previews.length === 0"
    class="w-full h-56 bg-white border rounded-xl">
    <div class="flex items-center justify-center gap-2 text-zinc-500">
      <i data-lucide="images" class="size-5"></i>
      <span class="text-sm">{{ $placeholder }}</span>
    </div>
  </button>

  <div x-show="previews.length > 0" class="grid grid-cols-2 gap-3">
    <template x-for="(preview, index) in previews" :key="index">
      <div class="relative overflow-hidden rounded-lg h-36 bg-zinc-50">
        <img x-bind:src="preview" class="object-cover size-full">
        <div class="absolute inset-0 transition-opacity opacity-0 hover:opacity-100 bg-zinc-900/50">
          <div class="flex items-center justify-center gap-2 size-full">
            <button type="button" x-on:click="remove(index)" class="p-2 bg-white rounded-full hover:bg-zinc-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="lucide lucide-x size-4 text-zinc-700" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </template>
  </div>
</div>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('multipleUpload', () => ({
      previews: [],

      init() {
        const value = @js($value);
        if (value) this.previews = value;
      },

      change(event) {
        const files = event.target.files;
        if (!files || files.length === 0) return;

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
