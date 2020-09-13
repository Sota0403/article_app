@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-2">
        <ul class="top-menus mt-2">
          <li class="top-menu"><a href="">新着</a></li>
          <li class="top-menu mt-2"><a href="">週間ランキング</a></li>
          <li class="top-menu mt-2"><a href="">月間ランキング</a></li>
        </ul>
      </div>
      <div class="col-md-7">
        <div class="top-body bg-white p-3">
          <ul class="mb-0">
            @foreach ($articles as $article)
              <li class="top-article d-flex p-2">
                <a href="{{ route('article.show', $article->id) }}">
                  <div class="top-article-img">
                    <img src="{{ asset('images/icon.png') }}" alt="">
                  </div>
                  <div class="top-article-content ml-3">
                    <p class="top-article-ttl mb-0">{{ $article->title }}</p>
                    <ul class="top-article-tags">
                      @foreach ($article->tags as $tag)
                         <li class="top-article-tag d-inline-block ml-2"><a href="">{{ $tag->name }}</a></li>
                      @endforeach
                    </ul>
                    <p class="top-article-like d-inline-block mb-0">12</p>
                    <p class="top-article-name d-inline-block ml-3 mb-0">{{ $article->user_name }}</p>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
      <div class="col-md-3">
        <div class="top-profile bg-white p-2">
          <div class="top-profile-img">
            <img src="{{ asset('images/icon.png') }}" alt="">
          </div>
          <p class="top-profile-name text-center mt-4">{{ $currentUser->name }}</p>
          <p class="text-center">記事数：</p>
          <p class="text-center">総いいね：</p>
          <a href="{{ route('article.create') }}" class="btn btn-primary mx-auto">記事作成</a>
        </div>
        <div class="mt-3 bg-white p-3">
          <p class="text-center">ユーザランキング</p>
          <div class="d-flex justify-content-center">
            <p class="p-1 bg-light">総いいね</p>
            <p class="ml-2 p-1 bg-light">記事数</p>
          </div>
          <ul>
            <li class="d-flex">
              <div class="top-ranking-img"><img src="{{ asset('images/icon.png') }}" alt=""></div>
              <p class="ml-2">なまえ</p>
              <p class="ml-2">♡</p>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>


@endsection