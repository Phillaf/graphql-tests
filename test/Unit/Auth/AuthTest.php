<?php

namespace App\Test\Unit\Auth;

use App\Auth\Auth;
use App\Auth\Jwt;
use App\Auth\User;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    private $jwt;

    public function setUp()
    {
        $this->jwt = new Jwt('this-is-the-key');
        $this->auth = new Auth($this->jwt);
    }

    /** @test */
    public function unParsableToken()
    {
        $user = $this->auth->getUser("");
        $this->assertFalse($user->authenticated());
    }

    /** @test */
    public function invalidToken()
    {
        $jwt = new Jwt('different-key');
        $token = $jwt->create(time());

        $user = $this->auth->getUser($token);
        $this->assertFalse($user->authenticated());
    }

    /** @test */
    public function noEmailClaim()
    {
        $expiration = strtotime('+1 day', time());
        $token = $this->jwt->create($expiration, []);
        $user = $this->auth->getUser($token);
        $this->assertFalse($user->authenticated());
    }

    /** @test */
    public function authSuccess()
    {
        $expiration = strtotime('+1 day', time());
        $token = $this->jwt->create($expiration, ['email' => 'phil@phillafrance.com']);
        $user = $this->auth->getUser($token);
        $this->assertTrue($user->authenticated());
    }

    /** @test */
    public function bearerStringSuccess()
    {
        $expiration = strtotime('+1 day', time());
        $token = $this->jwt->create($expiration, ['email' => 'phil@phillafrance.com']);
        $user = $this->auth->getUser("Bearer $token");
        $this->assertTrue($user->authenticated());
    }
}
