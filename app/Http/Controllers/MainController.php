<?php

namespace App\Http\Controllers;

use App\Components\Userbase\UserComponent;
use App\Components\Auth\LoginComponent;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function all(Request $request)
    {
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        $user = new UserComponent();
        $list = $user->listOtherUsers($email);
        return view('users.listing', ['users' => $list]);
    }

    public function friends(Request $request)
    {
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        $user = new UserComponent();
        $list = $user->listOtherUsers($email, onlyFriends: true);
        return view('users.listing', ['users' => $list]);
    }
}
