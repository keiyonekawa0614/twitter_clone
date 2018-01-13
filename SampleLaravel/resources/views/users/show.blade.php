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
<div class="table-responsive">
  <div class="container">
  <div class="row" style="margin-right: -195px;margin-left: 195px;">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body" style="padding: 15px;">
          <div class="table-container">

              <table class="table table-filter">
                <tbody>
                  @foreach ($posts as $post)
                  <tr data-status="pagado">
                    <td>
                      <a style="text-decoration: none;color: black;" href="{{ url('posts/'.$post->id) }}">
                      <div class="media">
                        <a href="#" style="padding-right: 10px;float: left!important;">
                          <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                        </a>
                        <div class="media-body">
                          <a style="text-decoration: none;color: black;" href="{{ url('posts/'.$post->id) }}">
                          <span style="float: right!important;" class="media-meta">{{ $post->created_at }}</span>
                          <h4 class="title">
                            {{ $post->user_name }}
                            <span style="float: right!important;" class="pagado">{{ $post->user_name }}</span>
                          </h4>
                          <p class="summary">{!! nl2br(e( $post->body )) !!}</p>
                        </div>
                      </div>
                      </a>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
  </div>
</div>

@endsection
