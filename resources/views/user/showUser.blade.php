@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 p-4 bg-white">
      <h1>{{ $user->name }}</h1>
      {{-- <div class="profile-row">
        <p class="font-weight-bold">アバター</p>
        <p>{{ $currentUser->avator }}</p>
      </div> --}}
      <div class="profile-row">
        <p class="font-weight-bold">名前</p>
        <p>{{ $user->name }}</p>
      </div>
      <div class="profile-row">
        <p class="font-weight-bold">メールアドレス</p>
        <p>{{ $user->email }}</p>
      </div>
    </div>
    <div class="col-md-3 p-4 bg-white">
      @if(!$followStatus)
      {!! Form::open(['route' => ['follow', $user->id], 'method' => 'post']) !!}
      {!! Form::submit('フォローする', ['class' => 'btn btn-primary']) !!}
      {!! Form::close() !!}
      @else
      <a href="" class="btn btn-danger">フォロー解除</a>
      @endif
    </div>
  </div>
</div>
@endsection