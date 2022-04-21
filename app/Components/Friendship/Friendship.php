<?php

namespace App\Components\Friendship;

enum FriendshipState
{
    case Both;
    case Sent;
    case Recieved;
    case None;

    public function string(): string
    {
        return match($this)
        {
            self::Both => 'both',
            self::Sent => 'sent',
            self::Recieved => 'recieved',
            self::None => 'none',
        };
    }
};
