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
    <a href="{{ url('follows/'.$user->id.'/edit') }}" class="btn btn-primary">
        {{ __('フォローする') }}
    </a>
    <a href="{{ url('follows/'.$user->id) }}" class="btn btn-danger">
        {{ __('フォロー解除') }}
    </a>
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('Author') }}</th>
                <th>{{ __('Body') }}</th>
                <th>{{ __('Created') }}</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>{{ $post->user_name }}</td>
                <td><a href="{{ url('posts/'.$post->id) }}">{{ $post->body }}</a></td>
                <td>{{ $post->created_at }}</td>
             </tr>
        @endforeach
        </tbody>
    </table>
</div>

@endsection
