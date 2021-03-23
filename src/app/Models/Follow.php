<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facade;

class Follow extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'user_id', 'follow_id',
    ];

    /**
     * フォロー削除
     * @param $userId
     * @param $followId
     */
    public static function deleteFollowUser($userId, $followId) {
      Follow::where([
        ['user_id', '=', $userId],
        ['follow_id', '=', $followId],
      ])->delete();
    }

    /**
     * フォロー追加
     * @param $userId
     * @param $followId
     */
    public static function insertFollowUser($userId, $id) {
      $follow = new Follow;
      $follow->fill(['user_id' => $userId, 'follow_id' => $id])->save();
    }
}
