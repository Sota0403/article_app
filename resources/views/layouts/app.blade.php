<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
  <header class="d-flex align-items-center">
    <div class="w-100 text-center"><a class="" href="{{ route('article.index') }}">Soooota</a></div>
  </header>

  <main>
    @yield('content')
  </main>

  <footer class="small text-center">
    <p>©2020 Gizumo.inc All Right Reserved.</p>
  </footer>

</body>
</html>