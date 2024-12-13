<?php

declare(strict_types=1);

namespace App\Components\UserLogin\Business;

use App\Components\User\Persistence\UserDto;
use App\Components\UserLogin\Business\Model\Login;

readonly class UserLoginFacade implements UserLoginFacadeInterface
{
    public function __construct(private Login $login)
    {
    }

    public function loginUser(UserDto $userDto): bool
    {
        return $this->login->loginUser($userDto);
    }
}
