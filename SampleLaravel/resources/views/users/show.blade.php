@php
    $title = __('User') . ': ' . $user->name;
    $userName = Auth::user()->name;
    $name = $user->name;
@endphp
@extends('layouts.my')
@section('content')

<div class="table-responsive">
  <div class="container">
	<div class="row" style="margin-right: -195px;margin-left: 195px;">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body" style="padding: 15px;">
        <div class="table-container">
				<table class="table table-filter">
					<tbody>
            <tr data-status="pagado">
              <span>Account</span>
              <td>
                <a style="text-decoration: none;color: black;" >
                <div class="media">
                  <a href="#" style="padding-right: 10px;float: left!important;">
                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                  </a>
                  <div class="media-body">
                    <h4 class="title">
                       Name : {{ $user->name }}
                    </h4>
                    <h4 class="title">
                       Email : {{ $user->email }}
                    </h4>
                    <!-- start 編集・フォローする・フォロー解除ボタン -->
                    @if($userName == $name)
                    <span style="float: right!important;">
                    <a href="{{ url('users/'.$user->id.'/edit') }}" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal" data-username="{{ $user->name }}">
                        {{ __('編集') }}
                    </a>
                    <!-- アカウント情報編集ページ(ポップ画面表示)-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-body">
                            <div class="table-container">
                             <table class="table table-filter">
                               <tbody>
                               <tr data-status="pagado">
                                 <td>
                                   <form action="{{ url('users/'.$user->id) }}" method="post">
                                       {{ csrf_field() }}
                                       {{ method_field('PUT') }}
                                       <div class="form-group">
                                           <label for="name">{{ __('Name') }}</label>
                                           <input id="name" type="text" class="form-control" name="name" value="" required autofocus>
                                       </div>
                                       <button type="submit" name="submit" class="btn btn-success btn-sm">{{ __('更新') }}</button>
                                   </form>
                                 </td>
                               </tr>
                               </tbody>
                            </table>
                           </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--アカウント情報編集ページ(ポップ画面表示)-->

                    </span>
                    @else
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
                    <!-- end 編集・フォローする・フォロー解除ボタン -->
                  </div>
                </div>
                </a>
              </td>
            </tr>
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
                      <a style="text-decoration: none;color: black;" >
                      <div class="media">
                        <a href="#" style="padding-right: 10px;float: left!important;">
                          <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                        </a>
                        <div class="media-body">
                          <a style="text-decoration: none;color: black;" href="#" data-toggle="modal" data-target="#detailModal" data-whatever="{{ $post->user_name }},{{ $post->created_at }},{{ $post->body }}">
                            <!-- start ツイート詳細ページ(ポップ画面表示)-->
                            <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-body">
                                    <div class="table-container">
                                     <table class="table table-filter">
                                       <tbody>
                                         <tr data-status="pagado">
                                         <td>
                                           <a style="text-decoration: none;color: black;" >
                                            <div class="media">
                                               <a href="#" style="padding-right: 10px;float: left!important;">
                                               <img src="https://s3.amazonaws.com/uifaces/faces/twitter/fffabs/128.jpg" class="media-photo">
                                               </a>
                                            <div class="media-body">
                                                <span style="float: right!important;" class="media-meta">登録日時</span>
                                                <h4 class="title">
                                                ユーザー名
                                                <span style="float: right!important;" class="pagado">ユーザー名</span>
                                                </h4>
                                            <pre><p class="summary">内容</p></pre>
                                            </div>
                                            </div>
                                           </a>
                                         </td>
                                         </tr>
                                       </tbody>
                                    </table>
                                   </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- end ツイート詳細ページ(ポップ画面表示)-->
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
