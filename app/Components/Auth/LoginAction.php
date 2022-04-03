<?php

namespace App\Components\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class used for authorization, deals with the database directly
 */
class LoginAction
{
    private array $params;

    private string $error;

    public function setParams(array $params): void
    {
        $this->params = $params;
    }

    public function error(): string
    {
        return $this->error;
    }

    public function run(): bool
    {
        $email = $this->params['email'];
        $password = $this->params['password'];

        $result = DB::select(DB::raw("SELECT `password` FROM users WHERE `email` = :email"), ['email' => $email]);
        $hashshedPassword = $result[0]->password ?? null;
        return Hash::check($password, $hashshedPassword);
    }

    public function authorize(string $email)
    {
        //session_start();
        //$_SESSION['currentUser'] = $email;
    }

}