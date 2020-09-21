@extends('layouts.app')

@section('content')
  <div class="l-container">
    <h1>記事編集ページです！</h1>
    <div class="create-form">
      {!! Form::open(['route' => ['article.comfirm', $targetArticle->id], 'method' => 'POST']) !!}
        @csrf
        <div>
          <label for="title">タイトル</label>
          {!! Form::text('title', $targetArticle->title, ['class' => 'w-100']) !!}
          @error('title')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <div class="mt-2">
          @foreach ($tags as $tag)
          {!! Form::checkbox('tags[]', $tag->id, in_array($tag->id, $hasTagsArray, true) ? true : false, ['class' => 'ml-2']) !!}{{ $tag->name }}
          @endforeach
        </div>
        <div class="d-flex mt-4">
          <div class="w-50">
            {!! Form::textarea('content',  $targetArticle->content, ['class' => 'w-100 min-height', 'id' => 'markdown_editor_area']) !!}
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <div class="create-preview w-50 bg-white min-height" id="markdown_preview">

          </div>
        </div>
        <div class="create-submit mt-5">
          <button class="btn btn-lg btn-primary" type="submit">送信</button>
        </div>
      {!! Form::close() !!}
    </div>
  </div>

@endsection