@php
    $title = __('Create Post');
@endphp
@extends('layouts.my')
@section('content')
<h1>{{ $title }}</h1>
<form action="{{ url('posts') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label for="body">{{ __('tweet') }}</label>
        <textarea id="body" class="form-control" name="body" rows="8" required></textarea>
    </div>
    <button type="submit" name="submit" class="btn btn-success">{{ __('Submit') }}</button>
</form>
@endsection
