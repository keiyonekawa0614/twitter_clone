<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  // フォロー解除
  public function show($id) {
    $follow = new Follow;
    $follow->deleteFollowUser(Auth::id(), $id);
    return redirect('/posts');
  }

  // フォロー追加
  public function edit($id) {
    $follow = new Follow;
    $follow->insertFollowUser(Auth::id(), $id);
    return redirect('/posts');
  }
}
