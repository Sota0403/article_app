<?php

namespace App\Http\Controllers;

use Auth;
use App\Article;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $article;
    public $user;
    public $follow;

    public function __construct(Article $article, User $user, Follow $follow)
    {
        $this->article = $article;
        $this->user = $user;
        $this->follow = $follow;
    }

    public function showMypage()
    {
      $articles = $this->article->where('user_id', Auth::id())
                                ->get();

      $currentUser = $this->user->where('id', Auth::id())
                          ->first();

      return view('user.mypage', compact('articles', 'currentUser'));
    }

    public function updateMypage(Request $request)
    {
        $request->picture->storeAs('public/users', Auth::id() . '.jpg');

        $user = $this->user->find(Auth::id())->fill($request->all());
        $user->picture = Auth::id() . '.jpg';
        $user->save();

        return redirect()->route('user.mypage');
    }

    public function showUser($user_id)
    {
        if(intval($user_id)  === Auth::id()) {
          return redirect()->route('user.mypage');
        }

        $user = $this->user->find($user_id);
        $followStatus = $this->follow->where('user_id', Auth::id())
                                     ->where('follow_id', $user_id)
                                     ->exists();

        $follows = $this->follow->where('user_id', $user_id)->get();

        $followers = DB::table('follows')->join('users', 'follows.follow_id', '=', 'users.id')
                                         ->select(['users.id', 'users.name'])
                                         ->where('users.id', $user->id)
                                         ->get();

        return view('user.showUser', compact('user', 'followStatus', 'follows', 'followers'));
    }
}
