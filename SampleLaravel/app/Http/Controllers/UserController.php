<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;

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
      $user = new User;
      return view('users.index', ['users' => $user->selectAllUser(), 'array_follow_id' =>$user->searchArrayFollowId()]);
    }

    /**
     * ユーザー新規作成
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $user = new User;
      $user->insertUser($request);
      return redirect('users/'.$user->id);
    }

    /**
     * ユーザー詳細ページ表示
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
      $user1 = new User;
      $post = new Post;
      return view('users.show', ['user' => $user,'posts' => $post->searchUserPost($user->id), 'array_follow_id' => $user1->searchArrayFollowId()]);
    }

    /**
     * ユーザー更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) {
      $user1 = new User;
      $user1->updateUser($request, $user);
      return redirect('users/'.$user->id);
    }
}
