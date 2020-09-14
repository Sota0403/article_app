<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class TopController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function editFirstLoginPassword()
    {
        $user_id = Auth::id();
        $isFirstLogin = $this->user->find($user_id);

        if(!$isFirstLogin->not_first_login) {
            return view('auth.first_login');
        } else {
            return redirect()->route('article.index');
        }
    }

    public function updateFirstLoginPassword(Request $request)
    {
        $user_id = Auth::id();
        $this->user->find($user_id)
             ->update([
              'not_first_login' => 1,
              'password' => Hash::make($request->password),
             ]);
        return redirect()->route('article.index');
    }
}
