@php
    $title = __('Posts');

    if (!empty($postdata)) {
      $key = true;
    } else {
      $key = false;
    };

@endphp
@extends('layouts.my')
@section('content')
<div class="table-responsive">
  <div class="container" style="overflow: hidden;">
	<div class="row" style="margin-right: -195px;margin-left: 195px;">
  <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
      <div class="panel-body" style="padding: 15px;">
        @if($key)
        <div class="alert alert-success alert-dismissible" role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <strong>Success!</strong>
       </div>
       @endif

        <form action="{{ url('posts') }}" method="post">
            {{ csrf_field() }}
            {{ method_field('POST') }}
            <div style="margin-bottom:0.3rem;">
                <textarea id="body" class="form-control" name="body" rows="3" placeholder="いまどうしてる？" required></textarea>
            </div>
             <button type="submit" name="submit" class="btn btn-info btn-sm" style="margin-bottom:5px;">{{ __('ツイート') }}</button>
      </form>
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
                          <a style="text-decoration: none;color: black;" href="#" data-toggle="modal" data-target="#detailModal" data-whatever="{{ $post->name }},{{ $post->created_at }},{{ $post->body }}">
                            <!-- ツイート詳細ページ(ポップ画面表示)-->
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
                            <!-- ツイート詳細ページ(ポップ画面表示)-->
													<span style="float: right!important;" class="media-meta">{{ $post->created_at }}</span>
													<h4 class="title">
														{{ $post->name }}
														<span style="float: right!important;" class="pagado">{{ $post->name }}</span>
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
