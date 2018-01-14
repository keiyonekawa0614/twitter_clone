@php
    use App\Follow;
    $title = __('Users');
@endphp
@extends('layouts.my')
@section('content')
<div class="table-responsive">
  <div class="container" style="overflow: hidden;">
	<div class="row" style="margin-right: -195px;margin-left: 195px;">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body" style="padding: 15px;">
        <div class="table-container">
				<table class="table table-filter">
					<tbody>
            @foreach ($users as $user)
            <tr data-status="pagado">
              <td>
                <a style="text-decoration: none;color: black;" >
                <div class="media">
                  <a href="#" style="padding-right: 10px;float: left!important;">
                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                  </a>
                  <div class="media-body">
                    <h4 class="title">
                      <a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a>
                    </h4>
                    @php
                    $follow_count = Follow::where('user_id','=',$user->id)->count();
                    $follower_count = Follow::where('follow_id','=',$user->id)->count();
                    @endphp
                    <h4 class="title">
                    {{$follow_count}}<span class="pagado">フォロー</span>
                    {{$follower_count}}<span class="pagado">フォロワー</span>
                    </h4>
                    @if(Auth::user()->name != $user->name)
                    @php
                    $key = in_array($user->id, $array_follow_id);
                    @endphp
                      @if($key)
                      <span style="float: right!important;">
                      <a href="{{ url('follows/'.$user->id) }}" class="btn btn-danger btn-sm">
                          {{ __('フォロー解除') }}
                      </a>
                      </span>
                      @else
                      <span style="float: right!important;">
                      <a href="{{ url('follows/'.$user->id.'/edit') }}" class="btn btn-primary btn-sm">
                          {{ __('フォローする') }}
                      </a>
                      </span>
                      @endif
                    @endif
                  </div>
                </div>
                </a>
              </td>
            </tr>
            @endforeach
        </tbody>
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
