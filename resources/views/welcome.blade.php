<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <h1>Selamat datang</h1>
  <span>{{ config('app.name') }}</span>

  <p>Temukan Kos Pilihanmu</p>

  <a href="{{ route('login') }}">
    <button>Are you a user?</button>
  </a>

  <a href="{{ route('login') }}">
    <button>Are you an owner?</button>
  </a>
</body>

</html>
