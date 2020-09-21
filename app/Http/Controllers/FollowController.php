<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Follow;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    private $follow;

    public function __construct(Follow $follow)
    {
      $this->follow = $follow;
    }

    public function followUser($user_id)
    {
      $this->follow->create(['follow_id' => $user_id, 'user_id' => Auth::id()]);
      return redirect()->route('user', $user_id);
    }
}
