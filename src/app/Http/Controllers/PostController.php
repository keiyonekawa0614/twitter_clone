<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Session;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * ツイート一覧画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (Auth::check()) {
            // ツイート一覧ページ遷移
            $posts = Post::searchPost(Auth::id());
            return view('posts.index', [
                'posts' => $posts,
                'postdata'=>Session::get('_old_input')
            ]);
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
    public function store(Request $request){
        // ツイート登録
        Post::insertPost($request->body);
        return redirect('/posts')->withInput();
    }
}
