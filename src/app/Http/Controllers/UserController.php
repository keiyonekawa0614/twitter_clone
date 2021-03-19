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
      $this->middleware('auth')->except(['store']);
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
     * ユーザー新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user) {
      $user->insertUser($request);
      return redirect('users/'.$user->id);
    }

    /**
     * ユーザー詳細ページ表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show() {
      $user = User::findOne();
      return view('users.show', ['user' => $user]);
    }

    /**
     * ユーザー更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
      $user->updateUser($request, $user);
      return redirect('users/'.$user->id);
    }
}
