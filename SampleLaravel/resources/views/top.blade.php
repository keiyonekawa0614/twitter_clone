@php
    $title = config('app.name');
@endphp

@extends('layouts.my')

@section('title', $title)

@section('content')
<h1>{{ $title }}</h1>
<p>
    {{ __('My practice for basic CRUD of Laravel 5.5 on Heroku.') }}
</p>
@endsection
