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
      <div class="col-md-10">
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
                      <li class="top-article-tag d-inline-block"><a href="">HTML</a></li>
                      <li class="top-article-tag d-inline-block ml-2"><a href="">CSS</a></li>
                    </ul>
                    <p class="top-article-like d-inline-block mb-0">12</p>
                    <p class="top-article-name d-inline-block ml-3 mb-0"></p>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>


@endsection