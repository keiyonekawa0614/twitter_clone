<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class Post extends Model
{
    // ユーザー投稿情報を取得
    public function searchPost($id) {
      // 自身のツイートとフォローしているユーザーのツイートを取得する
      return DB::select('select distinct posts.id,posts.user_id,users.name,posts.body,posts.created_at from posts left outer join follows on posts.user_id = follows.follow_id inner join users on users.id = posts.user_id where follows.user_id = ? or posts.user_id = ? order by posts.created_at desc', [$id, $id]);
    }

    // 自身のユーザー投稿情報取得
    public function searchUserPost($id) {
      return DB::select('select posts.user_id, users.name, posts.body, posts.created_at from posts inner join users on users.id = posts.user_id where posts.user_id = ? order by posts.created_at desc;', [$id]);
    }

    // ツイート登録
    public function insertPost($request) {
      $post = new Post;
      $post->body = $request->body;
      $post->user_id = Auth::id();
      $post->save();
    }
}
