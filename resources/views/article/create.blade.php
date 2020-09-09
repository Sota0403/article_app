@extends('layouts.app')

@section('content')
  <div class="l-container">
    <h1>記事作成ページです！</h1>
    <div class="create-form">
      <form action="{{ route('article.store') }}" method="POST">
        @csrf
        <div>
          <label for="title">タイトル</label>
          <input class="w-100" type="text" name="title">
          @error('title')
            <p class="text-danger">{{ $message }}</p>
          @enderror
        </div>
        <div class=mt-2>
          <input type="checkbox">HTML
          <input type="checkbox">CSS
          <input type="checkbox">Javascript
          <input type="checkbox">PHP
        </div>
        <div class="d-flex mt-4">
          <div class="w-50">
            <textarea class="w-100 min-height" name="content" id=""></textarea>
            @error('content')
            <p class="text-danger">{{ $message }}</p>
            @enderror
          </div>
          <div class="create-preview w-50 bg-white min-height">
            
          </div>
        </div>
        <div class="create-submit mt-5">
          <button class="btn btn-lg btn-primary" type="submit">送信</button>
        </div>
      </form>
    </div>
  </div>

@endsection