<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Post;
use App\Follow;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();
      $id = Auth::id();
      $follow_id = Follow::where('user_id','=',$id)->get(['follow_id']);
      $array_follow_id = array_column($follow_id->toArray(), 'follow_id');
      return view('users.index', ['users' => $users, 'array_follow_id' =>$array_follow_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = new User;
      $user->name = $request->name;
      $user->email = $request->email;
      $user->password = $request->password;
      $user->save();
      return redirect('users/'.$user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $id = Auth::id();
        $follow_id = Follow::where('user_id','=',$id)->get(['follow_id']);
        $array_follow_id = array_column($follow_id->toArray(), 'follow_id');
        $posts = DB::select('select * from posts where user_id = ? order by created_at desc', [$user->id]);
        return view('users.show', ['user' => $user,'posts' => $posts, 'array_follow_id' => $array_follow_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

      return view('users.edit', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
      $user->name = $request->name;
      $user->save();

      $userName = $request->name;
      $userId = $user->id;
      DB::update('update posts set user_name = ? where user_id = ?', [$userName, $userId]);
      return redirect('users/'.$user->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $user->delete();
      return redirect('users');
    }
}
