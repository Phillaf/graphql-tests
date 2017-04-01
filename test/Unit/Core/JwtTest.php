<?php

namespace App\Test\Unit\Core;

use App\Auth\Jwt;
use PHPUnit\Framework\TestCase;

class JwtTest extends TestCase
{
    /** @test */
    public function create()
    {
        $token = Jwt::create(['hello' => 'dude']);
        $this->assertTrue(Jwt::verify($token));
    }
}
