<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facade;

class Follow extends Model
{
    // フォロー削除
    public static function deleteFollowUser($userId, $followId) {
      DB::table('follows')->where([
        ['user_id', '=', $userId],
        ['follow_id', '=', $followId],
      ])->delete();
    }

    // フォロー追加
    public static function insertFollowUser($authId, $id) {
      $follow = new Follow;
      $follow->user_id = $authId;
      $follow->follow_id = $id;
      $follow->save();
    }
}
