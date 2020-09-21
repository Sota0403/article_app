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
  <header class="d-flex align-items-center justify-content-between px-4">
    <div><a class="" href="{{ route('article.index') }}">Soooota</a></div>
    <div class="d-flex">
      @if( Auth::check() )
      <ul class="d-flex mb-0">
        <li class="ml-2"><a href="{{ route('article.index') }}">記事一覧</a></li>
        <li class="ml-2"><a href="{{ route('user.mypage') }}">マイページ</a></li>
      </ul>
      <form action="{{ route('logout') }}" method="post">
        @csrf
        <input type="submit" value="ログアウト">
      </form>
      @endif
      @guest
      <ul class="d-flex mb-0">
        <li><a href="{{ route('login') }}">ログイン</a></li>
        <li class="ml-2"><a href="{{ route('register') }}">登録</a></li>
      </ul>
      @endguest
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <footer class="small text-center">
    <p>©2020 Gizumo.inc All Right Reserved.</p>
  </footer>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>