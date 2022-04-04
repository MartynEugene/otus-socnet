<?php

namespace App\Components\Userbase;

use Illuminate\Support\Facades\DB;

class InfoComponent
{
    public function exists(string $email): bool
    {
        $sql = "SELECT `ud`.`id` FROM `user_data` `ud` LEFT JOIN `users` `u` ON `u`.`id` = `ud`.`user_id` WHERE `u`.`email` = :email";
        $result = DB::select(DB::raw($sql), ['email' => $email]);
        return (bool)$result;
    }

}