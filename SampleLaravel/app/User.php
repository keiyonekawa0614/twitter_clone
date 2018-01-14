<?php

namespace App;

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

    // ユーザー情報全件取得
    public function selectAllUser() {
        return User::all();
    }

    // フォローidを配列で取得
    public function searchArrayFollowId() {
      $id = Auth::id();
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




}
