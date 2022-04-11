<?php

namespace App\Components\Userbase;

use Illuminate\Support\Facades\DB;

class UserComponent
{
    public function listOtherUsers(string $email): array
    {
        $sql = "SELECT * FROM `user_data` `ud` LEFT JOIN `users` `u` ON `u`.`id` = `ud`.`user_id` WHERE `u`.`email` != :email";
        $result = DB::select(DB::raw($sql), ['email' => $email]);
        if (empty($result)) {
            return [];
        }

        $result = array_map(function ($value) {
            return (array)$value;
        }, $result);

        return $result;
    }
}