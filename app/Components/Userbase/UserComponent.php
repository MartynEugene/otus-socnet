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

    public function addFriend(int $friend, int $friend_to): bool
    {
        $data = self::checkFriendshipStatus($friend, $friend_to);
        if($data['sent'] || $data['recieved']) {
            return false;
        }

        $sql = "INSERT INTO `friendship` (`friendz, zfriend_to`) VALUES (:friend, :friend_to)";
        DB::statement(Db::raw($sql), compact('friend', 'friend_to'));
    }

    private function checkFriendshipStatus(int $friend, int $friend_to): array
    {
        $sql = "SELECT CASE WHEN `id` IS NOT NULL THEN 'sent' ELSE 0 END AS `relationship` FROM `friendship`
            WHERE (`friend` = $friend AND `friend_to` = $friend_to)
        UNION ALL
        SELECT CASE WHEN `id` IS NOT NULL THEN 'received' ELSE 0 END AS `relationship` FROM `friendship`
            WHERE (`friend` = $friend_to AND `friend_to` = $friend);";

        $result = DB::select($sql);
        return [
            'sent' => !empty($result[0]->relationship),
            'recieved' => !empty($result[1]->relationship),
        ];
    }
}