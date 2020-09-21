@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-3 bg-white p-4">
        <p class="h3 text-center font-weight-bold">プロフィール</p>
        <div class="text-center mt-3">
          <img class="w-75" src="{{ asset('storage/users/' . $currentUser->picture) }}" alt="">
        </div>
        <div>
          <p class="font-weight-bold mb-1 mt-2">名前</p>
          <p>{{ $currentUser->name }}</p>
        </div>
        <div>
          <p class="font-weight-bold mb-1">メールアドレス</p>
          <p>{{ $currentUser->email }}</p>
        </div>
        <p class="btn btn-primary" data-toggle="modal" data-target="#profileModal">プロフィール変更</p>
      </div>
      <div class="col-md-9">
        <div class="top-body bg-white p-3">
          <ul class="mb-0">
            @foreach ($articles as $article)
              <li class="top-article d-flex p-2">
                <a href="{{ route('article.show', $article->id) }}">
                  <div class="top-article-img">
                    <img src="{{ asset('storage/users/' . $article->user->picture) }}" alt="">
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

  <!-- Modal -->
  <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">プロフィール変更</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {!! Form::open(['route' => 'user.mypage.update', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
        <div class="modal-body py-4">
          <div>
            <p class="mb-1">名前</p>
            {!! Form::text('name', $currentUser->name, ['class' => 'w-100']) !!}
          </div>
          <div class="mt-3">
            <p class="mb-1">メールアドレス</p>
            {!! Form::text('email', $currentUser->email, ['class' => 'w-100']) !!}
          </div>
          <div class="mt-3">
            <p class="mb-1">プロフィール画像</p>
            {!! Form::file('picture', []) !!}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <button type="submit" class="btn btn-primary">保存</button>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

@endsection