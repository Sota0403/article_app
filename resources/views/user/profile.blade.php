@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9 p-4 bg-white">
      <h1>マイページです</h1>
      {{-- <div class="profile-row">
        <p class="font-weight-bold">アバター</p>
        <p>{{ $currentUser->avator }}</p>
      </div> --}}
      <div class="profile-row">
        <p class="font-weight-bold">名前</p>
        <p>{{ $currentUser->name }}</p>
      </div>
      <div class="profile-row">
        <p class="font-weight-bold">メールアドレス</p>
        <p>{{ $currentUser->email }}</p>
      </div>
    </div>
    <div class="col-md-3 p-4 bg-white">
      <p class="btn btn-primary mx-auto" data-toggle="modal" data-target="#exampleModal">プロフ変更</p>
    </div>
  </div>
</div>


@endsection