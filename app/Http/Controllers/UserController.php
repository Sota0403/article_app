<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;

    public function __construct(User $user)
    {
        $this->usre = $user;
    }

    public function showProfile()
    {
        $currentUser = DB::table('users')
                         ->where('id', Auth::id())
                         ->first();

        return view('user.profile', compact('currentUser'));
    }
}
