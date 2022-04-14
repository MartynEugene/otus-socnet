<?php

namespace App\Components\Userbase;

use Illuminate\Support\Facades\DB;

use App\Components\Userbase\InfoComponent;

class UserComponent
{
    public function listOtherUsers(string $email): array
    {
        $sql = "SELECT
                    `u`.`id`,
                    `u`.`email`,
                    `ud`.`first_name`,
                    `ud`.`last_name`,
                    `ud`.`city`,
                    `ud`.`gender`,
                    `ud`.`hobbies`,
                    (CASE
                        WHEN `f1`.`id` IS NOT NULL AND `f2`.`id` IS NOT NULL THEN 'both'
                        WHEN `f1`.`id` IS NOT NULL THEN 'proposed'
                        WHEN `f2`.`id` IS NOT NULL THEN 'incoming'
                        ELSE 'none'
                    END) `is_friend`
                FROM `user_data` `ud`
                LEFT JOIN `users` `u` ON `u`.`id` = `ud`.`user_id`
                LEFT JOIN `friendship` `f1` ON `f1`.`friend` = `u`.`id`
                LEFT JOIN `friendship` `f2` ON `f2`.`friend_to` = `u`.`id`
                WHERE `u`.`email` != :email";

        $result = DB::select(DB::raw($sql), ['email' => $email]);
        if (empty($result)) {
            return [];
        }

        $result = array_map(function ($value) {
            return (array)$value;
        }, $result);

        return $result;
    }

    private function checkFriendshipStatus()
    {
        // TODO: Check friendship status
    }
}