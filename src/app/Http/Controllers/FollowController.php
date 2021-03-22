<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  /**
   * フォロー解除
   */
  public function cancel($id) {
    Follow::deleteFollowUser(Auth::id(), $id);
    return redirect('/posts');
  }

  /**
   * フォローする
   */
  public function add($id) {
    Follow::insertFollowUser(Auth::id(), $id);
    return redirect('/posts');
  }
}
