<?php

namespace App\Auth;

class Auth
{
    public static function getUser(string $user = null) : User
    {
        return new User();
    }
}
