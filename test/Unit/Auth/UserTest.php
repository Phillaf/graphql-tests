<?php

namespace App\Test\Unit\Auth;

use App\Auth\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function validEmail()
    {
        $user = new User('phil@phillafrance.com');
        $this->assertTrue($user->authenticated());
        $this->assertEquals('phil@phillafrance.com', $user->email());
    }

    /** @test */
    public function invalidEmail()
    {
        $user = new User('invalid');
        $this->assertFalse($user->authenticated());
        $this->assertEquals('', $user->email());
    }
}
