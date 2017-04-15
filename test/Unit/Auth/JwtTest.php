<?php

namespace App\Test\Unit\Core;

use App\Auth\Jwt;
use Lcobucci\JWT\ValidationData;
use PHPUnit\Framework\TestCase;
use Lcobucci\JWT\Signer\Hmac\Sha512;

class JwtTest extends TestCase
{
    private $key = 'this-is-the-key';
    private $data = ['hello' => 'world'];
    private $expiration;

    public function setUp()
    {
        $this->expiration = strtotime('+1 minute', time());

        $this->validation = new ValidationData;
        $this->validation->setIssuer('some-issuer');
    }

    /** @test */
    public function simple()
    {
        $jwt = new Jwt($this->key);
        $token = $jwt->create($this->expiration, $this->data);
        $this->assertTrue($jwt->accept($token));
    }

    /** @test */
    public function customValidationSuccess()
    {
        $jwt = new Jwt($this->key, $this->validation);

        $token = $jwt->create($this->expiration, $this->data);
        $this->assertTrue($jwt->accept($token));
    }

    /** @test */
    public function customValidationFailure()
    {
        $jwt = new Jwt($this->key);
        $differentJwt = new Jwt($this->key, $this->validation);

        $token = $jwt->create($this->expiration, $this->data);
        $this->assertFalse($differentJwt->accept($token));
    }

    /** @test */
    public function customSignerSuccess()
    {
        $jwt = new Jwt($this->key, null, new Sha512);

        $token = $jwt->create($this->expiration, $this->data);
        $this->assertTrue($jwt->accept($token));
    }

    /** @test */
    public function customSignerFailure()
    {
        $jwt = new Jwt($this->key);
        $differentJwt = new Jwt($this->key, null, new Sha512);

        $token = $jwt->create($this->expiration, $this->data);
        $this->assertFalse($differentJwt->accept($token));
    }
}
