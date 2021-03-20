<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 全ユーザー情報とフォロー数、フォロワー数を取得
     */
    public static function findAll() {
        return User::withCount(['follow', 'follower'])->get();
    }

    /**
     * ログインユーザーに関する情報を取得
     */
    public static function findOne($id) {
      return User::withCount(['follow', 'follower'])
            ->with(['posts' => function ($query) {
                $query->orderBy('created_at', 'desc');
              }])
            ->where('id', $id)
            ->first();
    }

    // フォローidを配列で取得
    public static function searchArrayFollowId() {
      $follow_id = Follow::where('user_id','=', Auth::id())->get(['follow_id']);
      return array_column($follow_id->toArray(), 'follow_id');
    }

    /**
     * 新規登録 or 更新
     * @param  \Illuminate\Http\Request  $request
     */
    public static function upsert($request, $user) {
      return $user->fill($request->all())->save();
    }

    /**
     * follow relation
     */
    public function follow() {
      return $this->hasMany('App\Models\Follow', 'user_id');
    }

    /**
     * follower relation
     */
    public function follower() {
      return $this->hasMany('App\Models\Follow', 'follow_id');
    }

    public function posts() {
      return $this->hasMany('App\Models\Post', 'user_id');
    }

}
