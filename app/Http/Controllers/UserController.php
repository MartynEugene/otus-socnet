<?php

namespace App\Http\Controllers;

use App\Components\Auth\LoginComponent;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function info(Request $request)
    {
        $login = new LoginComponent();
        $email = $login->getEmail($request);
        return view('users.info', ['email' => $email ?? null]);
    }

    public function editInfo(Request $request)
    {
        return "fuck you!";
    }
}
