<?php

namespace App\Auth;

class User
{
    private $email = '';
    private $authenticated = false;

    public function __construct(string $email = null)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
            $this->authenticated = true;
        }
    }

    public function authenticated() : bool
    {
        return $this->authenticated;
    }

    public function email() : string
    {
        return $this->email;
    }
}
