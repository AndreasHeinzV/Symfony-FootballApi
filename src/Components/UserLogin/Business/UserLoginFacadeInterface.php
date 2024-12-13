<?php

namespace App\Components\UserLogin\Business;

use App\Components\User\Persistence\UserDto;

interface UserLoginFacadeInterface
{
    public function loginUser(UserDto $userDto): bool;
}
