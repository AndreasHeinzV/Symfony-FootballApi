<?php

declare(strict_types=1);

namespace App\Components\UserLogin\Business\Model;

use App\Components\User\Persistence\UserDto;

class Login
{
    public function __construct()
    {
    }

    public function loginUser(UserDto $userDto): bool
    {
        return true;
    }
}
