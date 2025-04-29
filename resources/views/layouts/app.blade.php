<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')
</head>

<body class="font-sans antialiased bg-zinc-100 text-zinc-950">
  <div class="container relative h-screen max-w-md overflow-x-hidden bg-zinc-100 md:border-x">

    <x-ui.status variant="success" status="{{ session('success') }}" />
    <x-ui.status variant="error" status="{{ session('error') }}" />

    <main class="pb-[70px]">
      @isset($header)
        {{ $header }}
      @endisset

      {{ $slot }}
    </main>

    @isset($action)
      <div class="fixed bottom-0 w-full max-w-md">
        {{ $action }}
      </div>
    @else
      <div class="fixed bottom-0 w-full max-w-md">
        <x-tenants.navigation />
      </div>
    @endisset
  </div>

  @stack('scripts')
</body>

</html>
