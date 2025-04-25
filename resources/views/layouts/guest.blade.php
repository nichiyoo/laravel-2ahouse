<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-zinc-100 text-zinc-950">
  <div class="container h-screen max-w-md overflow-y-auto border bg-zinc-50 border-x">
    <div class="grid items-center h-full">
      <div class="flex flex-col gap-8 p-content">
        <a href="{{ route('welcome') }}">
          <x-ui.logo class="mx-auto max-w-40" />
        </a>

        <div class="grid gap-8">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div>
</body>

</html>
