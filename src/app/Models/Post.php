<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class Post extends Model {

    /**
     * ユーザー投稿情報を取得
     */
    public static function searchPost($id) {
      return DB::table('posts')
            ->distinct()
            ->select('posts.id', 'posts.user_id', 'users.name', 'posts.body', 'posts.created_at')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->leftJoin('follows', 'follows.follow_id', '=', 'posts.user_id')
            ->where('follows.user_id', $id)
            ->orWhere('posts.user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * ツイート登録
     */
    public static function insertPost($request) {
      $post = new Post;
      $post->body = $request->body;
      $post->user_id = Auth::id();
      $post->save();
    }
}
