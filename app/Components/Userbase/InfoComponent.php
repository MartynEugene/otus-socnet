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

    public function editInfo(string $email, array $info): bool
    {
        $user_id = $this->getUserId($email);
        $statement = DB::table('user_data');
        if ($this->exists($email)) {
            $statement->where(['user_id' => $user_id])->update($this->prepareParams($info));
        } else {
            $insert = $this->prepareParams($info);
            $insert['user_id'] = $user_id;
            $statement->insert($insert);
        }
        return true;
    }

    public function getUserId(string $email): ?int
    {
        $select = DB::select(DB::raw("SELECT `id` FROM `users` WHERE `email` = :email"), ['email' => $email]);
        return $select[0]->id ?? null;
    }

    public function getUserData(string $email): array
    {
        $sql = "SELECT `ud`.* FROM `users` `u` JOIN `user_data` `ud` ON `u`.`id` = `ud`.`user_id` WHERE `email` = :email";
        $select = DB::select(DB::raw($sql), ['email' => $email]);
        return !empty($select[0]) ? (array)$select[0] : [];
    }

    private function prepareParams(array $params): array
    {
        $first_name = $params['firstname'];
        $last_name = $params['lastname'];
        $city = $params['city'] ?? null;
        $gender = $params['gender'];
        $hobbies = $params['hobbies'] ?? null;
        return compact('first_name', 'last_name', 'city', 'gender', 'hobbies');
    }
}