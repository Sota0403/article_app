@extends('layouts.app')

@section('content')
  <div class="l-container">
    <h1>記事確認ページです！</h1>
    <div class="create-form">
      @if(isset($articleContent['article_id']))
      {!! Form::open(['route' => ['article.update', $articleContent['article_id']], 'method' => 'PUT']) !!}
      @else
      {!! Form::open(['route' => 'article.store', 'method' => 'POST']) !!}
      @endif
        @csrf
        <div>
          <label for="title">タイトル</label>
          <p class="p-2 bg-white">{{ $articleContent['title'] }}</p>
          {{-- {!! Form::text('title', $targetArticle->title, ['class' => 'w-100']) !!} --}}
          {{-- @error('title')
            <p class="text-danger">{{ $message }}</p>
          @enderror --}}
        </div>
        <ul class="d-flex">
          {{-- @dd($tags, $articleContent['tags'], $tags->pluck('id')->toArray()) --}}
          @foreach ($tags as $tag)
          {!! Form::checkbox('tags[]', $tag->id, in_array($tag->id, $articleContent['tags'], true) ? true : false, ['class' => 'ml-2', 'disabled']) !!}{{ $tag->name }}
          {{-- {!! Form::checkbox('tags[]', $tag->id, in_array(, , true) ? true : false, ['class' => 'ml-2']) !!}{{ $tag->name }} --}}
          @endforeach
        </ul>
        <div class="d-flex mt-4">
          <div class="w-100 min-height bg-white p-4">
            {{ $articleContent['content'] }}
            {{-- {!! Form::textarea('content',  $targetArticle->content, ['class' => 'w-100 min-height']) !!} --}}
            {{-- @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror --}}
          </div>
        </div>
        <div class="create-submit mt-5">
          <button class="btn btn-lg btn-primary" type="submit">送信</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection