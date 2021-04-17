<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class Post extends Model {

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'body',
    ];

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
     * @param string $body
     */
    public static function insertPost($body) {
      $post = new Post;
      $post->fill(['user_id' => Auth::id(), 'body' => $body])->save();
    }
}
