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
            <a href="{{ route('article.edit', $article->id) }}" class="btn btn-primary">編集</a>
            {!! Form::open(['route' => ['article.delete', $article->id], 'method' => 'DELETE']) !!}
              {!! Form::submit('削除', ['class' => 'btn btn-danger ml-3', 'onclick' => 'confirmFunction()']) !!}
            {!! Form::close() !!}
          </div>
        </div>
        <h1 class="mt-3">{{ $article->title }}</h1>
        <ul class="d-flex">
          @foreach($article->tags as $tag)
          <li class="pl-2"><a href="">{{ $tag->name }}</a></li>
          @endforeach
        </ul>
        <div class="mt-5">
          {{ $article->content }}
        </div>
      </div>
      <div class="col-md-2 bg-white p-3">
        <p>サイドバーですよん</p>
      </div>
    </div>
  </div>

@endsection

<script>
  $(function() {
    function confirmFunction(e) {
      e.preventDefault();
      confirm( "本当に削除してよろしいですか？" );
    }
  });
</script>