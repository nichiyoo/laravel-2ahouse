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
  <div class="container relative h-screen max-w-md overflow-y-auto border bg-zinc-100 border-x">

    <main class="pb-20">
      {{ $slot }}
    </main>

    <x-navigation class="fixed bottom-0 max-w-md" />
  </div>
</body>

</html>
