<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      {{-- CSRF トークン --}}
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>@if (! Request::is('/')){{ $title }} | @endif{{ env('APP_NAME') }}</title>

      {{-- Bootstrap用CSS --}}
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
      <script type="text/javascript" src="{{ asset('js/modal.js') }}"></script>
  </head>
  <body>
    <div class='fixed-top'>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ url('/posts') }}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            @guest
              <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
            @else
              <li class="nav-item">
                <a href="#" id="new-post" class="nav-link" data-toggle="modal" data-target="#basicModal">{{ __('Tweet') }}</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Setting
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ url('users/'.auth()->user()->id) }}">{{ __('Profile') }}</a>
                  <a class="dropdown-item" href="{{ url('users') }}">{{ __('Users') }}</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            @endguest
          </ul>
          @auth
            <form class="form-inline my-2 my-lg-0">
              <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          @endauth
        </div>
      </nav>
    </div>
    {{-- start ツイート投稿ページ(ポップアップ画面)--}}
    <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <div class="table-responsive">
              <div class="container">
                <div class="row" >
                  <div style="margin: 0 auto;">
                    <div class=" panel-default">
                      <div class="panel-body">
                        <form action="{{ url('posts') }}" method="post">
                          {{ csrf_field() }}
                          {{ method_field('POST') }}
                            <div style="margin-bottom:0.3rem;">
                                <textarea id="body" class="form-control" name="body" rows="3" cols="40" placeholder="いまどうしてる？" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-info btn-sm" style="margin-bottom:5px;">{{ __('ツイート') }}</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- end ツイート投稿ページ(ポップアップ画面)--}}
    {{-- 個別ページの内容 --}}
    <div class="container mt-3">
        @yield('content')
    </div>
    <script src=" {{ mix('js/app.js') }} "></script>
    {{-- Bootstrap用JavaScript --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>
