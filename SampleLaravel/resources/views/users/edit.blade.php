@php
    $title = __('Edit').': '.$user->name;
@endphp
@extends('layouts.my')
@section('content')
<h1>{{ $title }}</h1>
<form action="{{ url('users/'.$user->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>
    </div>
    <button type="submit" name="submit" class="btn btn-success">{{ __('Submit') }}</button>
</form>
@endsection
