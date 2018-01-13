@php
    $title = __('Create Post');
@endphp
@extends('layouts.my')
@section('content')
<div class="table-responsive">
  <div class="container">
	  <div class="row" style="margin-right: -195px;margin-left: 195px;">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-body" style="padding: 15px;">
            <form action="{{ url('posts') }}" method="post">
              {{ csrf_field() }}
              {{ method_field('POST') }}
                <div style="margin-bottom:0.3rem;">
                   <textarea id="body" class="form-control" name="body" rows="3" placeholder="いまどうしてる？" required></textarea>
                </div>
                <button type="submit" name="submit" class="btn btn-info btn-sm" style="margin-bottom:5px;">{{ __('ツイート') }}</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
