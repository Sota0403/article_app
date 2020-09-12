@extends('layouts.app')

@section('content')
<div class="container">
  <div class="w-75 mx-auto p-5 bg-white">
    <p>初回ログインに辺り、パスワードを変更して下さい。</p>
    <form action="" method="post">
      @method('PUT')
      @csrf
      <input type="password" name="password" class="mt-3 w-100">
      <input type="password" name="password_confimation" class="mt-3 w-100">
      <input type="submit" class="btn btn-primary mt-3" value="パスワード変更">
    </form>
  </div>
</div>
@endsection
