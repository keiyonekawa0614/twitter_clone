<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * ツイート一覧画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::check()) {
        // ログインしている場合、ツイート一覧画面を表示する
        $id = Auth::id();
        // 自身のツイートとフォローしているユーザーのツイートを取得する
        $posts = DB::select('select distinct posts.id, posts.user_id, posts.user_name, posts.body, posts.created_at from posts left outer join follows on posts.user_id = follows.follow_id where follows.user_id = ? or posts.user_id = ? order by posts.created_at desc', [$id, $id]);
        return view('posts.index', ['posts' => $posts]);
      } else {
        // ログインしていない場合、ログインページにリダイレクトする
        return redirect('/login');
      }
    }

    /**
     * ツイート投稿画面を表示する
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('posts.create');
    }

    /**
     * ツイートをDBに登録する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $post = new Post;
      $post->body = $request->body;
      $id = Auth::id();
      $post->user_id = $id;
      $name = Auth::user()->name;
      $post->user_name = $name;
      $post->save();
      return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return redirect('posts/'.$post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      $post->delete();
      return redirect('posts');
    }
}
