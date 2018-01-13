<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
  public function index()
  {
      //
  }

  public function create()
  {
      //
  }
  public function store()
  {
      //
  }
  public function show($id)
  {
    DB::table('follows')->where([
    ['user_id', '=', Auth::id()],
    ['follow_id', '=', $id],
    ])->delete();
      return redirect('/posts');
  }

  public function edit($id)
  {
      $follow = new Follow;
      $userId = Auth::id();
      $follow->user_id = $userId;
      $follow->follow_id = $id;
      $follow->save();
      return redirect('/posts');
  }

  public function update($id)
  {
      //
  }

  public function destroy($id)
  {

  }
}
