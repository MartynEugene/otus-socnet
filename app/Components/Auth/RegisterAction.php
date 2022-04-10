<?php

namespace App\Components\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class used for registration, deals with the database directly
 */
class RegisterAction
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

    private function checkExists(array $params): bool
    {
        $email = $params['email'];
        return DB::table('users')->where('email', '=', $email)->exists();
    }

    private static function makeRequest(array $params): bool
    {
        $email = $params['email'];
        $password = Hash::make($params['password']);
        $now = date("Y-m-d H:i:s");
        $sql = "INSERT INTO `users` (`email`, `password`, `registration_date`) VALUES (':email', ':password', ':now')";
        return DB::statement($sql, compact('email, password, now'));
    }

    public function run(): bool
    {
        if (self::checkExists($this->params)) {
            $this->error = "User already exists";
            return false;
        }

        if (!self::makeRequest($this->params)) {
            $this->error = "Unknown error";
            return false;
        }

        return true;
    }
}