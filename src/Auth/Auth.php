<?php

namespace App\Auth;

use Lcobucci\JWT\Parser;

class Auth
{
    private $claim;
    private $jwt;

    public function __construct(
        Jwt $jwt,
        string $claim = null
    ) {
        $this->jwt = $jwt;
        $this->claim = $claim ?? 'email';
    }

    public function getUser(string $tokenString)
    {
        if (preg_match('/Bearer\s(\S+)/', $tokenString, $matches)) {
            $tokenString = $matches[1];
        }

        try {
            $token = (new Parser())->parse($tokenString);
        } catch (\InvalidArgumentException $e) {
            return new User();
        }

        if (!$this->jwt->accept($token)) {
            return new User();
        }

        try {
            $email = $token->getClaim($this->claim, null);
        } catch (\OutOfBoundsException $e) {
            return new User();
        }

        return new User($email);
    }
}
