@php
    $title = __('Create User');
@endphp
@extends('layouts.app')
@section('content')
<h1>{{ $title }}</h1>
<form action="{{ url('users') }}" method="post">
    {{ csrf_field() }}
    {{ method_field('POST') }}
    <div class="form-group">
        <label for="name">{{ __('Name') }}</label>
        <input id="name" type="text" class="form-control" name="name" required autofocus>
    </div>
    <div class="form-group">
        <label for="email">{{ __('Email') }}</label>
        <input id="email" type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>
        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">{{ __('Submit') }}</button>
</form>
@endsection
