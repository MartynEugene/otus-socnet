<?php

namespace App\Components\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class used for authorization, deals with the database directly
 */
class LoginAction
{
    public function error(): string
    {
        return $this->error;
    }

    public function run($request): bool
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $result = DB::select(DB::raw("SELECT `password` FROM users WHERE `email` = :email"), ['email' => $email]);
        $hashshedPassword = $result[0]->password ?? null;
        if (Hash::check($password, $hashshedPassword)) {
            $this->login($email, $request);
            return true;
        }
        return false;
    }

    public function isLoggedIn($request): bool
    {
        return !!$request->session()->get('loggedin');
    }

    public function login(string $email, $request)
    {
        $request->session()->put('loggedin', true);
        $request->session()->put('username', $email);
    }

    public function logout($request)
    {
        $request->session()->put('loggedin', false);
        $request->session()->forget('username');
    }
}