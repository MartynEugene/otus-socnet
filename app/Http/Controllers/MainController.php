<?php

namespace App\Http\Controllers;

use App\Components\Userbase\UserComponent;
use App\Components\Auth\LoginComponent;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        $id = $login->getId($request);
        $user = new UserComponent();
        $list = $user->listOtherUsers($email);
        return view('users.listing', ['users' => $list]);
    }

    public function addFriend(Request $request)
    {
        $this->actionFriend($request, function($friend, $friend_to)
        {
            $user = new UserComponent();
            $status = $user->friendshipStatus($friend, $friend_to);
            if (strcmp($status, 'none') !== 0) {
                return false;
            }

            return $user->addFriend($friend_to, $friend);
        });
    }

    public function acceptFriend(Request $request)
    {
        $this->actionFriend($request, function($friend, $friend_to)
        {
            $user = new UserComponent();
            $status = $user->friendshipStatus($friend, $friend_to);
            if (strcmp($status, 'incoming') !== 0) {
                return false;
            }

            return $user->addFriend($friend_to, $friend);
        });
    }

    public function deleteFriend(Request $request)
    {
        $this->actionFriend($request, function($friend, $friend_to)
        {
            $user = new UserComponent();
            $status = $user->friendshipStatus($friend, $friend_to);
            if (strcmp($status, 'both') !== 0) {
                return false;
            }

            return $user->deleteFriend($friend, $friend_to);
        });
    }

    public function declineFriend(Request $request)
    {
        $this->actionFriend($request, function($friend, $friend_to) : bool
        {
            $user = new UserComponent();
            $status = $user->friendshipStatus($friend, $friend_to);
            if (strcmp($status, 'proposed') !== 0) {
                return false;
            }

            return $user->deleteFriend($friend_to, $friend);
        });
    }

    private function actionFriend(Request $request, callable $action)
    {
        $login = new LoginComponent();
        $friend = $login->getId($request);
        $validated = $this->validate($request, [
            'friend_to' => 'required|exists:users,id|not_in:'.$friend
        ]);

        $friend_to = $validated['friend_to'];
        if ($action($friend, $friend_to) === false) {
            throw new BadRequestException();
        }
    }
}
