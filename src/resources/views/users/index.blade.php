@php
use App\Models\Follow;
$title = __('Users');
@endphp
@extends('layouts.my')
@section('content')
<div class="table-responsive">
  <div class="container">
	  <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="panel panel-default">
          <div class="panel-body" style="padding: 15px;">
            <div class="table-container">
              <table class="table table-filter">
                <tbody>
                @foreach ($users as $user)
                  <tr data-status="pagado">
                    <td>
                      <div style="display: flex; justify-content: space-between;">
                        <div class="media">
                          <a href="#">
                            <img src="{{ asset('image/default_icon.png') }}" class="media-photo">
                          </a>
                          <div style="margin-left: 10px">
                            <h4 class="title">
                              <a href="{{ url('users/'.$user->id) }}">{{ $user->name }}</a>
                            </h4>
                            {{-- start フォロー・フォロワーのカウント表示 --}}
                            <h4 class="title">
                              {{$user->follow_count}}<span class="pagado">フォロー</span>
                              {{$user->follower_count}}<span class="pagado">フォロワー</span>
                            </h4>
                            {{-- end フォロー・フォロワーのカウント表示 --}}
                          </div>
                        </div>
                        {{-- start フォローする・フォロー解除ボタン切り替え --}}
                        @if(Auth::user()->name != $user->name)
                          @if(in_array($user->id, $array_follow_id))
                            <span>
                              <a href="{{ url('follows/cancel/'.$user->id) }}" class="btn btn-danger btn-sm">
                                  {{ __('フォロー解除') }}
                              </a>
                            </span>
                          @else
                            <span>
                              <a href="{{ url('follows/add/'.$user->id) }}" class="btn btn-primary btn-sm">
                                  {{ __('フォローする') }}
                              </a>
                            </span>
                          @endif
                        @endif
                      </div>
                      {{-- end フォローする・フォロー解除ボタン切り替え --}}
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
