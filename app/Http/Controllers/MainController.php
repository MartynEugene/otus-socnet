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


        return print_r($list, true);
    }
}
