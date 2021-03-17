<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Session;

class PostController extends Controller {

    public function __construct() {
      $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * ツイート一覧画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post) {
      if (Auth::check()) {
        // ツイート一覧ページ遷移
        return view('posts.index', ['posts' => $post->searchPost(Auth::id()), 'postdata'=>Session::get('_old_input')]);
      } else {
        // ログインページにリダイレクト
        return redirect('/login');
      }
    }

    /**
     * ツイートをDBに登録する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post){
      // ツイート登録
      $post->insertPost($request);
      return redirect('/posts')->withInput();
    }
}
