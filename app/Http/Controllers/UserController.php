<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;
    public $follow;

    public function __construct(User $user, Follow $follow)
    {
        $this->user = $user;
        $this->follow = $follow;
    }

    public function showProfile()
    {
        $currentUser = DB::table('users')
                         ->where('id', Auth::id())
                         ->first();

        return view('user.profile', compact('currentUser'));
    }

    public function showUser($user_id)
    {
        $user = $this->user->find($user_id);
        $followStatus = $this->follow->where('user_id', Auth::id())
                                     ->where('follow_id', $user_id)
                                     ->exists();

        return view('user.showUser', compact('user', 'followStatus'));
    }
}
