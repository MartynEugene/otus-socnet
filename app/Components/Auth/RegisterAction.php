<?php

namespace App\Components\Auth;

/**
 * Class used for registration, deals with the database directly
 */
class RegisterAction
{
    private array $params;

    public function setParams(array $params): void
    {
        $this->params = $params;
    }


}