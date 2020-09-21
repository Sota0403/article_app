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
      <div class="row mt-5">
        <div class="col-md-6">
          <p class="text-center">フォローリスト</p>
          <ul>
            @if(isset($follows))
            @foreach ($follows as $follow)
            <li class="d-flex align-items-center">
              <div>
                <img src="" alt="">
              </div>
              <p>{{ $follow->name }}</p>
            </li>
            @endforeach
            <a href="" class="btn btn-primary">もっと見る</a>
            @endif
          </ul>
        </div>
        <div class="col-md-6">
          <p class="text-center">フォロワーリスト</p>
          <ul>
            @if(isset($followers))
            @foreach ($followers as $follower)
            <li class="d-flex align-items-center">
              <div>
                <img src="" alt="">
              </div>
              <p>{{ $follower->name }}</p>
            </li>
            @endforeach
            <a href="" class="btn btn-primary">もっと見る</a>
            @endif
          </ul>
        </div>
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