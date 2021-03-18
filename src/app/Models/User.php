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

    public function posts() {
      return $this->hasMany('App\Posts');
    }

    /**
     * ユーザー情報とフォロー数、フォロワー数を取得
     */
    public static function selectAllUser() {
        return User::withCount(['follow', 'follower'])->get();
    }

    // フォローidを配列で取得
    public static function searchArrayFollowId() {
      $follow_id = Follow::where('user_id','=', Auth::id())->get(['follow_id']);
      return array_column($follow_id->toArray(), 'follow_id');
    }

    // ユーザー新規登録
    public function insertUser($request) {
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->save();
    }

    // ユーザー更新
    public function updateUser($request, $user) {
      $user->name = $request->name;
      $user->save();
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


}
