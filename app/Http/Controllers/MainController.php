<?php

namespace App\Http\Controllers;

use App\Components\Userbase\UserComponent;
use App\Components\Auth\LoginComponent;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        $user = new UserComponent();
        $list = $user->listOtherUsers($email);
        return view('users.listing', ['users' => $list]);
    }

    public function addFriend(Request $request)
    {
        $login = new LoginComponent();
        $friend = $login->getId($request);

        $validated = $this->validate($request, [
            'friend_to' => 'required|exists:users,id|not_in:'.$friend
        ]);

        $friend_to = $validated['friend_to'];
        $user = new UserComponent();
        $user->addFriend($friend, $friend_to);
    }
}
