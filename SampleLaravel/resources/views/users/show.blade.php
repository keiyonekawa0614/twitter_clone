@php
    $title = __('User') . ': ' . $user->name;
    $userName = Auth::user()->name;
    $name = $user->name;

@endphp
@extends('layouts.my')
@section('content')
<h1>{{ $title }}</h1>

<!-- 編集・削除ボタン -->
<div>
    @if($userName == $name)
    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary">
        {{ __('Edit') }}
    </a>
    <!--  <a href="#" class="btn btn-danger">
        {{ __('Delete') }}
    </a> -->
    @else
    @php
    $key = in_array($user->id, $array_follow_id);
    @endphp
  　  @if($key)
        <a href="{{ url('follows/'.$user->id) }}" class="btn btn-danger">
          {{ __('フォロー解除') }}
        </a>
  　  @else
        <a href="{{ url('follows/'.$user->id.'/edit') }}" class="btn btn-primary">
          {{ __('フォローする') }}
        </a>
    　@endif
    @endif
</div>

<!-- ユーザー1件の情報 -->
<dl class="row">
    <dt class="col-md-2">{{ __('ID') }}</dt>
    <dd class="col-md-10">{{ $user->id }}</dd>
    <dt class="col-md-2">{{ __('Name') }}</dt>
    <dd class="col-md-10">{{ $user->name }}</dd>
    <dt class="col-md-2">{{ __('Email') }}</dt>
    <dd class="col-md-10">{{ $user->email }}</dd>
</dl>

<hr>

<h1>Posts</h1>
<div class="table-responsive">
        @foreach ($posts as $post)
        <div class="card">
              <div class="card-header">
                {{ $post->user_name }}
              </div>
              <div class="card-body" style="padding-bottom: 0px;">
                <a href="{{ url('posts/'.$post->id) }}">
                <p>{{ $post->body }}</p>
                </a>
                  <small class="text-muted">{{ $post->created_at }}</small>
                <hr>
          </div>
        </div>
        @endforeach
</div>

@endsection
