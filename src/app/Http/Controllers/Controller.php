<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // ログイン画面表示
    public function authCheck()
    {
        if (Auth::check()) {
            // ツイート一覧ページ遷移
            $posts = Post::searchPost(Auth::id());
            return view('posts.index', [
                'posts' => $posts,
                'postdata'=>Session::get('_old_input')
            ]);
        }
        return view('auth/login');
    }
}
