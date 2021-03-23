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
      return DB::select('select distinct posts.id,posts.user_id,users.name,posts.body,posts.created_at from posts left outer join follows on posts.user_id = follows.follow_id inner join users on users.id = posts.user_id where follows.user_id = ? or posts.user_id = ? order by posts.created_at desc', [$id, $id]);

      // TODO: 一旦query builderで戻し 要リファクタ
      // return Post::with('user')
      //       ->with(['follow' => function ($query) use ($id) {
      //         $query->where('user_id', $id);
      //       }])
      //       ->orderBy('created_at', 'desc')
      //       ->get();
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

    public function user() {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function follow() {
      return $this->hasMany('App\Models\Follow', 'follow_id');
    }
}
