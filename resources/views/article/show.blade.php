@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-10 bg-white p-5">
        <div class="d-flex align-items-center justify-content-between">
          <div class="d-flex">
            <div class="show-img">
              <img src="{{ asset('images/icon.png') }}" alt="">
            </div>
            <p class="show-name"></p>
          </div>
          <div class="d-flex">
            <a href="" class="btn btn-primary">編集</a>
            <a href="" class="btn btn-danger ml-3">削除</a>
          </div>
        </div>
        <h1 class="mt-3">タイトル</h1>
        <ul class="d-flex">
          <li><a href="">たぐ</a></li>
          <li class="ml-2"><a href="">たぐ</a></li>
        </ul>
        <div class="mt-5">
          content
        </div>
      </div>
      <div class="col-md-2 bg-white p-3">
        <p>サイドバーですよん</p>
      </div>
    </div>
  </div>

@endsection