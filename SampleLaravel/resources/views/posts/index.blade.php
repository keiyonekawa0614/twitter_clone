@php
    $title = __('Posts');
@endphp
@extends('layouts.my')
@section('content')
<h1>{{ $title }}</h1>
<div class="table-responsive">
        @foreach ($posts as $post)
        <div class="card">
              <div class="card-header">
                {{ $post->user_name }}
              </div>
              <div class="card-body" style="padding-bottom: 0px;">
                <a href="{{ url('posts/'.$post->id) }}">
                <p>{!! nl2br(e( $post->body )) !!}</p>
                </a>
                  <small class="text-muted">{{ $post->created_at }}</small>
                <hr>
          </div>
        @endforeach
</div>
@endsection
