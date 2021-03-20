<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function __construct() {
      $this->middleware('auth')->except(['index', 'show', 'store']);
    }

    /**
     * ユーザー一覧ページ表示
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $user = User::findAll();
      $array_follow_id = User::searchArrayFollowId();
      return view('users.index', [
        'users' => $user,
        'array_follow_id' => $array_follow_id
      ]);
    }

    /**
     * ユーザー詳細ページ表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      if ($id != Auth::id()) {
        return redirect('/posts');
      }
      $user = User::findOne($id);
      return view('users.show', ['user' => $user]);
    }

    /**
     * ユーザー新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $user = new User;
      $user->User::upsert($request, $user);
      return redirect('users/' . $user->id);
    }

    /**
     * ユーザー更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
      $user = Auth::user();
      User::upsert($request, $user);
      return redirect('users/' . $user->id);
    }
}
