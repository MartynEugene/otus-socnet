<?php

namespace App\Components\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


/**
 * Class used for authorization, deals with the database directly
 */
class LoginComponent
{
    public function error(): string
    {
        return $this->error;
    }

    public function authentificate(Request $request): bool
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $result = DB::select(DB::raw("SELECT `id`, `password` FROM users WHERE `email` = :email"), ['email' => $email]);
        $hashshedPassword = $result[0]->password ?? null;
        if (Hash::check($password, $hashshedPassword)) {
            $id = $result[0]->id ?? null;
            $this->login($id, $email, $request);
            return true;
        }
        return false;
    }

    public function isLoggedIn(Request $request): bool
    {
        return !!$request->session()->get('loggedin');
    }

    public function getEmail(Request $request): ?string
    {
        return $request->session()->get('username') ?? null;
    }

    public function getId(Request $request): ?int
    {
        return (int)$request->session()->get('userid') ?? null;
    }

    public function login(int $id, string $email, Request $request)
    {
        $request->session()->put('loggedin', true);
        $request->session()->put('username', $email);
        $request->session()->put('userid', $id);
    }

    public function logout(Request $request)
    {
        $request->session()->put('loggedin', false);
        $request->session()->forget('username');
        $request->session()->forget('userid');
    }
}