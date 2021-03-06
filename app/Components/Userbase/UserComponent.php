<?php

namespace App\Components\Userbase;

use Illuminate\Support\Facades\DB;

use App\Components\Userbase\InfoComponent;

class UserComponent
{
    public function listOtherUsers(string $email, bool $onlyFriends = false): array
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

        if ($onlyFriends) {
            $sql .= " AND `f1`.`id` IS NOT NULL AND `f2`.`id` IS NOT NULL";
        }

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
        $sql = "INSERT INTO `friendship` (`friend`, `friend_to`) VALUES (:friend, :friend_to)";
        return DB::statement(Db::raw($sql), compact('friend', 'friend_to'));
    }

    public function acceptFriend(int $friend, int $friend_to): bool
    {
        $sql = "INSERT INTO `friendship` (`friend`, `friend_to`) VALUES (:friend, :friend_to)";
        return DB::statement(Db::raw($sql), compact('friend', 'friend_to'));
    }

    public function deleteFriend(int $friend, int $friend_to): bool
    {
        $sql = "DELETE FROM `friendship` WHERE `friend` = :friend AND `friend_to` = :friend_to";
        return DB::statement(Db::raw($sql), compact('friend', 'friend_to'));
    }

    public function friendshipStatus(int $friend, int $friend_to): string
    {
        $sql = "SELECT CASE WHEN `id` IS NOT NULL THEN 'sent' ELSE 0 END AS `relationship` FROM `friendship`
            WHERE (`friend` = $friend AND `friend_to` = $friend_to)
        UNION ALL
        SELECT CASE WHEN `id` IS NOT NULL THEN 'received' ELSE 0 END AS `relationship` FROM `friendship`
            WHERE (`friend` = $friend_to AND `friend_to` = $friend);";

        $result = DB::select($sql);

        $statusTable =  [
            'sent' => !empty($result[0]->relationship),
            'recieved' => !empty($result[1]->relationship),
        ];

        if ($statusTable['sent'] && $statusTable['recieved']) {
            return 'both';
        }

        if (!$statusTable['sent'] && $statusTable['recieved']) {
            return 'incoming';
        }

        if ($statusTable['sent'] && !$statusTable['recieved']) {
            return 'proposed';
        }

        return 'none';
    }
}