@php
    $title = __('Users');
@endphp
@extends('layouts.my')
@section('content')
<h1>{{ $title }}</h1>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Name') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td><a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a></td>
                    <td>
                      @if(Auth::user()->name != $user->name)
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
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
</div>
@endsection
